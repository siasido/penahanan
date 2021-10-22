<?php

function datetime_indo($param){
    if ($param){
        $datetimeIndo = new DateTime($param); 
        return $datetimeIndo->format('d/m/Y H:i');
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

function bulan($bln)
{
    switch ($bln)
    {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}

function date_indo_text($param){
    if ($param){
        $tgl = explode('-', $param);

        return ($tgl[2].' '.bulan($tgl[1]).' '.$tgl[0]);
    }
    return null;
}
