<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\UserTicketsController;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;

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

Broadcast::routes(['middleware' => ['auth:sanctum']]);

Route::post('/login', LoginController::class);

Route::middleware('auth:sanctum')->get('/open', [TicketsController::class, 'open']);
Route::middleware('auth:sanctum')->get('/closed', [TicketsController::class, 'closed']);
Route::middleware('auth:sanctum')->get('/users/{email}/tickets', UserTicketsController::class);
Route::middleware('auth:sanctum')->get('/stats', StatsController::class);


