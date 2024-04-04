<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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

    
});

#prefix rappresenta il nome del gruppo di views che saranno del tipo localhost/dashboard/
#name rappresenta il nome del gruppo di rotte che saranno del tipo dashboard.projects.index ecc..
Route::middleware('auth')
    ->prefix('dashboard')
    ->name('dashboard.')
    ->group(function () {

    Route::resource('projects', ProjectController::class)->parameters([
        'projects' => 'project:repo_name'
    ]);

    Route::resource('types', TypeController::class);

});

require __DIR__.'/auth.php';
