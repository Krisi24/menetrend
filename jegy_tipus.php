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
		<li><a class="active" href="jegy_tipus.php">Jegy típusok</a></li>
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
		<li><a class="active" href="jegy_tipus.php">Jegy típusok</a></li>
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
		<li><a class="active" href="jegy_tipus.php">Jegy típusok</a></li>
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

<main>
<?php
if(isset($_GET["message"])){
	echo $_GET["message"];
}
jegy_leker();
?>


<?php
if($_SESSION["beosztas"] == "Karbantartó") {
?>


<form action="jegy_tipus.php" method="POST" class='center'>

        <div><label >Új Jegy megnevezése</label>
			<input type="text" name="megnevezes_new"><br></div>
				
		<div><label >Új Jegy ár</label>
			<input type="text" name="ar_new"><br></div>

		<input  type="submit" name="excecute" value="Hozzáad"/>
	</form>

<?php
if ( isset($_POST["megnevezes_new"]) && isset($_POST["ar_new"])){
	$sql_code = "INSERT INTO JEGYEK (TIPUS, AR) VALUES ('" . $_POST["megnevezes_new"] . "', '" . $_POST["ar_new"] . "')";
	
	sql_code_vegrehajtas($sql_code, "jegy_tipus.php");
}
?>


<form action="jegy_tipus.php" method="POST" class='center'>

        <div><label >Jegy megnevezése</label>
			<input type="text" name="megnevezes_valtoztat"><br></div>
				
		<div><label >Új Jegy ár</label>
			<input type="text" name="ar_change"><br></div>

		<input  type="submit" name="excecute" value="Módosít"/>
	</form>


<?php
if ( isset($_POST["megnevezes_valtoztat"]) && isset($_POST["ar_change"])){
	$sql_code = "UPDATE JEGYEK SET ar = " . $_POST["ar_change"] . " WHERE tipus LIKE '" . $_POST["megnevezes_valtoztat"] . "'";
	
	sql_code_vegrehajtas($sql_code, "jegy_tipus.php");
}


?>


<form action="jegy_tipus.php" method="POST" class='center'>

        <div><label >Jegy megnevezése</label>
				<input type="text" name="j_delete"><br></div>

		<input  type="submit" value="Törlés"/>
	</form>

<?php
if ( isset($_POST["j_delete"])){
	$sql_code = "DELETE FROM JEGYEK WHERE tipus = '" . $_POST["j_delete"] . "'";
	
	sql_code_vegrehajtas($sql_code, "jegy_tipus.php");
}}
?>
</main>
<?php 
kapcsolat_bontas();
?>
</body>
</html> 


