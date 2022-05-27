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
	<meta name="author" content="Beáta Eke, Kristóf Péter Cseh">
	
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
		<li><a class="active" href="varos_modositas.php">Város módosítas</a></li>
		<li><a href="jarat_felvetel.php">Új járat</a></li>
		<li><a href="jegykezeles.php">Jegykezelés</a></li>
		<li><a href="beosztaskezeles.php">Beosztáskezelés</a></li>
        <li style="float:right"><a  href="logout.php">Kijelentkezés</a></li>
	</ul>
</nav>        
        ';
}
?>

<main style="text-align: center; width: 50%; margin-left: 25%;">
<div style="display: inline-block;">
	<form action="varos_modositas.php" method="POST" class='center'>

        <div><label >Új város</label>
			<input type="text" name="megnevezes_new"><br></div>
				
		<input  type="submit" name="excecute" value="Hozzáad"/>
	</form>
</div>
<?php
if ( isset($_POST["megnevezes_new"])){
	$sql_code = "INSERT INTO VAROSOK VALUES ('" . $_POST["megnevezes_new"] . "')";
	
	sql_code_vegrehajtas($sql_code, "varos_modositas.php");
}
?>
<div style="display: inline-block;">
	<form action="varos_modositas.php" method="POST" class='center'>

        <div><label >Városnév</label>
				<input type="text" name="megnevezes"><br></div>

		<input  type="submit" name="delete" value="Törlés"/>
	</form>
</div>

<?php
if(isset($_GET["message"])){
	echo $_GET["message"];
}
if ( isset($_POST["megnevezes"])){
	$sql_code = "DELETE FROM VAROSOK WHERE NEV LIKE '" . $_POST["megnevezes"] . "'";
	
	sql_code_vegrehajtas($sql_code, "varos_modositas.php");
}


?>
<div style="text-align: left;">
<?php 
$sql_code = "SELECT * FROM VAROSOK";
$header = "<tr>	<th>Városnév</th></tr>";
SELECT_to_table($sql_code, $header);
?>
</div>
</main>
<?php 
kapcsolat_bontas();
?>
</body>
</html> 


