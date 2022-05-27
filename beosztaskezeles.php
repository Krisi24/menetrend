<!DOCTYPE html>
<?php
include_once("fuggvenyek.php");
?>
<html lang="hu">
<head>

    <title>Menetrend</title>

    <meta charset="UTF-8">
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
		<li><a href="main_page.php">Vasútmenetrend</a></li>
		<li><a href="jegy_tipus.php">Jegy típusok</a></li>
        <li><a href="statisztika.php">Statisztikák</a></li>
		<li><a href="naplok.php">Naplók</a></li>
		<li><a href="vasarlas.php">Vásárlások</a></li>
		<li><a class="active" href="jegykezeles.php">Jegykezelés</a></li>
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
		<li><a href="jarat_felvetel.php">Új járat</a></li>
		<li><a href="jegykezeles.php">Jegykezelés</a></li>
		<li><a class="active" href="beosztaskezeles.php">Beosztáskezelés</a></li>
        <li style="float:right"><a  href="logout.php">Kijelentkezés</a></li>
	</ul>
</nav>        
        ';
} else {

}
?>
<main>
<h1 class="center"> Beosztáskezelés </h1>
<?php

$sql_code = "SELECT MEGNEVEZES FROM BEOSZTAS";
$header = "<tr>	<th>Megnevezés</th></tr>";
SELECT_to_table($sql_code, $header);
?>
    <form action="beosztaskezeles.php" method="POST" class="center">

        <div><label >Megnevezése</label>
            <input type="text" name="megnevezes"><br></div>
        <input  type="submit" name="delete" value="Törlés"/>
    </form>

    <?php
    if ( isset($_POST["megnevezes"])){
        $sql_code = "DELETE FROM BEOSZTAS WHERE MEGNEVEZES LIKE '" . $_POST["megnevezes"] . "'";

        sql_code_vegrehajtas($sql_code, "beosztaskezeles.php");
    }
    ?>

    <form action="beosztaskezeles.php" method="POST" class="center">
        <div><label >Megnevezése</label>
            <input type="text" name="megnevezes_new"><br></div>
        <input  type="submit" name="delete" value="Hozzáad"/>
    </form>

    <?php
    if ( isset($_POST["megnevezes_new"])){
        $sql_code = "INSERT INTO BEOSZTAS (MEGNEVEZES) VALUES ('" . $_POST["megnevezes_new"] . "')";

        sql_code_vegrehajtas($sql_code, "beosztaskezeles.php");
    }
    if(isset($_GET["message"])){
        echo $_GET["message"];
    }
?>
</main>
<?php	

kapcsolat_bontas();
?>
</body>
</html>