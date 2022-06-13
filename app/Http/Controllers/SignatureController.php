<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SignatureController extends Controller
{
    public function index(): View
    {
        return view('pages.signature');
    }

    public function home(): RedirectResponse
    {
        return redirect()->route('signature.index');
    }
}
