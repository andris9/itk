<?php

session_start();

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
            $id = intval($_POST['id']);
            $result = controller_delete($id);
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

mysqli_close($l);
