<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    // Add a question to a quiz
    public function store(Request $request, $quizId)
    {
       try {
        // Validate the request data
        $request->validate([
            'question_text' => 'required|string',
            'answers' => 'required|array|min:2', // At least 2 answers
            'answers.*.answer_text' => 'required|string',
            'answers.*.is_correct' => 'required|boolean',
        ]);

        // Create the question
        $question = Question::create([
            'quiz_id' => $quizId,
            'question_text' => $request->question_text,
        ]);

        // Create answers for the question
        $question->answers()->createMany($request->answers);

        return response()->json([
            'error' => false,
            'question' => $question->load('answers')
        ], 201); // 201 Created
       } catch (\Exception $e) {
        return response()->json([
        "error"=>$e->getMessage()]);
       }
    }

    // Update a question and its answers
    public function update(Request $request, $id)
    {
        // Attempt to find the question
        $question = Question::find($id);

        // If the question is not found, return an error response
        if (!$question) {
            return response()->json([
                'error' => true,
                'message' => 'Question not found'
            ], 404);
        }

        // Validate the request data
        $request->validate([
            'question_text' => 'required|string',
            'answers' => 'required|array|min:2', // At least 2 answers
            'answers.*.answer_text' => 'required|string',
            'answers.*.is_correct' => 'required|boolean',
        ]);

        // Update the question text
        $question->update(['question_text' => $request->question_text]);

        // Delete old answers and recreate new ones
        $question->answers()->delete();
        $question->answers()->createMany($request->answers);

        return response()->json([
            'error' => false,
            'question' => $question->load('answers')
        ]);
    }

    // Delete a question
    public function destroy($id)
    {
        // Attempt to find the question
        $question = Question::find($id);

        // If the question is not found, return an error response
        if (!$question) {
            return response()->json([
                'error' => true,
                'message' => 'Question not found'
            ], 404);
        }

        // Delete the question
        $question->delete();

        return response()->json([
            'error' => false,
            'message' => 'Question deleted successfully'
        ]);
    }
}
