<?php
$user = 'web1_bead';
$password = 'admin123'; // Password should be empty if not set
$database = 'web1_bead';
$servername = 'mysql.omega:3306'; // Specify port if not default
$mysqli = new mysqli($servername, $user, $password, $database);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$sql = "SELECT felhasznalo, email, szoveg, datum FROM email ORDER BY datum DESC";
$result = $mysqli->query($sql);
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Üzenetek</title>
</head>
<body>
    <section>
        <h1>Üzenetek</h1><br>

        <table>
            <tr>
                <th>Felhasználó</th>
                <th>E-mail</th>
                <th>Üzenet</th>
                <th>Dátum</th>
            </tr>

            <?php
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['felhasznalo']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['szoveg']; ?></td>
                    <td><?php echo $row['datum']; ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </section>
</body>
</html>
