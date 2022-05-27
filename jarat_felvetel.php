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
		<li><a href="main_page.php">Vasútmenetrend</a></li>
		<li><a href="jegy_tipus.php">Jegy típusok</a></li>
        <li><a href="dolgozok.php">Dolgozók</a></li>
        <li><a href="dolgozo_szerkeszt.php">Dolgozók szerkesztése</a></li>
        <li><a href="dolgozo_felvet.php">Dolgozók felvétele</a></li>
        <li><a href="statisztika.php">Statisztikák</a></li>
		<li><a href="naplok.php">Naplók</a></li>
		<li><a href="vasarlas.php">Vásárlások</a></li>
		<li><a href="varos_modositas.php">Város módosítas</a></li>
		<li><a class="active" href="jarat_felvetel.php">Új járat</a></li>
		<li><a href="jegykezeles.php">Jegykezelés</a></li>
		<li><a href="beosztaskezeles.php">Beosztáskezelés</a></li>
        <li style="float:right"><a  href="logout.php">Kijelentkezés</a></li>
	</ul>
</nav>        
        ';
}
?>

<main>



<form action="jarat_felvetel.php" method="POST" class='center'>
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
			</select><br/><br/>
			
			
		<label for="datemax">Indulás</label>
			<input type="datetime-local" name="date_start" max="2030-12-31">	
		<label for="datemax">Érkezés</label>
			<input type="datetime-local" name="date_end" max="2030-12-31">	<br/><br/>
			
		<label >táv</label>
			<input type="number" value="100" min="5" max="1000" name="tav">
		
		<label >Pótjegy</label>
		<input type="number" value="250" min="0" max="10000" name="potjegy">
		<br/><br/>
		<input  type="submit" name="excecute" value="Hozzáad"/>
	</form>


<?php

if(isset($_GET["message"])){
	echo $_GET["message"];
}

//$date = date_create($_POST["date_start"]);
//echo = date_format(date_create($_POST["date_start"]), 'Y-m-d H:i:s');
if ( isset($_POST["varos1"]) && isset($_POST["varos2"]) && isset($_POST["date_start"]) && isset($_POST["date_end"]) && isset($_POST["tav"]) && isset($_POST["potjegy"]) ){
	
	$date_start = date_format(date_create($_POST["date_start"]), 'Y-m-d H:i:s'); // datumot készítünk, majd adott formátumra alakítjuk
	$date_end = date_format(date_create($_POST["date_end"]), 'Y-m-d H:i:s');
	
	$sql_code = "DECLARE 
BEGIN
    NEW_JARAT('" . $_POST["varos1"] . "', '" . $_POST["varos2"] . "', '" . $date_start . "', '" . $date_end  . "', " . $_POST["tav"] . ", " . $_POST["potjegy"] . ");
END;";
	
	//echo $sql_code; //debug
	sql_code_vegrehajtas($sql_code, "jarat_felvetel.php");
}
if ( isset($_POST["megnevezes"])){
	$sql_code = "DELETE FROM MENETREND WHERE jaratszam = " . $_POST["megnevezes"];
	
	sql_code_vegrehajtas($sql_code, "jarat_felvetel.php");
}
// 
$pl_sql_code = "SELECT jaratszam, honnan, hova,
TO_CHAR(datum_indul, 'YYYY-MM-DD HH24:MI:SS') INDUL,
TO_CHAR(datum_erkezik, 'YYYY-MM-DD HH24:MI:SS') ERKEZIK,
km, potjegy FROM menetrend ORDER BY jaratszam DESC FETCH NEXT 10 ROWS ONLY";
$table_header = "<tr>
    <th>Járatszam</th>
    <th>Honnan</th>
	<th>Hova</th>
    <th>Indulás idő</th>
    <th>Érkezés idő</th>
    <th>út hossza (km)</th>
    <th>pótjegy ára</th>
  </tr>";
  
  
SELECT_to_table($pl_sql_code, $table_header);
?>

<form action="jarat_felvetel.php" method="POST" class='center'>

        <div><label >Járatszám</label>
				<input type="text" name="megnevezes"><br></div>

		<input  type="submit" name="delete" value="Törlés"/>
	</form>

<?php

?>

</main>
<?php 
kapcsolat_bontas();
?>
</body>
</html> 


