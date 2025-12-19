-- *********************************************
-- * Standard SQL generation                   
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Fri Dec 19 16:00:20 2025 
-- * LUN file: C:\Users\anton\OneDrive\Desktop\AlmaNotes\ALMANOTES.lun 
-- * Schema: AlmanotesLogicaVera/SQL1 
-- ********************************************* 


-- Database Section
-- ________________ 

create database AlmanotesLogicaVera;


-- DBSpace Section
-- _______________


-- Tables Section
-- _____________ 

create table APPUNTI (
     Codice char(1) not null,
     Nome char(1) not null,
     File char(1) not null,
     Download numeric(1) not null,
     Data date not null,
     Professore char(1) not null,
     Utente char(1) not null,
     constraint ID_APPUNTI_ID primary key (Codice));

create table CORSO_DI_LAUREA (
     Codice char(1) not null,
     Nome char(1) not null,
     Campus char(1) not null,
     Ambito char(1) not null,
     Tipologia char(1) not null,
     Lingua char(1) not null,
     constraint ID_CORSO_DI_LAUREA_ID primary key (Codice));

create table INSEGNAMENTO (
     Codice char(1) not null,
     Nome char(1) not null,
     Lingua char(1) not null,
     Corso_di_laurea char(1) not null,
     constraint ID_INSEGNAMENTO_ID primary key (Codice));

create table PROFESSORE (
     Codice char(1) not null,
     Nome char(1) not null,
     constraint ID_PROFESSORE_ID primary key (Codice));

create table Recensione (
     Utente char(1) not null,
     Stelle numeric(1) not null,
     Appunti char(1) not null,
     constraint ID_Recen_UTENT_ID primary key (Utente));

create table Scarica (
     Appunti char(1) not null,
     Utente char(1) not null,
     constraint ID_Scarica_ID primary key (Utente, Appunti));

create table Tenere (
     Insegnamento char(1) not null,
     Professore char(1) not null,
     constraint ID_Tenere_ID primary key (Professore, Insegnamento));

create table UTENTE (
     Username char(1) not null,
     Email char(1) not null,
     Password char(1) not null,
     constraint ID_UTENTE_ID primary key (Username));


-- Constraints Section
-- ___________________ 

alter table APPUNTI add constraint REF_APPUN_PROFE_FK
     foreign key (Professore)
     references PROFESSORE;

alter table APPUNTI add constraint REF_APPUN_UTENT_FK
     foreign key (Utente)
     references UTENTE;

alter table CORSO_DI_LAUREA add constraint ID_CORSO_DI_LAUREA_CHK
     check(exists(select * from INSEGNAMENTO
                  where INSEGNAMENTO.Corso_di_laurea = Codice)); 

alter table INSEGNAMENTO add constraint ID_INSEGNAMENTO_CHK
     check(exists(select * from Tenere
                  where Tenere.Insegnamento = Codice)); 

alter table INSEGNAMENTO add constraint EQU_INSEG_CORSO_FK
     foreign key (Corso_di_laurea)
     references CORSO_DI_LAUREA;

alter table Recensione add constraint ID_Recen_UTENT_FK
     foreign key (Utente)
     references UTENTE;

alter table Recensione add constraint REF_Recen_APPUN_FK
     foreign key (Appunti)
     references APPUNTI;

alter table Scarica add constraint REF_Scari_UTENT
     foreign key (Utente)
     references UTENTE;

alter table Scarica add constraint REF_Scari_APPUN_FK
     foreign key (Appunti)
     references APPUNTI;

alter table Tenere add constraint REF_Tener_PROFE
     foreign key (Professore)
     references PROFESSORE;

alter table Tenere add constraint EQU_Tener_INSEG_FK
     foreign key (Insegnamento)
     references INSEGNAMENTO;


-- Index Section
-- _____________ 

create unique index ID_APPUNTI_IND
     on APPUNTI (Codice);

create index REF_APPUN_PROFE_IND
     on APPUNTI (Professore);

create index REF_APPUN_UTENT_IND
     on APPUNTI (Utente);

create unique index ID_CORSO_DI_LAUREA_IND
     on CORSO_DI_LAUREA (Codice);

create unique index ID_INSEGNAMENTO_IND
     on INSEGNAMENTO (Codice);

create index EQU_INSEG_CORSO_IND
     on INSEGNAMENTO (Corso_di_laurea);

create unique index ID_PROFESSORE_IND
     on PROFESSORE (Codice);

create unique index ID_Recen_UTENT_IND
     on Recensione (Utente);

create index REF_Recen_APPUN_IND
     on Recensione (Appunti);

create unique index ID_Scarica_IND
     on Scarica (Utente, Appunti);

create index REF_Scari_APPUN_IND
     on Scarica (Appunti);

create unique index ID_Tenere_IND
     on Tenere (Professore, Insegnamento);

create index EQU_Tener_INSEG_IND
     on Tenere (Insegnamento);

create unique index ID_UTENTE_IND
     on UTENTE (Username);

