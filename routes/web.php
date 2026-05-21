<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdmin;
use App\Http\Controllers\Admin\{
    DashboardController,
    AuthController,
    CategoryController,
    CommentController,
    PostController,
    ServiceController,
    CustomerController,
    TodoController,
    SaleController
};

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {

    Route::prefix('auth')->controller(AuthController::class)->group(function () {
        Route::get('', 'index')->name('admin.auth.index');
        Route::post('login', 'login')->name('admin.auth.login');
        Route::get('logout','logout')->name('admin.auth.logout');
    });

   Route::middleware(CheckAdmin::class)->group(function(){
    
        Route::get('', [DashboardController::class,'index'])->name('admin.dashboard.index');

        Route::prefix('category')->controller(CategoryController::class)->group(function(){
           Route::get('','index')->name('admin.category.index');
           Route::get('create','create')->name('admin.category.create');
           Route::post('store','store')->name('admin.category.store');
           Route::prefix('{category_id}')->group(function(){
              Route::get('edit','edit')->name('admin.category.edit');
              Route::post('update','update')->name('admin.category.update');
              Route::get('delete','delete')->name('admin.category.delete');
        });
    });

        Route::prefix('post')->controller(PostController::class)->group(function(){
            Route::get('','index')->name('admin.post.index');
            Route::get('create','create')->name('admin.post.create');
            Route::post('store','store')->name('admin.post.store');
            Route::prefix('{post_id}')->group(function(){
               Route::get('edit','edit')->name('admin.post.edit');
               Route::post('update','update')->name('admin.post.update');
               Route::get('delete','delete')->name('admin.post.delete');
        });
     });

       Route::prefix('comment')->controller(CommentController::class)->group(function(){
           Route::get('','index')->name('admin.comment.index');
           Route::prefix('{comment_id}')->group(function(){
                 Route::get('approved','approved')->name('admin.comment.approved');
                 Route::get('delete','delete')->name('admin.comment.delete');
           });
     });

        Route::prefix('service')->controller(ServiceController::class)->group(function(){
            Route::get('','index')->name('admin.service.index');
            Route::get('create','create')->name('admin.service.create');
            Route::post('store','store')->name('admin.service.store');
            Route::prefix('{service_id}')->group(function(){
               Route::get('edit','edit')->name('admin.service.edit');
               Route::post('update','update')->name('admin.service.update');
               Route::get('delete','delete')->name('admin.service.delete');
        });
     });

       Route::prefix('customer')->controller(CustomerController::class)->group(function(){
           Route::get('','index')->name('admin.customer.index');
           Route::get('create','create')->name('admin.customer.create');
           Route::post('store','store')->name('admin.customer.store');
           Route::prefix('{customer_id}')->group(function(){
                Route::get('edit','edit')->name('admin.customer.edit');
                Route::post('update','update')->name('admin.customer.update');
                Route::get('delete','delete')->name('admin.customer.delete');
              });
          });

       Route::prefix('todo')->controller(TodoController::class)->group(function(){
           Route::get('','index')->name('admin.todo.index');
           Route::get('create','create')->name('admin.todo.create');
           Route::post('store','store')->name('admin.todo.store');
           Route::prefix('{todo_id}')->group(function(){
                Route::get('edit','edit')->name('admin.todo.edit');
                Route::post('update','update')->name('admin.todo.update');
                Route::get('delete','delete')->name('admin.todo.delete');
          });
       });

       Route::prefix('sale')->controller(SaleController::class)->group(function(){
          Route::get('','index')->name('admin.sale.index');
          Route::get('create','create')->name('admin.sale.create');
          Route::post('store','store')->name('admin.sale.store');
          Route::prefix('{sale_id}')->group(function(){
              Route::get('edit','edit')->name('admin.sale.edit');
              Route::post('update','update')->name('admin.sale.update');
              Route::get('delete','delete')->name('admin.sale.delete');
          });
        });

   });

});
