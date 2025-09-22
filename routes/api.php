<?php
use App\Events\OrderUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/order-status-update', function (Request $request) {
    $request->validate([
        'id' => 'required|integer',
        'status' => 'required|string|in:Ready,Cooking,Pending',
    ]);
    broadcast(new OrderUpdate($request->id, $request->status));
    return response()->noContent(200);
});
