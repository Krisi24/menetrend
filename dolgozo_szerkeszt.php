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
        <li><a class="active" href="dolgozo_szerkeszt.php">Dolgozók szerkesztése</a></li>
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
    <form action="dolgozo_szerkeszt.php" method="POST" class='center'>

        <div><label >Személyi szám</label>
            <input type="text" name="sz_azonosito"><br></div>

        <div><label >Fizetés</label>
            <input type="text" name="uj_fizetes"><br></div>

        <input  type="submit" name="change" value="Módosít"/>
    </form>

    <?php
	
    if ( isset($_POST["sz_azonosito"]) && isset($_POST["uj_fizetes"])){
        $sql_code = "UPDATE DOLGOZOK SET FIZETES = '" . $_POST["uj_fizetes"] . "' WHERE SZEMELYISZAM = '" . $_POST["sz_azonosito"] . "'";
		//echo $sql_code;
        sql_code_vegrehajtas($sql_code, "dolgozok.php");
    }
	
    ?>

    <form action="dolgozo_szerkeszt.php" method="POST" class='center'>
        <div><label >Személyi szám</label>
            <input type="text" name="azonosito_delet"><br></div>

        <div id="two" class="button" >
            <input type="submit" value="Töröl!" name="change">
        </div>
    </form>

    <?php
    if ( isset($_POST["azonosito_delet"])){
        $sql_code = "DELETE FROM DOLGOZOK WHERE SZEMELYISZAM LIKE '" . $_POST["azonosito_delet"] . "'";

        sql_code_vegrehajtas($sql_code, "dolgozok.php");
    }
	
	if(isset($_GET["message"])){
	echo $_GET["message"];
}
    ?>

    <form action="dolgozok.php" method="post" class='center'>
        <input  type="submit" name="change" value="Vissza"/>
    </form>
</main>
<?php
kapcsolat_bontas();
?>
</body>
</html>


