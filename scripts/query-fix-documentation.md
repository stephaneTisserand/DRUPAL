# Correction de la Query PostgreSQL

## Query Originale (Problématique)

```sql
DECLARE 
   t_curs cursor for 
      select field_numero_da_value from public.drupal_node__field_numero_da;
	  t_row text;
BEGIN
    FOR t_row in t_curs LOOP
        Select max(field_numero_da_value),Cast(SPLIT_PART(field_numero_da_value,'-',2) as Integer) + 1  FROM public.drupal_node__field_numero_da as num_da
	    INNER JOIN public.drupal_node__field_type_da as type_da
	    ON num_da.entity_id = type_da.entity_id
		WHERE field_type_da_value = 'externe'
	    AND field_numero_da_value LIKE '25-%'
		Group by field_numero_da_value;
    END LOOP;
END;
```

## Problèmes Identifiés

### 1. Déclaration incorrecte du curseur et de la variable
- **Problème** : `t_row` est déclaré comme `text` mais utilisé dans un `FOR ... IN cursor LOOP`, ce qui nécessite un type record
- **Impact** : Erreur de syntaxe, le code ne peut pas s'exécuter

### 2. SELECT sans affectation
- **Problème** : Le `SELECT` dans la boucle ne stocke pas ses résultats (pas de `INTO`)
- **Impact** : Les résultats sont calculés mais jamais utilisés ni retournés

### 3. Logique MAX avec GROUP BY incohérente
- **Problème** : `MAX(field_numero_da_value)` avec `GROUP BY field_numero_da_value` retourne simplement chaque valeur comme son propre maximum
- **Impact** : La requête ne trouve pas le maximum réel de tous les enregistrements

### 4. Données du curseur non utilisées
- **Problème** : Le curseur récupère toutes les valeurs mais ne les utilise jamais dans la boucle
- **Impact** : Inefficacité, la boucle répète la même requête plusieurs fois inutilement

### 5. Structure manquante
- **Problème** : Le code manque un wrapper `CREATE FUNCTION` ou `DO` block approprié
- **Impact** : Ne peut pas être exécuté tel quel

## Solutions Proposées

### Solution 1 : Requête Simple (Recommandée)
Si vous voulez simplement obtenir le prochain numéro DA disponible :

```sql
-- Requête simple sans boucle ni curseur
SELECT 
    MAX(CAST(SPLIT_PART(field_numero_da_value, '-', 2) AS INTEGER)) + 1 AS prochain_numero
FROM public.drupal_node__field_numero_da AS num_da
INNER JOIN public.drupal_node__field_type_da AS type_da
    ON num_da.entity_id = type_da.entity_id
WHERE field_type_da_value = 'externe'
    AND field_numero_da_value LIKE '25-%';
```

### Solution 2 : Fonction avec Curseur (Si vraiment nécessaire)
Si vous avez besoin d'une fonction qui traite les enregistrements un par un :

```sql
CREATE OR REPLACE FUNCTION get_next_da_number()
RETURNS INTEGER AS $$
DECLARE 
    t_curs CURSOR FOR 
        SELECT field_numero_da_value 
        FROM public.drupal_node__field_numero_da;
    t_row RECORD;
    max_numero INTEGER := 0;
    current_numero INTEGER;
BEGIN
    FOR t_row IN t_curs LOOP
        -- Vérifier si la valeur correspond au pattern
        IF t_row.field_numero_da_value LIKE '25-%' THEN
            -- Extraire le numéro et comparer
            current_numero := CAST(SPLIT_PART(t_row.field_numero_da_value, '-', 2) AS INTEGER);
            IF current_numero > max_numero THEN
                max_numero := current_numero;
            END IF;
        END IF;
    END LOOP;
    
    RETURN max_numero + 1;
END;
$$ LANGUAGE plpgsql;

-- Utilisation :
-- SELECT get_next_da_number();
```

### Solution 3 : Bloc DO pour Exécution Ponctuelle
Si vous voulez exécuter du code PL/pgSQL sans créer de fonction permanente :

```sql
DO $$
DECLARE 
    max_numero INTEGER;
    prochain_numero INTEGER;
BEGIN
    SELECT MAX(CAST(SPLIT_PART(field_numero_da_value, '-', 2) AS INTEGER))
    INTO max_numero
    FROM public.drupal_node__field_numero_da AS num_da
    INNER JOIN public.drupal_node__field_type_da AS type_da
        ON num_da.entity_id = type_da.entity_id
    WHERE field_type_da_value = 'externe'
        AND field_numero_da_value LIKE '25-%';
    
    prochain_numero := COALESCE(max_numero, 0) + 1;
    
    RAISE NOTICE 'Prochain numéro DA : %', prochain_numero;
END $$;
```

### Solution 4 : Fonction Retournant une Table
Si vous voulez retourner plusieurs résultats :

```sql
CREATE OR REPLACE FUNCTION get_da_analysis()
RETURNS TABLE(
    max_numero_da TEXT,
    prochain_numero INTEGER
) AS $$
BEGIN
    RETURN QUERY
    SELECT 
        MAX(field_numero_da_value) AS max_numero_da,
        MAX(CAST(SPLIT_PART(field_numero_da_value, '-', 2) AS INTEGER)) + 1 AS prochain_numero
    FROM public.drupal_node__field_numero_da AS num_da
    INNER JOIN public.drupal_node__field_type_da AS type_da
        ON num_da.entity_id = type_da.entity_id
    WHERE field_type_da_value = 'externe'
        AND field_numero_da_value LIKE '25-%';
END;
$$ LANGUAGE plpgsql;

-- Utilisation :
-- SELECT * FROM get_da_analysis();
```

## Recommandation Finale

**La Solution 1 (Requête Simple) est recommandée** car :
- ✅ Plus performante (pas de boucle inutile)
- ✅ Plus claire et facile à maintenir
- ✅ Évite les curseurs qui peuvent être lents
- ✅ Directement exécutable sans créer de fonction

Si vous avez besoin d'utiliser le résultat dans du code applicatif, utilisez simplement cette requête. Si vous devez l'intégrer dans une procédure stockée plus complexe, utilisez la Solution 3 ou 4 selon vos besoins.

## Explications Techniques

### Pourquoi éviter les curseurs ?
Les curseurs en PostgreSQL sont généralement plus lents que les opérations ensemblistes (set-based operations). Dans ce cas, la boucle ne fait rien qui ne puisse être fait plus efficacement avec une simple requête `MAX()`.

### Utilisation de COALESCE
Dans les solutions avec variables, `COALESCE(max_numero, 0)` gère le cas où aucun enregistrement n'est trouvé (retourne NULL), en retournant 0 comme valeur par défaut.

### SPLIT_PART et Cast
`SPLIT_PART(field_numero_da_value, '-', 2)` extrait la partie numérique après le tiret dans des valeurs comme '25-123'. Le `CAST(...AS INTEGER)` convertit le texte en nombre pour permettre les opérations mathématiques.
