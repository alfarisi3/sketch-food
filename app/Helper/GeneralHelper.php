<?php

// format tanggal
if (!function_exists('dateFormat')) // jika fungsi dateIndo belum ada maka buat fungsi dateIndo
{
    function dateFormat($tanggal)
    {
        $value = carbon\Carbon::parse($tanggal);
        $parse = $value->locale('id');
        return $parse->translatedFormat('l, d F Y, H:i:s');
    }
}

// Format tanggal backEnd (Admin)
if (!function_exists('dateFormatBack')) {
    function dateFormatBack($tanggal, $jam = null)
    {
        $value = carbon\Carbon::parse($tanggal);
        $parse = $value->locale('id');

        if ($jam) {
            return $parse->translatedFormat('l, d F Y,' . $jam);
        } else {
            return $parse->translatedFormat('l, d F Y, H:i');
        }
    }
}

// Format tanggal frontEnd (User)
if
(!function_exists('dateFormatFront')) {
    function dateFormatFront($tanggal, $jam = null)
    {
        $value = carbon\Carbon::parse($tanggal);
        $parse = $value->locale('id');

        if ($jam) {
            return $parse->translatedFormat('d F Y,' . $jam);
        } else {
            return $parse->translatedFormat('d F Y, H:i');
        }
    }
}

// Format jam backend(admin)
if (!function_exists('timeFormatBack')) {
    function timeFormatBack($jam)
    {
        $value = carbon\Carbon::parse($jam);
        $parse = $value->locale('id');
        return $parse->translatedFormat('H:i');
    }
}

// Format jam frontEnd (User)
if (!function_exists('timeFormatFront')) {
    function timeFormatFront($jam)
    {
        $value = carbon\Carbon::parse($jam);
        $parse = $value->locale('id');
        return $parse->translatedFormat('H:i');
    }
}
