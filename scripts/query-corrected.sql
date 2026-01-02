-- ============================================================================
-- REQUÊTE CORRIGÉE - Solution Simple (Recommandée)
-- ============================================================================
-- Cette requête trouve le prochain numéro DA disponible pour les DA externes
-- commençant par '25-'

SELECT 
    MAX(CAST(SPLIT_PART(field_numero_da_value, '-', 2) AS INTEGER)) + 1 AS prochain_numero
FROM public.drupal_node__field_numero_da AS num_da
INNER JOIN public.drupal_node__field_type_da AS type_da
    ON num_da.entity_id = type_da.entity_id
WHERE field_type_da_value = 'externe'
    AND field_numero_da_value LIKE '25-%';


-- ============================================================================
-- FONCTION - Pour une utilisation réutilisable
-- ============================================================================
-- Créer cette fonction si vous avez besoin d'appeler cette logique fréquemment

CREATE OR REPLACE FUNCTION get_next_da_number()
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

-- Utilisation de la fonction :
-- SELECT get_next_da_number();


-- ============================================================================
-- FONCTION AVEC TABLE DE RÉSULTATS - Pour des analyses plus détaillées
-- ============================================================================

CREATE OR REPLACE FUNCTION get_da_analysis()
RETURNS TABLE(
    max_numero_da TEXT,
    prochain_numero INTEGER,
    total_da_externes INTEGER
) AS $$
BEGIN
    RETURN QUERY
    SELECT 
        MAX(field_numero_da_value) AS max_numero_da,
        MAX(CAST(SPLIT_PART(field_numero_da_value, '-', 2) AS INTEGER)) + 1 AS prochain_numero,
        COUNT(*)::INTEGER AS total_da_externes
    FROM public.drupal_node__field_numero_da AS num_da
    INNER JOIN public.drupal_node__field_type_da AS type_da
        ON num_da.entity_id = type_da.entity_id
    WHERE field_type_da_value = 'externe'
        AND field_numero_da_value LIKE '25-%';
END;
$$ LANGUAGE plpgsql;

-- Utilisation de la fonction :
-- SELECT * FROM get_da_analysis();


-- ============================================================================
-- BLOC DO - Pour une exécution ponctuelle avec affichage
-- ============================================================================

DO $$
DECLARE 
    max_numero INTEGER;
    prochain_numero INTEGER;
    max_numero_da TEXT;
BEGIN
    SELECT 
        MAX(field_numero_da_value),
        MAX(CAST(SPLIT_PART(field_numero_da_value, '-', 2) AS INTEGER))
    INTO max_numero_da, max_numero
    FROM public.drupal_node__field_numero_da AS num_da
    INNER JOIN public.drupal_node__field_type_da AS type_da
        ON num_da.entity_id = type_da.entity_id
    WHERE field_type_da_value = 'externe'
        AND field_numero_da_value LIKE '25-%';
    
    prochain_numero := COALESCE(max_numero, 0) + 1;
    
    RAISE NOTICE 'Numéro DA maximum trouvé : %', max_numero_da;
    RAISE NOTICE 'Prochain numéro DA disponible : %', prochain_numero;
END $$;
