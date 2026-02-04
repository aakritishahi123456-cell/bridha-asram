<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::with('city')->get();
        
        return view('programs.index', compact('programs'));
    }
    
    public function show(Program $program)
    {
        $program->load('city');
        
        return view('programs.show', compact('program'));
    }
}