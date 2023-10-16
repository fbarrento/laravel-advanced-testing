<?php

use App\Http\Controllers\Products\{
    IndexController as ProductIndexController,
    CreateController as ProductCreateController,
    StoreController as ProductStoreController,
    EditController as ProductEditController,
    UpdateController as ProductUpdateController,
    DestroyController as ProductDestroyController,
    DownloadController as ProductDownloadController
};

use App\Http\Controllers\WebpConverter\{
    IndexController as WebpConverterIndexController,
    UploadController as WebpConverterUploadController
};

use App\Http\Controllers\ProfileController;
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

Route::prefix('webp-converter')->group(function () {
    Route::get('/', WebpConverterIndexController::class)
        ->name('webp-converter.index');
    Route::post('/upload', WebpConverterUploadController::class)
        ->name('webp-converter.upload');;
});

Route::get('openai', \App\Http\Controllers\OpenAIController::class);

Route::get('download', ProductDownloadController::class);

Route::prefix('products')->middleware(['auth'])->group(function () {
    Route::get('/', ProductIndexController::class)
        ->name('products');

    Route::middleware(['is_admin'])->group(function () {
        Route::post('', ProductStoreController::class)
            ->name('products.store');

        Route::get('/create', ProductCreateController::class)
            ->name('products.create');

        Route::get('/{product}/edit', ProductEditController::class)
            ->name('products.edit');

        Route::put('{product}', ProductUpdateController::class)
            ->name('products.update');

        Route::delete('{product}', ProductDestroyController::class)
            ->name('products.delete');

    });
});

require __DIR__.'/auth.php';



