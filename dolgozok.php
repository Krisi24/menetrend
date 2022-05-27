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
        <li><a class="active" href="dolgozok.php">Dolgozók</a></li>
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
	<form action="dolgozok.php" method="POST" class='center'>
        <div><label for="fname">Dolgozó</label>
                <select name="dolgozok">
                    <?php
                    form_option_Beosztas();
                    ?>
                </select><br></div>

		<input  type="submit" name="search" value="Szűrés"/>
	</form>
	
	<form action="dolgozok.php" method="POST" class='center'>
        <div><label for="fname">Dolgozó</label>

        <div><label >Személyi azonosító</label>
				<input type="text" name="sz_azonosito"><br></div>
				
		<input  type="submit" name="search2" value="Szűrés"/>
	</form><br/><br/>

    <?php
	

    if ( isset($_POST["dolgozok"]) && isset($_POST["search"]) ) {
		$pl_sql_code = "SELECT szemelyiszam, veznev, kernev, fizetes, beosztas FROM dolgozok " .
        "WHERE beosztas LIKE '" .$_POST["dolgozok"] . "'" ;


    $table_header = "<tr>
    <th>Személyiszám</th>
	<th>Vezetéknév</th>
    <th>Keresztnév</th>
    <th>Fizetés</th>
    <th>Beosztás</th>
  </tr>";
  SELECT_to_table(  $pl_sql_code ,  $table_header);
    }else 
	  if ( isset($_POST["sz_azonosito"])) {
        $pl_sql_code = "SELECT szemelyiszam, veznev, kernev, fizetes, beosztas FROM dolgozok " .
        "WHERE szemelyiszam = '" . $_POST["sz_azonosito"] . "'" ;


    $table_header = "<tr>
    <th>Személyiszám</th>
	<th>Vezetéknév</th>
    <th>Keresztnév</th>
    <th>Fizetés</th>
    <th>Beosztás</th>
  </tr>";
   SELECT_to_table(  $pl_sql_code ,  $table_header);
    }
    ?>

    <fieldset style="margin-top: 40px">
        <legend><em style="font-size: 25px">Dolgozók listája</em></legend>
        <table border="1">

            <?php
            $dolgozok = dolgozo_leker();
          ?>

        </table>
        <form action="dolgozo_felvet.php" method="POST" class='center'>
            <input  type="submit" name="excecute" value="Új dolgozó felvétele"/>
        </form>

    </fieldset>

</main>
<?php 
kapcsolat_bontas();
?>
</body>
</html> 


