<?php

use App\Http\Controllers\AiQuestionController;
use App\Http\Controllers\ConceptController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('domains', DomainController::class);
    Route::resource('domains.concepts', ConceptController::class)->parameters(['concepts' => 'concept']);
    Route::post('domains/{domain}/concepts/{concept}/toggle-status', [ConceptController::class, 'toggleStatus'])->name('concepts.toggle-status');
    Route::post('domains/{domain}/concepts/{concept}/restore', [ConceptController::class, 'restore'])->name('concepts.restore');
    Route::get('domains/{domain}/concepts/archived', [ConceptController::class, 'archived'])->name('concepts.archived');
    Route::post('domains/{domain}/concepts/{concept}/generate', [AiQuestionController::class, 'generate'])->name('concepts.generate');
    Route::delete('generated-questions/{generation}', [AiQuestionController::class, 'destroy'])->name('generated-questions.destroy');
});

require __DIR__.'/auth.php';
