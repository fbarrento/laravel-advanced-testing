<?php

namespace Tests\PHPUnit\Unit;

use App\Exceptions\CurrencyRateNotFoundException;
use App\Services\CurrencyService;
use PHPUnit\Framework\TestCase;

class CurrencyTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_convert_usd_to_eur_successful(): void
    {
        $result = (new CurrencyService())
            ->convert(100, 'usd', 'eur');

        $this->assertEquals(98, $result);
    }

    public function test_convert_usd_to_gbp_return_zero(): void
    {
        $result = (new CurrencyService())
            ->convert(100,  'usd', 'gbp');

        $this->assertEquals(0, $result);
    }

    public function test_convert_gbp_to_usd_returns_zero()
    {
        $this->expectException(CurrencyRateNotFoundException::class);

        (new CurrencyService())
            ->convert(
                amount: 100,
                currencyFrom: 'gbp',
                currencyTo: 'usd'
            );
    }
}
