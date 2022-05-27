<!DOCTYPE html>

<?php
include_once("fuggvenyek.php");
?>

<html lang="hu">
<head>

	<title>Menetrend</title>
	
	<meta charset="UTF-8">
	<link rel="icon" href="img/logo1.jpg" />
	<meta name="keywords" content="vasút, menetrend, vasútmenetrend, utazás, útvonal, vasútvonal">
	<meta name="description" content="menetrend kereső">
	<meta name="author" content="Kristóf Péter Cseh">
	
	<link rel="stylesheet" href="style.css">
	
</head>
<body>
<?php
session_start();
if (!isset($_SESSION["szemelyiszam"])) {
    echo '
<nav>
	<ul id="navbar">
		<li><a class="active" href="main_page.php">Vasútmenetrend</a></li>
		<li style="float:right"><a class="active" href="login.php">Bejelentkezés</a></li>
	</ul>
</nav>
        ';
} else if($_SESSION["beosztas"] == "Pénztáros") {
    echo '
<nav>
	<ul id="navbar">
		<li><a href="main_page.php">Vasútmenetrend</a></li>
		<li><a href="jegy_tipus.php">Jegy típusok</a></li>
        <li><a class="active" href="statisztika.php">Statisztikák</a></li>
		<li><a href="naplok.php">Naplók</a></li>
		<li><a href="vasarlas.php">Vásárlások</a></li>
        <li style="float:right"><a  href="logout.php">Kijelentkezés</a></li>
	</ul>
</nav>        
        ';
} else if($_SESSION["beosztas"] == "Kalauz") {
    echo '
<nav>
	<ul id="navbar">
		<li><a href="main_page.php">Vasútmenetrend</a></li>
		<li><a href="jegy_tipus.php">Jegy típusok</a></li>
        <li><a class="active" href="statisztika.php">Statisztikák</a></li>
		<li><a href="naplok.php">Naplók</a></li>
		<li><a href="vasarlas.php">Vásárlások</a></li>
		<li><a href="jegykezeles.php">Jegykezelés</a></li>
        <li style="float:right"><a  href="logout.php">Kijelentkezés</a></li>
	</ul>
</nav>        
        ';

} else if($_SESSION["beosztas"] == "Karbantartó") {
    echo '
<nav>
	<ul id="navbar">
		<li><a href="main_page.php">Vasútmenetrend</a></li>
		<li><a href="jegy_tipus.php">Jegy típusok</a></li>
        <li><a href="dolgozok.php">Dolgozók</a></li>
        <li><a href="dolgozo_szerkeszt.php">Dolgozók szerkesztése</a></li>
        <li><a href="dolgozo_felvet.php">Dolgozók felvétele</a></li>
        <li><a class="active" href="statisztika.php">Statisztikák</a></li>
		<li><a href="naplok.php">Naplók</a></li>
		<li><a href="vasarlas.php">Vásárlások</a></li>
		<li><a href="varos_modositas.php">Város módosítas</a></li>
		<li><a href="jarat_felvetel.php">Új járat</a></li>
		<li><a href="jegykezeles.php">Jegykezelés</a></li>
		<li><a href="beosztaskezeles.php">Beosztáskezelés</a></li>
        <li style="float:right"><a  href="logout.php">Kijelentkezés</a></li>
	</ul>
</nav>        
        ';
}
?>
<main>
<h2>1. Eladott jegyek db-száma típusokként</h2>
<?php

$sql_code ="SELECT jegyek.tipus, SUM(v_sum.db) FROM jegyek LEFT OUTER JOIN
    (SELECT jegy_tipus, db FROM vasarlas) v_sum
    ON v_sum.jegy_tipus = jegyek.tipus
GROUP BY jegyek.tipus ORDER BY tipus";
$table_header = "<tr>
    <th>Jegy típus</th>
	<th>db</th>
	</tr>";
SELECT_to_table($sql_code, $table_header);
?>

<h2>2. Eladások összege típusokként.</h2>
<?php

$sql_code ="SELECT jegyek.tipus, SUM(v_sum.bo_on_jegy) FROM jegyek LEFT OUTER JOIN
(SELECT jegy_tipus, v.jaratszam,  befizetett_osszeg , befizetett_osszeg - (db * m.potjegy) bo_on_jegy  FROM vasarlas v INNER JOIN menetrend m ON  v.jaratszam = m.jaratszam) v_sum
ON v_sum.jegy_tipus = jegyek.tipus
GROUP BY jegyek.tipus ORDER BY tipus";
$table_header = "<tr>
    <th>Jegy típus</th>
	<th>bevétel (Ft)</th>
	</tr>";
SELECT_to_table($sql_code, $table_header);
?>

<h2>3. Eladások összege típusokként, ebben a hónapban induló járatokra.</h2>
<?php
$sql_code ="SELECT jegyek.tipus, SUM(v_sum.bo_on_jegy) FROM jegyek LEFT OUTER JOIN
(SELECT jegy_tipus, v.jaratszam,  befizetett_osszeg , befizetett_osszeg - (db * m.potjegy) bo_on_jegy  
FROM vasarlas v INNER JOIN menetrend m ON  v.jaratszam = m.jaratszam WHERE trunc(m.datum_indul ,'mm') = trunc( SYSDATE ,'mm') ) v_sum
ON v_sum.jegy_tipus = jegyek.tipus
GROUP BY jegyek.tipus ORDER BY tipus";
$table_header = "<tr>
    <th>Jegy típus</th>
	<th>bevétel (Ft)</th>
	</tr>";
SELECT_to_table($sql_code, $table_header);
?>

<h2>4. Eladások összege típusokként, ebben az évben induló járatokra.</h2>
<?php
$sql_code ="SELECT jegyek.tipus, SUM(v_sum.bo_on_jegy) FROM jegyek LEFT OUTER JOIN
(SELECT jegy_tipus, v.jaratszam,  befizetett_osszeg , befizetett_osszeg - (db * m.potjegy) bo_on_jegy  
FROM vasarlas v INNER JOIN menetrend m ON  v.jaratszam = m.jaratszam WHERE trunc(m.datum_indul ,'yy') = trunc( SYSDATE ,'yy') ) v_sum
ON v_sum.jegy_tipus = jegyek.tipus
GROUP BY jegyek.tipus ORDER BY tipus";
$table_header = "<tr>
    <th>Jegy típus</th>
	<th>bevétel (Ft)</th>
	</tr>";
SELECT_to_table($sql_code, $table_header);
?>

<h2>5. Kinek mennyiszer volt fizetése VÁLTOZTATÁSA összesen. (dolgozó felvételével együtt)</h2>
<?php

$sql_code ="SELECT dolgozok.szemelyiszam, dolgozok.veznev , dolgozok.kernev, dolgozok.beosztas, fiz.eset_szam FROM dolgozok INNER JOIN 
(SELECT fiznaplo.szemelyiszam, count(*) eset_szam FROM fiznaplo GROUP BY fiznaplo.szemelyiszam) fiz
ON dolgozok.szemelyiszam = fiz.szemelyiszam ORDER BY dolgozok.veznev, dolgozok.kernev";
$table_header = "<tr>
    <th>Személyiszám</th>
	<th>Vezeték név</th>
	<th>Kereszt név</th>
	<th>beosztás</th>
	<th>esetek száma</th>
	</tr>";
SELECT_to_table($sql_code, $table_header);
?>

<h2>6. Egy beosztásban mennyiszer volt fizetés VÁLTOZTATÁS összesen. (dolgozó felvételével együtt)</h2>
<?php

$sql_code ="SELECT beosztas.megnevezes, count(dol_fiz.szemelyiszam) FROM beosztas LEFT OUTER JOIN 
(SELECT dolgozok.szemelyiszam, dolgozok.beosztas FROM dolgozok INNER JOIN fiznaplo ON dolgozok.szemelyiszam = fiznaplo.szemelyiszam) dol_fiz ON dol_fiz.beosztas = beosztas.megnevezes
GROUP BY beosztas.megnevezes";
$table_header = "<tr>
    <th>Beosztás</th>
	<th>esetek száma</th>
	</tr>";
SELECT_to_table($sql_code, $table_header);
?>

<h2>7. Kinek mennyiszer volt fizetése EMELÉSE összesen. (dolgozó felvétele nélkül)</h2>
<?php

$sql_code ="SELECT dolgozok.szemelyiszam, dolgozok.veznev , dolgozok.kernev, dolgozok.beosztas, fiz.eset_szam FROM dolgozok INNER JOIN 
	(SELECT fiznaplo.szemelyiszam, count(*) eset_szam FROM fiznaplo 
	WHERE regi < uj AND regi != 0
	GROUP BY fiznaplo.szemelyiszam
	) fiz
ON dolgozok.szemelyiszam = fiz.szemelyiszam 
ORDER BY dolgozok.veznev, dolgozok.kernev";
$table_header = "<tr>
    <th>Személyiszám</th>
	<th>Vezeték név</th>
	<th>Kereszt név</th>
	<th>beosztás</th>
	<th>esetek száma</th>
	</tr>";
SELECT_to_table($sql_code, $table_header);
?>

<h2>8. Egy beosztásban mennyiszer volt fizetés EMELÉS összesen. (dolgozó felvétele nélkül)</h2>
<?php

$sql_code ="SELECT beosztas.megnevezes, count(dol_fiz.szemelyiszam) FROM beosztas LEFT OUTER JOIN 
    (SELECT dolgozok.szemelyiszam, dolgozok.beosztas
    FROM dolgozok INNER JOIN fiznaplo ON dolgozok.szemelyiszam = fiznaplo.szemelyiszam
    WHERE regi < uj AND regi != 0)
    dol_fiz ON dol_fiz.beosztas = beosztas.megnevezes
GROUP BY beosztas.megnevezes";
$table_header = "<tr>
    <th>Beosztás</th>
	<th>esetek száma</th>
	</tr>";
SELECT_to_table($sql_code, $table_header);
?>

<h2>9. Egy beosztásban mennyiszer volt fizetés EMELÉS ebben a hónapban. (dolgozó felvétele nélkül)</h2>
<?php

$sql_code ="SELECT beosztas.megnevezes, count(dol_fiz.szemelyiszam) FROM beosztas LEFT OUTER JOIN 
    (SELECT dolgozok.szemelyiszam, dolgozok.beosztas
    FROM dolgozok INNER JOIN fiznaplo ON dolgozok.szemelyiszam = fiznaplo.szemelyiszam
    WHERE regi < uj AND regi != 0 AND trunc(ido ,'mm') = trunc( SYSDATE ,'mm'))
    dol_fiz ON dol_fiz.beosztas = beosztas.megnevezes
GROUP BY beosztas.megnevezes";
$table_header = "<tr>
    <th>Beosztás</th>
	<th>esetek száma</th>
	</tr>";
SELECT_to_table($sql_code, $table_header);
?>

<h2>10. Egy beosztásban mennyiszer volt fizetés EMELÉS ebben az évben. (dolgozó felvétele nélkül)</h2>
<?php

$sql_code ="SELECT beosztas.megnevezes, count(dol_fiz.szemelyiszam) FROM beosztas LEFT OUTER JOIN 
    (SELECT dolgozok.szemelyiszam, dolgozok.beosztas
    FROM dolgozok INNER JOIN fiznaplo ON dolgozok.szemelyiszam = fiznaplo.szemelyiszam
    WHERE regi < uj AND regi != 0 AND trunc(ido ,'yy') = trunc( SYSDATE ,'yy') )
    dol_fiz ON dol_fiz.beosztas = beosztas.megnevezes
GROUP BY beosztas.megnevezes";
$table_header = "<tr>
    <th>Beosztás</th>
	<th>esetek száma</th>
	</tr>";
SELECT_to_table($sql_code, $table_header);
?>

<h2>11. A városokból mennyi járat indulása van tervezve a jövőben. (jelen pillanattól nézve)</h2>
<?php

$sql_code ="SELECT varosok.nev, count(m.jaratszam)
FROM varosok LEFT OUTER JOIN 
(SELECT * FROM menetrend
WHERE menetrend.datum_indul > SYSDATE) m
ON varosok.nev = m.honnan
GROUP BY varosok.nev";
$table_header = "<tr>
    <th>Város</th>
	<th>indulások db száma</th>
	</tr>";
SELECT_to_table($sql_code, $table_header);
?>

<h2>12. A városokból mennyi járat indul a mai napon</h2>
<?php

$sql_code ="SELECT varosok.nev, count(m.jaratszam)
FROM varosok LEFT OUTER JOIN 
(SELECT * FROM menetrend
WHERE trunc(menetrend.datum_indul ,'dd') = trunc( SYSDATE ,'dd')) m
ON varosok.nev = m.honnan
GROUP BY varosok.nev";
$table_header = "<tr>
    <th>Város</th>
	<th>indulások db száma</th>
	</tr>";
SELECT_to_table($sql_code, $table_header);
?>

<h2>13. A városokból mennyi járat indul ebben a hónapban</h2>
<?php

$sql_code ="SELECT varosok.nev, count(m.jaratszam)
FROM varosok LEFT OUTER JOIN 
(SELECT * FROM menetrend
WHERE trunc(menetrend.datum_indul ,'mm') = trunc( SYSDATE ,'mm')) m
ON varosok.nev = m.honnan
GROUP BY varosok.nev";
$table_header = "<tr>
    <th>Város</th>
	<th>indulások db száma</th>
	</tr>";
SELECT_to_table($sql_code, $table_header);
?>

<h2>14. A városokból mennyi járat indul ebben az évben</h2>
<?php

$sql_code ="SELECT varosok.nev, count(m.jaratszam)
FROM varosok LEFT OUTER JOIN 
(SELECT * FROM menetrend
WHERE trunc(menetrend.datum_indul ,'yy') = trunc( SYSDATE ,'yy')) m
ON varosok.nev = m.honnan
GROUP BY varosok.nev";
$table_header = "<tr>
    <th>Város</th>
	<th>indulások db száma</th>
	</tr>";
SELECT_to_table($sql_code, $table_header);
?>

<h2>15. Melyik járatokon volt  a legtöbb jegyeladás
<br/>(egy vásárlás alkalmával több jegyet is lehet vásárolni egyszerre)
<br/>(azon a járatok közül amik már megérkeztek)
<br/>(első 3)</h2>
<?php

$sql_code ="SELECT m.jaratszam, v.db, m.honnan, m.hova FROM menetrend m INNER JOIN
    (SELECT jaratszam, SUM(db) db  FROM vasarlas GROUP BY jaratszam) v
    ON v.jaratszam = m.jaratszam
WHERE m.datum_erkezik < SYSDATE ORDER BY v.db DESC, jaratszam DESC FETCH FIRST 3 ROWS ONLY";
$table_header = "<tr>
    <th>Járatszám</th>
    <th>eladott jegyek db száma</th>
    <th>Honnan</th>
    <th>Hova</th>
	</tr>";
SELECT_to_table($sql_code, $table_header);
?>


<h2>16. Legtöbb eladott jeggyel rendelkező járatok 
<br/>( többet ad vissza ha több maximum eladás volt)
<br/>(azon a járatok közül amik már megérkeztek)</h2>
<?php

$sql_code ="SELECT db, m.jaratszam, m.honnan, m.hova,
TO_CHAR(m.datum_indul, 'YYYY-MM-DD HH24:MI:SS') INDUL,
TO_CHAR(m.datum_erkezik, 'YYYY-MM-DD HH24:MI:SS' ) ERKEZIK FROM
(SELECT jaratszam, SUM(db) db FROM vasarlas GROUP BY jaratszam) v3 INNER JOIN menetrend m
ON v3.jaratszam = m.jaratszam 
WHERE V3.db = (SELECT MAX(v.db) FROM (SELECT jaratszam, SUM(db) db FROM vasarlas GROUP BY jaratszam) v)
AND m.datum_erkezik < SYSDATE ORDER BY m.datum_erkezik DESC";
$table_header = "<tr>
    <th>eladott jegyek db száma</th>
    <th>Járatszám</th>
    <th>Honnan</th>
    <th>Hova</th>
    <th>indulás</th>
    <th>érkezés</th>
	</tr>";
SELECT_to_table($sql_code, $table_header);
?>
</main>
<?php 
kapcsolat_bontas();
?>
</body>
</html> 


