<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use Illuminate\Http\Request;

class ProblemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get(Problem $problem)
    {
        return response(['problem' => $problem], 200);
    }
}
