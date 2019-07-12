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

Session::put('locale', 'en');


Route::get('language/{locale}', function ($locale){
	Session::put('locale', $locale);
	return redirect()->back();
});


route::pattern('name' ,'(.*)');
route::pattern('name1' ,'(.*)');
route::pattern('id', '([0-9]*)');

Route::namespace('House')->group( function() {

    Route::get('', 'IndexController@index')->name('house.index.index');
    Route::get('search', 'IndexController@search')->name('house.index.search');
    Route::get('search_product', 'IndexController@search_product')->name('house.index.search_product');

    // Sản phẩm
    Route::get('product/{name}-{id}.html', 'ProductController@index')->name('house.product.index');
    Route::post('product/{name}-{id}.html', 'ProductController@post_ContactPR')->name('contact');


    // Danh mục
    Route::get('{name1}/{name}.htm', 'CatController@Choose_Collection')->name('house.cat.choose_collection');
    Route::get('{name1}.htm', 'CatController@Choose_Product')->name('house.cat.choose_product');
    Route::get('ajax_product', 'CatController@Ajax_Product')->name('ajax_product');

    // Liên hệ
 	Route::get('info/contact', 'ContactController@index')->name('house.contact.index');
 	Route::post('info/contact', 'ContactController@post_Contact')->name('house.contact.index');

 	Route::get('/admin/contact', 'ContactController@index_admin')->name('admin.contact.index');
 	Route::post('ajax_reply', 'ContactController@reply_contact')->name('ajax_reply');

 	// Blog

 	Route::get('blog', 'BlogController@index')->name('house.blog.index');
 	Route::get('blog/{name}-{id}.html', 'BlogController@detail_news')->name('house.blog.detail');
 	Route::get('search_blog', 'BlogController@search_blogs')->name('house.blog.search');
 	Route::get('project', 'BlogController@index_project')->name('house.blog.project.index');
 	Route::get('project/{name}-{id}.html', 'BlogController@news_project')->name('house.blog.project.detail');



 	// Page

 	Route::get('about-us.html', 'PageController@about_us')->name('house.page.about');

});

Route::get('admin/login' , [
	'uses' => 'Admin\UserController@login_Admin',
	'as'   => 'auth.login'
]);


Route::get('admin/login', 'Admin\UserController@login_Admin')->name('auth.login');
Route::post('admin/login', 'Admin\UserController@post_login_Admin')->name('auth.login');



Route::middleware('admin')->namespace('Admin')->prefix('admin')->group( function() {
	Route::any('/ckfinder/examples/{example?}', 'CKSource\CKFinderBridge\Controller\CKFinderController@examplesAction')
    ->name('ckfinder_examples');

	Route::get('logout',  [
		'uses' => 'UserController@Logout',
		'as'   => 'logout'
	]);
	Route::get('dashboard' , [
		'uses' => 'DashboardController@index',
		'as'   => 'admin.index.index'
	]);

	//// Quản lý Category

	Route::get('category' , [
		'uses' => 'CatController@index',
		'as'   => 'admin.cat.index'
	]);


	Route::get('category/add' , [
		'uses' => 'CatController@get_Add',
		'as'   => 'admin.cat.add'
	]);


	Route::post('category/add' , [
		'uses' => 'CatController@post_Add',
		'as'   => 'admin.cat.add'
	]);


	Route::get('category/edit/{id}' , [
		'uses' => 'CatController@get_Edit',
		'as'   => 'admin.cat.edit'
	]);

	Route::post('category/edit/{id}' , [
		'uses' => 'CatController@post_Edit',
		'as'   => 'admin.cat.edit'
	]);

	Route::get('delete_category', 'CatController@post_Delete')->name('delete_category');


	//// Quản lý Users

	Route::get('user', 'UserController@index')->name('admin.users.index');
	Route::get('user/add', 'UserController@get_Add')->name('admin.users.add');
	Route::post('user/add', 'UserController@post_Add')->name('admin.users.add');
	Route::post('user/change_pass', 'UserController@post_ChangePass')->name('change_pass');
	Route::post('user/active_user', 'UserController@active_User')->name('active_user');


	// Quản lý Products

	Route::get('product', 'ProductController@index')->name('admin.product.index');
	Route::get('product/add', 'ProductController@get_Add')->name('admin.product.add');
	Route::post('product/add', 'ProductController@post_Add')->name('admin.product.add');
	Route::post('product/delete', 'ProductController@post_Delete')->name('delete_product');
	Route::get('product/edit/{id}', 'ProductController@get_Edit')->name('admin.product.edit');
	Route::post('product/edit/{id}', 'ProductController@post_Edit')->name('admin.product.edit');


	// Quản lý Blogs

	Route::get('news', 'NewsController@index')->name('admin.news.index');
	Route::get('news/add', 'NewsController@get_Add')->name('admin.news.add');
	Route::post('news/add', 'NewsController@post_Add')->name('admin.news.add');
	Route::get('delete_news', 'NewsController@post_Delete')->name('delete_news');
	Route::get('news/edit/{id}', 'NewsController@get_Edit')->name('admin.news.edit');
	Route::post('news/edit/{id}', 'NewsController@post_Edit')->name('admin.news.edit');



	// Quản lý pages

	Route::get('pages', 'PageController@index')->name('admin.pages.index');
	Route::get('pages/add', 'PageController@get_Add')->name('admin.pages.add');
	Route::post('pages/add', 'PageController@post_Add')->name('admin.pages.add');
	Route::get('pages/edit/{id}', 'PageController@get_Edit')->name('admin.pages.edit');
	Route::post('pages/edit/{id}', 'PageController@post_Edit')->name('admin.pages.edit');

	// Quản lý slider trang chủ

	Route::get('slider/index', 'SliderController@index_Index')->name('admin.slider.index.index');
	Route::get('slider/index/add', 'SliderController@get_Index_Add')->name('admin.slider.index.add');
	Route::post('slider/index/add', 'SliderController@post_Index_Add')->name('admin.slider.index.add');
	Route::get('slider/index/edit/{id}', 'SliderController@get_Index_Edit')->name('admin.slider.index.edit');
	Route::post('slider/index/edit/{id}', 'SliderController@post_Index_Edit')->name('admin.slider.index.edit');
	Route::get('slider/index/delete', 'SliderController@delete_slider_index')->name('delete_slider_index');


	// Quản lý slider Sản phẩm

	Route::get('slider/product', 'SliderController@index_Product')->name('admin.slider.product.index');
	Route::get('slider/product/add', 'SliderController@get_Product_Add')->name('admin.slider.product.add');
	Route::post('slider/product/add', 'SliderController@post_Product_Add')->name('admin.slider.product.add');
	Route::get('slider/product/edit/{id}', 'SliderController@get_Product_Edit')->name('admin.slider.product.edit');
	Route::post('slider/product/edit/{id}', 'SliderController@post_Product_Edit')->name('admin.slider.product.edit');
	Route::get('slider/product/delete', 'SliderController@delete_slider_Product')->name('delete_slider_product');

});


