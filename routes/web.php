<?php

$mainRouter = function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::post('/gdpr', 'HomeController@gdpr');
    Auth::routes();

// Main site cart
    Route::group(['prefix' => 'cart'], function () {
        Route::post('/checkout', 'CartController@page')->name('checkout');
        Route::get('/success', 'CartController@success')->name('purchaseSuccess');
        Route::get('/failed', 'CartController@failed')->name('purchaseFailed');
        Route::put('/proccess', 'CartController@proccess')->name('purchase');
        Route::get('/check', 'CartController@check')->name('check');
    });

    Route::group(['prefix'=>'manage','middleware'=>'auth'],function() {
       Route::get('/dashboard','Panel\DashboardController@index')->name('manage.dashboard');
       Route::get('/page:profile','Panel\ProfileController@index')->name('manage.profile');
       Route::post('/update/password', 'Auth\ChangePasswordController@update')->name('manage.changepw');
       Route::get('/page:upgrade', 'Panel\UpgradeController@index')->name('manage.upgrade');
       Route::post('/page:upgrade/site', 'Panel\UpgradeController@show')->name('manage.siteupgrade');
       Route::post('/page:upgrade/upgrade', 'Panel\CheckoutController@proccess')->name('manage.upgradeproccess');
       Route::get('/page:upgrade/upgrade/check', 'Panel\CheckoutController@check')->name('manage.check');

       Route::group(['prefix'=>'site','middleware'=>['auth','siteToUser']],function() {

           Route::get('/{slug}/home','ShopPanel\HomeController@index')->name('site.home');
           Route::get('/{slug}/design/sidebars','ShopPanel\SidebarController@index')->name('site.sidebars');
           Route::get('/{slug}/design/change','ShopPanel\DesignController@index')->name('site.design');
           Route::get('/{slug}/design/category/notifications','ShopPanel\NotificationController@index')->name('site.notifications');
           Route::get('/{slug}/design/homepage','ShopPanel\HomepageController@index')->name('site.homepage');
           Route::get('/{slug}/server/add','ShopPanel\ServerController@index')->name('site.serveradd');
           Route::get('/{slug}/server/status','ShopPanel\ServerController@status_page')->name('site.serverstatus');
           Route::get('/{slug}/server/connection','ShopPanel\ServerController@connection_page')->name('site.serverconnection');
           Route::get('/{slug}/sms', 'ShopPanel\SmsController@index')->name('site.sms');
           Route::get('/{slug}/coupons','ShopPanel\CouponController@index')->name('site.coupons');
           Route::get('/{slug}/paypal','ShopPanel\PayPalController@index')->name('site.paypal');
           Route::get('/{slug}/categories','ShopPanel\CategoryController@index')->name('site.categories');

           // Ajax calls
           Route::post('/{slug}/ajax/update/title','ShopPanel\HomeController@updatetitle')->name('site.updatetitle');
           Route::post('/{slug}/ajax/update/status','ShopPanel\ServerController@updatestatus')->name('site.updatestatus');
           Route::post('/{slug}/ajax/update/design/static_content','ShopPanel\SidebarController@static_sidebar_content')->name('site.static_sidebar_content');
           Route::post('/{slug}/ajax/update/keywords','ShopPanel\HomeController@updatekeywords')->name('site.updatekeywords');
           Route::post('/{slug}/design/sidebars/update/position','ShopPanel\SidebarController@updateposition')->name('site.sidebars.updateposition');
           Route::put('/{slug}/design/sidebars/create','ShopPanel\SidebarController@create')->name('site.sidebars.create');
           Route::delete('/{slug}/design/sidebars/delete/{id}','ShopPanel\SidebarController@delete')->name('site.sidebars.delete');
           Route::post('/{slug}/design/sidebars/update/{id}/title','ShopPanel\SidebarController@updatetitle')->name('site.sidebars.updatetitle');
           Route::post('/{slug}/design/sidebars/update/{id}/content','ShopPanel\SidebarController@updatecontent')->name('site.sidebars.updatecontent');
           Route::post('/{slug}/design/sidebars/update/{id}/hide','ShopPanel\SidebarController@hidesidebar')->name('site.sidebars.hidesidebar');
           Route::post('/{slug}/design/change','ShopPanel\DesignController@update');
           Route::put('/{slug}/design/category/notifications','ShopPanel\NotificationController@create')->name('site.notification.create');
           Route::delete('/{slug}/design/category/notifications/{id}/delete','ShopPanel\NotificationController@delete')->name('site.notification.delete');
           Route::post('/{slug}/design/category/notifications/{id}/editTitle','ShopPanel\NotificationController@editTitle')->name('site.notification.edittitle');
           Route::post('/{slug}/design/category/notifications/edit','ShopPanel\NotificationController@edit')->name('site.notification.edit');
           Route::post('/{slug}/design/homepage','ShopPanel\HomepageController@update');
           Route::delete('/{slug}/server/{id}/delete','ShopPanel\ServerController@delete')->name('site.serverdelete');
           Route::put('/{slug}/server/add','ShopPanel\ServerController@create')->name('site.servercreate');
           Route::post('/{slug}/server/connection','ShopPanel\ServerController@configure');
           Route::post('/{slug}/sms', 'ShopPanel\SmsController@update');
           Route::post('/{slug}/sms/update/data', 'ShopPanel\SmsController@update_sms');
           Route::put('/{slug}/sms/add', 'ShopPanel\SmsController@create');
           Route::get('/{slug}/users/json','ShopPanel\UserController@json');
           Route::post('/{slug}/coupons/update/data','ShopPanel\CouponController@update');
           Route::put('/{slug}/coupons/create','ShopPanel\CouponController@create');
           Route::put('/{slug}/categories/create','ShopPanel\CategoryController@create')->name('categories.create');
           Route::post('/{slug}/paypal/update','ShopPanel\PayPalController@update');

       });
    });

};
Route::group(['domain' => env('PLAIN_URL')], $mainRouter);

// Shop things content
Route::group(['domain' => '{slug}.' . env('PLAIN_URL')], function () {
    Route::get('/', 'Shop\HomeController@page');
    Route::get('/language/{lang}', 'Shop\LanguageController@changeLang');
    Route::get('/currency/{currency}', 'Shop\CurrencyController@change')->middleware('mcAuth');
    Route::get('/category/{category}', 'Shop\CategoryController@page');

    Route::group(['prefix' => 'auth'], function () {
        Route::get('/login','Shop\AuthController@page')->middleware('guest');
        Route::get('/logout','Shop\AuthController@logout')->middleware('auth:mcuser');
        Route::post('/login','Shop\AuthController@create')->middleware('guest');
    });

    Route::group(['prefix'=>'cart'],function() {
       Route::post('/','Shop\CartController@add')->middleware(['isPurchased','isRequireProduct']);
       Route::delete('/remove','Shop\CartController@delete');
       Route::post('/coupon/check','Shop\CouponController@check');
       Route::post('/checkout/sms','Shop\CheckoutController@sms_checkout')->middleware(['isPurchased','isRequireProduct']);
       Route::get('/failed', 'Shop\CartController@failed');
       Route::get('/paypal/check','Shop\CheckoutController@paypal_check');
       Route::post('/checkout/paypal','Shop\CheckoutController@paypal_checkout')->middleware(['isPurchased','isRequireProduct']);
    });

});

