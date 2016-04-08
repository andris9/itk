<?php

session_start();

$username = 'testkasutaja';
$password = 'testparool';

if (
    !isset($_SERVER['PHP_AUTH_USER']) ||
    $_SERVER['PHP_AUTH_USER'] != $username ||
    $_SERVER['PHP_AUTH_PW'] != $password
  ) {
    header('HTTP/1.0 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="ladu"');

    header('Content-Type: text/plain; charset=utf-8');
    echo 'Autentimine ebaõnnestus';
    exit;
}

// laeme andmete haldamise meetodid
require 'model.php';

// laeme andmete modifitseerimise meetodid
require 'controller.php';

// rakenduse "ruuter"
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // $result muutuja indikeerib kas toimus mõni õnnestunud tegevus või mitte
    $result = false;

    switch ($_POST['action']) {

        case 'add':
            $nimetus = $_POST['nimetus'];
            $kogus = intval($_POST['kogus']);
            $result = controller_add($nimetus, $kogus);
            break;

        case 'delete':
            $kustuta = intval($_POST['kustuta']);
            $result = controller_delete($kustuta);
            break;
    }

    if ($result) {
        // kuna $result on true siis järelikult toimus mõni õnnestunud tegevus
        // sellisel juhul suuname kasutaja tagasi eelmisele lehele
        header('Location: '.$_SERVER['PHP_SELF']);
    } else {
        header('Content-type: text/plain; charset=utf-8');
        echo 'Päring ebaõnnestus!';
    }

    // POST päringu puhul me sisu ei näita
    exit;
}

require 'view.php';
