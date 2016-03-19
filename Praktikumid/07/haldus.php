<?php

// Fail peab olema veebiserveri kasutaja jaoks kirjutatav
$baas = 'faili-asukoht.txt';

// loeme faili sisu tekstina muutujasse
$andmebaas = file_get_contents($baas);
// deserialiseerime teksti JSON formaadist masiiviks
$andmebaas = json_decode($andmebaas, true);

// järgneva käivitame ainult POST päringu korral
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['kustuta'])) { // kontrollime kas vormis oli väli nimega "kustuta"

        // eemaldame valitud indeksiga elemendi massiivist
        $kustuta = intval($_POST['kustuta']);
        unset($andmebaas[$kustuta]);

    } else {

        $nimetus = $_POST['nimetus'];
        // kogus on number seega peame stringisisendi numbriks sundima
        $kogus = intval($_POST['kogus']);

        // kontrollime kas sisendväärtused on oodatud kujul või mitte
        if ($nimetus == '' || $kogus <= 0) {
            header('Content-Type: text/plain; charset=utf-8');
            echo 'Vigased väärtused!';
            exit;
        }

        // lisame kirje "andmebaasi", st. et lisame massiivi uue indeksi koos vormi andmetega
        $andmebaas[] = array(
            'nimetus' => $nimetus,
            'kogus' => $kogus,
        );
    }

    // salvestame muudetud massiivi
    // kõigepealt serialiseerime massiivi JSON stringiks
    $andmebaas = json_encode($andmebaas);
    // salvestame serialiseeritud stringi andmebaasifaili
    file_put_contents($baas, $andmebaas);

    // suuname brauseri tagasi esialgsele lehele
    header('Location: ladu.php');
}
