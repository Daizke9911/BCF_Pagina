<?php

function maskNumber($number, $visibleStart = 4, $visibleEnd = 3, $maskChar = '*')
{
    $length = strlen($number);
    $maskedLength = $length - $visibleStart - $visibleEnd;

    if ($maskedLength <= 0) {
        return $number; // Si no hay nada que tapar, devuelve el número original
    }

    $start = substr($number, 0, $visibleStart);
    $end = substr($number, -$visibleEnd);
    $mask = str_repeat($maskChar, $maskedLength);

    return $start . $mask . $end;
}