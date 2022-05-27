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
menetrend_table_jaratszam($_GET["jaratszam"]);
?>

<form class="center" method="POST" action='<?php echo "jegy_vasarlas.php?jaratszam=" . $_GET["jaratszam"] ?>'>
		<label for="fname">Jegy</label>
			<select  name="jegytipus">
<?php
form_option_jegyek();
?>
			</select>
		<label for="lname">db</label>
			<select  name="db">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
			</select>
		<input class="margo" type="submit" value="hozzáad"><br/>
	</form> 
	
	<?php
if ( isset($_POST["jegytipus"]) && isset($_POST["db"]) ) {
	vasarlas($_GET["jaratszam"], $_POST["jegytipus"], $_POST["db"], $_SESSION["szemelyiszam"]);
}

if(isset($_GET["message"])){
	echo $_GET["message"];
if ( $_GET["message"] != "<h2 class='hiba' >Sikertelen művelet!</h2>"){
$sql_code ="
select befizetett_osszeg from vasarlas where tranzakcioszam = (select max(tranzakcioszam) from vasarlas)";
$table_header = "<tr>
    <th>Végösszeg:</th>
	</tr>";
SELECT_to_table($sql_code, $table_header);
}}

jegy_leker();
?>

<!--
<table>
  <tr>
    <th>jegytípus</th>
	<th>db szám</th>
    <th>összeg</th>
    <th></th>
  </tr>
  <tr>
    <td>Diák (50%)</td>
    <td>1</td>
    <td>3450 Ft</td>
    <td><a class="line_delete" href="main_page.html">törlés</a></td>
  </tr>
   <tr>
    <td>Felnőtt (100%)</td>
    <td>1</td>
    <td>6900 Ft</td>
    <td><a class="line_delete" href="main_page.html">törlés</a></td>
  </tr>
</table>

	<p class="center">végösszeg: 10.350 Ft</p>
	
	
<form class="center" action="/action_page.php">
		
		<input class="margo" type="submit" value="rögzítés"><br/>
	</form> 
-->

</main>
<?php 
kapcsolat_bontas();
?>
</body>
</html> 


