<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Response;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('answers')->get();

        return view('welcome', compact('questions'));
    }

}