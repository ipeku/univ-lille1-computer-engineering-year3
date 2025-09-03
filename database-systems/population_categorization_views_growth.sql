--q1 1:

SELECT *,
       TRUNC(superficie / 5) + 1 AS cat_sup
FROM communes;


--q1 2:

SELECT TRUNC(superficie / 5) + 1 AS cat_sup,
       COUNT(*) AS nombre_communes,
       AVG(superficie) AS superficie_moyenne
FROM communes
GROUP BY cat_sup
ORDER BY cat_sup;


--q1 3:

SELECT c.*, 
       TRUNC(c.superficie / 5) + 1 AS cat_sup,
       TRUNC(p.pop_totale / 1000) + 1 AS cat_pop,
       p.pop_totale AS pop_2016
FROM communes c
JOIN population p ON c.insee = p.insee
WHERE p.recensement = 2016;

--q1 4:
--a)
SELECT TRUNC(p.pop_totale / 1000) + 1 AS cat_pop,
       COUNT(*) AS nombre_communes,
       MIN(c.superficie) AS superficie_min,
       MAX(c.superficie) AS superficie_max,
       ROUND(AVG(c.superficie), 2) AS superficie_moyenne
FROM communes c
JOIN population p ON c.insee = p.insee
GROUP BY cat_pop
ORDER BY cat_pop;


--b)
SELECT TRUNC(p.pop_totale / 1000) + 1 AS cat_pop,
       COUNT(*) AS nombre_communes,
       MIN(c.superficie) AS superficie_min,
       MAX(c.superficie) AS superficie_max,
       ROUND(AVG(c.superficie), 2) AS superficie_moyenne
FROM communes c
JOIN population p ON c.insee = p.insee
GROUP BY cat_pop
HAVING COUNT(*) > 5
ORDER BY nombre_communes DESC;


--q2 1:

CREATE VIEW comm_2016 AS
SELECT c.*, 
       TRUNC(c.superficie / 5) + 1 AS cat_sup,
       TRUNC(p.pop_totale / 1000) + 1 AS cat_pop,
       p.pop_totale AS pop_2016
FROM communes c
JOIN population p ON c.insee = p.insee
WHERE p.recensement = 2016;

--

SELECT 
    cat_pop,
    COUNT(*) AS nombre_communes,
    MIN(c.superficie) AS superficie_min,
    MAX(c.superficie) AS superficie_max,
    ROUND(AVG(c.superficie), 2) AS superficie_moyenne
FROM 
    comm_2016 c
JOIN 
    population p ON c.insee = p.insee
WHERE 
    p.recensement = 2016
GROUP BY 
    cat_pop
ORDER BY 
    cat_pop;
   
--
   
SELECT 
    cat_pop,
    COUNT(*) AS nombre_communes,
    MIN(c.superficie) AS superficie_min,
    MAX(c.superficie) AS superficie_max,
    ROUND(AVG(c.superficie), 2) AS superficie_moyenne
FROM 
    comm_2016 c
JOIN 
    population p ON c.insee = p.insee
WHERE 
    p.recensement = 2016
GROUP BY 
    cat_pop
HAVING 
    COUNT(*) > 5
ORDER BY 
    nombre_communes DESC;

--q3:
   
SELECT 
    c.insee,                                        
    c.nom,                                           
    p2012.pop_totale AS pop_2012,                     
    p2016.pop_totale AS pop_2016,                     
    (round(p2016.pop_totale - p2012.pop_totale) / p2012.pop_totale)*100 AS pourcentage_progression  
FROM 
    communes c
JOIN 
    population p2012 ON c.insee = p2012.insee         
    AND p2012.recensement = 2012                      
JOIN 
    population p2016 ON c.insee = p2016.insee         
    AND p2016.recensement = 2016                      
WHERE 
    p2012.pop_totale > 0                              
ORDER BY 
    pourcentage_progression ASC;                     


