<?php
// require_once ('vendor/autoload.php');
use \Statickidz\GoogleTranslate;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Media;
use App\Models\ProductMedia;
use App\Models\CategoryLink;

Auth::routes();
Route::group(['middleware' => 'locale'], function() {

    
    Route::get('change-language/{language}', 'Client\HomeController@changeLanguage')
        ->name('user.change-language');


        Route::get('/', 'Client\HomeController@index')->name('home.index');
        Route::get('/detail', 'Client\ProductController@detail')->name('post.detail');
        Route::post('/order', 'Client\CustomerController@save_customer')->name('customer.order');
        
        //--------------------------------databoard
        Route::get('chart', 'LoginController@databoard');
        //---------------------------------Login
        Route::get('login', 'Admin\LoginController@index')->name('get.login')->middleware('CheckLogoutAD');
        Route::post('login-admin', 'Admin\LoginController@postLogin')->name('post.login');
        Route::get('login-out', 'Admin\LoginController@logOut')->name('logout');
        //chi tiết history
        Route::get('/history-view/{id}', 'Admin\LoginController@historyView')->name('history.view');
        Route::get('/history-view-product/{id}', 'Admin\LoginController@historyViewProduct')->name('history.view.product');
        
        
        //---------------------------------Login-------------------------------//
        
        //---------------------------------Register
        
        Route::get('register', 'Admin\LoginController@getRegister')->name('get.register');
        
        Route::post('register-admin', 'Admin\LoginController@postRegister')->name('post.register');
        
        //---------------------------------Register-------------------------------//
        //---------------------------------Dashboard
        //
        
        
        //---------------------------------Dashboard-------------------------------//
        
        //-----------------------------------client
        //Route::group(['prefix' => 'client'], function () {
        
            Route::get('index', 'Client\ContactController@index')->name('index');
            Route::post('savecontact', 'Client\ContactController@saveContact')->name('savecontact');
        
        
        
            Route::get('paymentgoods', 'Client\PostController@getUsermanual')->name('paymentgoods');
            //Home
            Route::group(['prefix' => 'home'], function () {
                Route::get('list-menu-url/{id}', 'Client\HomeController@getListUrl')->name('home.list.url');
            });
            //post
            //Route::group(['prefix' => 'post'], function () {
        
                Route::get('hdsd', 'Client\PostController@getAllpost')->name('hdsd');
        
                Route::get('list-menu-post/{id}', 'Client\PostController@getDetailPost')->name('home.list.post');
                Route::get('list-menu-page/{id}', 'Client\PostController@getDetailPage')->name('home.list.page');
                //add lien he
                Route::post('add-contact', 'Client\PostController@postContactPage')->name('post.contact.page');
                //add comment
                Route::post('add-comment-post', 'Client\PostController@postAddComment')->name('post.add.comment');
                //đăng kí nhận bản tin post
                Route::post('subcriber', 'Client\PostController@postSubcriberPost')->name('post.subcriber.post');
                Route::get('list-post/{id}', 'Client\PostController@getListPost')->name('get.list.post');
            //});
            //product
            //Route::group(['prefix' => 'product'], function () {
                Route::get('filter/{filter}', 'Client\ProductController@filter')->name('home.list.filter');
                Route::get('products', 'Client\ProductController@getProducts')->name('home.list.products');
                Route::get('tag', 'Client\ProductController@getProductsByTag')->name('home.list.products.tag');
                Route::get('product_detail/{id}', 'Client\ProductController@getDetailProduct')->name('home.list.product');
                Route::get('product-list/{id}', 'Client\ProductController@getListProduct')->name('get.list.product');
                Route::post('insert-rating', 'Client\ProductController@postInserRating')->name('insert.rating');
        
                Route::get('search_product', 'Client\ProductController@searchProduct')->name('searchproduct');
                //shopping cart
                Route::get('checkout', 'Client\ProductController@getCheckout')->name('get.checkout');
                Route::get('donepay', 'Client\ProductController@getCheckoutDonePay')->name('get.donepay');
                Route::get('/select-delivery', 'Client\ProductController@select_delivery')->name('delivery.product');
                //Cart
                Route::post('/add-to-cart', 'Client\ProductController@addToCart')->name('add.cart');
                Route::post('/add-to-cart-detail', 'Client\ProductController@addToCartDetail')->name('add.cart.detail');
                Route::post('/update-to-cart', 'Client\ProductController@updateToCart')->name('update.cart');
                Route::get('/shopping-cart', 'Client\ProductController@shoppingCart')->name('shopping.cart');
                Route::post('/checkcoupon', 'Client\ProductController@checkCoupon')->name('shopping.checkcoupon');
                Route::get('resetcoupon', 'Client\ProductController@resetCoupon')->name('resetCoupon');
                Route::get('cart/delete-product/{id}', 'Client\ProductController@deleteCart')->name('delete.product.cart');
                Route::post('checkout', 'Client\ProductController@postCheckout')->name('post.checkout');
                Route::post('nganluong', 'Client\ProductController@postNganLuong')->name('post.nganluong');
                Route::get('canceltransaction/{bill_code}', 'Client\ProductController@cancelTransaction')->name('cancel.transaction');
                // Route::get('canceltransactionbk/{mrc_order_id}', 'Client\ProductController@cancelTransactionbk')->name('cancel.transactionbk');
                Route::get('nganluong/checkoutv3/payment_success', 'Client\ProductController@paymentSuccess')->name('get.paymentSuccess');
                Route::get('nganluong/checkoutv3/payment_successbk', 'Client\ProductController@paymentSuccessbk')->name('get.paymentSuccessbk');
        
            //});
            //category-post
            Route::group(['prefix' => 'category-post'], function () {
                Route::get('list-menu-category-post/{id}', 'Client\CategoryPostController@getListCategoryPost')->name('home.list.category.post');
            });
            //category-product
            Route::group(['prefix' => 'category-product'], function () {
                // Route::get('list-menu-category-product/{id}','Client\ProductController@getListCategoryProduct')->name('home.list.category.product');
            });
            //Cart
            Route::group(['prefix' => 'cart'], function () {
                Route::post('save-cart', 'Client\ProductController@save_cart')->name('save.cart');
            });
        
        //});
        
        
        //-------------------------------------client-----------------------------------------//
        
        
        //-------------------------------------admin
        Route::group(['prefix' => 'admin', 'middleware' => 'CheckLoginAD'], function () { //middle ware
            //dashboard
            Route::group(['prefix' => 'dashboard'], function () {
                Route::get('index', 'Admin\LoginController@dashboard')->name('dashboard');
            });
            //profile
            Route::group(['prefix' => 'profile'], function () {
                Route::get('update/{id}', 'Admin\ProfileController@index')->name('profile.index');
                Route::post('edit', 'Admin\ProfileController@editProfile')->name('profile.edit');
            });
        
            //product
            Route::group(['prefix' => 'product'], function () {
                Route::get('index', 'Admin\ProductController@index')->name('index.product');
                Route::get('create/1', 'Admin\ProductController@create')->name('create.product');
                Route::post('create-product', 'Admin\ProductController@store')->name('add.product');
                Route::get('edit/{id}', 'Admin\ProductController@edit')->name('edit.product');
                Route::post('edit-product', 'Admin\ProductController@update')->name('update.product'); //{id}: biết muốn sửa thể loại nào
                Route::get('delete', 'Admin\ProductController@destroy')->name('delete.product');
                Route::post('add-category-pro', 'Admin\ProductController@addCategoryPro')->name('add.category.pro');
                Route::get('search', 'Admin\ProductController@search')->name('search');
                Route::get('filter/{category_id}', 'Admin\ProductController@filter')->name('filter');
        
        
                //upload file
                Route::post('/store', 'Admin\ProductController@fileStore')->name('media.store.pro');
                Route::post('/delete', 'Admin\ProductController@fileDestroy')->name('media.delete.pro');
                Route::post('/deleteimage', 'Admin\ProductController@deleteImage')->name('media.delete.image.pro');
                //xoa checkbox
                Route::get('delete-multiple-product', 'Admin\ProductController@delete_multiple_product')->name('delete-multiple-product.product');
            });
            //category
            Route::group(['prefix' => 'category'], function () {
                Route::get('index-product-category', 'Admin\CategoryController@indexProduct')->name('index.product.category');
        
        
        
                Route::get('category-images/{type}', 'Admin\CategoryController@index')->name('index.categoryimage');
                Route::get('catgory-video/{type}', 'Admin\CategoryController@index')->name('index.categoryvideo');
                Route::get('create-category/{type}', 'Admin\CategoryController@create')->name('create.category');
                Route::post('create-category-image', 'Admin\CategoryController@store')->name('category.add');
        
                Route::get('index-post-category', 'Admin\CategoryController@indexPost')->name('index.post.category');
                Route::get('create-product-category', 'Admin\CategoryController@createProduct')->name('create.category.product');
                Route::post('create-category-product', 'Admin\CategoryController@storeProduct')->name('post.add.category.product');
        
                Route::get('create-post-category', 'Admin\CategoryController@createPost')->name('create.category.post');
                Route::post('create-category-post', 'Admin\CategoryController@storePost')->name('post.add.category.post');
        
                Route::get('edit-category/{id}/{type}', 'Admin\CategoryController@edit')->name('edit.category');
                Route::post('edit-category/{id}', 'Admin\CategoryController@update')->name('update.category');
        
                Route::get('edit-post-category/{id}', 'Admin\CategoryController@editPost')->name('edit.category.post');
                Route::post('edit-category-post/{id}', 'Admin\CategoryController@updatePost')->name('update.category.post');
                Route::get('edit-product-category/{id}', 'Admin\CategoryController@editProduct')->name('edit.category.product');
                Route::post('edit-category-product/{id}', 'Admin\CategoryController@updateProduct')->name('update.category.product');
        
                Route::get('delete-category/{id}/{type}', 'Admin\CategoryController@destroy')->name('delete.category');
                Route::get('delete-product-category/{id}', 'Admin\CategoryController@destroyPost')->name('delete.category.post');
                Route::get('delete-post-category/{id}', 'Admin\CategoryController@destroyProduct')->name('delete.category.product');
                //search
                Route::get('/search-category-post', 'Admin\CategoryController@searchPost')->name('search.cate.post');
                Route::get('/search-category-product', 'Admin\CategoryController@searchProduct')->name('search.cate.product');
        
                Route::get('/search-category/{type}', 'Admin\CategoryController@search')->name('search.cate');
        
                //xoa checkbox
                Route::get('delete-multiple-category-product', 'Admin\CategoryController@delete_multiple_category_product')->name('delete-multiple-category-product.product');
                Route::get('delete-multiple-category-post', 'Admin\CategoryController@delete_multiple_category_post')->name('delete-multiple-category-post.post');
            });
            //media
            Route::group(['prefix' => 'media'], function () {
                Route::get('index-video-media', 'Admin\MediaController@indexVideo')->name('index.video.media');
                Route::get('more-media', 'Admin\MediaController@moreMedia')->name('more-media');
        
                //upload file
                Route::get('index', 'Admin\MediaController@index')->name('index.image.media');
                Route::post('/store', 'Admin\MediaController@fileStore')->name('media.store');
                //video
                Route::post('store-video', 'Admin\MediaController@fileStoreVideo')->name('media.store.video');
                Route::post('/delete', 'Admin\MediaController@fileDestroy')->name('media.delete');
                Route::post('/delete-image', 'Admin\MediaController@delete')->name('media.delete.image');
                Route::get('/delete-multi-image', 'Admin\MediaController@deleteMutiMedia')->name('delete.multiple.image.media');
            });
            //company
            Route::group(['prefix' => 'company'], function () {
                Route::get('edit', 'Admin\CompanyController@edit')->name('edit.company');
                Route::post('edit-company', 'Admin\CompanyController@update')->name('update.company'); //{id}: biết muốn sửa thể loại nào
            });
            //Menu
            Route::group(['prefix' => 'menu'], function () {
                Route::get('index', 'Admin\MenuController@index')->name('index.menu');
                Route::get('edit', 'Admin\MenuController@edit')->name('edit.menu');
                Route::get('create', 'Admin\MenuController@create')->name('create.menu');
                
                Route::post('create-menu', 'Admin\MenuController@store')->name('add.menu');
                Route::get('delete/{id}', 'Admin\MenuController@destroy')->name('delete.menu');
                Route::post('editmastermenu', 'Admin\MenuController@editMasterMenu')->name('edit.mastermenu');
                Route::post('createmastermenu', 'Admin\MenuController@createMasterMenu')->name('create.mastermenu');
                Route::get('delete-all', 'Admin\MenuController@deleteAllMenu')->name('delete.all.menu');
                Route::get('/search/menu', 'Admin\MenuController@search')->name('search.menu');
                Route::get('/search/menu/post', 'Admin\MenuController@searchPost')->name('search.menu.post');
                Route::get('/search/menu/category/pro', 'Admin\MenuController@searchCategoryPro')->name('search.menu.category.pro');
                //get all menu ajax
                Route::post('/all-memnu', 'Admin\MenuController@getAllAjax')->name('get.all.ajax');
                //edit menu
                Route::post('edit-menu', 'Admin\MenuController@editMenu')->name('edit.menu.id');
                Route::post('delete-menu', 'Admin\MenuController@deleteMenu')->name('delete.menu.id');
            });
            //User
            Route::group(['prefix' => 'user'], function () {
                Route::get('index', 'Admin\UserController@index')->name('index.user');
                Route::get('create/1', 'Admin\UserController@create')->name('create.user');
                Route::post('create-user', 'Admin\UserController@store')->name('add.user');
                Route::get('edit/{id}', 'Admin\UserController@edit')->name('edit.user');
                Route::post('edit-user/{id}', 'Admin\UserController@update')->name('update.user');
                Route::get('delete/{id}', 'Admin\UserController@destroy')->name('delete.user');
                Route::get('/search/user', 'Admin\UserController@search')->name('search.user');
                //xoa checkbox
                Route::get('delete-multiple-user', 'Admin\UserController@delete_multiple_user')->name('delete-multiple-user.user');
                //resetpassword
                Route::get('resetpassword', 'Admin\ResetpasswordController@index')->name('reset.password');
                Route::post('edit-password', 'Admin\ResetpasswordController@update')->name('update.password');
        
            });
            //Post
            Route::group(['prefix' => 'post'], function () {
                Route::get('index', 'Admin\PostController@index')->name('index.post');
                Route::get('create/1', 'Admin\PostController@create')->name('create.post');
                Route::post('create-post', 'Admin\PostController@store')->name('add.post');
                //add trang
                Route::get('create-page', 'Admin\PostController@createPage')->name('create.page.post');
                Route::post('create-page-post', 'Admin\PostController@storePage')->name('add.page.post');
        
                Route::get('edit/{id}', 'Admin\PostController@edit')->name('edit.post');
                Route::post('edit-post', 'Admin\PostController@update')->name('update.post');
                Route::get('delete', 'Admin\PostController@destroy')->name('delete.post');
                Route::get('lock-post/{id}', 'Admin\PostController@lockPost')->name('lock.post');
                Route::get('unlock-post/{id}', 'Admin\PostController@unlockPost')->name('unlock.post');
        
                Route::post('add-category-post', 'Admin\PostController@addCategoryPost')->name('add.category.post');
        
                Route::get('/search/post', 'Admin\PostController@search')->name('search.post');
                //xoa checkbox
                Route::get('delete-multiple-post', 'Admin\PostController@delete_multiple_post')->name('delete-multiple-post.post');
        
            });
            // image box
            Route::group(['prefix' => 'image-box'], function () {
                Route::get('index', 'Admin\ImageBoxController@index')->name('index.image.box');
                Route::get('create/1', 'Admin\ImageBoxController@create')->name('create.image.box');
                Route::post('create-image-box', 'Admin\ImageBoxController@store')->name('add.image.box');
        
                Route::get('edit/{id}', 'Admin\ImageBoxController@edit')->name('edit.image.box');
                Route::post('edit-image-box', 'Admin\ImageBoxController@update')->name('update.image.box');
                Route::get('delete', 'Admin\ImageBoxController@destroy')->name('delete.image.box');
        
                Route::get('/search/image-box', 'Admin\ImageBoxController@search')->name('search.image.box');
                //xoa checkbox
                Route::get('delete-multiple-galary-image', 'Admin\ImageBoxController@delete_multiple_galary_image')->name('delete-multiple.image.box');
            });
            // video box
            Route::group(['prefix' => 'video-box'], function () {
                Route::get('index', 'Admin\VideoBoxController@index')->name('index.video.box');
                Route::get('create/1', 'Admin\VideoBoxController@create')->name('create.video.box');
                Route::post('create-video-box', 'Admin\VideoBoxController@store')->name('add.video.box');
        
                Route::get('edit/{id}', 'Admin\VideoBoxController@edit')->name('edit.video.box');
                Route::post('edit-video-box', 'Admin\VideoBoxController@update')->name('update.video.box');
                Route::get('delete', 'Admin\VideoBoxController@destroy')->name('delete.video.box');
        
                Route::get('/search/post', 'Admin\VideoBoxController@search')->name('search.video.box');
                //xoa checkbox
                Route::get('delete-multiple-galary-image', 'Admin\VideoBoxController@delete_multiple_galary_image')->name('delete-multiple.video.box');
                Route::get('delete-multiple-galary-videobox', 'Admin\VideoBoxController@delete_multiple_video_box')->name('delete-multiple.video.boxx');
            });
            //galary
            Route::group(['prefix' => 'galary'], function () {
                Route::get('index', 'Admin\GalaryController@index')->name('index.galary');
                Route::get('create/1', 'Admin\GalaryController@create')->name('create.galary');
                Route::post('create-galary', 'Admin\GalaryController@store')->name('add.galary');
                Route::get('edit/{id}', 'Admin\GalaryController@edit')->name('edit.galary');
                Route::post('edit-galary', 'Admin\GalaryController@update')->name('update.galary');
                Route::get('delete', 'Admin\GalaryController@destroy')->name('delete.galary');
        
                Route::get('/search/galary', 'Admin\GalaryController@search')->name('search.galary');
                //xoa ckechbox
                Route::get('delete-multiple-galary', 'Admin\GalaryController@delete_multiple_galary')->name('delete-multiple-galary');
            });
            //Comment
            Route::group(['prefix' => 'comment'], function () {
                Route::get('pendding-index', 'Admin\CommentController@penddingIndex')->name('pendding.index.comment');
                Route::get('success-index', 'Admin\CommentController@successIndex')->name('success.index.comment');
                Route::get('success-comment/{id}', 'Admin\CommentController@successComment')->name('success.comment');
                Route::get('delete-comment', 'Admin\CommentController@deleteComment')->name('delete.comment');
                Route::get('pendding-comment-product-index', 'Admin\CommentController@penddingCommentProductIndex')->name('pendding.index.comment.product');
        
                Route::get('success-comment-product-index', 'Admin\CommentController@successCommentProductIndex')->name('success.index.comment.product');
                //tim kiem theo status
                Route::get('list-commnet', 'Admin\CommentController@listComment')->name('list.comment');
                Route::get('list-commnet-post', 'Admin\CommentController@listCommentPost')->name('list.comment.post');
                //tim kiem theo search
                Route::get('searchCommentproduct', 'Admin\CommentController@searchCommentproduct')->name('searchComment.product');
                Route::get('searchCommentpost', 'Admin\CommentController@searchCommentpost')->name('searchComment.post');
        
                //xoa ckechbox
                Route::get('delete-multiple-Comment-susscess', 'Admin\CommentController@delete_multiple_Comment_susscess')->name('delete-multiple-Comment-susscess');
                Route::get('delete-multiple-Comment-pendding', 'Admin\CommentController@delete_multiple_Comment_pendding')->name('delete-multiple-Comment-pendding');
        
                //update status
                Route::post('update-status-comment', 'Admin\CommentController@updateStasusComment')->name('update.status.comment');
                Route::post('update-status-comment-post', 'Admin\CommentController@updateStasusCommentPost')->name('update.status.comment.post');
        
        
            });
            //Tag
            Route::group(['prefix' => 'tag'], function () {
                Route::get('index-tag-post', 'Admin\TagController@indexTagPost')->name('index.tag.post');
                Route::get('index-tag-product', 'Admin\TagController@indexTagProduct')->name('index.tag.product');
                Route::get('create-tag-product', 'Admin\TagController@createProduct')->name('create.tag.product');
                Route::post('create-tag-pro', 'Admin\TagController@storeProduct')->name('add.tag.product');
        
                Route::get('create-tag-post', 'Admin\TagController@createPost')->name('create.tag.post');
                Route::post('create-tag-post', 'Admin\TagController@storePost')->name('add.tag.post');
        
                Route::get('edit-tag-pro/{id}', 'Admin\TagController@editTagProduct')->name('edit.tag.product');
                Route::post('edit-tag-pro/{id}', 'Admin\TagController@updateTagProduct')->name('update.tag.product');
                Route::get('edit-tag-post/{id}', 'Admin\TagController@editTagPost')->name('edit.tag.post');
                Route::post('edit-tag-post/{id}', 'Admin\TagController@updateTagPost')->name('update.tag.post');
        
                Route::get('delete-tag-post', 'Admin\TagController@destroyPost')->name('delete.tag.post');
                Route::get('delete-tag-product', 'Admin\TagController@destroyProduct')->name('delete.tag.product');
        
                Route::get('/search-tag-post', 'Admin\TagController@searchPost')->name('search.tag.post');
                Route::get('/search-tag-product', 'Admin\TagController@searchProduct')->name('search.tag.product');
                //xoa checkbox
                Route::get('delete-multiple-tag-product', 'Admin\TagController@delete_multiple_tag_product')->name('delete-multiple-tag-product.product');
                Route::get('delete-multiple-tag-post', 'Admin\TagController@delete_multiple_tag_post')->name('delete-multiple-tag-post');
        
            });
            //Slide
            Route::group(['prefix' => 'slide'], function () {
                Route::get('index', 'Admin\SlideController@index')->name('index.slide');
                Route::get('create/1', 'Admin\SlideController@create')->name('create.slide');
                Route::post('create-slide', 'Admin\SlideController@store')->name('add.slide');
                Route::get('edit/{id}', 'Admin\SlideController@edit')->name('edit.slide');
                Route::post('edit-slide', 'Admin\SlideController@update')->name('update.slide'); 
                Route::get('delete', 'Admin\SlideController@destroy')->name('delete.slide');
        
                Route::get('/search/slide', 'Admin\SlideController@search')->name('search.slide');
                //xoa ckechbox
                Route::get('delete-multiple-slide', 'Admin\SlideController@delete_multiple_slide')->name('delete-multiple-slide');
            });
            //Form
            Route::group(['prefix' => 'form'], function () {
                Route::get('index', 'Admin\FormController@index')->name('index.form');
                Route::get('create/1', 'Admin\FormController@create')->name('create.form');
                Route::post('create-form', 'Admin\FormController@store')->name('add.form');
                Route::get('edit/{id}', 'Admin\FormController@edit')->name('edit.form');
                Route::post('edit-form/{id}', 'Admin\FormController@update')->name('update.form');
                Route::get('delete', 'Admin\FormController@destroy')->name('delete.form');
        
                Route::get('/search/form', 'Admin\FormController@search')->name('search.form');
                //xoa ckechbox
                Route::get('delete-multiple-form', 'Admin\FormController@delete_multiple_form')->name('delete-multiple-form');
        
            });
            //contact
            Route::group(['prefix' => 'contact'], function () {
        
                Route::get('list', 'Admin\ContactController@getList')->name('list.contact');
                Route::get('contactlist', 'Admin\ContactController@getListByStatus')->name('list.contactbystatus');
                Route::get('handle-contact/{id}', 'Admin\ContactController@getHandleContact')->name('get.handle.contact');
                Route::get('not-contact/{id}', 'Admin\ContactController@getNotContact')->name('get.not.contact');
                Route::get('detail-contact/{id}', 'Admin\ContactController@getDetailContact')->name('get.detail.contact');
                Route::post('update-status-contact', 'Admin\ContactController@updateStatusContact')->name('update.status.contact');
                Route::get('list-processed', 'Admin\ContactController@getProcessed')->name('list.processed');
                Route::get('delete', 'Admin\ContactController@destroy')->name('delete.contact');
                Route::get('/search/contact', 'Admin\ContactController@searchPendding')->name('search.pendding');
                Route::get('/search/contact-success', 'Admin\ContactController@searchSuccess')->name('search.success');
                //xoa ckechbox
                Route::get('delete-multiple-contact-susscess', 'Admin\ContactController@delete_multiple_contact_susscess')->name('delete-multiple-contact-susscess');
                Route::get('delete-multiple-contact-pendding', 'Admin\ContactController@delete_multiple_contact_pendding')->name('delete-multiple-contact-pendding');
        
            });
            //call api history
            Route::get('getAPi', 'Admin\HistoryController@index');
            Route::get('postApi/{$url},{$body}', 'Admin\HistoryController@getListUrl')->name('home.list.url');
            //Bill
            Route::group(['prefix' => 'bill'], function () {
                Route::get('/list', 'Admin\BillController@getList')->name('list.bill');
                Route::get('billlist', 'Admin\BillController@getListBybills')->name('list.billlist');
        
                Route::get('/list-process', 'Admin\BillController@getListProcess')->name('list.process');
                Route::get('detail-bill/{id}', 'Admin\BillController@getDetailBill')->name('detail.bill');
                Route::get('detail-transaction/{bill_code}', 'Admin\BillController@getTransaction')->name('detail.transaction');
                Route::post('update-detail-bill', 'Admin\BillController@updateDetailBill')->name('update.bill.detail');
                Route::get('delete', 'Admin\BillController@destroy')->name('delete.bill');
                //search
                Route::get('/search/bill', 'Admin\BillController@searchBill')->name('search.bill');
                //xoa checkbox
                Route::get('delete-multiple-bill', 'Admin\BillController@delete_mutiple_bill')->name('delete-multiple-bill.bill');
                //process handle bill
                Route::get('comfirm-bill/{id}', 'Admin\BillController@getComfirm')->name('get.comfirm.bill');
                Route::get('pack-bill/{id}', 'Admin\BillController@getPack')->name('get.pack.bill');
                Route::get('shipping-bill/{id}', 'Admin\BillController@getShipping')->name('get.shipping.bill');
                Route::get('success-bill/{id}', 'Admin\BillController@getSuccess')->name('get.success.bill');
                Route::get('return-bill/{id}', 'Admin\BillController@getReturn')->name('get.return.bill');
                Route::post('update-status', 'Admin\BillController@updateStatus')->name('bill.updatestatus');
        
            });
        
            //Voucher
            Route::group(['prefix' => 'voucher'],function(){
                 Route::post('addvoucher', 'Admin\VoucherController@store')->name('addvoucher');
                 Route::get('add', 'Admin\VoucherController@add')->name('add');
                 Route::get('index', 'Admin\VoucherController@index')->name('index');
                 Route::get('edit/{id}', 'Admin\VoucherController@edit')->name('edit.voucher');
                 Route::post('update/{id}', 'Admin\VoucherController@update')->name('update.voucher');
                 Route::get('delete/{id}', 'Admin\VoucherController@delete')->name('delete.vuocher');
                 Route::get('delete-multiple-voucher', 'Admin\VoucherController@delete_multiple_voucher')->name('delete_multiple_voucher');
                 Route::get('search-voucher', 'Admin\VoucherController@searchVoucher')->name('search_voucher');
        
        
        
            });
        });



});



//-------------------------------------admin-----------------------------------------//

Route::get('/data', function(){

    $source = 'vi';
    $target = 'en';
    // $text = 'chào buổi tối  ';
    
    $trans = new GoogleTranslate();
    // $result = $trans->translate($source, $target, $text);
    
    // echo $result;

    
    $fp = fopen(asset('product-id.txt'), "r");//mở file ở chế độ đọc
     // dd($fp);
   $aaa=1;
    while(!feof($fp)) {
    echo $aaa;$aaa++;      
    $iii=  "https://tiki.vn/api/v2/products/".substr(fgets($fp), 0, -1);//fget doc tung dong trong van ban, 0:cat ki tu dau tien, cuoi cung luc nao cung la -1,
    $ch = curl_init(); //tạo đối tượng
    curl_setopt($ch, CURLOPT_URL, $iii);//url gui di, goi den url iii
    curl_setopt($ch, CURLOPT_POST, 0);//0 phuong thuc get
                                    //1 phuong thuc post
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch); //nhận dữ liệu
    $a =json_decode($result,false);//false tra ve object//true tra ve mang
              if(2==$aaa){
 dd($a);
              }                   
    // dd($a);

     $b=$a->thumbnail_url;
     $c = \explode("/",$b);//tach chuoi thanh mang
     $url  =$c[sizeof($c)-1];
     // dd()
    curl_close($ch);//dong ket noi
    // $media_id  = Media::insertGetId([
    //     'type'=>1,
    //     'url'=>$url,
    //     'user_id'=>1,
    // ]);
    // $product_id = Product::insertGetId([
    //     'title'=> $trans->translate($source, $target, $a->name),
    //     'short_content'=>$trans->translate($source, $target,$a->short_description ), 
    //     // 'content'=> $trans->translate($source, $target, $a->description ),
    //     'content'=> null,
    //     'product_media_id'=>$media_id,
    //     'user_id'=>1
    // ]);
    // $md = ProductMedia::insertGetId([
    //     'media_id'=>$media_id,
    //     'product_id'=>$product_id
    // ]);
    // $ct = CategoryLink::insertGetId([
    // 'category_id'=>15,
    // 'link_id'=>$product_id,
    // 'type'=>2
    // ]);
    }
    fclose($fp);//dong đọc file
   
    
});