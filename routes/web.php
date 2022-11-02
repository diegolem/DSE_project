<?php

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

Route::get('/', function () {
    if(auth()->check()){
        return redirect('/' . strtolower(auth()->user()->userType->id));
    }else{
        return view('public.home');
    }
});

Auth::routes();

Route::get('/login', function (){
    if(Auth::check()){
        return redirect('/');
    }else{
        return view( 'public.login');
    }
})->name('login');

Route::get('/register', function(){
    return view('public.register');
})->name('register');

Route::post('/register', 'UserController@store')->name('register');

Route::middleware(['auth.admin'])->group(function(){
    Route::prefix('adm')->group(function(){
        Route::get('/', 'AdminController@index')->name('admin.index');
        Route::resource('users', 'UserController');
        Route::get('/', 'AccountantController@index')->name('accountant.index');
        Route::get('/new_users/{year?}', 'AccountantController@usuarios_registrados')->name('accountant.chart_newclient');
        Route::get('/income/{year?}', 'AccountantController@ingresos')->name('accountant.chart_ingreso');
        Route::get('/cars/{year?}', 'AccountantController@automoviles')->name('accountant.chart_automovil');
        Route::get('/mechanics', 'AccountantController@mecanicos')->name('accountant.chart_mecanicos');
        Route::get('/categories', 'AccountantController@categorias')->name('accountant.chart_categoria');
        Route::get('/customers', 'AccountantController@clientes')->name('accountant.chart_client');
        Route::get('/repairs', 'AccountantController@repairs')->name('accountant.repairs');
    });
});

Route::middleware(['auth.assistant'])->group(function(){
    Route::prefix('asi')->group(function(){
        Route::get('/', 'AssistantController@index')->name('assistant.index');
        Route::resource('cars', 'CarController');
        Route::resource('brands', 'BrandController');
        Route::resource('models','ModelController');
        Route::resource('specialties','SpecialityController');
        Route::resource('users', 'UserController');
        Route::resource('repairs', 'RepairController');
        Route::post('repairs/finish', ['as' => 'repairs.finish', 'uses' => 'RepairController@finish']);
//        Route::resource('details', 'DetailController');
        Route::get('repairs/pdf/{id}', ['as' => 'repairs.pdf', 'uses' => 'RepairController@pdf']);//PDF

        Route::get('details/create/{id}', [
            'as' => 'details.create',
            'uses' => 'DetailController@create'
        ]);

        Route::post('details/store', [
            'as' => 'details.store',
            'uses' => 'DetailController@store'
        ]);

        Route::resource('category','CategoryController');
        Route::post('mechanic/destroy','SpecialityController@destroyM')->name('specialties.mechanicDestroy');
        Route::post('mechanic/store','SpecialityController@storeM')->name('specialties.mechanicStore');
        Route::get('mechanic/storage','SpecialityController@createMC')->name('mechanic.storecreate');
        Route::post('get/mechanic','SpecialityController@recuperarM')->name('mechanic.get');
    });
});

Route::middleware(['auth.client'])->group(function(){
    Route::prefix('cle')->group(function(){
        Route::get('/', 'ClientController@index')->name('client.index');
        Route::resource('cars', 'CarController', ['except' => [ 'create', 'store' , 'edit', 'update', 'destroy' ]]);
        Route::resource('users', 'UserController');

        Route::post('enabledClient', 'CarController@enabledClient')->name('cars.enabledClient');
    });
});

Route::middleware(['auth.mechanic'])->group(function(){
    Route::prefix('mco')->group(function(){
        Route::get('/', 'MechanicController@index')->name('mechanic.index');

        Route::get('/details/create/{id}', 'DetailController@create')->name('mechanic.details.create');
        Route::post('/details/create', 'DetailController@store')->name('mechanic.details.store');
        Route::resource('users', 'UserController');
        Route::get('repairs/{id}', 'RepairController@show')->name('mechanic.repairs.show');
    });
});

//Route::get('/home', 'HomeController@index')->name('home');
