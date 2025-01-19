<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;

class QuizController extends Controller
{
    // List all quizzes
    public function index()
    {
        $quizzes = Quiz::with('questions.answers')->get();

        return response()->json(['quizzes' => $quizzes]);
    }

    // Show a single quiz
    public function show($id)
    {
        $quiz = Quiz::with('questions.answers')->find($id);

        if (!$quiz) {
            return response()->json(['message' => 'Quiz not found'], 404);
        }

        return response()->json(['quiz' => $quiz]);
    }

    // Create a new quiz
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $quiz = Quiz::create([
            'title' => $request->title,
            'user_id' => auth()->id(),
        ]);

        return response()->json(['quiz' => $quiz], 201);
    }

    // Update a quiz
    public function update(Request $request, $id)
    {
        $quiz = Quiz::find($id);

        if (!$quiz) {
            return response()->json(['message' => 'Quiz not found'], 404);
        }

        $request->validate(['title' => 'required|string|max:255']);

        $quiz->update(['title' => $request->title]);

        return response()->json(['quiz' => $quiz]);
    }

    // Delete a quiz
    public function destroy($id)
    {
        $quiz = Quiz::find($id);

        if (!$quiz) {
            return response()->json(['message' => 'Quiz not found'], 404);
        }

        $quiz->delete();

        return response()->json(['message' => 'Quiz deleted successfully']);
    }
}
