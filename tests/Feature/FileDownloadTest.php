<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
