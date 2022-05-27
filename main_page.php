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
		<li><a class="active" href="main_page.php">Vasútmenetrend</a></li>
		<li><a href="jegy_tipus.php">Jegy típusok</a></li>
        <li><a href="statisztika.php">Statisztikák</a></li>
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
		<li><a class="active" href="main_page.php">Vasútmenetrend</a></li>
		<li><a href="jegy_tipus.php">Jegy típusok</a></li>
        <li><a href="statisztika.php">Statisztikák</a></li>
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
		<li><a class="active" href="main_page.php">Vasútmenetrend</a></li>
		<li><a href="jegy_tipus.php">Jegy típusok</a></li>
        <li><a href="dolgozok.php">Dolgozók</a></li>
        <li><a href="dolgozo_szerkeszt.php">Dolgozók szerkesztése</a></li>
        <li><a href="dolgozo_felvet.php">Dolgozók felvétele</a></li>
        <li><a href="statisztika.php">Statisztikák</a></li>
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

	<h1 class="center"> Vasútmenetrend </h1>
	<?php
echo 'PHP version: ' . phpversion();
?>
<main>
	<form class="center" action="main_page.php" method="POST"  accept-charset="utf-8">
		<label for="fname">honnan:</label>
			<select name="varos1">
				<?php
					form_option_Varosok();
				?>
			</select>
		<label for="lname">hova:</label>
			<select name="varos2">
				<?php
					form_option_Varosok();
				?>
			</select>
		<label for="datemax">Indulás</label>
			<input type="datetime-local" name="date" max="2030-12-31" 
			value="<?php current_time_php(); ?>">	
			
		<input class="margo" type="submit" value="Keresés">
	</form> 
	
<?php


if (isset($_SESSION["szemelyiszam"])) {
    if ( isset($_POST["varos1"]) && isset($_POST["varos2"]) && isset($_POST["date"])) {
        menetrend_table($_POST["varos1"], $_POST["varos2"], $_POST["date"]);
    }
} else {
	if ( isset($_POST["varos1"]) && isset($_POST["varos2"]) && isset($_POST["date"])) {
		$pl_sql_code = "SELECT jaratszam, honnan, hova, TO_CHAR(datum_indul, 'YYYY-MM-DD HH24:MI:SS') INDUL, TO_CHAR(datum_erkezik, 'YYYY-MM-DD HH24:MI:SS') ERKEZIK, km, potjegy FROM menetrend " .
			"WHERE honnan LIKE '" . $_POST["varos1"] . "' " . " AND " .  "hova LIKE '" . $_POST["varos2"] . 
			"' AND DATUM_INDUL > " . "TO_DATE('" . str_replace('T', ' ', $_POST["date"]) . "','YYYY-MM-DD HH24:MI:SS')
				AND DATUM_INDUL > (SYSDATE - 1) order by INDUL FETCH NEXT 10 ROWS ONLY";
				
				$table_header = "<tr>
    <th>Járatszam</th>
    <th>Honnan</th>
	<th>Hova</th>
    <th>Indulás idő</th>
    <th>Érkezés idő</th>
    <th>út hossza (km)</th>
    <th>pótjegy ára</th>
  </tr>"; 
        SELECT_to_table($pl_sql_code  ,$table_header );
		
    }
	jegy_leker();
}



?>


</main>
<?php 
kapcsolat_bontas();
?>
</body>
</html> 


