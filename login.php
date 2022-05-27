<?php
session_start();
if (!empty($_SESSION['szemelyiszam'])) {
    header('location: main_page.php');
} else {
    session_destroy();
}

$conn = oci_connect('TEST3', '123', 'Localhost/XE', 'AL32UTF8');
if(!$conn){
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

if (isset($_POST["submit"])) {
    $errors = array();
    $true = true;
    if (empty($_POST['szemelyiszam'])) {
        $true = false;
        array_push($errors, "A felhasználónév mező üres!");
    }
    if (empty($_POST['password'])) {
        $true = false;
        array_push($errors, "A jelszó mező üres!");
    }
    if ($true) {
        $felhasznalonev = $_POST['szemelyiszam'];
        $pwd = $_POST['password'];

        $sql = "SELECT SZEMELYISZAM, JELSZO, BEOSZTAS FROM DOLGOZOK WHERE SZEMELYISZAM = '$felhasznalonev'";
        $stid = oci_parse($conn, $sql);

        oci_define_by_name($stid, 'SZEMELYISZAM', $szemelyiszam);
        oci_define_by_name($stid, 'JELSZO', $jelszo);
        oci_define_by_name($stid, 'BEOSZTAS', $beosztas);

        oci_execute($stid);

        if (oci_fetch($stid)){
            if ($szemelyiszam == $felhasznalonev AND $jelszo == $pwd) {
                session_start();
                $_SESSION['szemelyiszam'] = $szemelyiszam;
                $_SESSION['beosztas'] = $beosztas;
                header('location: main_page.php');
            } else {
                array_push($errors, "A jelszó nem megfelelő, próbáld újra!");
            }
        } else {
            array_push($errors, "A felhasználónév nincs regisztrálva!");
        }
        oci_free_statement($stid);
        oci_close($conn);

    }
}

?>
<!DOCTYPE html>

<html lang="hu">
<head>

    <title>Menetrend</title>

    <meta charset="UTF-8">
    <meta name="keywords" content="vasút, menetrend, vasútmenetrend, utazás, útvonal, vasútvonal">
    <meta name="description" content="menetrend kereső">
    <meta name="author" content="Beáta Eke, Kristóf Péter Cseh">

    <link rel="stylesheet" href="style.css">

</head>
<body>
<nav>
    <ul id="navbar">
        <li><a href="main_page.php">VISSZA</a></li>
        <li style="float:right"><a class="active" href="login.php">Bejelentkezés</a></li>
    </ul>
</nav>

<div class="center">
    <h2 >Csak dolgozók részére!</h2>

    <form action="login.php" method="post">
        <label for="fname">Felhasználónév:<br>
            <input type="text" id="name" name="szemelyiszam" placeholder="123456AA" style="text-align: center"></label><br>
        <label for="lname">Jelszó:<br>
            <input type="password" id="password" name="password" placeholder="123" style="text-align: center"></label><br><br>
        <input type="submit" name="submit" value="Bejelentkezés">
    </form>
</div>

<?php

if (!empty($errors)) {
    foreach ($errors as $error) {
        echo $error."<br/>";
    }
}

?>

</body>

</html> 


