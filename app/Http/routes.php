<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

use App\Task;
use Illuminate\Http\Request;

Route::group(['middleware' => ['web']], function () {
    /**
     * Show Task Dashboard
     */
    Route::get('/', function () {
        return view('tasks', [
            'tasks' => Task::orderBy('created_at', 'asc')->get()
        ]);
    });

    /**
     * Add New Task
     */
    Route::post('/task', function (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'max:1000',
            'deadline' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $date = new DateTime($_POST["deadline"], new DateTimeZone($_POST["timezone"]));
        $time_in_user_timezone = $date->format('Y-m-d H:i:sP');
        $date->setTimezone(new DateTimeZone(config('app.timezone')));
        $time_in_system_timezone = $date->format('Y-m-d H:i:sP');

        $task = new Task;
        $task->name = $request->name;
        $task->description = $request->description;
        $task->deadline = $time_in_system_timezone;
        $task->save();
        return redirect('/');
    });

    /**
     * Delete Task
     */
    Route::delete('/task/{id}', function ($id) {
        Task::findOrFail($id)->delete();

        return redirect('/');
    });
});
