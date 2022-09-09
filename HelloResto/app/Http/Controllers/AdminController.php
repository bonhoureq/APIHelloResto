<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Product;

class AdminController extends Controller
{
    public function show()
    {
        return view('admin');
    }//
}
