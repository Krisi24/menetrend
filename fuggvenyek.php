<?php
/*
	DB CSATLAKOZÁS STB. ELŐKÉSZÍTÉSE
*/
$conn = oci_connect('TEST3', '123', 'Localhost/XE', 'AL32UTF8');
	if(!$conn){
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	
// MEG KELL HÍVNI AZ OLDALAK VÉGÉN!!!
function kapcsolat_bontas(){
	global $conn;
	oci_close($conn);
}


//
//		TÁBLÁZATOK LEKÉRÉSE
//

function jegy_leker(){
    $pl_sql_code = "SELECT * FROM jegyek";

    print "<h2>Jegy típusok</h2>";
    $table_header = "<tr>
    <th>Megnevezés</th>
	<th>ár/10km</th>
    </tr>";

    SELECT_to_table($pl_sql_code, $table_header);

}
// FV
function menetrend_table($v1, $v2, $time){
	
	global $conn;
	$pl_sql_code = "SELECT jaratszam, honnan, hova, TO_CHAR(datum_indul, 'YYYY-MM-DD HH24:MI:SS') INDUL, TO_CHAR(datum_erkezik, 'YYYY-MM-DD HH24:MI:SS') ERKEZIK, km, potjegy FROM menetrend " .
			"WHERE honnan LIKE '" . $v1 . "' " . " AND " .  "hova LIKE '" . $v2 . 
			"' AND DATUM_INDUL > " . "TO_DATE('" . str_replace('T', ' ', $time) . "','YYYY-MM-DD HH24:MI:SS')
				AND DATUM_INDUL > (SYSDATE - 1) order by INDUL FETCH NEXT 10 ROWS ONLY";
			
		//	$pl_sql_code ='SELECT honnan, hova, datum_indul, datum_erkezik, km, potjegy FROM menetrend WHERE HONNAN LIKE "Alcsut"';
		//print  $pl_sql_code;		//hiba keresés
	
	$table_header = "<tr>
    <th>Járatszam</th>
    <th>Honnan</th>
	<th>Hova</th>
    <th>Indulás idő</th>
    <th>Érkezés idő</th>
    <th>út hossza (km)</th>
    <th>pótjegy ára</th>
    <th></th>
  </tr>"; 
  
	$stid = oci_parse($conn, $pl_sql_code);
	if(!$stid){
		$e = oci_error($conn);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	$r = oci_execute($stid);
	if(!$r){
		$e = oci_error($stid);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	
	if( $row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
		print "<table border='1'>\n" . $table_header;
			print "<tr>";
			print "<td>" . ($row['JARATSZAM'] !== null ? htmlentities($row['JARATSZAM'], ENT_QUOTES) : "&nbsp;") . "</td>";
			print "<td>" . ($row['HONNAN'] !== null ? htmlentities($row['HONNAN'], ENT_QUOTES) : "&nbsp;") . "</td>";
			print "<td>" . ($row['HOVA'] !== null ? htmlentities($row['HOVA'], ENT_QUOTES) : "&nbsp;") . "</td>";
			print "<td>" . ($row['INDUL'] !== null ? htmlentities($row['INDUL'], ENT_QUOTES) : "&nbsp;") . "</td>";
			print "<td>" . ($row['ERKEZIK'] !== null ? htmlentities($row['ERKEZIK'], ENT_QUOTES) : "&nbsp;") . "</td>";
			print "<td>" . ($row['KM'] !== null ? htmlentities($row['KM'], ENT_QUOTES) : "&nbsp;") . "</td>";
			print "<td>" . ($row['POTJEGY'] !== null ? htmlentities($row['POTJEGY'], ENT_QUOTES) : "&nbsp;") . "</td>";
			print "<td><a class=\"line\" name=\"jaratszam\" value='" . $row['JARATSZAM'] . "' href='jegy_vasarlas.php?jaratszam=" . $row['JARATSZAM'] . "'>tovább</a></td></tr>";
		
		while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
			print "<tr>";
			print "<td>" . ($row['JARATSZAM'] !== null ? htmlentities($row['JARATSZAM'], ENT_QUOTES) : "&nbsp;") . "</td>";
			print "<td>" . ($row['HONNAN'] !== null ? htmlentities($row['HONNAN'], ENT_QUOTES) : "&nbsp;") . "</td>";
			print "<td>" . ($row['HOVA'] !== null ? htmlentities($row['HOVA'], ENT_QUOTES) : "&nbsp;") . "</td>";
			print "<td>" . ($row['INDUL'] !== null ? htmlentities($row['INDUL'], ENT_QUOTES) : "&nbsp;") . "</td>";
			print "<td>" . ($row['ERKEZIK'] !== null ? htmlentities($row['ERKEZIK'], ENT_QUOTES) : "&nbsp;") . "</td>";
			print "<td>" . ($row['KM'] !== null ? htmlentities($row['KM'], ENT_QUOTES) : "&nbsp;") . "</td>";
			print "<td>" . ($row['POTJEGY'] !== null ? htmlentities($row['POTJEGY'], ENT_QUOTES) : "&nbsp;") . "</td>";
			print "<td><a class=\"line\" name=\"jaratszam\" value='" . $row['JARATSZAM'] . "' href='jegy_vasarlas.php?jaratszam=" . $row['JARATSZAM'] . "'>tovább</a></td></tr>";
		}
		print "</table>\n";
	
	} else {
		print "<h2 class='hiba' >Nincs találat!</h2>";
	}
	
	
	oci_free_statement($stid);
}
//FV
function dolgozok_table($v1){

    global $conn;
    $pl_sql_code = "SELECT szemelyiszam, veznev, kernev, fizetes, beosztas FROM dolgozok " .
        "WHERE beosztas LIKE '" . $v1 . "'" ;


    $table_header = "<tr>
    <th>Személyiszám</th>
	<th>Vezetéknév</th>
    <th>Keresztnév</th>
    <th>Fizetés</th>
    <th>Beosztás</th>
    <th></th>
  </tr>";
    $szerkeszt = "<td><a class=\"line\" name=\"ertek\" href=\"jegy_vasarlas.php\">szerkeszt</a></td>";

    $stid = oci_parse($conn, $pl_sql_code);
    if(!$stid){
        $e = oci_error($conn);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

    $r = oci_execute($stid);
    if(!$r){
        $e = oci_error($stid);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

    if( $row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
        print "<table border='1'>\n" . $table_header;
        print "<tr>";
        print "<td>" . ($row['SZEMELYISZAM'] !== null ? htmlentities($row['SZEMELYISZAM'], ENT_QUOTES) : "&nbsp;") . "</td>";
        print "<td>" . ($row['VEZNEV'] !== null ? htmlentities($row['VEZNEV'], ENT_QUOTES) : "&nbsp;") . "</td>";
        print "<td>" . ($row['KERNEV'] !== null ? htmlentities($row['KERNEV'], ENT_QUOTES) : "&nbsp;") . "</td>";
        print "<td>" . ($row['FIZETES'] !== null ? htmlentities($row['FIZETES'], ENT_QUOTES) : "&nbsp;") . "</td>";
        print "<td>" . ($row['BEOSZTAS'] !== null ? htmlentities($row['BEOSZTAS'], ENT_QUOTES) : "&nbsp;") . "</td>";
        print $szerkeszt . "</tr>";

        while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
            print "<tr>";
            print "<td>" . ($row['SZEMELYISZAM'] !== null ? htmlentities($row['SZEMELYISZAM'], ENT_QUOTES) : "&nbsp;") . "</td>";
            print "<td>" . ($row['VEZNEV'] !== null ? htmlentities($row['VEZNEV'], ENT_QUOTES) : "&nbsp;") . "</td>";
            print "<td>" . ($row['KERNEV'] !== null ? htmlentities($row['KERNEV'], ENT_QUOTES) : "&nbsp;") . "</td>";
            print "<td>" . ($row['FIZETES'] !== null ? htmlentities($row['FIZETES'], ENT_QUOTES) : "&nbsp;") . "</td>";
            print "<td>" . ($row['BEOSZTAS'] !== null ? htmlentities($row['BEOSZTAS'], ENT_QUOTES) : "&nbsp;") . "</td>";
            print $szerkeszt . "</tr>";
        }
        print "</table>\n";

    } else {
        print "<h2 class='hiba' >Nincs találat!</h2>";
    }

    oci_free_statement($stid);
}

//FV
function SELECT_to_table($pl_sql_code, $table_header){
	global $conn;
	
	//print  $pl_sql_code;		//hiba keresés
	
	$stid = oci_parse($conn, $pl_sql_code);
	if(!$stid){
		$e = oci_error($conn);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	$r = oci_execute($stid);
	if(!$r){
		$e = oci_error($stid);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	print "<table border='1'>\n" . $table_header;
	while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
		print "<tr>";
		foreach ($row as $item){
			print "<td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>";
		}
		print "</tr>";
	}
	print "</table>\n";
	
	oci_free_statement($stid);
}

//FV
function menetrend_table_jaratszam($jaratszam){
	
	global $conn;
	$pl_sql_code = "SELECT jaratszam, honnan, hova, TO_CHAR(datum_indul, 'YYYY-MM-DD HH24:MI:SS') INDUL, TO_CHAR(datum_erkezik, 'YYYY-MM-DD HH24:MI:SS') ERKEZIK, km, potjegy FROM menetrend ".
					"WHERE JARATSZAM = " . $jaratszam;
			
		//print  $pl_sql_code;		//hiba keresés
	
	$table_header = "<tr>
    <th>Járatszam</th>
    <th>Honnan</th>
	<th>Hova</th>
    <th>Indulás idő</th>
    <th>Érkezés idő</th>
    <th>út hossza (km)</th>
    <th>pótjegy ára</th>
    <th></th>
  </tr>";
  $vissza = "<td><a class=\"line\" href=\"main_page.php\">vissza</a></td>";
	
	$stid = oci_parse($conn, $pl_sql_code);
	if(!$stid){
		$e = oci_error($conn);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	$r = oci_execute($stid);
	if(!$r){
		$e = oci_error($stid);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	
	if( $row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
		print "<table border='1'>\n" . $table_header;
			print "<tr>";
			print "<td>" . ($row['JARATSZAM'] !== null ? htmlentities($row['JARATSZAM'], ENT_QUOTES) : "&nbsp;") . "</td>";
			print "<td>" . ($row['HONNAN'] !== null ? htmlentities($row['HONNAN'], ENT_QUOTES) : "&nbsp;") . "</td>";
			print "<td>" . ($row['HOVA'] !== null ? htmlentities($row['HOVA'], ENT_QUOTES) : "&nbsp;") . "</td>";
			print "<td>" . ($row['INDUL'] !== null ? htmlentities($row['INDUL'], ENT_QUOTES) : "&nbsp;") . "</td>";
			print "<td>" . ($row['ERKEZIK'] !== null ? htmlentities($row['ERKEZIK'], ENT_QUOTES) : "&nbsp;") . "</td>";
			print "<td>" . ($row['KM'] !== null ? htmlentities($row['KM'], ENT_QUOTES) : "&nbsp;") . "</td>";
			print "<td>" . ($row['POTJEGY'] !== null ? htmlentities($row['POTJEGY'], ENT_QUOTES) : "&nbsp;") . "</td>";
			print $vissza . "</tr>";
		print "</table>\n";
	
	} else {
		print "<h2 class='hiba' >Nincs találat!</h2>";
	}
	
	
	oci_free_statement($stid);
}
//FV
function dolgozo_leker(){

    $pl_sql_code = "SELECT szemelyiszam, veznev, kernev, fizetes, beosztas FROM dolgozok ORDER BY veznev, kernev";
    $table_header = "
            <tr>
                <th>Személyi szám</th>
                <th>Vezetékév</th>
                <th>Keresztnév</th>
                <th>Fizetés</th>
                <th>Beosztás</th>
            </tr>        
    ";

    SELECT_to_table($pl_sql_code, $table_header);

}

//
//		FROM OPTION XXX			LEGÖRDÜLŐ LISTÁK
//

function form_option_Varosok(){
	global $conn;
	$stid = oci_parse($conn, "SELECT NEV FROM VAROSOK");
	if(!$stid){
		$e = oci_error($conn);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	$r = oci_execute($stid);
	if(!$r){
		$e = oci_error($stid);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
		foreach ($row as $item){
			print "<option value='" . $item . "'>" . $item . "</option>";
		}
	}
	oci_free_statement($stid);
}

function form_option_jegyek(){
	global $conn;
	$stid = oci_parse($conn, "SELECT tipus FROM JEGYEK");
	if(!$stid){
		$e = oci_error($conn);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	$r = oci_execute($stid);
	if(!$r){
		$e = oci_error($stid);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
		foreach ($row as $item){
			print "<option value='" . $item . "'>" . $item . "</option>";
		}
	}
	oci_free_statement($stid);
}

function form_option_Beosztas(){
    global $conn;
    $stid = oci_parse($conn, "SELECT MEGNEVEZES FROM BEOSZTAS");
    if(!$stid){
        $e = oci_error($conn);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

    $r = oci_execute($stid);
    if(!$r){
        $e = oci_error($stid);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

    while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
        foreach ($row as $item){
            print "<option value='" . $item . "'>" . $item . "</option>";
        }
    }
    oci_free_statement($stid);
}

//
//		EGYÉB FUNKCÓT ELLÁTÓ FV.-K
//

// sikeres vgrehajtástól függően visszad egy üzenetet:: "Sikertelen/Sikeres művelet!";
function sql_code_vegrehajtas($sql_code, $header){
	global $conn;
    $stid = oci_parse($conn, $sql_code );
	$success_message = "<h2 style='color: green;' class='center'>Sikeres művelet!</h2>";;
	
    $r = oci_execute($stid, OCI_NO_AUTO_COMMIT);
if (!$r) {    
    $e = oci_error($stid);
    //oci_rollback($conn);  // rollback changes to both tables
    //trigger_error(htmlentities($e['message']), E_USER_ERROR);
	$success_message = "<h2 class='hiba' >Sikertelen művelet!</h2>";
}

// Commit the changes to both tables
$r = oci_commit($conn);
if (!$r) {
    //$e = oci_error($conn);
    //trigger_error(htmlentities($e['message']), E_USER_ERROR);
}
	
	
    oci_free_statement($stid);
	header("Location: " . $header . "?message=" . $success_message );
}

function sql_code_v($sql_code, $header){
	global $conn;
    $stid = oci_parse($conn, $sql_code );
	$success_message = "<h2 style='color: green;' class='center'>Sikeres művelet!</h2>";;
	
    $r = oci_execute($stid, OCI_NO_AUTO_COMMIT);
if (!$r) {    
    $e = oci_error($stid);
    //oci_rollback($conn);  // rollback changes to both tables
    //trigger_error(htmlentities($e['message']), E_USER_ERROR);
	$success_message = "<h2 class='hiba' >Sikertelen művelet!</h2>";
}

// Commit the changes to both tables
$r = oci_commit($conn);
if (!$r) {
    //$e = oci_error($conn);
    //trigger_error(htmlentities($e['message']), E_USER_ERROR);
}
	echo $success_message;
	
    oci_free_statement($stid);
}

// sikeres vgrehajtástól függően visszad egy üzenetet:: "Sikertelen/Sikeres művelet!";
function sql_code_vegrehajtas_jegyvasar($sql_code, $header){
	global $conn;
    $stid = oci_parse($conn, $sql_code );
	$success_message = "<h2 style='color: green;' class='center'>Sikeres művelet!</h2>";;
	
    $r = oci_execute($stid, OCI_NO_AUTO_COMMIT);
if (!$r) {    
    //$e = oci_error($stid);
    oci_rollback($conn);  // rollback changes to both tables
    //trigger_error(htmlentities($e['message']), E_USER_ERROR);
	$success_message = "<h2 class='hiba' >Sikertelen művelet!</h2>";
}

// Commit the changes to both tables
$r = oci_commit($conn);
if (!$r) {
    //$e = oci_error($conn);
    //trigger_error(htmlentities($e['message']), E_USER_ERROR);
}
	
	
    oci_free_statement($stid);
	header("Location: " . $header . "&message=" . $success_message );
}


// sikeres vgrehajtástól függően visszad egy üzenetet:: "Sikertelen/Sikeres művelet!";
function sql_code_vegrehajtas_jegykezeles($sql_code, $header){
	global $conn;
    $stid = oci_parse($conn, $sql_code );
	$success_message = "<h2 style='color: green;' class='center'>Érvényes a jegy!</h2>";;
	
    $r = oci_execute($stid, OCI_NO_AUTO_COMMIT);
if (!$r) {    
    //$e = oci_error($stid);
    oci_rollback($conn);  // rollback changes to both tables
    //trigger_error(htmlentities($e['message']), E_USER_ERROR);
	$success_message = "<h2 class='hiba' >A jegy érvénytelen!</h2>";
}

// Commit the changes to both tables
$r = oci_commit($conn);
if (!$r) {
    //$e = oci_error($conn);
    //trigger_error(htmlentities($e['message']), E_USER_ERROR);
}
	
	
    oci_free_statement($stid);
	header("Location: " . $header . "?message=" . $success_message );
}

function current_time_php(){
	global $conn;
	$stid = oci_parse($conn, "SELECT TO_CHAR(SYSDATE, 'YYYY-MM-DD HH24:MI') FROM dual");
	if(!$stid){
		$e = oci_error($conn);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	$r = oci_execute($stid);
	if(!$r){
		$e = oci_error($stid);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){
		foreach ($row as $item){
			print str_replace(' ', 'T', $item);
		}
	}
	oci_free_statement($stid);
}

function vasarlas( $jaratszam, $jegytipus, $db, $sz){
	
	$header = "jegy_vasarlas.php?jaratszam=" . $_GET["jaratszam"];
	$sql_code =
	"BEGIN 
		NEW_VASARLAS(" . $jaratszam . ", '" . $jegytipus . "', " . $db . ", '" . $sz . "');
	END;
					";
	//echo $sql_code;
	sql_code_vegrehajtas_jegyvasar($sql_code, $header);
}











?>



