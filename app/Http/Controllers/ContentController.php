<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContentController extends Controller
{
    public function hairProblem(): View
    {
        return view ('content.hairProblem');
    }
}
