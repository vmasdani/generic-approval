<?php

use App\Models\ApprovalConfig;
use App\Models\Document;
use App\Models\DocumentApproval;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', function () {
    return User::all();
});

Route::get('/approvalconfigs', function () {
    return ApprovalConfig::all();
});

Route::get('/documents', function () {
    return Document::all();
});

Route::get('/documentapprovals', function () {
    return DocumentApproval::all();
});
