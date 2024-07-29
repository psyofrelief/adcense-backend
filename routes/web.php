<?php

use App\Http\Controllers\AdDomainController;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return view("home");
});

Route::middleware(["cors"])->group(function () {
    Route::get("/ad-domains", "AdDomainController@index");
});

Route::get("/ad-domains", [AdDomainController::class, "index"]);
Route::post("/ad-domains", [AdDomainController::class, "store"]);
Route::delete("/ad-domains", [AdDomainController::class, "destroy"]);
