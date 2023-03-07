<?php
/**
 * Created by PhpStorm.
 * User: gbmcarlos
 * Date: 10/30/18
 * Time: 11:44 AM
 */

namespace App\ServiceProviders;

use App\Controllers\BookEditorController;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class RoutesServiceProvider extends RouteServiceProvider {

    public function map(Request $request) {

        Route::get('/book-editor', BookEditorController::class . '@index');

    }

}