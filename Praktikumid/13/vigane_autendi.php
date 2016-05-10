<?php

$host = 'localhost';
$user = 'test';
$pass = 't3st3r123';
$db = 'test';

$l = mysqli_connect($host, $user, $pass, $db);
mysqli_query($l, 'SET CHARACTER SET UTF8');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $user = $_POST['user'];
    // $user = addslashes($user);
    $pass = $_POST['pass'];

    $query = "SELECT Id FROM areinman__kasutajad WHERE Kasutajanimi='$user' AND Parool=MD5('$pass')";
    $result = mysqli_query($l, $query);
    $row = mysqli_fetch_assoc($result);
    if(!$row){
        echo 'Viga!';
        exit;
    }
    echo 'Sisse logitud kui #' . $row['Id'];
    exit;
}

?>

<form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
    <input type="text" name="user" value="admin"/> kasutajanimi<br />
    <input type="text" name="pass" /> parool<br />
    <button type="submit">Logi sisse</button>
</form>
