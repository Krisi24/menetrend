--bosztás
Insert into BEOSZTAS (MEGNEVEZES) values ('Kalauz');
Insert into BEOSZTAS (MEGNEVEZES) values ('Karbantartó');
Insert into BEOSZTAS (MEGNEVEZES) values ('Pénztáros');

-- dolgozok
Insert into DOLGOZOK (VEZNEV,KERNEV,FIZETES,SZEMELYISZAM,JELSZO,BEOSZTAS) values ('Cseh','Kristóf Péter','0','000001HU','123','Kalauz');
Insert into DOLGOZOK (VEZNEV,KERNEV,FIZETES,SZEMELYISZAM,JELSZO,BEOSZTAS) values ('Cseh','Kartal','0','000002HU','123','Kalauz');
Insert into DOLGOZOK (VEZNEV,KERNEV,FIZETES,SZEMELYISZAM,JELSZO,BEOSZTAS) values ('Kovács','Béla','0','000003HU','123','Kalauz');

Insert into DOLGOZOK (VEZNEV,KERNEV,FIZETES,SZEMELYISZAM,JELSZO,BEOSZTAS) values ('Cseh','Viktor','0','000011HU','123','Pénztáros');
Insert into DOLGOZOK (VEZNEV,KERNEV,FIZETES,SZEMELYISZAM,JELSZO,BEOSZTAS) values ('Orbán','Viktor','0','000012HU','123','Pénztáros');
Insert into DOLGOZOK (VEZNEV,KERNEV,FIZETES,SZEMELYISZAM,JELSZO,BEOSZTAS) values ('Orbán','László','0','000013HU','123','Pénztáros');
Insert into DOLGOZOK (VEZNEV,KERNEV,FIZETES,SZEMELYISZAM,JELSZO,BEOSZTAS) values ('Illés','Bence','0','000014HU','123','Pénztáros');
Insert into DOLGOZOK (VEZNEV,KERNEV,FIZETES,SZEMELYISZAM,JELSZO,BEOSZTAS) values ('Illés','Elemér','0','000015HU','123','Pénztáros');

Insert into DOLGOZOK (VEZNEV,KERNEV,FIZETES,SZEMELYISZAM,JELSZO,BEOSZTAS) values ('Nyúl','Béla','0','000021HU','123','Karbantartó');
Insert into DOLGOZOK (VEZNEV,KERNEV,FIZETES,SZEMELYISZAM,JELSZO,BEOSZTAS) values ('Nyúl','Beáta','0','000022HU','123','Karbantartó');
Insert into DOLGOZOK (VEZNEV,KERNEV,FIZETES,SZEMELYISZAM,JELSZO,BEOSZTAS) values ('Szekeres','Béla','0','000023HU','123','Karbantartó');
Insert into DOLGOZOK (VEZNEV,KERNEV,FIZETES,SZEMELYISZAM,JELSZO,BEOSZTAS) values ('Kovács','Péter','0','000024HU','123','Karbantartó');
-- 12 + 12 = 24
Update DOLGOZOK set FIZETES =  300300 WHERE  SZEMELYISZAM LIKE '000001HU';
Update DOLGOZOK set FIZETES =  300500 WHERE  SZEMELYISZAM LIKE '000002HU';
Update DOLGOZOK set FIZETES =  300500 WHERE  SZEMELYISZAM LIKE '000003HU';

Update DOLGOZOK set FIZETES =  250000 WHERE  SZEMELYISZAM LIKE '000011HU';
Update DOLGOZOK set FIZETES =  200000 WHERE  SZEMELYISZAM LIKE '000012HU';
Update DOLGOZOK set FIZETES =  200000 WHERE  SZEMELYISZAM LIKE '000013HU';
Update DOLGOZOK set FIZETES =  260000 WHERE  SZEMELYISZAM LIKE '000014HU';
Update DOLGOZOK set FIZETES =  260000 WHERE  SZEMELYISZAM LIKE '000015HU';

Update DOLGOZOK set FIZETES =  460200 WHERE  SZEMELYISZAM LIKE '000021HU';
Update DOLGOZOK set FIZETES =  460200 WHERE  SZEMELYISZAM LIKE '000022HU';
Update DOLGOZOK set FIZETES =  400000 WHERE  SZEMELYISZAM LIKE '000023HU';
Update DOLGOZOK set FIZETES =  400000 WHERE  SZEMELYISZAM LIKE '000024HU';
--12
/*
Update DOLGOZOK set FIZETES =  310300 WHERE  SZEMELYISZAM LIKE '000001HU';

Update DOLGOZOK set FIZETES =  300000 WHERE  SZEMELYISZAM LIKE '000011HU';
Update DOLGOZOK set FIZETES =  250000 WHERE  SZEMELYISZAM LIKE '000012HU';

Update DOLGOZOK set FIZETES =  470200 WHERE  SZEMELYISZAM LIKE '000021HU';
Update DOLGOZOK set FIZETES =  450000 WHERE  SZEMELYISZAM LIKE '000022HU';
Update DOLGOZOK set FIZETES =  470000 WHERE  SZEMELYISZAM LIKE '000022HU';*/
-- sum() = 42

--jegy típusok
Insert into JEGYEK (TIPUS,AR) values ('felnőtt','0');
Insert into JEGYEK (TIPUS,AR) values ('diák','0');
Insert into JEGYEK (TIPUS,AR) values ('nem természetes személy','0');
Insert into JEGYEK (TIPUS,AR) values ('bicikli','0');
Insert into JEGYEK (TIPUS,AR) values ('nyugdíjas','0');

UPDATE JEGYEK set AR = 90;/*
UPDATE JEGYEK set AR = 100;
-- 20fb
UPDATE JEGYEK set AR = 100 where TIPUS LIKE 'felnőtt';
UPDATE JEGYEK set AR = 50 where TIPUS LIKE 'diák';
UPDATE JEGYEK set AR = 150 where TIPUS LIKE 'nem természetes személy';
UPDATE JEGYEK set AR = 20 where TIPUS LIKE 'bicikli';
UPDATE JEGYEK set AR = 10 where TIPUS LIKE 'nyugdíjas';*/
--sum = 25
-- városok 7db
Insert into VAROSOK (NEV) values ('Budapest');
Insert into VAROSOK (NEV) values ('Felcsút');
Insert into VAROSOK (NEV) values ('Alcsút');
Insert into VAROSOK (NEV) values ('Szeged');
Insert into VAROSOK (NEV) values ('Hódmezővásárhely');
Insert into VAROSOK (NEV) values ('Kecskemét');
Insert into VAROSOK (NEV) values ('Pécs');

-- menetrend (járatok)

--BP -Felcsút
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('1','Budapest','Felcsút',to_date('2022-04-24 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-24 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('2','Budapest','Felcsút',to_date('2022-04-25 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-25 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('3','Budapest','Felcsút',to_date('2022-04-26 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-26 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('4','Budapest','Felcsút',to_date('2022-04-27 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-27 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('5','Budapest','Felcsút',to_date('2022-04-28 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-28 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('6','Budapest','Felcsút',to_date('2022-05-01 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-01 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('7','Budapest','Felcsút',to_date('2022-05-02 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-02 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('8','Budapest','Felcsút',to_date('2022-05-03 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-03 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('9','Budapest','Felcsút',to_date('2022-05-04 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-04 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('10','Budapest','Felcsút',to_date('2022-05-05 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-05 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
--10db
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('11','Felcsút','Budapest',to_date('2022-04-24 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-24 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('12','Felcsút','Budapest',to_date('2022-04-25 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-25 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('13','Felcsút','Budapest',to_date('2022-04-26 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-26 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('14','Felcsút','Budapest',to_date('2022-04-27 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-27 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('15','Felcsút','Budapest',to_date('2022-04-28 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-28 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('16','Felcsút','Budapest',to_date('2022-05-01 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-01 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('17','Felcsút','Budapest',to_date('2022-05-02 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-02 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('18','Felcsút','Budapest',to_date('2022-05-03 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-03 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('19','Felcsút','Budapest',to_date('2022-05-04 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-04 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('20','Felcsút','Budapest',to_date('2022-05-05 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-05 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
--10db

Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('21','Alcsút','Budapest',to_date('2022-04-24 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-24 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('22','Alcsút','Budapest',to_date('2022-04-25 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-25 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('23','Alcsút','Budapest',to_date('2022-04-26 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-26 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('24','Alcsút','Budapest',to_date('2022-04-27 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-27 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('25','Alcsút','Budapest',to_date('2022-04-28 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-28 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('26','Alcsút','Budapest',to_date('2022-05-01 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-01 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('27','Alcsút','Budapest',to_date('2022-05-02 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-02 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('28','Alcsút','Budapest',to_date('2022-05-03 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-03 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('29','Alcsút','Budapest',to_date('2022-05-04 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-04 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('30','Alcsút','Budapest',to_date('2022-05-05 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-05 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
--10db
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('31','Budapest','Felcsút',to_date('2022-05-24 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-24 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('32','Budapest','Felcsút',to_date('2022-05-25 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-25 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('33','Budapest','Felcsút',to_date('2022-05-26 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-26 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('34','Budapest','Felcsút',to_date('2022-05-27 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-27 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('35','Budapest','Felcsút',to_date('2022-05-28 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-28 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('36','Budapest','Felcsút',to_date('2022-06-01 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-01 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('37','Budapest','Felcsút',to_date('2022-06-02 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-02 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('38','Budapest','Felcsút',to_date('2022-06-03 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-03 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('39','Budapest','Felcsút',to_date('2022-06-04 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-04 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('40','Budapest','Felcsút',to_date('2022-06-05 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-05 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
--10db
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('41','Felcsút','Budapest',to_date('2022-05-24 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-24 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('42','Felcsút','Budapest',to_date('2022-05-25 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-25 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('43','Felcsút','Budapest',to_date('2022-05-26 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-26 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('44','Felcsút','Budapest',to_date('2022-05-27 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-27 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('45','Felcsút','Budapest',to_date('2022-05-28 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-28 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('46','Felcsút','Budapest',to_date('2022-06-01 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-01 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('47','Felcsút','Budapest',to_date('2022-06-02 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-02 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('48','Felcsút','Budapest',to_date('2022-06-03 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-03 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('49','Felcsút','Budapest',to_date('2022-06-04 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-04 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('50','Felcsút','Budapest',to_date('2022-06-05 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-05 12:45:00','yyyy-mm-dd HH24:MI:SS'),'50','100');
-- 40
-- !!!
-- BP Pécs
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('51','Budapest','Pécs',to_date('2022-04-24 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-24 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('52','Budapest','Pécs',to_date('2022-04-25 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-25 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('53','Budapest','Pécs',to_date('2022-04-26 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-26 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('54','Budapest','Pécs',to_date('2022-04-27 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-27 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('55','Budapest','Pécs',to_date('2022-04-28 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-28 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('56','Budapest','Pécs',to_date('2022-05-01 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-01 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('57','Budapest','Pécs',to_date('2022-05-02 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-02 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('58','Budapest','Pécs',to_date('2022-05-03 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-03 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('59','Budapest','Pécs',to_date('2022-05-04 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-04 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('60','Budapest','Pécs',to_date('2022-05-05 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-05 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
--10db
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('61','Pécs','Budapest',to_date('2022-04-24 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-24 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('62','Pécs','Budapest',to_date('2022-04-25 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-25 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('63','Pécs','Budapest',to_date('2022-04-26 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-26 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('64','Pécs','Budapest',to_date('2022-04-27 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-27 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('65','Pécs','Budapest',to_date('2022-04-28 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-28 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('66','Pécs','Budapest',to_date('2022-05-01 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-01 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('67','Pécs','Budapest',to_date('2022-05-02 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-02 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('68','Pécs','Budapest',to_date('2022-05-03 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-03 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('69','Pécs','Budapest',to_date('2022-05-04 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-04 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('70','Pécs','Budapest',to_date('2022-05-05 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-05 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
--10db
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('71','Budapest','Pécs',to_date('2022-05-24 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-24 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('72','Budapest','Pécs',to_date('2022-05-25 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-25 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('73','Budapest','Pécs',to_date('2022-05-26 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-26 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('74','Budapest','Pécs',to_date('2022-05-27 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-27 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('75','Budapest','Pécs',to_date('2022-05-28 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-28 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('76','Budapest','Pécs',to_date('2022-06-01 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-01 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('77','Budapest','Pécs',to_date('2022-06-02 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-02 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('78','Budapest','Pécs',to_date('2022-06-03 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-03 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('79','Budapest','Pécs',to_date('2022-06-04 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-04 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('80','Budapest','Pécs',to_date('2022-06-05 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-05 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
--10db
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('81','Pécs','Budapest',to_date('2022-05-24 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-24 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('82','Pécs','Budapest',to_date('2022-05-25 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-25 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('83','Pécs','Budapest',to_date('2022-05-26 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-26 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('84','Pécs','Budapest',to_date('2022-05-27 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-27 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('85','Pécs','Budapest',to_date('2022-05-28 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-28 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('86','Pécs','Budapest',to_date('2022-06-01 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-01 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('87','Pécs','Budapest',to_date('2022-06-02 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-02 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('88','Pécs','Budapest',to_date('2022-06-03 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-03 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('89','Pécs','Budapest',to_date('2022-06-04 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-04 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('90','Pécs','Budapest',to_date('2022-06-05 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-05 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','100');
-- 40
-- !!!

-- menetrend (járatok)
--BP Szeged
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('91','Budapest','Szeged',to_date('2022-04-24 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-24 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('92','Budapest','Szeged',to_date('2022-04-25 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-25 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('93','Budapest','Szeged',to_date('2022-04-26 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-26 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('94','Budapest','Szeged',to_date('2022-04-27 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-27 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('95','Budapest','Szeged',to_date('2022-04-28 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-28 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('96','Budapest','Szeged',to_date('2022-05-01 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-01 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('97','Budapest','Szeged',to_date('2022-05-02 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-02 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('98','Budapest','Szeged',to_date('2022-05-03 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-03 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('99','Budapest','Szeged',to_date('2022-05-04 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-04 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('100','Budapest','Szeged',to_date('2022-05-05 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-05 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
--10db
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('101','Szeged','Budapest',to_date('2022-04-24 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-24 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('102','Szeged','Budapest',to_date('2022-04-25 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-25 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('103','Szeged','Budapest',to_date('2022-04-26 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-26 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('104','Szeged','Budapest',to_date('2022-04-27 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-27 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('105','Szeged','Budapest',to_date('2022-04-28 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-04-28 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('106','Szeged','Budapest',to_date('2022-05-01 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-01 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('107','Szeged','Budapest',to_date('2022-05-02 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-02 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('108','Szeged','Budapest',to_date('2022-05-03 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-03 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('109','Szeged','Budapest',to_date('2022-05-04 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-04 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('110','Szeged','Budapest',to_date('2022-05-05 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-05 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
--10db
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('111','Budapest','Szeged',to_date('2022-05-24 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-24 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('112','Budapest','Szeged',to_date('2022-05-25 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-25 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('113','Budapest','Szeged',to_date('2022-05-26 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-26 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('114','Budapest','Szeged',to_date('2022-05-27 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-27 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('115','Budapest','Szeged',to_date('2022-05-28 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-28 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('116','Budapest','Szeged',to_date('2022-06-01 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-01 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('117','Budapest','Szeged',to_date('2022-06-02 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-02 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('118','Budapest','Szeged',to_date('2022-06-03 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-03 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('119','Budapest','Szeged',to_date('2022-06-04 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-04 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('120','Budapest','Szeged',to_date('2022-06-05 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-05 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
--10db
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('121','Szeged','Budapest',to_date('2022-05-24 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-24 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('122','Szeged','Budapest',to_date('2022-05-25 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-25 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('123','Szeged','Budapest',to_date('2022-05-26 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-26 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('124','Szeged','Budapest',to_date('2022-05-27 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-27 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('125','Szeged','Budapest',to_date('2022-05-28 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-05-28 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('126','Szeged','Budapest',to_date('2022-06-01 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-01 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('127','Szeged','Budapest',to_date('2022-06-02 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-02 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('128','Szeged','Budapest',to_date('2022-06-03 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-03 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('129','Szeged','Budapest',to_date('2022-06-04 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-04 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
Insert into MENETREND (JARATSZAM,HONNAN,HOVA,DATUM_INDUL,DATUM_ERKEZIK,KM,POTJEGY) values ('130','Szeged','Budapest',to_date('2022-06-05 12:00:00','yyyy-mm-dd HH24:MI:SS'),to_date('2022-06-05 14:00:00','yyyy-mm-dd HH24:MI:SS'),'300','0');
-- 40
-- 13 db !!!


--vásárlások
BEGIN
NEW_VASARLAS(76, 'felnőtt', 2, '000011HU');
NEW_VASARLAS(76, 'felnőtt', 2, '000011HU');
NEW_VASARLAS(76, 'felnőtt', 2, '000011HU');
NEW_VASARLAS(76, 'felnőtt', 2, '000011HU');
NEW_VASARLAS(76, 'felnőtt', 2, '000011HU');
NEW_VASARLAS(76, 'diák', 2, '000011HU');
NEW_VASARLAS(76, 'diák', 2, '000011HU');
NEW_VASARLAS(76, 'diák', 2, '000011HU');
NEW_VASARLAS(76, 'diák', 2, '000011HU');
NEW_VASARLAS(76, 'diák', 2, '000011HU');
NEW_VASARLAS(76, 'nyugdíjas', 4, '000011HU');
NEW_VASARLAS(76, 'nyugdíjas', 1, '000011HU');

NEW_VASARLAS(27, 'felnőtt', 2, '000012HU');
NEW_VASARLAS(27, 'felnőtt', 2, '000012HU');
NEW_VASARLAS(27, 'felnőtt', 2, '000012HU');
NEW_VASARLAS(27, 'felnőtt', 2, '000012HU');
NEW_VASARLAS(27, 'felnőtt', 2, '000012HU');
NEW_VASARLAS(27, 'diák', 2, '000012HU');
NEW_VASARLAS(27, 'diák', 2, '000012HU');
NEW_VASARLAS(27, 'diák', 2, '000012HU');
NEW_VASARLAS(27, 'diák', 2, '000012HU');
NEW_VASARLAS(27, 'diák', 2, '000012HU');
NEW_VASARLAS(27, 'nyugdíjas', 2, '000012HU');
NEW_VASARLAS(27, 'nyugdíjas', 2, '000012HU');
NEW_VASARLAS(27, 'nyugdíjas', 2, '000012HU');
NEW_VASARLAS(27, 'nyugdíjas', 2, '000012HU');

NEW_VASARLAS(28, 'felnőtt', 2, '000013HU');
NEW_VASARLAS(28, 'felnőtt', 2, '000013HU');
NEW_VASARLAS(28, 'felnőtt', 2, '000013HU');
NEW_VASARLAS(28, 'felnőtt', 2, '000013HU');
NEW_VASARLAS(28, 'felnőtt', 2, '000013HU');
NEW_VASARLAS(28, 'diák', 2, '000013HU');
NEW_VASARLAS(28, 'diák', 2, '000013HU');
NEW_VASARLAS(28, 'diák', 2, '000013HU');
NEW_VASARLAS(28, 'diák', 2, '000013HU');
NEW_VASARLAS(28, 'diák', 2, '000013HU');

NEW_VASARLAS(29, 'felnőtt', 2, '000013HU');
NEW_VASARLAS(29, 'felnőtt', 2, '000013HU');
NEW_VASARLAS(29, 'felnőtt', 2, '000013HU');
NEW_VASARLAS(29, 'felnőtt', 2, '000013HU');
NEW_VASARLAS(29, 'felnőtt', 2, '000013HU');
NEW_VASARLAS(29, 'diák', 2, '000013HU');
NEW_VASARLAS(29, 'diák', 2, '000013HU');
NEW_VASARLAS(29, 'diák', 2, '000013HU');
NEW_VASARLAS(29, 'diák', 2, '000013HU');
NEW_VASARLAS(29, 'diák', 2, '000013HU');
NEW_VASARLAS(29, 'nem természetes személy', 2, '000013HU');
NEW_VASARLAS(29, 'nem természetes személy', 2, '000013HU');
NEW_VASARLAS(29, 'nem természetes személy', 2, '000013HU');
NEW_VASARLAS(29, 'nem természetes személy', 2, '000013HU');
NEW_VASARLAS(29, 'nem természetes személy', 2, '000013HU');
NEW_VASARLAS(29, 'nem természetes személy', 2, '000013HU');
NEW_VASARLAS(29, 'bicikli', 1, '000013HU');
NEW_VASARLAS(29, 'bicikli', 1, '000013HU');
NEW_VASARLAS(29, 'bicikli', 1, '000013HU');
NEW_VASARLAS(29, 'nyugdíjas', 2, '000013HU');
NEW_VASARLAS(29, 'nyugdíjas', 1, '000013HU');
NEW_VASARLAS(29, 'nyugdíjas', 1, '000013HU');
NEW_VASARLAS(29, 'nyugdíjas', 2, '000013HU');
NEW_VASARLAS(29, 'nyugdíjas', 4, '000013HU');
END;
-- 60 db

