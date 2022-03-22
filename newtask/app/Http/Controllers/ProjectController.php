<?php

namespace App\Http\Controllers;

use App\Models\project;
use App\Http\Requests\StoreprojectRequest;
use App\Http\Requests\UpdateprojectRequest;
use App\Models\projectuser;
use App\Models\tasks;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{

    public function ProjectController()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // $projects = project::with('users')->get();
        $projects = project::all();
        return view('projects.projectlist', compact('projects'));
    }

    public function create()
    {
    }

    public function store(StoreprojectRequest $request)
    {
        $data =  request()->validate([
            'project_name' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        // $date = project::setStartDateAttribute($data['start_date']);
        // dd( $date );
        $date = project::create($data);
        // return redirect('/home');
        return redirect()->back();
    }

    public function show($id)
    {
        // SELECT * FROM projects LEFT JOIN projectusers on projectusers.project_id = projects.id RIGHT JOIN users on users.id = projectusers.user_id where projects.id= 4
        // $project = DB::table('projects')->select(
        //     'projects.id as pid',
        //     'projects.project_name as pname',
        //     'projects.project_description as p_description',
        //     'projects.start_date as pstartdate',
        //     'projects.end_date as penddate',
        //     'users.id as userid',
        //     'users.name as username',
        //     'users.email as useremail'
        // )
        //     ->leftJoin('projectusers', 'projectusers.project_id', '=', 'projects.id')
        //     ->rightJoin('users', 'users.id', '=', 'projectusers.user_id')
        //     ->where('projects.id', $id)->get()->toArray();
        $project = project::with('tasks')->where('id', $id)->get();
        $users = projectuser::with('projectUserList')->where('project_id', $id)->get();

        return view('projects.projectDetails', compact('project', 'users'));
    }


    public function edit($id)
    {
        $project_details = project::where('id', $id)->get();
        return response()->json($project_details);
    }


    public function update(UpdateprojectRequest $request)
    {
        $data =  request()->validate([
            'edit_id' => 'required',
            'project_name' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);
        $projects = project::where('id', $data['edit_id'])
            ->update(
                [
                    'project_name' => $data['project_name'],
                    'start_date' => $data['start_date'],
                    'end_date' => $data['end_date'],
                ]
            );
        // return redirect('/home');
        return redirect()->back();
    }


    public function destroy($id)
    {
        project::where('id', $id)->delete();
        tasks::where('project_id', $id)->delete();
        projectuser::where('project_id', $id)->delete();
        return redirect('/home');
        // return redirect()->back();
    }
}
