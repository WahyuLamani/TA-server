<?php


use App\Http\Controllers\Auth\UpdateUserController;
use App\Http\Controllers\Clients\ClientRegisterController;
use App\Http\Controllers\Clients\GetOrderController;
use App\Http\Controllers\Clients\HomeController as ClientsHomeController;
use App\Http\Controllers\Dashboard\{AgentPostController, CompanyPostController, DistributorPostController, ExportController, ProfileController, ShowOrderController};
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Server\{AgentsController, CompanyController, ContainerController, DistributorController, DistributionController, WarehouseController};
use Illuminate\Support\Facades\{Auth, Route};



// Auth::routes();
// Auth::routes(['verify' => true]);
Route::view('/agent-register', 'clients.register.agent-register')->name('agent.register');
Route::post('/agent-register', [ClientRegisterController::class, 'agentRegister']);
Route::patch('/agent-register', [ClientRegisterController::class, 'agentRegisterStepTwo'])->name('agent.form');
// Route::view('/agent-form', 'clients.register.agent-register')->name('agent.form');
Route::view('/distributor-register', 'clients.register.distributor-register')->name('distributor.register');
Route::post('/distributor-register', [ClientRegisterController::class, 'distributorRegister']);

Auth::routes();

// Route::middleware('verified')->group(function () {
Route::middleware('auth')->group(function () {

    Route::get('/', [HomeController::class, 'handle'])->name('handle');
    Route::post('/', [CompanyController::class, 'create'])->name('company.create');
    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('server');

    Route::group(['middleware' => 'client', 'prefix' => 'clients'], function () {
        Route::get('/', [ClientsHomeController::class, 'index'])->name('clients');
        Route::post('/', [GetOrderController::class, 'order']);
        Route::patch('{order:id}', [GetOrderController::class, 'acceptOrder']);
        Route::post('{order:id}', [GetOrderController::class, 'distributed']);
        Route::patch('accept/{order:id}', [GetOrderController::class, 'completeOrder']);
        Route::delete('delete/{order:id}', [GetOrderController::class, 'delete']);
    });

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [CompanyPostController::class, 'posting'])->name('profile.posting');
    Route::post('/profile/data', [CompanyPostController::class, 'updatePost'])->name('post.update');
    Route::post('/profile/upload-images', [CompanyPostController::class, 'saveImages'])->name('post.image');
    Route::delete('/company-post/delete/{post:id}', [CompanyPostController::class, 'destroy']);
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update/{user:id}', [UpdateUserController::class, 'update'])->name('profile.update');


    Route::middleware('server')->group(function () {
        Route::get('/agents', [AgentsController::class, 'index'])->name('agents');
        Route::post('/agent/store', [AgentsController::class, 'store'])->name('agent.store');
        Route::get('/agent/details/{agent:id}', [AgentsController::class, 'details']);
        Route::delete('/agent/delete/{agent:id}', [AgentsController::class, 'destroy']);
        Route::get('/distributors', [DistributorController::class, 'index'])->name('distributors');
        Route::get('/distributor/details/{distributor:id}', [DistributorController::class, 'details']);
        Route::delete('/distributor/delete/{distributor:id}', [DistributorController::class, 'destroy']);

        Route::get('/agents/export', [ExportController::class, 'exportAgents'])->name('export.agent');
        Route::get('/distribution/export', [ExportController::class, 'exportDistributions'])->name('export.distributions');

        Route::get('/distribution', [DistributionController::class, 'index'])->name('distributed');
        Route::get('/distribution-request', [ShowOrderController::class, 'show'])->name('request.distributor');

        Route::get('/agent-container', [ContainerController::class, 'index'])->name('container');
        Route::post('/agent-container', [ContainerController::class, 'store'])->name('container.store');
        Route::post('/agent-container/handle/{container:id}', [ContainerController::class, 'handle'])->withoutMiddleware('server');
        Route::delete('/container/delete/{container:id}', [ContainerController::class, 'destroy']);

        Route::get('/post/agent/{post:id}', [AgentPostController::class, 'detail']);
        Route::get('/post/distributor/{post:id}', [DistributorPostController::class, 'detail']);

        Route::get('/warehouse', [WarehouseController::class, 'index']);
        Route::get('/warehouse/{warehouse:id}', [WarehouseController::class, 'detail']);
        Route::post('/warehouse', [WarehouseController::class, 'store']);
        Route::post('/warehouse/product-type', [WarehouseController::class, 'createProductType'])->name('product-type');
    });
});
