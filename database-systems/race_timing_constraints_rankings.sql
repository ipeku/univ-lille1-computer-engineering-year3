--q1 1

create table etapes(
	numero int primary key check (numero>=1),
	nom text not null
);

insert into etapes (numero, nom) values (1, 'etape 1'), 
										(2, 'etape 2'), 
										(3, 'etape 3'), 
										(4, 'etape 4');

								
--q1 2

create table temps(
	dossard int not null,
	etape int not null,
	chrono interval not null,
	id serial primary key
);

--q1 3

alter table temps add constraint dossard foreign key (dossard) references coureurs(dossard);
alter table temps add constraint etape foreign key (etape) references etapes(numero);


--q1 4

alter table temps add constraint chrono check (chrono >= interval '0' hour and chrono <= interval '6' hour);
insert into temps(dossard, etape, chrono) values(1, 1, interval '-5 hour');

--q1 5

insert into temps(dossard, etape, chrono) 
	values  (1, 1, interval '1' hour), 
			(2, 2, interval '4' hour), 
			(3, 3, interval '2' hour), 
			(4, 4, interval '5' hour), 
			(1, 2, interval '3' hour), 
			(2, 3, interval '2.5' hour), 
			(3, 4, interval '3.5' hour), 
			(5, 1, interval '1' hour);
		
--q1 6 1

create table copie_etapes as select * from etapes;
create table copie_temps as select * from temps;

--q1 6 2

delete from etapes;
--lorsque j'essaie de supprimer les données de la table etapes avec la commande delete from etapes
--une erreur se produit en raison de la contrainte de clé étrangère avec la table temps. 
--en effet, la colonne etape de la table temps dépend de la table etapes, donc je dois d'abord supprimer les enregistrements de temps avant de vider etapes.

--q1 6 3

delete from temps;
insert into temps(dossard, etape, chrono) values(5, 3, interval '2' hour);
select id from temps;

--c'est 10. ça n'a pas commencé à 0. il continue à augmenter.
--les identifiants dans la table des temps continuent d'augmenter même après la suppression et la réinsertion de données, 
--car chaque nouvelle ligne se voit automatiquement attribuer le prochain numéro disponible. 
--par ailleurs, les entrées erronées participent également à cette augmentation.

--q1 6 4

delete from temps;
alter sequence temps_id_seq restart;

--q1 6 5

delete from etapes;

--q1 6 6

insert into etapes
select * from copie_etapes;

insert into temps
select * from copie_temps;

--q1 7

create view classement_etape_1 as
select dossard, chrono, rank() over (order by chrono) as rang
from temps
where etape = 1;

create view classement_etape_2 as
select dossard, chrono, rank() over (order by chrono) as rang
from temps
where etape = 2;

--q1 8

select c.dossard, c.nom, c.equipe,
       classement_etape_1.chrono as chrono_1, classement_etape_1.rang as classement_1, 
       classement_etape_2.chrono as chrono_2, classement_etape_2.rang as classement_2
from coureurs c
left join classement_etape_1 using (dossard)
left join classement_etape_2 using (dossard);


--q1 9

select c.dossard, c.nom, c.equipe,
       classement_etape_1.chrono as chrono_1, classement_etape_1.rang as classement_1, 
       classement_etape_2.chrono as chrono_2, classement_etape_2.rang as classement_2,
       (classement_etape_1.chrono + classement_etape_2.chrono) as chrono_total
from coureurs c
left join classement_etape_1 using (dossard)
left join classement_etape_2 using (dossard);


