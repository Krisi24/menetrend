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
        <li><a href="statisztika.php">Statisztikák</a></li>
		<li><a class="active" href="naplok.php">Naplók</a></li>
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
        <li><a href="statisztika.php">Statisztikák</a></li>
		<li><a class="active" href="naplok.php">Naplók</a></li>
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
        <li><a href="statisztika.php">Statisztikák</a></li>
		<li><a class="active" href="naplok.php">Naplók</a></li>
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

<h2>Ár napló</h2>
<?php 
$sql_code = "SELECT TO_CHAR(ido, 'YYYY-MM-DD HH24:MI:SS'), regi, uj, tipus FROM ARNAPLO ORDER BY ido DESC";
$header = "<tr>	<th>Idő</th>
						<th>régi ár</th>
    					<th>új ár</th>
    					<th>típus</th></tr>";
SELECT_to_table($sql_code, $header);
?>


<h2>Fizetés napló</h2>
<?php 
$sql_code = "SELECT TO_CHAR(ido, 'YYYY-MM-DD HH24:MI:SS'), regi, uj, szemelyiszam FROM FIZNAPLO ORDER BY ido DESC";
$header = "<tr>	<th>Idő</th>
						<th>régi fizetés</th>
    					<th>új fizetés</th>
    					<th>szemelyiszám</th></tr>";
SELECT_to_table($sql_code, $header);
?>

<h2>Be/Kijelentkezés napló</h2>
<?php 
$sql_code = "SELECT TO_CHAR(ido, 'YYYY-MM-DD HH24:MI:SS'), DB_USER, szemelyiszam FROM LOGINNAPLO ORDER BY ido DESC";
$header = "<tr>	<th>Idő</th>
						<th>db felhasználó</th>
    					<th>szemelyiszám</th></tr>";
SELECT_to_table($sql_code, $header);
?>
</main>
<?php 
kapcsolat_bontas();
?>
</body>
</html> 


