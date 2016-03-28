/* eslint-env browser */
'use strict';

/*
Seame nupule "Kuva lisamise vorm" sündmuse "click" halduri, mis peidab "kuva-nupp" paragrahvi,
aga toob nähtavale "lisa-vorm" form elemendi
*/
document.querySelector('#kuva-nupp button').addEventListener('click',
    /**
     * Funktsioon teeb vormi nähtavaks ning peidab "peida" nupu
     * @event
     */
    function () {
        document.getElementById('lisa-vorm').style.display = 'block';
        document.getElementById('kuva-nupp').style.display = 'none';
    });

/*
Seame nupule "Peida lisamise vorm" sündmuse "click" halduri, mis teeb "kuva-nupp"
paragrahvi nähtavaks, aga peidab "lisa-vorm" form elemendi
*/
document.querySelector('#peida-nupp button').addEventListener('click',
    /**
     * Funktsioon peidab vormi ning teeb nähtavaks "peida" nupu
     * @event
     */
    function () {
        document.getElementById('lisa-vorm').style.display = 'none';
        document.getElementById('kuva-nupp').style.display = 'block';
    });

/*
Lisame vormielemendile "lisa-vorm" sündmuse "submit" halduri, mis ilmeb siis kui kasutaja
kas klikib vormis asuval submit nupul või vajutab tekstikastis enter klahvi.
*/
document.getElementById('lisa-vorm').addEventListener('submit',
    /**
     * Käivitatakse vormi postitamisel. Kontrollib vormis olevaid väärtusi ja lisab
     * laotabelisse uue rea valitud väärtusega
     * @event
     * @param  {Event} event Sündmuse info
     */
    function (event) {
        // Katkestame tavalise submit tegevuse, vastasel korral navigeeriks brauser mujale
        event.preventDefault();

        // loeme tekstikastidest kasutaja sisestatud andmed
        var nimetus = document.getElementById('nimetus').value;
        var kogus = Number(document.getElementById('kogus').value);

        // kontrollime väärtuseid
        if (!nimetus || kogus <= 0) {
            alert('Vigased väärtused!');
            return;
        }

        // Kutsume välja AJAX päringu uue rea salvestamiseks ning laokirjete tabeli uuesti koostamiseks
        request('haldus.php', {
            method: 'post',
            // FormData koostab DOM vormielemendist mutlipart/form-data päringu sisu
            // ja paneb paika kõik seellega seonduvad päised
            body: new FormData(document.getElementById('lisa-vorm'))
        });
    });

/**
 * Funktsioon lisab laovaate tabelisse uue rea nimetuse,
 * koguse ja sama rea kustutamise nupuga
 * @param  {String} nimetus Kasutaja sisestatud artikli nimetus
 * @param  {String} kogus   Kasutaja sisestatud artikli kogus
 */
function lisaRida(nimetus, kogus, index) {

    // Loome vajalikud DOM elemendid, millest rida kokku panna
    var rida = document.createElement('tr'); // <tr></tr>
    var tdNimetus = document.createElement('td'); // <td></td>
    var tdKogus = document.createElement('td');
    var tdTegevused = document.createElement('td');
    var kustutaNupp = document.createElement('input');

    // Seame tekstiväärtused vastavate lahtrite tekstiliseks sisuks
    tdNimetus.textContent = nimetus; // <td>Külmkapp</td>
    tdKogus.textContent = kogus;

    // Muudame kustutamise nuppu, seame sellele "type" ning "value" väärtused
    kustutaNupp.setAttribute('type', 'button');
    kustutaNupp.value = 'Kustuta rida';

    // Lisame nupu elemendi tegevuste lahtrisse
    tdTegevused.appendChild(kustutaNupp); // <td><input type="button" value="Kustuta rida"></td>

    // Moodustame eraldiseisvatest lahtritest ühe tervikliku rea
    rida.appendChild(tdNimetus); // <tr><td>Külmkapp</td></tr>
    rida.appendChild(tdKogus);
    rida.appendChild(tdTegevused);

    // lisame rea lehel olevasse tabelisse
    document.querySelector('#ladu tbody').appendChild(rida); // <tbody><tr><td>Külmkapp</td></tr></tbody>

    kustutaNupp.addEventListener('click',
        /**
         * Käivitatakse "kustuta" nupul klikkimisel. Kustutab laotabelist varem lisatud rea
         * @event
         */
        function () {
            if (confirm('Kas oled kindel')) {
                //Kutsume välja AJAX päringu valitud rea kustutamiseks ja laotabeli uuendamiseks
                request('haldus.php', {
                    method: 'post',
                    // Kuna koostame päringu sisu käsitsi peame serverile ette ütlema ka
                    // kasutatud andmete kodeeringu. Vaikimisi on Content-Type väärtuseks
                    // text/plain ja selle seest ei oska PHP õigeid andmeid välja lugeda
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    // kasutame urlencoded kodeeringut kujul: key1=value1&key2=value2&...&keyN=valueN
                    body: 'kustuta=' + index
                });
            }
        });
}

function request(url, options) {
    fetch('haldus.php', options).then(function (res) {
        if (res.ok) {
            return res.json();
        } else {
            throw new Error('Vigane vastuskood!');
        }
    }).then(function (data) {

        // tühjendame vormiväljad kuna saame andmed juba tabelisse kanda
        document.getElementById('nimetus').value = '';
        document.getElementById('kogus').value = '';

        //
        document.querySelector('#ladu tbody').innerHTML = '';

        for (var i = 0; i < data.length; i++) {
            lisaRida(data[i].nimetus, data[i].kogus, i);
        }

    }).catch(function (err) {
        alert('Ilmnes viga: ' + err.message);
    });
}

// Kutsume välja AJAX päringu ja laotabeli koostamise.
// Kuna funktsioon käivitatakse lehe laadimise järel, siis
// ilmub päringu tagajärjel laoseis koheselt ekraanile.
// Täiendavaid argumente pole vaja kasutada, kuna tegu on
// vaikimisi GET päringuga
request('haldus.php');
