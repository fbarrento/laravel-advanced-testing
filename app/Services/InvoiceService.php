<?php

namespace App\Services;

class InvoiceService
{

    public function __construct(
        protected SalesTaxService $salesTaxService,
        protected PaymentGatewayService $gatewayService
    ) {

    }

    public function process(array $customer, float $amount): bool
    {

        $tax = $this->salesTaxService->calculate($amount, $customer);

        if (!$this->gatewayService->charge($customer, $amount, $tax)) {
            return false;
        }

        return true;

    }

}
