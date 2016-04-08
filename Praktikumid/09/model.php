<?php

$model_data = array();

function model_load()
{
    global $model_data;

    if (empty($_SESSION['ladu'])) {
        $model_data = array();
    } else {
        $model_data = json_decode($_SESSION['ladu'], true);
    }

    return true;
}

function model_save()
{
    global $model_data;
    $_SESSION['ladu'] = json_encode($model_data);

    return true;
}

model_load();
