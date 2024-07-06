<?php

if (!function_exists('format_idr')) {
    function format_idr($number)
    {
        return 'Rp ' . number_format($number, 0, ',', '.');
    }
}
