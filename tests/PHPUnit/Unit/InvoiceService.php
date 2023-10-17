<?php

namespace Tests\PHPUnit\Unit;

use App\Services\PaymentGatewayService;
use App\Services\SalesTaxService;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class InvoiceService extends TestCase
{
    /**
     * A basic unit test example.
     * @throws Exception
     */
    public function test_it_processes_invoice(): void
    {
        $salesTaxServiceMock = $this->createMock(SalesTaxService::class);
        $paymentGatewayServiceMock = $this->createMock(PaymentGatewayService::class);

        $invoiceService = new \App\Services\InvoiceService(
            $salesTaxServiceMock,
            $paymentGatewayServiceMock
        );

        $paymentGatewayServiceMock->method('charge')->willReturn(true);

        $customer = ['name' => 'Frank'];
        $amount = 150;

        $result = $invoiceService->process($customer, $amount);

        $this->assertTrue($result);

    }
}
