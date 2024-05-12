<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Eredmény</title>
</head>
<body>
<div>
<?php

//session_start();

$servername = "localhost";
$username = "root";
$password = ""; // Jelszó üresen hagyva
$dbname = "email";

$re = '/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/';
if (!isset($_POST['email']) || !preg_match($re, $_POST['email'])) {
    exit("Adja meg az üzenetet a Kapcsolat fülön." . $_POST['email']);
}
if (!isset($_POST['szoveg']) || empty($_POST['szoveg'])) {
    exit("Hibás szöveg: " . $_POST['szoveg']);
}

echo "E-mail adatok: ";
echo "<pre>";
var_dump($_POST);
echo "</pre>";

if (isset($_SESSION['login'])) {
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=web1_bead', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

        $sqlSelect = "SELECT id, csaladi_nev, uto_nev FROM felhasznalok WHERE bejelentkezés = :bejelentkezes AND jelszo = SHA1(:jelszo)";
        $sth = $dbh->prepare($sqlSelect);
        $sth->bindParam(':bejelentkezes', $_SESSION['login']);
        $sth->execute();
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $_SESSION['csn'] = $row['csaladi_nev'];
            $_SESSION['un'] = $row['uto_nev'];
        }
        $id = $_SESSION['id'];
        $nev = $_SESSION['csn'];
    } catch (PDOException $e) {
        echo "Hiba az adatbáziskapcsolat létrehozása közben: " . $e->getMessage();
    }
} else {
    $nev = "Vendég";
}

$email = $_POST['email'];
$szoveg = $_POST['szoveg'];
//$felhasznalo = $_POST['felhasznalo'];
$d = date('Y-m-d H:i:s');

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $sql = "INSERT INTO email (id, felhasznalo, email, szoveg, datum) VALUES(:id, :felhasznalo, :email, :szoveg, :datum)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $nev);
    $stmt->bindParam(':felhasznalo', $nev);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':szoveg', $szoveg);
    $stmt->bindParam(':datum', $d);
    $stmt->execute();

    echo "A küldés sikeres volt!";
} catch (PDOException $e) {
    echo "Hiba az üzenet küldése közben: " . $e->getMessage();
}

?>
</div>
</body>
</html>
