<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Publication\PublicationController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Service\ServiceController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\Auth\RegisterController;
//use App\Http\Controllers\Payment\MercadoPagoController;
use App\Http\Controllers\Webhooks\StripeController;
use App\Http\Controllers\Stripe\CreateController;
use App\Http\Controllers\Plan\PlanController;
use App\Http\Controllers\Business\BusinessController;
use App\Http\Controllers\Subscription\SubscriptionController;

use Illuminate\Support\Str;

Route::post('/create', [CreateController::class, 'create'         ])->name('create');
Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::middleware('auth:web')->group(function () {

    Route::get( '/home'                   ,[HomeController::class,           'index'   ])->name('home');
    
    Route::get(   '/my_business/show'    , [BusinessController::class,   'my_business_show'     ])->name('my_business.show');
    Route::get(   '/my_business/create'  , [BusinessController::class,   'my_business_create'   ])->name('my_business.create');
    Route::post(  '/my_business'         , [BusinessController::class,   'my_business_store'    ])->name('my_business.store');
    Route::get(   '/my_business/edit'    , [BusinessController::class,   'my_business_edit'     ])->name('my_business.edit');
    Route::put(   '/my_business/update'  , [BusinessController::class,   'my_business_update'   ])->name('my_business.update');
    Route::get(   '/my_business'         , [BusinessController::class,   'my_business'          ])->name('my_business.my_business');
    Route::get(   '/my_business/details' , [BusinessController::class,   'my_business_details'  ])->name('my_business.details');

    /*
    Route::get(   '/business/create' , [BusinessController::class,   'create'         ])->name('business.create');
    Route::post(  '/business'        , [BusinessController::class,   'store'          ])->name('business.store');
    Route::get(   '/business/edit'   , [BusinessController::class,   'edit'           ])->name('business.edit');
    Route::get(   '/business'        , [BusinessController::class,   'show'           ])->name('business.show');
    Route::put(   '/business/update' , [BusinessController::class,   'update'         ])->name('business.update');
    Route::get(   '/my_business'     , [BusinessController::class,   'my_business'    ])->name('business.my_business');
    Route::get(   '/business/details'     , [BusinessController::class,   'details'    ])->name('business.details');
    */

    Route::get(   '/my_publication/create'      , [PublicationController::class,   'create'  ])->name('my_publication.create');
    Route::post(  '/my_publication'             , [PublicationController::class,   'store'   ])->name('my_publication.store');
    Route::get(   '/my_publication/edit/{id}'   , [PublicationController::class,   'edit'    ])->name('my_publication.edit');
    Route::put(   '/my_publication/update/{id}' , [PublicationController::class,   'update'  ])->name('my_publication.update');
    Route::get(   '/my_publications'            , [PublicationController::class,   'my'      ])->name('my_publications.index');
    Route::get(   '/my_publication/{id}'        , [PublicationController::class,   'my_show' ])->name('my_publications.show');
    Route::delete('/my_publication/{id}'        , [PublicationController::class,   'destroy' ])->name('my_publication.destroy');

    Route::get(   '/category/create'      , [CategoryController::class,      'create'  ])->name('category.create');
    Route::get(   '/category'             , [CategoryController::class,      'index'   ])->name('category.index');
    Route::post(  '/category'             , [CategoryController::class,      'store'   ])->name('category.store');
    Route::get(   '/category/edit/{id}'   , [CategoryController::class,      'edit'    ])->name('category.edit');
    Route::put(   '/category/update/{id}' , [CategoryController::class,      'update'  ])->name('category.update');
    Route::delete('/category/{id}'        , [CategoryController::class,      'destroy' ])->name('category.destroy');


    Route::get(   '/service/create'       , [ServiceController::class,       'create'  ])->name('service.create');
    Route::get(   '/service'              , [ServiceController::class,       'index'   ])->name('service.index');
    Route::post(  '/service'              , [ServiceController::class,       'store'   ])->name('service.store');
    Route::get(   '/service/edit/{id}'    , [ServiceController::class,       'edit'    ])->name('service.edit');
    Route::put(   '/service/update/{id}'  , [ServiceController::class,       'update'  ])->name('service.update');
    Route::delete('/service/{id}'         , [ServiceController::class,       'destroy' ])->name('service.destroy');

    //Route::get(   '/plans/config'             , [PlanController::class,      'index'   ])->name('plan.index');
    Route::get(   '/plan/create'      , [PlanController::class,      'create'  ])->name('plan.create');
    Route::get(   '/plan/edit/{id}'   , [PlanController::class,      'edit'    ])->name('plan.edit');
    Route::get(   '/plan'              , [PlanController::class,       'index'   ])->name('plan.index');
    Route::post(  '/plan'             , [PlanController::class,      'store'   ])->name('plan.store');
    Route::put(   '/plan/update/{id}'  , [PlanController::class,       'update'  ])->name('plan.update');
    Route::delete('/plan/{id}'         , [PlanController::class,       'destroy' ])->name('plan.destroy');

    //Route::post('/subscription', [SubscriptionController::class, 'index'])->name('subscription');
    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions');
    Route::get('/subscriptions/show', [SubscriptionController::class, 'show'])->name('subscriptions.show');
    Route::post('/subscriptions/store', [SubscriptionController::class, 'store'         ])->name('subscriptions.store');
    
});

Route::get('/loadservices'      , [ServiceController::class,     'loadservices' ])->name('loadservices');
Route::get('/loadcities'        , [CityController::class,        'loadcities'   ])->name('loadcities');
Route::get('/loaddistrict'      , [DistrictController::class,    'show'         ])->name('loaddistrict');


Route::view('/privacy', 'privacy.index')->name('privacy.index');
Route::view('/welcome' , 'welcome.index')->name('welcome');
Route::get('/plans', [PlanController::class,      'plans'])->name('plans');
Route::view('/register/index', 'register.index')->name('register.index');
Route::POST('/register/index', [SubscriptionController::class, 'register'         ])->name('subscriptions.index');

//Route::get('/register/foryou'            , [HomeController::class, 'foryou'              ])->name('foryou');
//Route::get('/register/professional'      , [HomeController::class, 'professional'        ])->name('professional');
//Route::post('/register/index'      , [HomeController::class, 'register'        ])->name('register.index');
//Route::get('/register/index'      , [HomeController::class, 'register'        ])->name('register2');

Route::get('/business/{category:slug}/{id}/{name:slug}'       , [BusinessController::class,   'show'                 ])->name('business.show');
//Route::get('/business/{id}'       , [BusinessController::class,   'show'                 ])->name('business.show');

Route::get('/publication/{id}'  , [PublicationController::class, 'show'         ])->name('publication.show');
Route::get('/search'            , [HomeController::class, 'search'              ])->name('search');


Route::post('/stripe/webhook', [StripeController::class, 'stripe'         ])->name('webhook.stripe');
Route::post('/stripe/create', [StripeController::class, 'create_product'         ])->name('create.product');


Route::get('/{category:slug}'                     , [HomeController::class, 'search_category'             ])->name('search.category');
Route::get('/search/{state:slug}/{city:slug}/{filter_search:slug}' , [HomeController::class, 'search_category_city_search' ])->name('search.category_city_search');
Route::get('/{category:slug}/{state:slug}/{city:slug}'      , [HomeController::class, 'search_category_city'        ])->name('search.category_city');


//Route::get('/{state}/{city}/{filter_search}'        , [HomeController::class, 'search_category'     ])->name('search.category_city');
Route::get('/{state:slug}/{city:slug}'    , [HomeController::class, 'search_city'         ])->name('search.city');




