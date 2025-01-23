<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\CoachDashboard\AuthController;
use App\Http\Controllers\CoachDashboard\HomeController;
use App\Http\Controllers\CoachDashboard\PackageController;
use App\Http\Controllers\CoachDashboard\SettingController;
use App\Http\Controllers\CoachDashboard\SupportController;
use App\Http\Controllers\CoachDashboard\CategoryController;
use App\Http\Controllers\CoachDashboard\FoodController;
use App\Http\Controllers\CoachDashboard\MealController;
use App\Http\Controllers\CoachDashboard\TraineeController;
use App\Http\Controllers\CoachDashboard\TraineeProfileController;
use App\Http\Controllers\CoachDashboard\TrainingController;
use App\Http\Controllers\CoachDashboard\VitaminController;

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


Route::group(['prefix' => 'coach', 'as' => 'coach.', 'middleware' => ['localization']], function () {
    ///////////////////////////  dashboard Club   ///////////////////////////////////////////////////////////
    Route::get('/', function () {
        return redirect()->to('coach/dashboard');
    });
    Route::get('login', [AuthController::class, 'create'])->name("login");
    Route::post('login', [AuthController::class, 'login'])->name("login");
    Route::get('logout', [AuthController::class, 'logout'])->name("logout");
    Route::middleware(["coach"])->group(function () {

        Route::get('/dashboard', [HomeController::class, 'dashboard'])->name("dashboard.index");


        Route::resource("trainees", TraineeController::class);
        Route::post('/trainees/deleteSelected', [TraineeController::class,'deleteSelected'])->name('trainees.deleteSelected');
        Route::post('toggle-activation/trainees', [TraineeController::class, 'toggleActivation'])->name('trainees.toggleActivation');
        Route::get('trainees/{trainee}/progress', [TraineeController::class, 'progress'])->name('trainees.progress');
        Route::get('trainees/progress/{progress}/edit', [TraineeController::class, 'editProgress'])->name('trainees.progress.edit');


        Route::resource("trainees-profile", TraineeProfileController::class);
        Route::post('/trainees-profile/deleteSelected', [TraineeProfileController::class, 'deleteSelected'])->name('trainees-profile.deleteSelected');
        Route::post('toggle-activation/trainees-profile', [TraineeProfileController::class, 'toggleActivation'])->name('trainees-profile.toggleActivation');

        Route::resource("categories", CategoryController::class);
        Route::post('/categories/deleteSelected', [CategoryController::class,'deleteSelected'])->name('categories.deleteSelected');


        Route::resource("trainings", TrainingController::class);
        Route::post('/trainings/deleteSelected', [TrainingController::class,'deleteSelected'])->name('trainings.deleteSelected');


        Route::resource("packages", PackageController::class);
        Route::post('/packages/deleteSelected', [PackageController::class, 'deleteSelected'])->name('packages.deleteSelected');


        Route::resource("food", FoodController::class);
        Route::post('/food/deleteSelected', [FoodController::class, 'deleteSelected'])->name('food.deleteSelected');

        Route::resource("meals", MealController::class);
        Route::post('/meals/deleteSelected', [MealController::class, 'deleteSelected'])->name('meals.deleteSelected');


        Route::resource("vitamins", VitaminController::class);
        Route::post('/vitamins/deleteSelected', [VitaminController::class, 'deleteSelected'])->name('vitamins.deleteSelected');






        Route::resource("settings", SettingController::class);
        Route::resource("supports", SupportController::class);

    });

});
