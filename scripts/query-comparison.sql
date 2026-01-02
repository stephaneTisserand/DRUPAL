-- ============================================================================
-- REQUÊTE ORIGINALE (AVEC PROBLÈMES)
-- ============================================================================

/*
DECLARE 
   t_curs cursor for 
      select field_numero_da_value from public.drupal_node__field_numero_da;
	  t_row text;                          ❌ PROBLÈME 1: Déclaration incorrecte
BEGIN
    FOR t_row in t_curs LOOP              ❌ PROBLÈME 2: t_row devrait être un RECORD
        Select max(field_numero_da_value),Cast(SPLIT_PART(field_numero_da_value,'-',2) as Integer) + 1  FROM public.drupal_node__field_numero_da as num_da
	    INNER JOIN public.drupal_node__field_type_da as type_da
	    ON num_da.entity_id = type_da.entity_id
		WHERE field_type_da_value = 'externe'
	    AND field_numero_da_value LIKE '25-%'
		Group by field_numero_da_value;   ❌ PROBLÈME 3: MAX avec GROUP BY n'a pas de sens
                                            ❌ PROBLÈME 4: SELECT sans INTO ou RETURN
                                            ❌ PROBLÈME 5: La boucle ne sert à rien
    END LOOP;
END;                                      ❌ PROBLÈME 6: Manque le wrapper de fonction
*/

-- ============================================================================
-- DÉTAIL DES PROBLÈMES
-- ============================================================================

-- PROBLÈME 1 & 2 : Déclaration incorrecte du curseur et de la variable
-- ❌ INCORRECT :
/*
DECLARE 
   t_curs cursor for select ...;
   t_row text;  -- Type incorrect pour une boucle FOR...IN cursor
*/

-- ✅ CORRECT :
DECLARE 
   t_curs cursor for select ...;
   t_row RECORD;  -- Utiliser RECORD pour les boucles de curseur


-- PROBLÈME 3 : MAX avec GROUP BY sur la même colonne
-- ❌ INCORRECT :
/*
SELECT MAX(field_numero_da_value), ...
GROUP BY field_numero_da_value
-- Cela retourne chaque valeur comme son propre maximum
*/

-- ✅ CORRECT :
SELECT MAX(CAST(SPLIT_PART(field_numero_da_value, '-', 2) AS INTEGER)) + 1
-- Pas de GROUP BY nécessaire pour obtenir le maximum global


-- PROBLÈME 4 : SELECT sans affectation
-- ❌ INCORRECT :
/*
FOR t_row IN t_curs LOOP
    SELECT max(...) FROM ... WHERE ...;  -- Résultat perdu
END LOOP;
*/

-- ✅ CORRECT (Option A - avec INTO) :
FOR t_row IN t_curs LOOP
    SELECT max(...) INTO ma_variable FROM ... WHERE ...;
END LOOP;

-- ✅ CORRECT (Option B - RETURN QUERY pour fonction) :
FOR t_row IN t_curs LOOP
    RETURN QUERY SELECT max(...) FROM ... WHERE ...;
END LOOP;


-- PROBLÈME 5 : Boucle inutile
-- ❌ INCORRECT :
/*
FOR t_row IN t_curs LOOP
    -- Requête qui ne dépend pas de t_row
    SELECT ... FROM ... WHERE ...;
END LOOP;
-- La même requête s'exécute plusieurs fois pour rien
*/

-- ✅ CORRECT :
-- Pas de boucle du tout, juste la requête une seule fois
SELECT ... FROM ... WHERE ...;


-- PROBLÈME 6 : Structure manquante
-- ❌ INCORRECT :
/*
DECLARE ... BEGIN ... END;  -- Code orphelin
*/

-- ✅ CORRECT (Option A - Fonction) :
CREATE OR REPLACE FUNCTION ma_fonction()
RETURNS INTEGER AS $$
DECLARE ... 
BEGIN ... 
END;
$$ LANGUAGE plpgsql;

-- ✅ CORRECT (Option B - Bloc DO) :
DO $$
DECLARE ... 
BEGIN ... 
END $$;


-- ============================================================================
-- EXEMPLE DE CORRECTION COMPLÈTE
-- ============================================================================

-- Si vous vouliez vraiment utiliser un curseur (bien que non recommandé ici) :

CREATE OR REPLACE FUNCTION get_next_da_with_cursor()
RETURNS INTEGER AS $$
DECLARE 
    t_curs CURSOR FOR 
        SELECT field_numero_da_value 
        FROM public.drupal_node__field_numero_da AS num_da
        INNER JOIN public.drupal_node__field_type_da AS type_da
            ON num_da.entity_id = type_da.entity_id
        WHERE field_type_da_value = 'externe'
            AND field_numero_da_value LIKE '25-%';
    t_row RECORD;          -- ✅ RECORD au lieu de text
    max_numero INTEGER := 0;
    current_numero INTEGER;
BEGIN
    FOR t_row IN t_curs LOOP
        -- Extraire le numéro
        current_numero := CAST(SPLIT_PART(t_row.field_numero_da_value, '-', 2) AS INTEGER);
        
        -- Comparer pour trouver le maximum
        IF current_numero > max_numero THEN
            max_numero := current_numero;
        END IF;
    END LOOP;
    
    RETURN max_numero + 1;  -- ✅ Retourner le résultat
END;
$$ LANGUAGE plpgsql;


-- ============================================================================
-- MEILLEURE SOLUTION : SANS CURSEUR
-- ============================================================================
-- Les curseurs sont rarement nécessaires en SQL. Cette requête fait la même chose,
-- plus rapidement et plus simplement :

CREATE OR REPLACE FUNCTION get_next_da_optimized()
RETURNS INTEGER AS $$
DECLARE 
    max_numero INTEGER;
BEGIN
    SELECT MAX(CAST(SPLIT_PART(field_numero_da_value, '-', 2) AS INTEGER))
    INTO max_numero
    FROM public.drupal_node__field_numero_da AS num_da
    INNER JOIN public.drupal_node__field_type_da AS type_da
        ON num_da.entity_id = type_da.entity_id
    WHERE field_type_da_value = 'externe'
        AND field_numero_da_value LIKE '25-%';
    
    RETURN COALESCE(max_numero, 0) + 1;
END;
$$ LANGUAGE plpgsql;

-- OU ENCORE PLUS SIMPLE, sans fonction :
SELECT MAX(CAST(SPLIT_PART(field_numero_da_value, '-', 2) AS INTEGER)) + 1 AS prochain_numero
FROM public.drupal_node__field_numero_da AS num_da
INNER JOIN public.drupal_node__field_type_da AS type_da
    ON num_da.entity_id = type_da.entity_id
WHERE field_type_da_value = 'externe'
    AND field_numero_da_value LIKE '25-%';
