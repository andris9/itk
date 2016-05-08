<?php

$host = 'localhost';
$user = 'test';
$pass = 't3st3r123';
$db = 'test';

$l = mysqli_connect($host, $user, $pass, $db);
mysqli_query($l, 'SET CHARACTER SET UTF8');

function model_load()
{
    global $l;

    $query = 'SELECT * FROM areinman__kaubad ORDER BY Nimetus ASC';
    $result = mysqli_query($l, $query);

    $rows = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function model_add($nimetus, $kogus)
{
    global $l;

    $query = 'INSERT INTO areinman__kaubad (Nimetus, Kogus) VALUES (?, ?)';
    $stmt = mysqli_prepare($l, $query);
    mysqli_stmt_bind_param($stmt, 'si', $nimetus, $kogus);

    mysqli_stmt_execute($stmt);

    $id = mysqli_stmt_insert_id($stmt);

    mysqli_stmt_close($stmt);

    return $id;
}

function model_delete($id)
{
    global $l;

    $query = 'DELETE FROM areinman__kaubad WHERE Id=? LIMIT 1';
    $stmt = mysqli_prepare($l, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);

    mysqli_stmt_execute($stmt);

    $deleted = mysqli_stmt_affected_rows($stmt);

    mysqli_stmt_close($stmt);

    return $deleted;
}

function model_user_add($kasutajanimi, $parool)
{
    global $l;

    $hash = password_hash($parool, PASSWORD_DEFAULT);

    $query = 'INSERT INTO areinman__kasutajad (Kasutajanimi, Parool) VALUES (?, ?)';
    $stmt = mysqli_prepare($l, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $kasutajanimi, $hash);

    mysqli_stmt_execute($stmt);

    $id = mysqli_stmt_insert_id($stmt);

    mysqli_stmt_close($stmt);

    return $id;
}
