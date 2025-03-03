<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Response;
use App\Models\Question;
use App\Models\Answer;

class ResponseController extends Controller
{
    public function submitAnswers(Request $request)
    {
        if (!session()->has('submit_count')) {
            session(['submit_count' => 1]);
        } else {
            session(['submit_count' => session('submit_count') + 1]);
        }

        $answers = $request->input('answer');

        $number = "คนที่ " . session('submit_count');
        
        if ($answers) {
            foreach ($answers as $questionId => $answerId) {
                if (!$answerId) {
                    continue;
                }
                $answer = Answer::find($answerId);
                
                if ($answer) {
                    Response::create([
                        'question_id' => $questionId,
                        'answer_id' => $answerId,
                        'answer_text' => $answer->answer_text,
                        'number_test' => $number,
                    ]);
                }
            }
        }
        
        return redirect()->route('index')->with('success', 'Your answers have been submitted!');
    }
}
