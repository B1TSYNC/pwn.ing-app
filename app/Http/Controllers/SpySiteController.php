<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpySiteController extends Controller
{
    public function showForm()
    {
        return view('home');
    }

    public function showWebsite(Request $request)
    {
        if (auth()->check()) {
            $url = $request->input('url');
            return view('spy', ['url' => $url]);
        } else {
            return redirect()->route('home');
        }
    }
}
