<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LabStudentController extends Controller
{
    public function index()
    {
        return view('Admin.student');
    }
}
