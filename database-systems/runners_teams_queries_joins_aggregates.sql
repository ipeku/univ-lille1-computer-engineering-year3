-- Q 1 a :
select dossard, nom 
from coureurs;

-- Q 1 b :
select dossard, nom 
from coureurs 
order by dossard asc;

-- Q 1 c :
select equipe, dossard, nom 
from coureurs 
order by equipe, nom;

-- Q 1 d :
select dossard, nom, taille 
from coureurs 
order by taille;

-- Q 1 e :
select nom, dossard 
from coureurs 
where equipe like 'LavePlusBlanc';

-- Q 1 f :
select coureurs."nom", coureurs."dossard" 
from coureurs 
where equipe like 'LavePlusBlanc';

-- Q 1 g :
select nom, taille, equipe 
from coureurs 
where taille < 180;

-- Q 1 h :
select nom, taille, equipe 
from coureurs 
where taille < 180 
order by taille asc;

-- Q 1 i :
select couleur 
from equipes;

-- Q 2 a :
select nom || ' appartient à l''équipe ' || equipe 
from coureurs;

-- Q 2 b :
select nom || ' appartient à l''équipe ' || equipe as "appartenance" 
from coureurs;

-- Q 2 c :
select upper(nom) as "nom maj", length(nom) as "lg" 
from coureurs;

-- Q 2 d :
select upper(nom), length(nom) 
from coureurs 
order by length(nom);
select upper(nom) as "nom maj", length(nom) as "lg" 
from coureurs 
order by length(nom);

-- Q 2 e :
select dossard, initcap(nom), upper(substring(equipe, 1, 3)) 
from coureurs;


-- Q 3 a :
select nom 
from coureurs 
where nom like 'a%';

-- Q 3 b :
select nom 
from coureurs 
where nom like '%er%';

-- Q 3 c :
select nom 
from coureurs 
where nom like '_____';

-- Q 3 d :
select nom 
from coureurs 
where nom like '%a__';

-- Q 3 e :
select nom 
from coureurs 
where nom like '%a__%';

-- Q 4 a :
select taille / 100 
from coureurs;
--Cette requête retourne les tailles des coureurs divisées par 100, mais sans les chiffres après la virgule. 
--Dans la division, le type de données des colonnes est un "int". En SQL, la division entre deux entiers retourne un entier. 
--Ainsi, la partie décimale du résultat est supprimée.

-- Q 4 b :
select taille / 100.0 
from coureurs;
--Cette fois, lorsque le nombre sera divisé, la partie fractionnaire après la virgule figurera également dans le résultat, 
--mais il n'est pas certain que l'on verra toujours exactement deux chiffres après la virgule, comme le demande l'énoncé.

-- Q 4 c :
select cast (taille as float) / 100 
from coureurs;

-- Q 4 d :
select trunc(taille, 2)/100 
from coureurs;

--Q 5 a : 
--La condition de jointure pertinente est coureurs.equipe = equipes.nom, 
--Elle relie la colonne equipe de la table coureurs à la colonne nom de la table equipes, 
--permettant ainsi de combiner les informations des coureurs avec celles de leurs équipes.

-- Q 5 b :
select coureurs.dossard, coureurs.nom, equipes.nom, equipes.couleur 
from coureurs 
join equipes on coureurs.equipe = equipes.nom;

-- Q 5 c :
select coureurs.nom, equipes.directeur 
from coureurs 
join equipes on coureurs.equipe = equipes.nom;

-- Q 5 d :
select coureurs.nom, coureurs.dossard 
from coureurs 
join equipes on coureurs.equipe = equipes.nom 
where equipes.directeur = 'Ralph';

-- Q 5 e :
select equipes.directeur 
from coureurs 
join equipes on coureurs.equipe = equipes.nom 
where coureurs.nom = 'alphonse';

-- Q 6 a :
insert into equipes (nom, couleur, directeur) values ('TeamWow', 'Rouge', 'Jean');

-- Q 6 b :
insert into coureurs (dossard, nom, equipe, taille) values (8, 'emily', 'TeamWow', 176), (9, 'gabriel', 'TeamWow', 182);

-- Q 7 a :
insert into equipes (couleur, nom) values ('orange', 'Nouvelle Équipe');

select * from equipes 
where directeur is null;

-- Q 7 b :
select * from equipes 
where directeur is not null;

-- Q 8 a :
update coureurs 
set taille = taille - 1 
where equipe = 'PicsouBank';

-- Q 8 b :
update equipes 
set directeur = 'Pierre' 
where directeur is null;

-- Q 9 1 :
select max(taille) as "taille maxi", trunc(avg(taille),1) as "taille moyenne" 
from coureurs;

-- Q 9 2 :
select max(taille) as "taille maxi", trunc(avg(taille),1) as "taille moyenne", count(*) as "nombre de coureurs" 
from coureurs;

-- Q 9 3 :
select count(*) as "nombre d'équipes", count(directeur) as "nombre d'équipes avec directeur" 
from equipes;

-- Q 10 1 :
create table visites (
    dossard int not null,
    quand date not null,
    primary key (dossard),
    foreign key (dossard) references coureurs (dossard)
);

insert into visites (dossard, quand)
values
	(5, '2020-08-12'),
    (2, '2020-09-03');

select c.dossard, nom, quand
from coureurs c
left join visites v on c.dossard = v.dossard 
order by c.dossard; 

-- Q 10 2 :
select c.dossard, nom
from coureurs c
left join visites v on c.dossard = v.dossard
where quand is null;

--

select dossard, nom
from coureurs
except
select c.dossard, nom
from coureurs c
join visites v on c.dossard = v.dossard;


-- TDM1 Supp:

-- Q 1 :
select max(dossard) 
from coureurs;

-- Q 2 : 

select c.dossard
from coureurs c

except 

select c2.dossard
from coureurs c 
cross join coureurs c2 
where c2.dossard < c.dossard ;

-- Q 3 :

select nom
from  coureurs 
where dossard = (select max(dossard) from coureurs);

-- Q 4 :
select nom
from  coureurs c
except 
select c1.nom
from coureurs c1
join coureurs c2
on c1.dossard<c2.dossard;

-- Q 5 :
select a.nom || ' ' || r.nom as noms,
a.dossard || ' ' || r.dossard as dossards
from coureurs a
join coureurs r
on a.equipe = r.equipe and a.dossard < r.dossard
order by a.equipe;

--J'ai voulu écrire une deuxième version au cas où je n'aurais pas bien compris la question en français
--Dans cette version, il y a précisément les couples où il n'y a que deux personnes dans leurs équipes:
/*select a.nom || ' ' || y.nom as noms,
a.dossard || ' ' || y.dossard as dossards
from coureurs a
join coureurs y
on a.equipe = y.equipe and a.dossard < y.dossard
left join coureurs c
on a.equipe = c.equipe and c.dossard != a.dossard and c.dossard != y.dossard
where c.equipe is null
order by a.equipe;*/

-- Q 6 :
select c1.nom || ' ' || c2.nom || ' ' || c3.nom as noms,
c1.dossard || ' ' || c2.dossard || ' ' || c3.dossard as dossards
from coureurs c1
join coureurs c2 
on c1.equipe = c2.equipe and c1.dossard < c2.dossard
join coureurs c3 
on c2.equipe = c3.equipe and c2.dossard < c3.dossard
order by c1.equipe;

--J'ai voulu écrire une deuxième version au cas où je n'aurais pas bien compris la question en français
--Dans cette version, il y a précisément les couples où il n'y a que trois personnes dans leurs équipes:
/*select s.nom || ' ' || k.nom || ' ' || e.nom as noms,
s.dossard || ' ' || k.dossard || ' ' || e.dossard as dossards
from coureurs s
join coureurs k
on s.equipe = k.equipe and s.dossard < k.dossard
join coureurs e
on s.equipe = e.equipe and k.dossard < e.dossard
left join coureurs dernier
on e.equipe = dernier.equipe and e.dossard < dernier.dossard
where e.dossard is not null and dernier.dossard is null
order by s.equipe;*/

-- Q 7 :

select c1.nom as "nom 1", c2.nom as "nom 2", c3.nom as "nom 3",
c1.dossard as "dossard 1", c2.dossard as "dossard 2", c3.dossard as "dossard 3"
from  coureurs c1
left join coureurs c2 
on c1.equipe = c2.equipe and c1.dossard < c2.dossard
left join coureurs c3 on c2.equipe = c3.equipe and c2.dossard < c3.dossard
order by c3.equipe, c2.equipe, c1.equipe;