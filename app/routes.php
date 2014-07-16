<?php
// protected routes:
Route::group(['before' => 'auth'], function () {

        // home controller
        Route::get('/', ['uses' => 'HomeController@index', 'as' => 'index']);

        // chart controller
        Route::get('/chart/home/account/{account?}', ['uses' => 'ChartController@homeAccount', 'as' => 'chart.home']);
        Route::get('/chart/home/budgets', ['uses' => 'ChartController@homeBudgets', 'as' => 'chart.budgets']);
        Route::get('/chart/home/beneficiaries', ['uses' => 'ChartController@homeBeneficiaries', 'as' => 'chart.beneficiaries']);
        Route::get('/chart/home/categories', ['uses' => 'ChartController@homeCategories', 'as' => 'chart.categories']);

        // preferences controller
        Route::get('/preferences', ['uses' => 'PreferencesController@index', 'as' => 'preferences']);

        // user controller
        Route::get('/logout', ['uses' => 'UserController@logout', 'as' => 'logout']);

        //profile controller
        Route::get('/profile', ['uses' => 'ProfileController@index', 'as' => 'profile']);
        Route::get('/profile/change-password',['uses' => 'ProfileController@changePassword', 'as' => 'change-password']);

        // account controller:
        Route::get('/accounts', ['uses' => 'AccountController@index', 'as' => 'accounts.index']);
        Route::get('/accounts/create', ['uses' => 'AccountController@create', 'as' => 'accounts.create']);
        Route::get('/accounts/{account}', ['uses' => 'AccountController@show', 'as' => 'accounts.show']);

        // JSON controller:
        Route::get('/json/beneficiaries', ['uses' => 'JsonController@beneficiaries', 'as' => 'json.beneficiaries']);
        Route::get('/json/categories', ['uses' => 'JsonController@categories', 'as' => 'json.categories']);


        // transaction controller:
          Route::get('/transactions/create/{what}', ['uses' => 'TransactionController@create', 'as' => 'transactions.create'])
            ->where(['what' => 'withdrawal|deposit|transfer']);


        Route::get('/transaction/show/{id}',['uses' => 'TransactionController@show','as' => 'transactions.show']);
        Route::get('/transaction/edit/{id}',['uses' => 'TransactionController@edit','as' => 'transactions.edit']);
        Route::get('/transaction/delete/{id}',['uses' => 'TransactionController@delete','as' => 'transactions.delete']);
        // migration controller
        Route::get('/migrate', ['uses' => 'MigrationController@index', 'as' => 'migrate']);

    }
);

// protected + csrf routes (POST)
Route::group(['before' => 'csrf|auth'], function () {
        // profile controller
        Route::post('/profile/change-password', ['uses' => 'ProfileController@postChangePassword']);

        // migration controller
        Route::post('/migrate', ['uses' => 'MigrationController@postIndex']);

        // preferences controller
        Route::post('/preferences', ['uses' => 'PreferencesController@postIndex']);

        // account controller:
        Route::get('/accounts/store', ['uses' => 'AccountController@store', 'as' => 'accounts.store']);

        // transaction controller:
        Route::post('/transactions/store/{what}', ['uses' => 'TransactionController@store', 'as' => 'transactions.store'])
            ->where(['what' => 'withdrawal|deposit|transfer']);
        Route::post('/transaction/update/{id}',['uses' => 'TransactionController@update','as' => 'transactions.update']);

    }
);

// guest routes:
Route::group(['before' => 'guest'], function () {
        // user controller
        Route::get('/login', ['uses' => 'UserController@login', 'as' => 'login']);
        Route::get('/register', ['uses' => 'UserController@register', 'as' => 'register']);
        Route::get('/verify/{verification}', ['uses' => 'UserController@verify', 'as' => 'verify']);
        Route::get('/reset/{reset}', ['uses' => 'UserController@reset', 'as' => 'reset']);
        Route::get('/remindme', ['uses' => 'UserController@remindme', 'as' => 'remindme']);

        // dev import route:
        Route::get('/dev',['uses' => 'MigrationController@dev']);
    }
);

// guest + csrf routes:
Route::group(['before' => 'csrf|guest'], function () {

        // user controller
        Route::post('/login', ['uses' => 'UserController@postLogin']);
        Route::post('/register', ['uses' => 'UserController@postRegister']);
        Route::post('/remindme', ['uses' => 'UserController@postRemindme']);
    }
);