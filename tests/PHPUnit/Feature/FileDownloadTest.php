<?php

namespace Tests\PHPUnit\Feature;

use Tests\TestCase;

class FileDownloadTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_product_success(): void
    {
        $response = $this->get('/download');


        $response->assertOk();
        $response->assertHeader(
            'Content-Disposition',
            'attachment; filename=test.txt'
        );
    }
}
