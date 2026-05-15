<?php

use App\Http\Controllers\AiQuestionController;
use App\Http\Controllers\ArchivesController;
use App\Http\Controllers\ConceptController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/domains/archived', [DomainController::class, 'archived'])->name('domains.archived');
    Route::resource('domains', DomainController::class)->except(['show']);
    Route::get('domains/{domain}', [DomainController::class, 'show'])->name('domains.show');
    Route::post('domains/{domain}/restore', [DomainController::class, 'restore'])->name('domains.restore');
    Route::delete('domains/{domain}/force-delete', [DomainController::class, 'forceDelete'])->name('domains.force-delete');

    // More specific routes must come before resource() declaration
    Route::get('domains/{domain}/concepts/archived', [ConceptController::class, 'archived'])->name('concepts.archived');
    Route::post('domains/{domain}/concepts/{concept}/toggle-status', [ConceptController::class, 'toggleStatus'])->name('concepts.toggle-status');
    Route::post('domains/{domain}/concepts/{concept}/restore', [ConceptController::class, 'restore'])->name('concepts.restore');

    Route::resource('domains.concepts', ConceptController::class)->parameters(['concepts' => 'concept']);
    Route::post('domains/{domain}/concepts/{concept}/generate', [AiQuestionController::class, 'generate'])->name('concepts.generate');
    Route::delete('generated-questions/{generation}', [AiQuestionController::class, 'destroy'])->name('generated-questions.destroy');
    Route::get('/archives', [ArchivesController::class, 'index'])->name('archives.index');
    Route::post('/archives/{concept}/restore', [ArchivesController::class, 'restore'])->name('archives.restore');
    Route::delete('/archives/{concept}', [ArchivesController::class, 'destroy'])->name('archives.destroy');
});

require __DIR__.'/auth.php';
