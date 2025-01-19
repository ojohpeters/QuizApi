<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Result;

class ResultController extends Controller
{
    // Submit quiz answers and calculate results
    public function store(Request $request, $quizId)
    {
        try {$quiz = Quiz::with('questions.answers')->find($quizId);

            if (!$quiz) {
                return response()->json(['message' => 'Quiz not found'], 404);
            }
    
            $request->validate([
                'answers' => 'required|array', // User's answers
                'answers.*.question_id' => 'required|exists:questions,id',
                'answers.*.answer_id' => 'required|exists:answers,id',
            ]);
    
            $score = 0;
    
            // Calculate score
            foreach ($request->answers as $userAnswer) {
                $question = $quiz->questions->find($userAnswer['question_id']);
                $correctAnswer = $question->answers->where('is_correct', true)->first();
    
                if ($correctAnswer && $correctAnswer->id == $userAnswer['answer_id']) {
                    $score++;
                }
            }
    
            // Save the result
            $result = Result::create([
                'user_id' => auth()->id(),
                'quiz_id' => $quizId,
                'score' => $score,
            ]);
    
            return response()->json(['result' => $result, 'score' => $score]);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    // Get results for a user
    public function index()
    {
        $results = Result::where('user_id', auth()->id())->with('quiz')->get();

        return response()->json(['results' => $results]);
    }
}
