<?php

namespace App\Http\Controllers;

use App\Mail\Post_Liked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Dashboard_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index() {
        return view('dashboard');
    }
}
