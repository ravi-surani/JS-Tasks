@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header row">
                        <div class="col-md-11">
                            <h4>Projet List</h4>
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-primary w-100" data-toggle="modal"
                                data-target="#addprojectmodel">
                                {{ __('+ Add ') }}
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table table-sm">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Project Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    {{-- {{ $project }} --}}
                                    <td>{{ $project->id }}</td>
                                    <td><a href="projectdetails/{{ $project->id }}">{{ $project->project_name }}</a>
                                    </td>
                                    <td>{{ $project->start_date }}</td>
                                    <td>{{ $project->end_date }}</td>
                                    <td>{{ $project->status ? 'Active' : 'Inactive' }}</td>
                                    {{-- <td>
                                        <button class="btn btn-primary"
                                            onclick="GetProjectDetails({{ $project->id }})">Update</button>
                                        <a href="{{route('project.destroy',$project->id)}}" class="btn btn-danger">Remove</a>
                                    </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- {{ $projects->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addprojectmodel" tabindex="-1" role="dialog" aria-labelledby="addprojectmodelLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addprojectmodelLabel">Add New Project</h5>
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('project.store') }}" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Project Name</label>
                            <input type="text" class="form-control" id="project_name" name="project_name"
                                placeholder="Project Name" required>
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

    <div class="modal fade" id="updateprojectmodel" tabindex="-1" role="dialog"
        aria-labelledby="updateprojectmodelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateprojectmodelLabel">Update Project</h5>
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="api/update_project" method="POST">
                    <input type="hidden" name="edit_id" id="edit_id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Project Name</label>
                            <input type="text" class="form-control" id="edit_project_name" name="project_name"
                                placeholder="Project Name" required>
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
        
    </script>
@endsection
