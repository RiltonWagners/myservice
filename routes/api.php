<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\PublicationController;
use App\Http\Controllers\api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
| middleware 'apiJwt' criado em: app\Http\Middleware\apiProtectedRoute.php
| 
| Authentication Guards: Next, you may define every authentication guard for your application.
| Em: config\auth.php
| 
|
*/

Route::post('auth/login'            , [AuthController::class,        'login'         ]);

Route::get('publications'           , [PublicationController::class, 'publications'  ]);
Route::get('publication/{id}'       , [PublicationController::class, 'publication'   ]);


Route::group(['middleware' => 'apiJwt'], function () {
    
    Route::get('user'                   , [UserController::class,        'show'             ]);
    Route::get('user/publications'      , [PublicationController::class, 'publicationsUser' ]);
    Route::get('user/publication/{id}'  , [PublicationController::class, 'publicationUser'  ]);


});


