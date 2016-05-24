<?php

$host = 'localhost';
$user = 'test';
$pass = 't3st3r123';
$db = 'test';
$prefix = 'areinman';

$l = mysqli_connect($host, $user, $pass, $db);
mysqli_query($l, 'SET CHARACTER SET UTF8');

/**
 * Laeb andmebaasist kirjed valitud lehekülje kohta ja tagastab need massiivina.
 *
 * @param int $page Lehekülje number, mille kirjeid kuvada
 *
 * @return array Andmebaasi read
 */
function model_load($page)
{
    global $l, $prefix;
    $max = 5;
    $start = ($page - 1) * $max;

    $query = 'SELECT Id, Nimetus, Kogus FROM '.$prefix.'__kaubad ORDER BY Nimetus ASC LIMIT ?,?';
    $stmt = mysqli_prepare($l, $query);
    if (mysqli_error($l)) {
        echo mysqli_error($l);
        exit;
    }
    mysqli_stmt_bind_param($stmt, 'ii', $start, $max);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $nimetus, $kogus);

    $rows = array();
    while (mysqli_stmt_fetch($stmt)) {
        $rows[] = array(
            'id' => $id,
            'nimetus' => $nimetus,
            'kogus' => $kogus,
        );
    }

    mysqli_stmt_close($stmt);

    return $rows;
}

/**
 * Lisab andmebaasi uue rea.
 *
 * @param string $nimetus Kirje nimetus
 * @param int    $kogus   Mitu tükki nimetust on
 *
 * @return int Lisatud rea ID
 */
function model_add($nimetus, $kogus)
{
    global $l, $prefix;

    $query = 'INSERT INTO '.$prefix.'__kaubad (Nimetus, Kogus) VALUES (?, ?)';
    $stmt = mysqli_prepare($l, $query);
    if (mysqli_error($l)) {
        echo mysqli_error($l);
        exit;
    }

    mysqli_stmt_bind_param($stmt, 'si', $nimetus, $kogus);
    mysqli_stmt_execute($stmt);

    $id = mysqli_stmt_insert_id($stmt);

    mysqli_stmt_close($stmt);

    return $id;
}

/**
 * Kustutab valitud rea andmebaasist.
 *
 * @param int $id Kustutatava rea ID
 *
 * @return int Mitu rida kustutati
 */
function model_delete($id)
{
    global $l, $prefix;

    $query = 'DELETE FROM '.$prefix.'__kaubad WHERE Id=? LIMIT 1';
    $stmt = mysqli_prepare($l, $query);
    if (mysqli_error($l)) {
        echo mysqli_error($l);
        exit;
    }

    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);

    $deleted = mysqli_stmt_affected_rows($stmt);

    mysqli_stmt_close($stmt);

    return $deleted;
}

/**
 * Uuendab rea kogust andmebaasis.
 *
 * @param int $id    Muudetava rea ID
 * @param int $kogus Uus koguse number
 *
 * @return bool Tagastab true kui uuendamine õnnestus
 */
function model_update($id, $kogus)
{
    global $l, $prefix;

    $query = 'UPDATE '.$prefix.'__kaubad SET Kogus=? WHERE Id=? LIMIT 1';
    $stmt = mysqli_prepare($l, $query);
    if (mysqli_error($l)) {
        echo mysqli_error($l);
        exit;
    }
    mysqli_stmt_bind_param($stmt, 'ii', $kogus, $id);
    mysqli_stmt_execute($stmt);
    if (mysqli_stmt_error($stmt)) {
        return false;
    }
    mysqli_stmt_close($stmt);

    return true;
}

/**
 * Lisab andmebaasi uue kasutaja. Õnnestub vaid juhul kui sellist kasutajat veel pole.
 * Parool salvestatakse BCRYPT räsina.
 *
 * @param string $kasutajanimi Kasutaja nimi
 * @param string $parool       Kasutaja parool
 *
 * @return int lisatud kasutaja ID
 */
function model_user_add($kasutajanimi, $parool)
{
    global $l, $prefix;

    $hash = password_hash($parool, PASSWORD_DEFAULT);

    $query = 'INSERT INTO '.$prefix.'__kasutajad (Kasutajanimi, Parool) VALUES (?, ?)';
    $stmt = mysqli_prepare($l, $query);
    if (mysqli_error($l)) {
        echo mysqli_error($l);
        exit;
    }

    mysqli_stmt_bind_param($stmt, 'ss', $kasutajanimi, $hash);
    mysqli_stmt_execute($stmt);

    $id = mysqli_stmt_insert_id($stmt);

    mysqli_stmt_close($stmt);

    return $id;
}

/**
 * Tagastab kasutaja ID, kelle kasutajanimi ja parool klapivad sisendiga.
 *
 * @param string $kasutajanimi Otsitava kasutaja kasutajanimi
 * @param string $parool       Otsitava kasutaja parool
 *
 * @return int Kasutaja ID
 */
function model_user_get($kasutajanimi, $parool)
{
    global $l, $prefix;

    $query = 'SELECT Id, Parool FROM '.$prefix.'__kasutajad WHERE Kasutajanimi=? LIMIT 1';
    $stmt = mysqli_prepare($l, $query);
    if (mysqli_error($l)) {
        echo mysqli_error($l);
        exit;
    }

    mysqli_stmt_bind_param($stmt, 's', $kasutajanimi);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $hash);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // kontrollime, kas vabateksti $parool klapib baasis olnud räsiga $hash
    if (password_verify($parool, $hash)) {
        return $id;
    }

    return false;
}
