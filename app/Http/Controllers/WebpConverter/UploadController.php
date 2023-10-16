<?php

namespace App\Http\Controllers\WebpConverter;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {

        foreach ($request->file('files') as $file) {
            $fileName = $file->getClientOriginalName();
            $file->storeAs('temp', $fileName);
        }

        return back()->with('success', 'File uploaded successfully');

    }
}
