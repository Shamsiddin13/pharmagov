<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will                
| be assigned to the "api" middleware group. Make something great!
|
*/

// Auth routes
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/register', [AuthController::class, 'register']);
Route::get('users', [AuthController::class, 'getAllUsers']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('auth/logout', [AuthController::class, 'logout']);
});

// Public API endpoints
Route::get('/version', function () {
    return response()->json([
        'version' => '1.0.0',
        'environment' => config('app.env')
    ]);
});

Route::get('/health', function () {
    return response()->json([
        'status' => 'healthy',
        'timestamp' => now()
    ]);
});

// Protected API endpoints
Route::middleware('auth:sanctum')->group(function () {
    // User endpoints
    Route::prefix('user')->group(function () {
        Route::get('/', function (Request $request) {
            return $request->user();
        });

        Route::get('/profile', function (Request $request) {
            return response()->json([
                'user' => $request->user(),
                'settings' => [
                    'notifications' => true,
                    'theme' => 'light'
                ]
            ]);
        });
    });

    // Dashboard endpoints
    Route::prefix('dashboard')->group(function () {
        Route::get('/stats', function () {
            return response()->json([
                'total_users' => 100,
                'active_users' => 50,
                'total_orders' => 1000,
                'revenue' => 50000
            ]);
        });

        Route::get('/recent-activity', function () {
            return response()->json([
                'activities' => [
                    ['type' => 'login', 'timestamp' => now()],
                    ['type' => 'order', 'timestamp' => now()->subHours(2)],
                    ['type' => 'payment', 'timestamp' => now()->subHours(3)]
                ]
            ]);
        });
    });
});