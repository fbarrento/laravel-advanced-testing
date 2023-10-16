<?php

namespace App\Services;

class CurrencyService
{

    const RATES = [
        'usd' => [
            'eur' => 0.98
        ]
    ];

    public function convert(int $amount, string $currencyFrom, string $currencyTo): int
    {
        $rate = self::RATES[$currencyFrom][$currencyTo] ?? 0;

        return round(num: $amount * $rate, precision: 2);
    }

}
