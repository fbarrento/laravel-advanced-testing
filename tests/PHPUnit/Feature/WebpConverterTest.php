<?php

namespace Tests\PHPUnit\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class WebpConverterTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_application_has_a_webp_converter_page(): void
    {
        $response = $this->get('/webp-converter');

        $response->assertOk();
    }

    public function test_webp_converter_page_has_a_title(): void
    {
        $response = $this->get('/webp-converter');

        $response->assertOk();
        $response->assertSee('<h1 class="text-3xl font-bold">WEBP Converter</h1>', false);
    }

    public function test_webp_converter_page_has_a_drop_zone(): void
    {
        $response = $this->get('/webp-converter');

        $response->assertOk();
        $response->assertSee('<label for="dropzone-file"', false);
    }

    public function test_upload_jpeg_file_successful(): void
    {
        Storage::fake('local');

        $response = $this->post('/webp-converter/upload', [
            'files' => [UploadedFile::fake()->image('photo1.jpg')]
        ]);


        Storage::disk('local')->assertExists('temp/photo1.jpg');
    }
}
