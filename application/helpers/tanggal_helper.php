<?php

function datetime_indo($param){
    if ($param){
        $datetimeIndo = new DateTime($param); 
        return $datetimeIndo->format('d-m-Y H:i:s');
    } 
    return null;
}

function date_indo($param){
    if ($param){
        $datetimeIndo = new DateTime($param); 
        return $datetimeIndo->format('d-m-Y');
    }
    return null;
}
