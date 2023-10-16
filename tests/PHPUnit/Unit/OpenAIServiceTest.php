<?php

namespace Tests\PHPUnit\Unit;

use App\Services\OpenAIService;
use Illuminate\Http\Client\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;


class OpenAIServiceTest extends TestCase
{

    public function test_get_response_from_openai(): void
    {


        $this->mock(OpenAIService::class, function (MockInterface $mock) {
            $mock->shouldReceive('sendMessage')
                ->once()
                ->andReturn('Hello from OpenAI');
        });

        $response = $this->get('/openai');

        $this->assertNotEmpty($response);
        $response->assertJson(fn (AssertableJson $json) =>
            $json->where('message', 'Hello from OpenAI')
        );

    }


}
