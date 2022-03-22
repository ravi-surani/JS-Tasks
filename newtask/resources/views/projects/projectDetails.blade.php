@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header row">
                        <div class="col-md-10">
                            <h4>{{ $project[0]->project_name }}</h4>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" onclick="updateproject()">Update</button>
                            <a href="{{ route('project.destroy', $project[0]->id) }}"
                                onclick="return confirm('Are you sure to remove?')" class="btn btn-danger">Remove</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('project.update')}}" method="POST">
                            <input type="hidden" name="edit_id" id="edit_id" value="{{ $project[0]->id }}">
                            <div class="form-group" id="project_name_div" style="display: none">
                                <label for="exampleInputEmail1">
                                    <h5>Project Name</h5>
                                </label>
                                <input type="text" class="form-control" id="project_name" name="project_name"
                                    placeholder="Project Name" value="{{ $project[0]->project_name }}"
                                    disabled>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-9">
                                    <label for="exampleInputEmail1">
                                        <h5>Project Description</h5>
                                    </label>
                                    <input type="text" class="form-control" id="project_description"
                                        name="project_description" placeholder="Project Description"
                                        value="{{ $project[0]->project_description }}" disabled>
                                </div>

                             
                                <div class="form-group col-2 d-flex align-items-center justify-content-center">
                                    <label for="exampleInputEmail1">
                                        <h5>Status</h5>
                                    </label>
                                    <label class="switch">
                                        <input type="checkbox" checked id="status" name="status"{{ $project[0]->status == 1 ?'checked':'' }} >
                                        <span class="slider round"></span>
                                      </label>
                                      
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">
                                        <h5>Start Date</h5>
                                    </label>
                                    <input type="text" class="form-control" id="start_date" name="start_date"
                                        placeholder="Start Date" value="{{ $project[0]->start_date }}" disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">
                                        <h5>End Date</h5>
                                    </label>
                                    <input type="date" class="form-control" id="end_date" name="end_date"
                                        placeholder="Start Date" value="{{ $project[0]->end_date }}" disabled>
                                </div>
                               
                                
                                <div class="col-md-3 mt-auto p-2 bd-highlight" id="update_btn_div" style="display: none">
                                    <button type="submit" class="btn btn-primary col-md-6">Update</button>
                                    <button type="button" class="btn btn-secondary col-md-5"
                                        onclick="cancleupdate()">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-8 ">
                            <div class="form-group row padding_bottem20">
                                <div class="col-md-10">
                                    <label for="exampleInputEmail1" class="col-md-8">
                                        <h5> Tasks</h5>
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-primary w-100" data-toggle="modal"
                                     data-target="#addtaskctmodel">
                                        {{ __('+ Add ') }}
                                    </button>
                                </div>
                            </div>

                            @if (isset($project[0]->tasks) && count($project[0]->tasks))
                                @foreach ($project[0]->tasks as $task)
                                    <div class="alert alert-secondary" role="alert">
                                        <a href=" {{route('taskdetails',$task->id )}}"> {{ $task->task_name }}</a>
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-warning" role="alert">
                                    No Task Avaiabel.
                                </div>
                            @endif

                        </div>
                        <div class="form-group col-md-3 border_left " >
                            <label for="exampleInputEmail1" class="padding_bottem20"> 
                                <h5> Users</h5>
                            </label>
                            @if (isset($users))
                                @foreach ($users as $user)
                                    <div class="alert alert-secondary" role="alert">
                                        @foreach ($user->projectUserList  as $data)
                                            {{ $data->name }}
                                        @endforeach
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-warning" role="alert">
                                    No User Avaiabel.
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addtaskctmodel" tabindex="-1" role="dialog" aria-labelledby="addtaskctmodelLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addtaskctmodelLabel">Add New Task</h5>
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('task.store') }}" method="POST">
                    <input type="hidden" name="project_id" id="project_id" value="{{ $project[0]->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Task Name</label>
                            <input type="text" class="form-control" id="task_name" name="task_name"
                                placeholder="Task Name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Task Description</label>
                            <input type="text" class="form-control" id="task_description" name="task_description"
                                placeholder="Task Description">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date"
                                placeholder="Start Date" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" placeholder="End Date"
                                required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Saves</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>
@endsection
