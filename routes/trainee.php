<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\TraineeProgressController;
use App\Http\Controllers\TraineeDashboard\AuthController;
use App\Http\Controllers\TraineeDashboard\FoodController;
use App\Http\Controllers\TraineeDashboard\HomeController;
use App\Http\Controllers\CoachDashboard\TraineeController;
use App\Http\Controllers\TraineeDashboard\ProfileController;
use App\Http\Controllers\TraineeDashboard\SettingController;
use App\Http\Controllers\TraineeDashboard\SupportController;
use App\Http\Controllers\TraineeDashboard\VitaminController;
use App\Http\Controllers\TraineeDashboard\TrainingController;
use App\Http\Controllers\CoachDashboard\TraineeProfileController;
use App\Http\Controllers\TraineeDashboard\TrainingController as TraineeDashboardTrainingController;
use App\Http\Controllers\TraineeDashboard\TraineeProgressController as TraineeDashboardTraineeProgressController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


///////////////////////////  dashboard Trainee   ///////////////////////////////////////////////////////////

Route::group(['prefix' => 'trainee', 'as' => 'trainee.', 'middleware' => ['localization']], function () {

    Route::get('/', function () {
        return redirect()->to('trainee/dashboard');
    });
    Route::get('login', [AuthController::class, 'create'])->name("login");
    Route::post('login', [AuthController::class, 'login'])->name("login");
    Route::get('logout', [AuthController::class, 'logout'])->name("logout");
    Route::middleware(["trainee"])->group(function () {

        Route::get('/dashboard', [HomeController::class, 'dashboard'])->name("dashboard.index");



        Route::get('profile', [ProfileController::class, 'index'])->name("profile");


        Route::resource("food", FoodController::class);


        Route::resource("vitamins", VitaminController::class);



        Route::get('/trainee/meals', [TraineeController::class, 'showMeals'])->name('meals.index');


        Route::resource("trainings", TrainingController::class);
        Route::get('/trainings/category/{id}', [TrainingController::class, 'showTrainings'])->name('trainee.trainings.show');


        Route::resource("progress", TraineeDashboardTraineeProgressController::class);


        Route::resource("settings", SettingController::class);
        Route::resource("supports", SupportController::class);





    });

});

