@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header row">
                        <div class="col-md-2">
                            <h4>Task List</h4></div>

                        <div class="col-md-8">
                            <form action="/tasks">
                                <label> Select Project : </label>
                                <select name="pid" id="pid" aria-label="Default select example" style="width: 75% ;"
                                    onchange="this.form.submit()" onchange="selectproject(this.value)">
                                    <option value="">Select Project</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary w-100" data-toggle="modal"
                                data-target="#addtaskctmodel">
                                {{ __('+ Add ') }}
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table table-sm">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Task Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    {{-- {{ $task }} --}}
                                    <td>{{ $task->id }}</td>
                                    <td> <a href="taskdetails/{{ $task->id }}"> {{ $task->task_name }}</a></td>
                                    <td>{{ $task->start_date }}</td>
                                    <td>{{ $task->end_date }}</td>
                                    <td>{{ $task->status? 'Active' :'Inactive' }}</td>
                                    {{-- <td>
                                        <button class="btn btn-primary"
                                            onclick="GetTaskDetails({{ $task->id }})">Update</button>
                                        <a href="api/task_remove/{{ $task->id }}" class="btn btn-danger">Remove</a>
                                    </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- {{ $tasks->links() }} --}}
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
                <form action="api/add_task" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Task Name</label>
                            <input type="text" class="form-control" id="task_name" name="task_name"
                                placeholder="Project Name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Task Description</label>
                            <input type="text" class="form-control" id="task_description" name="task_description"
                                placeholder="Project Name">
                        </div>
                        <div class="form-group">
                            <label> Select Project : </label>
                            <select name="project_id" id="project_id" class="form-select"
                                aria-label="Default select example" required>
                                <option value="" selected disabled>Select Project</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                @endforeach
                            </select>
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

    <div class="modal fade" id="updatetaskctmodel" tabindex="-1" role="dialog" aria-labelledby="updatetaskctmodelLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updatetaskctmodelLabel">Add New Task</h5>
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="api/update_task" method="POST">
                    <input type="hidden" name="edit_id" id="edit_id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Task Name</label>
                            <input type="text" class="form-control" id="edit_task_name" name="task_name"
                                placeholder="Project Name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Task Description</label>
                            <input type="text" class="form-control" id="edit_task_description" name="task_description"
                                placeholder="Project Name">
                        </div>
                        <div class="form-group">
                            <label> Select Project : </label>
                            <select name="project_id" id="edit_project_id" class="form-select"
                                aria-label="Default select example" required>
                                <option value="" selected disabled>Select Project</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Start Date</label>
                            <input type="date" class="form-control" id="edit_start_date" name="start_date"
                                placeholder="Start Date" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">End Date</label>
                            <input type="date" class="form-control" id="edit_end_date" name="end_date"
                                placeholder="End Date" required>
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

    <script>
        $(document).ready(function() {
            $('#pid').select2({
                closeOnSelect: false
            });
            // $('#project_id').select2({
            //     closeOnSelect: false
            // });
        });

        function GetTaskDetails(id) {
            $.ajax({
                url: 'api/task_details/' + id,
                type: "GET",
                success: function(response) {
                    $('#edit_id').val(response[0].id);
                    $('#edit_task_name').val(response[0].task_name);
                    $('#edit_task_description').val(response[0].task_description);
                    $('#edit_start_date').val(response[0].start_date);
                    $('#edit_end_date').val(response[0].end_date);
                    $("#edit_project_id option[value=" + response[0].project_id + "]").attr('selected',
                        'selected');

                    $('#updatetaskctmodel').modal('show');
                }
            });
        }


        function selectproject(pid) {
            $.ajax({
                url: '/tasks/' + pid,
                type: "GET",
                success: function(response) {

                }
            });
        }
    </script>
@endsection
