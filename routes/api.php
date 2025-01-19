<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizAttemptController;
use App\Http\Controllers\ResultController;
// Auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

// Quizzes
Route::apiResource('quizzes', QuizController::class)->middleware('auth:api');

// Questions
Route::post('quizzes/{quizId}/questions', [QuestionController::class, 'store'])->middleware('auth:api');
Route::put('questions/{id}', [QuestionController::class, 'update'])->middleware('auth:api');
Route::delete('questions/{id}', [QuestionController::class, 'destroy'])->middleware('auth:api');

// Results
Route::post('quizzes/{quizId}/results', [ResultController::class, 'store'])->middleware('auth:api');
Route::get('results', [ResultController::class, 'index'])->middleware('auth:api');
