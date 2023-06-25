<?php

namespace App\Http\Controllers;

class HelpController extends Controller
{
    public function show()
    {
        $url = url('/');
        $routes = [
            "Show Upload video view" => $url . "/upload",
            "Show videos" => $url . "/videos",
            "Upload video request" => $url . "/video/upload",
            "Sign Up" => $url . "/signup",
            "Sign In " => $url . "/signin",
        ];
        return view('help', compact('routes'));
    }
}
