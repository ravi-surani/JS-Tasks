<?php

namespace App\Http\Controllers;

use App\Models\tasks;
use App\Http\Requests\StoretasksRequest;
use App\Http\Requests\UpdatetasksRequest;
use App\Models\project;
use App\Models\projectuser;
use Auth;

class TasksController extends Controller
{
    public function TasksController()
    {
        $this->middleware('auth');
    }
 

    public function index(StoretasksRequest $request)
    {
        $tasks = [];
        if (isset($request->pid)) {
            $tasks = tasks::where('project_id', $request->pid)->get();
        } else {
            $tasks = tasks::all();
        }
        $projects = project::all();
        return view('tasks.tasklist', compact('tasks', 'projects'));
    }

    public function create()
    {
        //
    }

    public function store(StoretasksRequest $request)
    {
        $data = request()->validate([
            'task_name' => 'required',
            'task_description' => 'nullable',
            'project_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $date = tasks::create($data);
        // return redirect('/tasks');
        return redirect()->back();
    }

    public function show($id)
    {
        $task_details = tasks::with('project')->where('id', $id)->get();
        $projects = project::all();
        $users = projectuser::with('taskUserList')->where('project_id', $id)->get();
        return view('tasks.taskDetails', compact('task_details', 'projects','users'));
    }

    public function edit($id)
    {
        $task_details = tasks::where('id', $id)->get();
        return response()->json($task_details);
    }

    public function update(UpdatetasksRequest $request)
    {
        $data = request()->validate([
            'edit_id' => 'required',
            'task_name' => 'required',
            'task_description' => 'nullable',
            'project_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $date = tasks::where('id', $data['edit_id'])->update([
            'task_name' => $data['task_name'],
            'task_description' => $data['task_description'],
            'project_id' => $data['project_id'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ]);
        // return redirect('/tasks');
        return redirect()->back();
    }

    public function destroy($id)
    {
        tasks::where('id', $id)->delete();
        return redirect('/tasks');
    }

    public function taskByProject($pid)
    {
        $tasks = tasks::where('project_id', $pid)->get();
        return response()->json($tasks);
    }
}
