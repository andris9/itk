<?php

function controller_add($nimetus, $kogus)
{
    // kontrollime kas sisendväärtused on oodatud kujul või mitte
    if ($nimetus == '' || $kogus <= 0) {
        return false;
    }

    return model_add($nimetus, $kogus);
}

function controller_delete($id)
{
    if ($id <= 0) {
        return false;
    }

    return model_delete($id);
}
