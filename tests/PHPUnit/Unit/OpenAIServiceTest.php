<?php

namespace Tests\PHPUnit\Unit;

use App\Services\OpenAIService;
use Tests\TestCase;


class OpenAIServiceTest extends TestCase
{

    public function test_get_response_from_openai(): void
    {

        $response = (new OpenAIService())->sendMessage(
            'Please create a american test with questions and responses about snowflake cloud service. minimum of 2 questions.'
        );

        $this->assertNotEmpty($response);

    }


}
