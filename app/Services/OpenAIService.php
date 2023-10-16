<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class OpenAIService
{



    public function sendMessage(string $message): mixed
    {

        $key = env('OPENAI_API_KEY');
        $organization = env('OPENAI_API_ORGANIZATION');
        return $this->getResponse($message, $key, $organization)->json();

    }

    private function getResponse(string $message, string $key, string $organization): Response
    {
        return Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $key,
            'OpenAI-Organization' => $organization
        ])
            ->post("https://api.openai.com/v1/chat/completions", [
                "model" => "gpt-3.5-turbo",
                'messages' => [
                    [
                        "role" => "user",
                        "content" => $message
                    ]
                ],
                'temperature' => 0.5,
                "max_tokens" => 1024,
                "top_p" => 1.0,
                "frequency_penalty" => 0.52,
                "presence_penalty" => 0.5,
                "stop" => ["11."],
            ]);
    }

}
