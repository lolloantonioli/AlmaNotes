-- *********************************************
-- * Standard SQL generation                   
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Fri Dec 12 14:27:09 2025 
-- * LUN file: C:\Users\lorenzo.antonioli2\Desktop\ALMANOTES.lun 
-- * Schema: AlmaNotes Logica/SQL 
-- ********************************************* 


-- Database Section
-- ________________ 
create database almanotes;


-- DBSpace Section
-- _______________


-- Tables Section
-- _____________ 

create table CORSO_DI_LAUREA (
     Codice varchar(255) not null,
     Nome varchar(255) not null,
     Campus varchar(255) not null,
     Ambito varchar(255) not null,
     Tipologia varchar(255) not null,
     Lingua varchar(255) not null,
     constraint ID_CORSO_DI_LAUREA_ID primary key (Codice));

create table INSEGNAMENTO (
     Codice varchar(255) not null,
     Nome varchar(255) not null,
     Lingua varchar(255) not null,
     Corso_di_laurea varchar(255) not null,
     constraint ID_INSEGNAMENTO_ID primary key (Codice));

create table PROFESSORE (
     Codice varchar(255) not null,
     Nome varchar(255) not null,
     constraint ID_PROFESSORE_ID primary key (Codice));

create table Tenere (
     Insegnamento varchar(255) not null,
     Professore varchar(255) not null,
     constraint ID_Tenere_ID primary key (Professore, Insegnamento));


-- Constraints Section
-- ___________________ 

alter table CORSO_DI_LAUREA add constraint ID_CORSO_DI_LAUREA_CHK
     check(exists(select * from INSEGNAMENTO
                  where INSEGNAMENTO.Corso_di_laurea = Codice)); 

alter table INSEGNAMENTO add constraint ID_INSEGNAMENTO_CHK
     check(exists(select * from Tenere
                  where Tenere.Insegnamento = Codice)); 

alter table INSEGNAMENTO add constraint EQU_INSEG_CORSO_FK
     foreign key (Corso_di_laurea)
     references CORSO_DI_LAUREA;

alter table Tenere add constraint REF_Tener_PROFE
     foreign key (Professore)
     references PROFESSORE;

alter table Tenere add constraint EQU_Tener_INSEG_FK
     foreign key (Insegnamento)
     references INSEGNAMENTO;


-- Index Section
-- _____________ 

create unique index ID_CORSO_DI_LAUREA_IND
     on CORSO_DI_LAUREA (Codice);

create unique index ID_INSEGNAMENTO_IND
     on INSEGNAMENTO (Codice);

create index EQU_INSEG_CORSO_IND
     on INSEGNAMENTO (Corso_di_laurea);

create unique index ID_PROFESSORE_IND
     on PROFESSORE (Codice);

create unique index ID_Tenere_IND
     on Tenere (Professore, Insegnamento);

create index EQU_Tener_INSEG_IND
     on Tenere (Insegnamento);

