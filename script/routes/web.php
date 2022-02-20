<?php

use Illuminate\Support\Facades\Route;

Route::get('/check','FrontendController@check');
Route::get('/pwa',function(){
	return redirect('/'); 
});



// Match my own domain
Route::group(['domain' => env('APP_URL')], function($domain)
{
	Route::get('/', 'FrontendController@welcome');
	Route::get('/page/{slug}', 'FrontendController@page');
	Route::get('/about', 'FrontendController@about');
	Route::get('/service', 'FrontendController@service');
	Route::get('/priceing', 'FrontendController@priceing');
	Route::get('/make-translate', 'FrontendController@translate')->name('translate');
	Route::get('/contact', 'FrontendController@contact');
	Route::post('/sent-mail', 'FrontendController@send_mail')->name('send_mail');
	Route::get('merchant/register/{id}', 'FrontendController@register_view')->name('merchant.form');
	Route::post('seller-register/{id}', 'FrontendController@register')->name('merchant.register-make');

	Route::group(['prefix'=>'cron'],function(){
		Route::get('/make-expire-order','CronController@makeExpireAbleCustomer');
		Route::get('/make-alert-before-expire-plan','CronController@send_mail_to_will_expire_plan_soon');
		Route::get('/reset_product_price','CronController@reset_product_price');

	});


	Route::group(['as'=>'merchant.','prefix'=>'merchant','middleware'=>['auth']], function(){
		Route::get('/dashboard','FrontendController@dashboard')->name('dashboard');
		Route::get('/make-payment/{id}','FrontendController@make_payment')->name('make_payment');
		Route::get('/plan','FrontendController@plans')->name('plan');
		Route::get('/profile','FrontendController@settings')->name('profile.settings');

		Route::post('/make-charge/{id}','FrontendController@make_charge')->name('make_payment_charge');
		Route::get('/payment-success','FrontendController@success')->name('payment.success');
		Route::get('/payment-fail','FrontendController@fail')->name('payment.fail');
		Route::get('/instamojo','\App\Helper\Subscription\Instamojo@status')->name('instamojo.fallback');
		Route::get('/paypal','\App\Helper\Subscription\Paypal@status')->name('paypal.fallback');
		Route::get('/toyyibpay','\App\Helper\Subscription\Toyyibpay@status')->name('toyyibpay.fallback');
		Route::get('/payment-with/razorpay', '\App\Helper\Subscription\Razorpay@razorpay_view');
		Route::get('/payment/mollie', '\App\Helper\Subscription\Mollie@status');
		Route::get('/payment/mercado', '\App\Helper\Subscription\Mercado@status');
		Route::post('/razorpay/status', '\App\Helper\Subscription\Razorpay@status');
		Route::post('/paystack/status', '\App\Helper\Subscription\Paystack@status');
	});
	
	
	Route::get('/sitemap.xml', function(){
		return response(file_get_contents(base_path('sitemap.xml')), 200, [
			'Content-Type' => 'application/xml'
		]);

	});
	
	
});




// Match a subdomain of my domain
Route::group(['domain' => '{subdomain}.'.env('APP_PROTOCOLESS_URL'),'middleware'=>['domain']], function()
{

	
	
	Route::group(['namespace'=>'Frontend'], function(){
		Route::get('/', 'FrontendController@index');
		Route::get('product/{slug}/{id}', 'FrontendController@detail')->name('product.view');
		Route::get('/shop','FrontendController@shop');
		Route::get('/cart','FrontendController@cart');
		Route::get('/wishlist','FrontendController@wishlist');
		Route::get('/wishlist/remove/{id}','CartController@wishlist_remove');
		Route::get('/category/{slug}/{id}', 'FrontendController@category');
		Route::get('/brand/{slug}/{id}', 'FrontendController@brand');
		Route::get('/trending','FrontendController@trending');
		Route::get('/best-sales','FrontendController@best_seles');
		Route::get('/add_to_cart/{id}','CartController@add_to_cart');
		Route::get('/add_to_wishlist/{id}','CartController@add_to_wishlist');
		Route::post('/addtocart','CartController@cart_add');
		Route::get('/remove_cart','CartController@remove_cart');
		Route::get('/cart_remove/{id}','CartController@cart_remove');
		Route::get('/cart-clear','CartController@cart_clear');
		Route::post('apply_coupon','CartController@apply_coupon')->name('apply_coupon');

		Route::get('/get_home_page_products','FrontendController@home_page_products');
		Route::post('make_order','OrderController@store');
		Route::get('/express','CartController@express');
		Route::get('/get_ralated_product_with_latest_post','FrontendController@get_ralated_product_with_latest_post');
		Route::get('/get_category_with_product/{limit}','FrontendController@get_category_with_product');
		Route::get('/get_brand_with_product/{limit}','FrontendController@get_brand_with_product');
		Route::get('/get_featured_category','FrontendController@get_featured_category');
		Route::get('/get_featured_brand','FrontendController@get_featured_brand');
		Route::get('/get_category','FrontendController@get_category');
		Route::get('/get_brand','FrontendController@get_brand');
		Route::get('/get_products','FrontendController@get_products');
		Route::get('/get_latest_products','FrontendController@get_latest_products');
		Route::get('/get_shop_products','FrontendController@get_shop_products');
		Route::get('/get_slider','FrontendController@get_slider');
		Route::get('/get_bump_adds','FrontendController@get_bump_adds');
		Route::get('/get_banner_adds','FrontendController@get_banner_adds');
		Route::get('/get_menu_category','FrontendController@get_menu_category');
		Route::get('/get_trending_products','FrontendController@get_trending_products');
		Route::get('/get_best_selling_product','FrontendController@get_best_selling_product');
		Route::get('/get_ralated_products','FrontendController@get_ralated_products');
		Route::get('/get_offerable_products','FrontendController@get_offerable_products');
		Route::get('/product_search','FrontendController@product_search');
		Route::get('/get_featured_attributes','FrontendController@get_featured_attributes');
		Route::get('/get_random_products/{limit}','FrontendController@get_random_products');
		Route::get('/get_shop_attributes','FrontendController@get_shop_attributes');
		Route::get('/checkout','FrontendController@checkout');
		Route::post('/make-review/{id}','ReviewController@store')->middleware('throttle:1,1');
		Route::get('/get_reviews/{id}','FrontendController@get_reviews');
		Route::get('/thanks', 'FrontendController@thanks');
		Route::get('/make_local', 'FrontendController@make_local');
		Route::get('/sitemap.xml', 'FrontendController@sitemap');
		Route::get('/page/{slug}/{id}', 'FrontendController@page');

		Route::group(['prefix'=>'user'],function(){
			Route::get('/login','UserController@login')->middleware('guest');
			Route::get('/register','UserController@register')->middleware('guest');
			Route::post('/register-user','UserController@register_user')->middleware('guest');
			Route::get('/dashboard','UserController@dashboard')->middleware('customer');
			Route::get('/orders','UserController@orders')->middleware('customer');
			Route::get('/order/view/{id}','UserController@order_view')->middleware('customer');
			Route::get('/download','UserController@download')->middleware('customer');
			Route::get('/settings','UserController@settings')->middleware('customer');
			Route::post('/settings/update','UserController@settings_update')->middleware('customer');
		});


		//payment getway routes only
		Route::get('/payment/payment-success','OrderController@payment_success');
		Route::get('/payment/payment-fail','OrderController@payment_fail');
		Route::get('/payment/paypal','\App\Helper\Order\Paypal@status');
		Route::get('/payment/instamojo','\App\Helper\Order\Instamojo@status');
		Route::get('/payment/toyyibpay','\App\Helper\Order\Toyyibpay@status');
		Route::get('/payment/mercado','\App\Helper\Order\Mercado@status');
		Route::get('/payment/mollie','\App\Helper\Order\Mollie@status');
		Route::get('/payment-with-stripe','\App\Helper\Order\Stripe@view');
		Route::post('/payement/stripe','\App\Helper\Order\Stripe@status');
		Route::get('/payment-with-razorpay','\App\Helper\Order\Razorpay@view');
		Route::post('/payement/razorpay','\App\Helper\Order\Razorpay@status');

		Route::get('/payment-with-paystack','\App\Helper\Order\Paystack@view');
		Route::post('/payement/paystack','\App\Helper\Order\Paystack@status');
		
		
	});

});


// Match any other domains
Route::group(['domain' => '{domain}','middleware'=>['domain','customdomain']], function()
{

	
	
	Route::group(['namespace'=>'Frontend'], function(){
		Route::get('/', 'FrontendController@index');
		Route::get('product/{slug}/{id}', 'FrontendController@detail')->name('product.view');
		Route::get('/shop','FrontendController@shop');
		Route::get('/cart','FrontendController@cart');
		Route::get('/wishlist','FrontendController@wishlist');
		Route::get('/wishlist/remove/{id}','CartController@wishlist_remove');
		Route::get('/category/{slug}/{id}', 'FrontendController@category');
		Route::get('/brand/{slug}/{id}', 'FrontendController@brand');
		Route::get('/trending','FrontendController@trending');
		Route::get('/best-sales','FrontendController@best_seles');
		Route::get('/add_to_cart/{id}','CartController@add_to_cart');
		Route::get('/add_to_wishlist/{id}','CartController@add_to_wishlist');
		Route::post('/addtocart','CartController@cart_add');
		Route::get('/remove_cart','CartController@remove_cart');
		Route::get('/cart_remove/{id}','CartController@cart_remove');
		Route::get('/cart-clear','CartController@cart_clear');
		Route::post('apply_coupon','CartController@apply_coupon')->name('apply_coupon');

		Route::get('/get_home_page_products','FrontendController@home_page_products');
		Route::post('make_order','OrderController@store');
		Route::get('/express','CartController@express');
		Route::get('/get_ralated_product_with_latest_post','FrontendController@get_ralated_product_with_latest_post');
		Route::get('/get_category_with_product/{limit}','FrontendController@get_category_with_product');
		Route::get('/get_brand_with_product/{limit}','FrontendController@get_brand_with_product');
		Route::get('/get_featured_category','FrontendController@get_featured_category');
		Route::get('/get_featured_brand','FrontendController@get_featured_brand');
		Route::get('/get_category','FrontendController@get_category');
		Route::get('/get_brand','FrontendController@get_brand');
		Route::get('/get_products','FrontendController@get_products');
		Route::get('/get_latest_products','FrontendController@get_latest_products');
		Route::get('/get_shop_products','FrontendController@get_shop_products');
		Route::get('/get_slider','FrontendController@get_slider');
		Route::get('/get_bump_adds','FrontendController@get_bump_adds');
		Route::get('/get_banner_adds','FrontendController@get_banner_adds');
		Route::get('/get_menu_category','FrontendController@get_menu_category');
		Route::get('/get_trending_products','FrontendController@get_trending_products');
		Route::get('/get_best_selling_product','FrontendController@get_best_selling_product');
		Route::get('/get_ralated_products','FrontendController@get_ralated_products');
		Route::get('/get_offerable_products','FrontendController@get_offerable_products');
		Route::get('/product_search','FrontendController@product_search');
		Route::get('/get_featured_attributes','FrontendController@get_featured_attributes');
		Route::get('/get_random_products/{limit}','FrontendController@get_random_products');
		Route::get('/get_shop_attributes','FrontendController@get_shop_attributes');
		Route::get('/checkout','FrontendController@checkout');
		Route::post('/make-review/{id}','ReviewController@store')->middleware('throttle:1,1');
		Route::get('/get_reviews/{id}','FrontendController@get_reviews');
		Route::get('/thanks', 'FrontendController@thanks');
		Route::get('/make_local', 'FrontendController@make_local');
		Route::get('/sitemap.xml', 'FrontendController@sitemap');
		Route::get('/page/{slug}/{id}', 'FrontendController@page');

		Route::group(['prefix'=>'user'],function(){
			Route::get('/login','UserController@login')->middleware('guest');
			Route::get('/register','UserController@register')->middleware('guest');
			Route::post('/register-user','UserController@register_user')->middleware('guest');
			Route::get('/dashboard','UserController@dashboard')->middleware('customer');
			Route::get('/orders','UserController@orders')->middleware('customer');
			Route::get('/order/view/{id}','UserController@order_view')->middleware('customer');
			Route::get('/download','UserController@download')->middleware('customer');
			Route::get('/settings','UserController@settings')->middleware('customer');
			Route::post('/settings/update','UserController@settings_update')->middleware('customer');
		});


		//payment getway routes only
		Route::get('/payment/payment-success','OrderController@payment_success');
		Route::get('/payment/payment-fail','OrderController@payment_fail');
		Route::get('/payment/paypal','\App\Helper\Order\Paypal@status');
		Route::get('/payment/instamojo','\App\Helper\Order\Instamojo@status');
		Route::get('/payment/toyyibpay','\App\Helper\Order\Toyyibpay@status');
		Route::get('/payment/mercado','\App\Helper\Order\Mercado@status');
		Route::get('/payment/mollie','\App\Helper\Order\Mollie@status');
		Route::get('/payment-with-stripe','\App\Helper\Order\Stripe@view');
		Route::post('/payement/stripe','\App\Helper\Order\Stripe@status');
		Route::get('/payment-with-razorpay','\App\Helper\Order\Razorpay@view');
		Route::post('/payement/razorpay','\App\Helper\Order\Razorpay@status');

		Route::get('/payment-with-paystack','\App\Helper\Order\Paystack@view');
		Route::post('/payement/paystack','\App\Helper\Order\Paystack@status');
		
		
	});

});

Auth::routes();

Route::group(['as' =>'admin.','prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin']],function(){

	Route::get('dashboard','AdminController@dashboard')->name('dashboard');
	Route::get('dashboard/static','AdminController@staticData')->name('dashboard.static');
	Route::get('dashboard/perfomance/{period}','AdminController@perfomance')->name('dashboard.perfomance');
	Route::get('dashboard/order_statics/{month}','AdminController@order_statics');
	Route::get('dashboard/visitors/{day}','AdminController@google_analytics');

	Route::resource('category','CategoryController');
	Route::post('categoryss/destroy','CategoryController@destroy')->name('categorie.destroys');



	Route::get('/location/countries','CategoryController@countries')->name('country.index');
	Route::get('/location/countries/create','CategoryController@countryCreate')->name('country.create');
	Route::get('/location/cities','CategoryController@cities')->name('city.index');
	Route::get('/location/cities/create','CategoryController@cityCreate')->name('city.create');

	//role management
	//roles
	Route::resource('role', 'RoleController');
	Route::post('roles/destroy', 'RoleController@destroy')->name('roles.destroy');
	//users
	Route::resource('users', 'AdminController');
	Route::post('/userss/destroy', 'AdminController@destroy')->name('users.destroy');

	Route::resource('plan','PlanController');
	Route::post('plans/destroy','PlanController@destroy')->name('plans.destroys');

	Route::resource('domain','DomainController');
	Route::post('domains/destroy','DomainController@destroy')->name('domains.destroys');

	Route::resource('order','OrderController');
	Route::post('orders/destroy','OrderController@destroy')->name('orders.destroys');
	Route::get('order/invoice/{id}','OrderController@invoice')->name('order.invoice');

	Route::resource('customer','CustomerController');
	Route::get('customer/plan/{id}','CustomerController@planview')->name('customer.planedit');
	Route::put('customer/planupdate/{id}','CustomerController@updateplaninfo')->name('customer.updateplaninfo');
	Route::post('customers/destroy','CustomerController@destroy')->name('customers.destroys');

	Route::resource('page','PageController');
	Route::post('pages/destroy','PageController@destroy')->name('pages.destroys');


	Route::get('report','ReportController@index')->name('report');
	Route::resource('language','LanguageController');
	Route::get('languages/delete/{id}','LanguageController@destroy')->name('languages.delete');
	Route::post('languages/setActiveLanuguage','LanguageController@setActiveLanuguage')->name('languages.active');
	Route::post('languages/add_key','LanguageController@add_key')->name('language.add_key');

	Route::resource('payment-geteway','PaymentController');
	Route::resource('settings','SettingController');
	Route::resource('email','EmailController');

	Route::resource('emailtemplate','EmailtemplateController');

	Route::resource('marketing','MarketingController');

	Route::resource('template','TemplateController');
	Route::get('templates/delete/{id}','TemplateController@destroy')->name('templates.delete');


	Route::get('site-settings','SiteController@site_settings')->name('site.settings');

	Route::get('system-environment','SiteController@system_environment_view')->name('site.environment');
	Route::post('site_settings_update','SiteController@site_settings_update')->name('site_settings.update');

	Route::post('env_update','SiteController@env_update')->name('env.update');


	Route::resource('gallery','GalleryController');

	Route::resource('appearance','FrontendController');

	Route::post('gallery/destroyes','GalleryController@destroy')->name('galleries.destroys');
	Route::resource('menu','MenuController');
	Route::post('menus/delete','MenuController@destroy')->name('menues.destroy');
	Route::post('menus/MenuNodeStore','MenuController@MenuNodeStore')->name('menus.MenuNodeStore');
	Route::resource('seo','SeoController');

	Route::resource('cron','CronController');

	Route::get('/profile','AdminController@settings')->name('profile.settings');
	

});

Route::group(['as' =>'author.','prefix'=>'author','namespace'=>'Admin','middleware'=>['auth','author']],function(){
	Route::get('dashboard','DashboardController@dashboard')->name('dashboard');
});

Route::post('user_profile_update','Seller\SettingController@profile_update')->name('my.profile.update');

Route::group(['as' =>'seller.','prefix'=>'seller','namespace'=>'Seller','middleware'=>['auth','seller']],function(){

	Route::get('dashboard','DashboardController@dashboard')->name('dashboard');
	Route::get('dashboard/static','DashboardController@staticData')->name('dashboard.static');
	Route::get('dashboard/perfomance/{period}','DashboardController@perfomance')->name('dashboard.perfomance');

	Route::get('dashboard/order_statics/{month}','DashboardController@order_statics');


	Route::get('dashboard/visitors/{day}','DashboardController@google_analytics');
	Route::resource('category','CategoryController');
	Route::post('categoryss/destroy','CategoryController@destroy')->name('categorie.destroys');

	Route::resource('brand','BrandController');
	Route::post('brands/destroy','BrandController@destroy')->name('brands.destroys');

	Route::resource('attribute','AttributeController');
	Route::post('attributes/destroy','AttributeController@destroy')->name('attributes.destroy');

	Route::resource('attribute-term','ChildattributeController');
	Route::post('attributes-terms/destroy','ChildattributeController@destroy')->name('attributes-terms.destroy');
	Route::resource('ads','AdsController');
	Route::get('ad/remove/{id}','AdsController@destroy')->name('ad.destroy');

	Route::resource('product','ProductController');
	Route::get('product/{id}/{type}','ProductController@edit')->name('product.config');
	Route::get('products/{status}','ProductController@index')->name('product.list');
	Route::post('products/destroy','ProductController@destroy')->name('products.destroys');
	Route::post('products/seo/{id}','ProductController@seo')->name('products.seo');
	Route::post('products/import','ProductController@import')->name('products.import');
	Route::put('products/price/{id}','ProductController@price')->name('products.price');
	Route::post('products/variation/{id}','ProductController@variation')->name('product.variation');
	Route::post('products/store_group/{id}','ProductController@store_group')->name('product.store_group');
	Route::post('products/stock/{id}','ProductController@stock')->name('products.stock');
	Route::post('products/add_row','ProductController@add_row')->name('product.add_row');
	Route::post('products/option_update/{id}','ProductController@option_update')->name('product.option_update');
	Route::post('products/option_delete','ProductController@option_delete')->name('product.option_delete');
	Route::post('products/row_update','ProductController@row_update')->name('product.row_update');
	Route::post('products/stock_update/{id}','ProductController@stock_update')->name('products.stock_update');

	Route::resource('varient','VarientController');
	Route::post('varients/destroy','VarientController@destroy')->name('variants.destroy');

	Route::resource('media','ProductmediaController');
	Route::post('medias/destroy','ProductmediaController@destroy')->name('medias.destroy');

	Route::resource('file','FileController');
	Route::post('files/update','FileController@update')->name('files.update');
	Route::post('files/destroy','FileController@destroy')->name('files.destroy');

	Route::resource('inventory','InventoryController');

	Route::resource('location','LocationController');
	Route::post('locations/destroy','LocationController@destroy')->name('locations.destroy');

	Route::resource('shipping','ShippingController');
	Route::post('shippings/destroy','ShippingController@destroy')->name('shippings.destroy');

	Route::resource('coupon','CouponController');
	Route::post('coupons/destroy','CouponController@destroy')->name('coupons.destroy');

	Route::resource('marketing','MarketingController');

	Route::resource('settings','SettingController');

	Route::resource('payment','GetwayController');
	
	Route::resource('transection','TransectionController');

	Route::get('report','ReportController@index')->name('report.index');
	

	Route::group(['prefix'=>'setting'],function(){
		Route::resource('seo','SeoController');
		Route::resource('theme','ThemeController');

		Route::resource('menu','MenuController');

		Route::resource('page','PageController');
		Route::post('pages/destroy','PageController@destroy')->name('pages.destroys');
		Route::resource('slider','SliderController');

	});

	Route::resource('customer','CustomerController');
	Route::get('customer/login/{id}','CustomerController@login')->name('customer.login');
	Route::post('customers/destroys','CustomerController@destroy')->name('customers.destroys');
	Route::get('user','CustomerController@user');

	Route::resource('order','OrderController');

	Route::resource('review','ReviewController');
	Route::post('reviews/destroy','ReviewController@destroy')->name('reviews.destroys');
	Route::get('order/cart/remove/{id}','OrderController@cartRemove')->name('cart.remove');
	Route::get('orders/{type}','OrderController@index')->name('orders.status');
	Route::get('orders/customer/checkout','OrderController@checkout')->name('checkout');
	Route::get('orders/invoice/{id}','OrderController@invoice')->name('invoice');
	Route::post('orders/destroys','OrderController@destroy')->name('orders.destroys');
	Route::post('orders/apply_coupon','OrderController@apply_coupon')->name('orders.apply_coupon');
	Route::post('orders/make_order','OrderController@make_order')->name('orders.make_order');
	Route::post('orders/fulfillment','OrderController@destroy')->name('orders.method');
	Route::get('/make-payment/{id}','PlanController@make_payment')->name('make_payment');
	Route::get('plan-renew','PlanController@renew');
	
	Route::get('/settings','SettingController@settings_view')->name('seller.settings');
	Route::post('/profile_update','SettingController@profile_update')->name('profile.update');
	Route::post('/make-charge/{id}','PlanController@make_charge')->name('make_payment_charge');
	

	Route::get('/support','SettingController@support_view')->name('support');

	
	

	//payment methods
	Route::get('/payment-success','PlanController@success')->name('payment.success');
	Route::get('/payment-fail','PlanController@fail')->name('payment.fail');
	Route::get('/instamojo','\App\Helper\Subscription\Instamojo@status')->name('instamojo.fallback');
	Route::get('/paypal','\App\Helper\Subscription\Paypal@status')->name('paypal.fallback');
	Route::get('/toyyibpay','\App\Helper\Subscription\Toyyibpay@status')->name('toyyibpay.fallback');
	Route::get('/payment-with/razorpay', '\App\Helper\Subscription\Razorpay@razorpay_view');
	Route::get('/payment_with_mollie', '\App\Helper\Subscription\Mollie@status');
	Route::post('/razorpay/status', '\App\Helper\Subscription\Razorpay@status')->name('razorpay.status');
	Route::post('/paystack/status', '\App\Helper\Subscription\Paystack@status');
	Route::get('/payment_with_mercado', '\App\Helper\Subscription\Mercado@status');
	

});



Route::get('/', 'FrontendController@welcome');
Route::get('/page/{slug}', 'FrontendController@page');
Route::get('/about', 'FrontendController@about');
Route::get('/service', 'FrontendController@service');
Route::get('/priceing', 'FrontendController@priceing');
Route::get('/make-translate', 'FrontendController@translate')->name('translate');
Route::get('/contact', 'FrontendController@contact');
Route::post('/sent-mail', 'FrontendController@send_mail')->name('send_mail');
Route::get('merchant/register/{id}', 'FrontendController@register_view')->name('merchant.form');
Route::post('seller-register/{id}', 'FrontendController@register')->name('merchant.register-make');
Route::group(['prefix'=>'cron_job','namespace'=>'Admin'],function(){
	Route::get('/make_expirable_user','CronController@make_expirable_user');
	Route::get('/send_mail_to_will_expire_plan_soon','CronController@send_mail_to_will_expire_plan_soon');
	Route::get('/reset_product_price','CronController@reset_product_price');

});


Route::group(['as'=>'merchant.','prefix'=>'merchant','middleware'=>['auth']], function(){
	Route::get('/dashboard','FrontendController@dashboard')->name('dashboard');
	Route::get('/make-payment/{id}','FrontendController@make_payment')->name('make_payment');
	Route::get('/plan','FrontendController@plans')->name('plan');
	Route::get('/profile','FrontendController@settings')->name('profile.settings');

	Route::post('/make-charge/{id}','FrontendController@make_charge')->name('make_payment_charge');
	Route::get('/payment-success','FrontendController@success')->name('payment.success');
	Route::get('/payment-fail','FrontendController@fail')->name('payment.fail');
	Route::get('/instamojo','\App\Helper\Subscription\Instamojo@status')->name('instamojo.fallback');
	Route::get('/paypal','\App\Helper\Subscription\Paypal@status')->name('paypal.fallback');
	Route::get('/toyyibpay','\App\Helper\Subscription\Toyyibpay@status')->name('toyyibpay.fallback');
	Route::get('/payment-with/razorpay', '\App\Helper\Subscription\Razorpay@razorpay_view');
	Route::get('/payment/mollie', '\App\Helper\Subscription\Mollie@status');
	Route::post('/razorpay/status', '\App\Helper\Subscription\Razorpay@status');
	Route::post('/paystack/status', '\App\Helper\Subscription\Paystack@status');
	Route::get('/payment/mercado', '\App\Helper\Subscription\Mercado@status');
});


Route::post('/customers/attempt','Frontend\UserController@userLogin')->name('customer.login');
Route::post('/customer/login','Customer\LoginController@login')->middleware('guest');
Route::get('/user/password/reset','Customer\ForgotPasswordController@showLinkRequestForm')->middleware('guest');
Route::post('/user/password/email','Customer\ForgotPasswordController@sendResetOtp')->middleware('throttle:5,5');

 //Reset Password Routes
Route::get('/user/password/otp','Customer\ResetPasswordController@otp')->middleware('guest');
Route::post('/user/password/reset','Customer\ResetPasswordController@resetPassword')->middleware('throttle:5,5');


