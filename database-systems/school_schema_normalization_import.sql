--Ex 2

--Q 2 1
/*
 
 relations proposées :
 
 Nature : cette table représentera les types d’établissements (école primaire, collège, etc.). elle comprendra un code unique pour chaque type d’établissement et le nom de cette nature.
 	
 	Nature:
 	code_nature (clé primaire)
	nature
 
 Region : cette table représentera les différentes régions. chaque région aura un code unique et un nom de région.
 	
 	Region:
 	code_reg (clé primaire)
	region
 	
 Academie : cette table représentera les académies, avec un code unique et le nom de chaque académie.
 	
 	Academie:
 	code_acad (clé primaire)
	academie
  
 Departement : les départements seront représentés dans cette table, avec un code unique, un nom de département, et une référence à l’académie à laquelle ils appartiennent.
 	
 	Departement:
 	code_dept (clé primaire)
	departement
	code_acad (clé étrangère vers Académie)
 
 Commune : cette table représentera les communes, avec un code unique, un nom de commune, et des références aux codes de région et de département correspondants.
 	
 	Commune:
 	code_commune (clé primaire)
	commune
	code_reg (clé étrangère vers Région)
	code_dept (clé étrangère vers Département)
 
 Etablissement : cette table représentera les établissements scolaires eux-mêmes, avec un code unique, un nom (appellation), une adresse, un code de nature d’établissement et une référence à la commune où il se situe.
 	
 	Etablissement:
 	code_etab (clé primaire)
	appellation
	adresse
	code_nature (clé étrangère vers Nature)
	code_commune (clé étrangère vers Commune)
 
 */
 
 --Q 2 2
 
 /*clés primaires :
 
 Nature : code_nature (clé primaire)
 Region : code_reg (clé primaire)
 Academie : code_acad (clé primaire)
 Departement : code_dept (clé primaire)
 Commune : code_commune (clé primaire)
 Etablissement : code_etab (clé primaire)
 
 */
 
 --Q 2 3
 
 /*clés étrangères :
 
 Department(code_acad) reference Academie(code_acad)
 Commune(code_reg) reference Region(code_reg)
 Commune(code_dept) reference Department(code_dept)
 Etablissement(code_nature) reference Nature(code_nature)
 Etablissement(code_commune) reference Commune(code_commune)
 
 c'est à dire:
 
 Departement : la clé étrangère code_acad référence la table académie.
 Commune : la clé étrangère code_reg référence la table région et la clé étrangère code_dept référence la table département.
 Etablissement : la clé étrangère code_nature référence la table nature et la clé étrangère code_commune référence la table commune.
 

 */


--Ex 3

--Q 3 2

create table Nature (
    code_nature text primary key,
    nature text not null
);

create table Region (
    code_reg text primary key,
    region text not null
);

create table Academie (
    code_acad text primary key,
    academie text not null
);

create table Departement (
    code_dept text primary key,
    departement text not null,
    code_acad text not null,
    foreign key (code_acad) references Academie(code_acad)  
);

create table Commune (
    code_commune text primary key,
    commune text not null,
    code_reg text not null,
    code_dept text not null,
    foreign key (code_reg) references Region(code_reg),    
    foreign key (code_dept) references Departement(code_dept)
);


create table Etablissement (
    code_etab text primary key,
    appellation text not null,
    adresse text,
    code_nature text not null,
    code_commune text not null,
    foreign key (code_nature) references Nature(code_nature),  
    foreign key (code_commune) references Commune(code_commune)  
);




--Q 3 3
insert into Nature
select distinct code_nature, nature
from importation;


insert into Region 
select distinct code_reg, region
from importation;

insert into Academie
select distinct code_acad, academie
from importation;


insert into Departement
select distinct code_dept, departement, code_acad
from importation;


insert into Commune
select distinct code_commune, commune, code_reg, code_dept
from importation;


insert into Etablissement
select distinct code_etab, appellation, adresse, code_nature, code_commune
from importation;







