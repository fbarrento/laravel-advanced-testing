<?php

namespace App\Http\Controllers;

use App\Services\OpenAIService;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;

class OpenAIController extends Controller
{

    public OpenAIService $openAIService;
    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    public function __invoke(Request $request): Response
    {
        $response = $this->openAIService->sendMessage('Create a list of 8 questions for a interview of a sales rep to sale credit cards.');
        return $response;
    }
}
