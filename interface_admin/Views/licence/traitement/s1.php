<?php
include('config.php');


$tsql4="IF NOT EXISTS(select * FROM sys.views where name = 's1')
BEGIN    
  EXEC ('
  create view s1 (mat,moy,sauv,session,cracq,anet) as select distinct mat,moy,sauv,session,CRACQ,anet from [usthb90000L].[dbo].CREDITRES c
where mat in (select MAT from intersection)
and sauv = (select max(sauv) from [usthb90000L].[dbo].CREDITRES
where mat = c.mat
and anet=1
and session in (''janv'',''rjanv'')
group by mat)
and anet=1
and session in (''janv'',''rjanv'')
  ')
END
ELSE
BEGIN
  EXEC ('
  alter view s1 (mat,moy,sauv,session,cracq,anet) as select distinct mat,moy,sauv,session,CRACQ,anet from [usthb90000L].[dbo].CREDITRES c
  where mat in (select MAT from intersection)
  and sauv = (select max(sauv) from [usthb90000L].[dbo].CREDITRES
  where mat = c.mat
  and anet=1
  and session in (''janv'',''rjanv'')
  group by mat)
  and anet=1
  and session in (''janv'',''rjanv'')
  ')
END";
$getresults = $conn->prepare($tsql4)->execute();

$tsql10="if not exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[s11]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
    create table [dbo].[s11] (
    [MAT] [varchar] (13) COLLATE Latin1_General_100_CI_AI_SC NOT NULL ,
    [MOY] [real] NULL,
    [SAUV] [int] NOT NULL ,
    [SESSION] [varchar] (50) COLLATE Latin1_General_100_CI_AI_SC NOT NULL ,
    [CRACQ] [real] NULL,
    [ANET] [int] NOT NULL ,
    )
    ON [PRIMARY]
    ";
$getresults = $conn->prepare($tsql10)->execute();

$tsql4="if not exists (select * from sysindexes
  where id=object_id('[dbo].[s11]') and name='index1') CREATE INDEX index1 ON [dbo].[s11] (mat)";
$getresults = $conn->prepare($tsql4)->execute();

$tsql11= "truncate table [usthb90000L].[dbo].[s11]";
$getresults1 = $conn->prepare($tsql11);
$getresults1->execute();

$tsql4="insert into [usthb90000L].[dbo].[s11] (mat,moy,sauv,session,cracq,anet) (select distinct mat,moy,sauv,session,CRACQ,anet from [usthb90000L].[dbo].s1 c
where mat in (select MAT from intersection)
and moy=(select max(moy) from [usthb90000L].[dbo].s1
where mat=c.mat
group by mat)
and cracq=(select max(cracq) from [usthb90000L].[dbo].s1
where mat=c.mat
and cracq>0
group by mat)
)";
$getresults = $conn->prepare($tsql4)->execute();

$tsql="update [usthb90000L].[dbo].[results] set moy1=(select max(moy) from [usthb90000L].[dbo].[s11] where [usthb90000L].[dbo].[results].mat= [usthb90000L].[dbo].[S11].mat group by mat)";
    $getresults2 = $conn->prepare($tsql);
$getresults2->execute();

$tsql="update [usthb90000L].[dbo].[results] set cracq1=(select max(cracq) from [usthb90000L].[dbo].[s11] where [usthb90000L].[dbo].[results].mat= [usthb90000L].[dbo].[S11].mat group by mat)";
    $getresults2 = $conn->prepare($tsql);
$getresults2->execute();

$tsql="update [usthb90000L].[dbo].[results] set session1=(select distinct session from [usthb90000L].[dbo].[s11] where [usthb90000L].[dbo].[results].mat= [usthb90000L].[dbo].[S11].mat and session like 'R%')";
    $getresults2 = $conn->prepare($tsql);
$getresults2->execute();
$tsql="update [usthb90000L].[dbo].[results] set session1='JANV' where session1 is NULL";
    $getresults2 = $conn->prepare($tsql);
$getresults2->execute();

$tsql="update [usthb90000L].[dbo].[results] set sauv1=(select max(sauv) from [usthb90000L].[dbo].[s11] where [usthb90000L].[dbo].[results].mat= [usthb90000L].[dbo].[S11].mat group by mat)";
    $getresults2 = $conn->prepare($tsql);
$getresults2->execute();