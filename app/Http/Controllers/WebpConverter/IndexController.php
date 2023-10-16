<?php

namespace App\Http\Controllers\WebpConverter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function __invoke(): View
    {
        return view('webp-converter.index');
    }
}
