<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuizAttemptController extends Controller
{
    public function start(Request $request, Quiz $quiz)
    {
        try {
            $attempt = QuizAttempt::create([
                'user_id' => auth()->id(),
                'quiz_id' => $quiz->id,
                'score' => 0,
            ]);

            return response()->json([
                'attempt' => $attempt,
                'quiz' => $quiz->load('questions.answers')
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to start quiz', 'error' => $e->getMessage()], 500);
        }
    }

    public function submit(Request $request, QuizAttempt $quizAttempt)
    {
        try {
            $validator = Validator::make($request->all(), [
                'answers' => 'required|array',
                'answers.*' => 'required|exists:answers,id',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            // Calculate score
            $score = 0;
            $quiz = $quizAttempt->quiz;
            $questions = $quiz->questions;
            
            foreach ($questions as $question) {
                $correctAnswer = $question->answers()->where('is_correct', true)->first();
                if (in_array($correctAnswer->id, $request->answers)) {
                    $score++;
                }
            }

            $quizAttempt->update([
                'score' => $score,
                'completed_at' => now(),
            ]);

            return response()->json([
                'attempt' => $quizAttempt,
                'score' => $score,
                'total' => $quiz->questions->count()
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to submit quiz', 'error' => $e->getMessage()], 500);
        }
    }
}
