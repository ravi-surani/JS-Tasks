@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header row">
                        <div class="col-md-10">
                            <h4>{{ $task_details[0]->task_name }}</h4>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" onclick="updatetask()">Update</button>
                            <a href="{{ route('task.destroy', $task_details[0]->id) }}"
                                onclick="return confirm('Are you sure to remove?')" class="btn btn-danger">Remove</a>
                        </div>
                    </div>
                    {{-- {{ $task_details[0]}} --}}
                    {{-- {{ $projects }} --}}
                    {{-- {{ $users }} --}}
                    <div class="card-body">
                        <form action="{{ route('task.update') }}" method="POST">
                            <input type="hidden" name="edit_id" id="edit_id" value="{{ $task_details[0]->id }}">
                            <div class="form-group" id="task_name_div" style="display: none">
                                <label for="exampleInputEmail1">
                                    <h5>Task Name</h5>
                                </label>
                                <input type="text" class="form-control" id="task_name" name="task_name"
                                    placeholder="Task Name" value="{{ $task_details[0]->task_name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label>
                                    <h5>Project</h5>
                                </label>
                                <select name="project_id" id="project_id" class="form-select"
                                    aria-label="Default select example" required disabled>
                                    <option value="" selected disabled>Not Assigned To Project</option>
                                    @foreach ($projects as $project)
                                        <option @if ($project->id == $task_details[0]->project->id) selected @endif
                                            value="{{ $project->id }}">
                                            {{ $project->project_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">
                                    <h5>Task Description</h5>
                                </label>
                                <input type="text" class="form-control" id="task_description" name="task_description"
                                    placeholder="Task Description" value="{{ $task_details[0]->task_description }}"
                                    disabled>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">
                                        <h5>Start Date</h5>
                                    </label>
                                    <input type="text" class="form-control" id="start_date" name="start_date"
                                        placeholder="Start Date" value="{{ $task_details[0]->start_date }}" disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">
                                        <h5>End Date</h5>
                                    </label>
                                    <input type="date" class="form-control" id="end_date" name="end_date"
                                        placeholder="Start Date" value="{{ $task_details[0]->end_date }}" disabled>
                                </div>

                                <div class="form-group col-4">
                                </div>
                                <div class="col-md-3 mt-auto p-2 bd-highlight" id="update_btn_div" style="display: none">
                                    <button type="submit" class="btn btn-primary col-md-6">Update</button>
                                    <button type="button" class="btn btn-secondary col-md-5"
                                        onclick="cancleupdate()">Cancel</button>
                                </div>
                            </div>
                        </form>

                        <hr>
                        <div class="form-group">
                            <label for="exampleInputEmail1">
                                <h5> Users</h5>
                            </label>
                            <div class="row">
                                @if (isset($users))
                                    @foreach ($users as $user)
                                        <div class="alert alert-secondary col-md-3" role="alert" style="margin: 0px 15px;">
                                            @foreach ($user->taskUserList as $data)
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
    </div>
    </div>
    <style>
        .form-group {
            margin: 5px;
        }

    </style>
    <script>
        function updatetask() {
            $('#task_description').prop('disabled', false);
            $('#start_date').prop('disabled', false);
            $('#end_date').prop('disabled', false);
            $('#project_id').prop('disabled', false)
            $('#task_name').prop('disabled', false)
            $('#update_btn_div').show();
            $('#task_name_div').show();
        }

        function cancleupdate() {
            $('#task_description').prop('disabled', true);
            $('#start_date').prop('disabled', true);
            $('#end_date').prop('disabled', true);
            $('#task_name').prop('disabled', true)
            $('#update_btn_div').hide();
            $('#task_name_div').hide();
        }
    </script>
@endsection
