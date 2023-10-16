<?php

namespace App\Services;

use App\Exceptions\CurrencyRateNotFoundException;
use Illuminate\Support\Arr;

class CurrencyService
{

    const RATES = [
        'usd' => [
            'eur' => 0.98
        ]
    ];

    /**
     * @param int $amount
     * @param string $currencyFrom
     * @param string $currencyTo
     * @return int
     * @throws CurrencyRateNotFoundException
     */
    public function convert(int $amount, string $currencyFrom, string $currencyTo): int
    {

        if (! Arr::exists(self::RATES, $currencyFrom)) {
            throw new CurrencyRateNotFoundException('Currency Rate Not Found');
        }

        $rate = self::RATES[$currencyFrom][$currencyTo] ?? 0;

        return round(num: $amount * $rate, precision: 2);
    }

}
