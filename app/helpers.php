<?php

function format_dollar_amount(float $amount): string
{
    $isNegative = $amount < 0;
    return ($isNegative ? '-' : '') . '$' . number_format(abs($amount), 2);
}

function format_date(string $date): string
{
    return date('M j, Y', strtotime($date));
}
