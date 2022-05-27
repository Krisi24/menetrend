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
        <li><a class="active" href="dolgozo_felvet.php">Dolgozók felvétele</a></li>
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
    <form action="dolgozo_felvet.php" method="POST" class='center'>
        <div><label for="fname">Dolgozó</label>
            <select name="dolgozok">
                <?php
                form_option_Beosztas();
                ?>
            </select><br></div>

        <div><label >Vezetéknév</label>
            <input type="text" name="v_nev"><br></div>

        <div><label >Keresztnév</label>
            <input type="text" name="k_nev"><br></div>

        <div><label >Személyi azonosító</label>
            <input type="text" name="sz_azonosito"><br></div>

        <div><label >Fizetés</label>
            <input type="text" name="fizetes"><br></div>

        <div><label >Jelszó</label>
            <input type="text" name="pwd"><br></div>

        <input  type="submit" name="excecute" value="Hozzáad"/>
    </form>
<?php
if ( isset($_POST["dolgozok"]) && isset($_POST["v_nev"]) && isset($_POST["k_nev"]) && isset($_POST["sz_azonosito"]) && isset($_POST["fizetes"]) && isset($_POST["pwd"])){
    $sql_code = "INSERT INTO DOLGOZOK (veznev, kernev, fizetes, szemelyiszam, jelszo, beosztas) VALUES ('" . $_POST["v_nev"] . "', '" . $_POST["k_nev"] . "', '" . $_POST["fizetes"] . "', '" . $_POST["sz_azonosito"] . "', '" . $_POST["pwd"] . "', '" . $_POST["dolgozok"] . "')";

    sql_code_vegrehajtas($sql_code, "dolgozok.php");
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

