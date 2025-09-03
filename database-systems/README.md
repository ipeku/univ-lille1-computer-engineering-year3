# 📚 Database Systems Coursework – Université de Lille 1

This repository contains my SQL coursework for the **Database Systems** class at Université de Lille 1.  
It includes practical exercises on relational modeling, SQL querying, schema design, and database normalization.  

---

## 📂 Repository Structure

Each `.sql` file corresponds to a specific exercise set:

1. **Commune & Population Analysis**  
   [`communes_population_pollutants_queries.sql`](communes_population_pollutants_queries.sql)  
   - Queries on communes, population, stations, and pollutant measurements  
   - Filtering, ordering, joins, aggregations, and cross joins  

2. **Population Categorization & Growth**  
   [`population_categorization_views_growth.sql`](population_categorization_views_growth.sql)  
   - Categorization by area and population  
   - Creation of `comm_2016` view  
   - Population growth calculation between 2012 and 2016  

3. **Race Timing & Rankings**  
   [`race_timing_constraints_rankings.sql`](race_timing_constraints_rankings.sql)  
   - Schema design for race stages (`etapes`, `temps`)  
   - Primary/foreign key constraints, checks, and sequence management  
   - Rankings using `RANK()` window function  
   - Stage results and total chrono per runner  

4. **School Schema & Normalization**  
   [`school_schema_normalization_import.sql`](school_schema_normalization_import.sql)  
   - Conceptual model: Nature, Region, Académie, Département, Commune, Établissement  
   - Primary/foreign keys and referential integrity  
   - Data loading from `importation` with `DISTINCT`  

5. **Runners & Teams Practice**  
   [`runners_teams_queries_joins_aggregates.sql`](runners_teams_queries_joins_aggregates.sql)  
   - Basic SELECT and ORDER BY queries  
   - String operations (`UPPER`, `INITCAP`, `SUBSTRING`)  
   - Pattern matching with `LIKE`  
   - Arithmetic, casting, and truncation  
   - Joins between runners and teams  
   - Data manipulation (`INSERT`, `UPDATE`)  
   - Aggregations and statistics  
   - Left joins, anti-joins (`EXCEPT`), and self-joins for pairs/triples  

---

## 🛠️ Concepts Covered

- ✅ Relational schema design  
- ✅ Primary & foreign keys, constraints, and sequences  
- ✅ Data manipulation (INSERT, UPDATE, DELETE)  
- ✅ Joins (INNER, LEFT, CROSS)  
- ✅ Aggregations (`COUNT`, `AVG`, `MAX`, `MIN`, `HAVING`)  
- ✅ Window functions (`RANK`)  
- ✅ Normalization and referential integrity  
- ✅ Views for reusable queries  

---

