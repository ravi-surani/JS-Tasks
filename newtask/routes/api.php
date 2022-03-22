    <?php

    use App\Http\Controllers\ProjectController;
    use App\Http\Controllers\TasksController;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;

    /*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::prefix('project')->group(function () {
        Route::post('add_project', [ProjectController::class, 'store'])->name('project.store');
        Route::get('project_details/{id}', [ProjectController::class, 'edit'])->name('project.edit');
        Route::post('update_project', [ProjectController::class, 'update'])->name('project.update');
        Route::get('project_remove/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');
    });

    Route::prefix('task')->group(function () {
        Route::get('getprojecttask/{id}', [TasksController::class, 'taskByProject'])->name('task.taskByProject');
        Route::post('add_task', [TasksController::class, 'store'])->name('task.store');
        Route::get('task_details/{id}', [TasksController::class, 'edit'])->name('task.edit');
        Route::post('update_task', [TasksController::class, 'update'])->name('task.update');
        Route::get('task_remove/{id}', [TasksController::class, 'destroy'])->name('task.destroy');
    });
