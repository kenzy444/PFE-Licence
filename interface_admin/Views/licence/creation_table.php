<?php
include ('traitement/config.php');


//crétion de la table ANNEXE1
$tsql10="if not exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[ANNEXE1]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
    create table [dbo].[ANNEXE1] (
    [MAT] [varchar](13) COLLATE Latin1_General_100_CI_AI_SC NULL ,
    [NAME] [varchar](100)  COLLATE Latin1_General_100_CI_AI_SC NULL ,
    [PNAME] [varchar](100) COLLATE Latin1_General_100_CI_AI_SC NULL ,
    [DN] [varchar](1000)  COLLATE Latin1_General_100_CI_AI_SC NULL ,
    [LN] [varchar](1000) COLLATE Latin1_General_100_CI_AI_SC NULL ,
    [OCODE] [varchar](1000) COLLATE Latin1_General_100_CI_AI_SC NULL ,
    [SAUV] [varchar](1000) COLLATE Latin1_General_100_CI_AI_SC NULL ,
    [MC] [real] NULL,
    [MSE] [real] NULL,
    [RANG] [int] NULL,
    [CATEGORIE] [varchar](1) COLLATE Latin1_General_100_CI_AI_SC NULL ,
    )
    ON [PRIMARY]
    ";
$getresults = $conn->prepare($tsql10)->execute();
//crétion de la table ANNEXE2
$tsql11="if not exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[ANNEXE2]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
    create table [dbo].[ANNEXE2] (
    [MAT] [varchar](13) COLLATE Latin1_General_100_CI_AI_SC NULL ,
    [ANET] [varchar](100)  COLLATE Latin1_General_100_CI_AI_SC NULL ,
    [SESSION] [varchar](100)  COLLATE Latin1_General_100_CI_AI_SC NULL ,
    [UNITE] [varchar](100)  COLLATE Latin1_General_100_CI_AI_SC NULL ,
    [INTITULE] [varchar](100)  COLLATE Latin1_General_100_CI_AI_SC NULL ,
    [CREDIT] [varchar](100)  COLLATE Latin1_General_100_CI_AI_SC NULL ,
    [OCODE] [varchar](100)  COLLATE Latin1_General_100_CI_AI_SC NULL ,
    [NOTE] [varchar](100)  COLLATE Latin1_General_100_CI_AI_SC NULL ,
    [SAUV] [varchar](100)  COLLATE Latin1_General_100_CI_AI_SC NULL ,
    )
    ON [PRIMARY]
    ";
$getresults1 = $conn->prepare($tsql11)->execute();
?>

