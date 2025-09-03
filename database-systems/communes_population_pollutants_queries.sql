--q1.1:
select insee, nom, superficie
from communes
order by superficie desc;

--q1.2:
select insee, nom
from communes
where nom like '%Lille%';

--q1.3:
select insee, substring(insee,1, 2) as "département", nom
from communes

--q1.4: 
select c.insee, nom, recensement, pop_totale
from communes c
join population p on c.insee=p.insee
order by nom desc, recensement asc;

--q1.5: 
select c.insee, nom, pop_totale
from communes c
join population p on c.insee=p.insee
where recensement=2016
order by pop_totale desc;

--q1.6:
select c.insee, nom, pop_mun,superficie, cast ((pop_mun/superficie) as int) as "densité"
from communes c
join population p on c.insee=p.insee
where recensement=2016
order by "densité" desc;

--q2:
select c.insee, nom, pop_mun,superficie, cast ((pop_mun/superficie) as int) as "densité"
from communes c
join population p 
using (insee)
where recensement=2016
order by "densité" desc;

--q3.1:
select nom, nom_station, lat, lon
from stations s
join communes c on s.insee=c.insee 
order by nom;

--q3.2:
select nom, nom_station, lat, lon
from communes c
left join stations s on s.insee=c.insee 
order by nom;

--q4.1:
select count(code_station)
from mesures_mensuelles;

--q4.2:
select avg(valeur), max(valeur), min(valeur)
from mesures_mensuelles
where code_polluant=7;

--q4.3:
select count(valeur), avg(valeur), max(valeur), min(valeur)
from mesures_mensuelles
where code_polluant=7
group by code_station;

--q4.4:
select count(valeur), max(valeur), min(valeur), avg(valeur), nom_station
from mesures_mensuelles m
join stations c on c.code_station=m.code_station 
where code_polluant=7
group by m.code_station, c.nom_station;

--q4.5:
select count(valeur), max(valeur), min(valeur), avg(valeur), nom_station
from mesures_mensuelles m
join stations c on c.code_station=m.code_station 
where code_polluant=6001
group by  m.code_station, c.nom_station;

--q4.6:
select  count(valeur), avg(valeur), max(valeur), min(valeur), nom_station
from mesures_mensuelles m
join stations c on c.code_station=m.code_station 
where code_polluant=6001 
group by m.code_station, nom_station
having avg(valeur)>10;

--q4.7:
select code_station, code_polluant,count(valeur),avg(valeur), max(valeur), min(valeur)
from mesures_mensuelles m
group by code_station, code_polluant
order by code_polluant;

--q4.8:
select  nom_station, nom_polluant, count(valeur),  avg(valeur), max(valeur), min(valeur)
from mesures_mensuelles m
join polluants p on p.code_polluant = m.code_polluant 
join stations s on s.code_station = m.code_station 
group by nom_station, nom_polluant
order by nom_polluant;

--q5.1:
select code_station, code_polluant
from polluants
cross join stations;

--q5.2:
select s.code_station, p.code_polluant, count(mm.valeur) as nombre_mesures
from polluants p
cross join stations s
left join mesures_mensuelles mm 
using (code_station, code_polluant)
group by s.code_station, p.code_polluant
order by s.code_station, p.code_polluant;