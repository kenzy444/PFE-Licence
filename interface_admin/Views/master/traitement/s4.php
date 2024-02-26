<?php
include('config.php');

$tsql8="IF NOT EXISTS(select * FROM sys.views where name = 's4')
BEGIN    
  EXEC ('
  create view s4 (mat,moy,sauv,session,cracq,anet) as select mat,moy,sauv,session,CRACQ,anet from [usthb90000M].[dbo].CREDITRES c
  where sauv = (select max(sauv) from [usthb90000M].[dbo].CREDITRES 
  where mat = c.mat
  and anet=2
  and session in (''JUIN'',''RJUIN'')
  group by mat)
  and anet=2
  and session in (''JUIN'',''RJUIN'')
  ')
END
ELSE
BEGIN
  EXEC ('
  alter view s4 (mat,moy,sauv,session,cracq,anet) as select mat,moy,sauv,session,CRACQ,anet from [usthb90000M].[dbo].CREDITRES c
where sauv = (select max(sauv) from [usthb90000M].[dbo].CREDITRES 
where mat = c.mat
and anet=2
and session in (''JUIN'',''RJUIN'')
group by mat)
and anet=2
and session in (''JUIN'',''RJUIN'')
  ')
END";
$getresults = $conn->prepare($tsql8)->execute();


$tsql10="if not exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[s41]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
    create table [dbo].[s41] (
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
$tsql11= "truncate table [usthb90000M].[dbo].[s41]";
$getresults1 = $conn->prepare($tsql11);
$getresults1->execute();

$tsql4="if not exists (select * from sysindexes
  where id=object_id('[dbo].[s41]') and name='index4') CREATE INDEX index4 ON [dbo].[s41] (mat)";
$getresults = $conn->prepare($tsql4)->execute();

$tsql4="insert into [usthb90000M].[dbo].[s41] (mat,moy,sauv,session,cracq,anet) (select distinct mat,moy,sauv,session,CRACQ,anet from [usthb90000M].[dbo].s4 c
where mat in (select MAT from intersection)
and moy=(select max(moy) from [usthb90000M].[dbo].s4
where mat=c.mat
group by mat)
and cracq=(select max(cracq) from [usthb90000M].[dbo].s4
where mat=c.mat
and cracq>0
group by mat)
)";
$getresults = $conn->prepare($tsql4)->execute();

$tsql="update [usthb90000M].[dbo].[results] set moy4=(select max(moy) from [usthb90000M].[dbo].[s41] where [usthb90000M].[dbo].[results].mat= [usthb90000M].[dbo].[S41].mat group by mat)";
    $getresults2 = $conn->prepare($tsql);
$getresults2->execute();

$tsql="update [usthb90000M].[dbo].[results] set cracq4=(select max(cracq) from [usthb90000M].[dbo].[s41] where [usthb90000M].[dbo].[results].mat= [usthb90000M].[dbo].[S41].mat group by mat)";
    $getresults2 = $conn->prepare($tsql);
$getresults2->execute();

$tsql="update [usthb90000M].[dbo].[results] set session4=(select distinct session from [usthb90000M].[dbo].[s41] where [usthb90000M].[dbo].[results].mat= [usthb90000M].[dbo].[S41].mat and session like 'R%')";
    $getresults2 = $conn->prepare($tsql);
$getresults2->execute();
$tsql="update [usthb90000M].[dbo].[results] set session4='JUIN' where session4 is NULL";
    $getresults2 = $conn->prepare($tsql);
$getresults2->execute();

$tsql="update [usthb90000M].[dbo].[results] set sauv4=(select max(sauv) from [usthb90000M].[dbo].[s41] where [usthb90000M].[dbo].[results].mat= [usthb90000M].[dbo].[S41].mat group by mat)";
    $getresults2 = $conn->prepare($tsql);
$getresults2->execute();