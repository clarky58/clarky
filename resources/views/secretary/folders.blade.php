@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="page-content">
    {{-- <div class="container"> --}}

        <button type="button" class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#addFolderModal">
            Add Folder
        </button>




        <table class="table table-bordered table-responsive" id="departmentsTable" >
            <thead>
                <tr>

                    <th>Department</th>
                    <th>Name</th>
                    <th>Added By</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($folders as $folder)
                <tr>

                    <td>{{ $folder->name }}</td>
                    <td>{{ $folder->department->name }}</td>
                    <td>{{ $folder->user->name }}</td>
                    <td>
                        <a class="btn btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editFolderModal{{ $folder->id }}">
                                Edit
                            </a>
                            <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#deleteFolderModal{{ $folder->id }}">
                            Delete
                        </a>
                    </td>
                    <div class="modal fade" id="editFolderModal{{ $folder->id }}" tabindex="-1"
                        aria-labelledby="editFolderModalLabel{{ $folder->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editFolderModalLabel{{ $folder->id }}">Edit folder</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('secretary.folders.edit',$folder) }}">
                                    @csrf
                                    <div class="modal-body">

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    required value="{{$folder->name}}">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update Name</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="deleteFolderModal{{ $folder->id }}" tabindex="-1"
                        aria-labelledby="deleteFolderModalLabel{{ $folder->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteFolderModalLabel{{ $folder->id }}">Delete folder</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                    <div class="modal-body">
                                        <p>Are you sure you want to delete the folder, all files in this folder will be deleted with it?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <a href="{{route('secretary.folders.delete',$folder)}}" class="btn btn-danger">Delete Folder</a>
                            </div>
                        </div>
                    </div>
                </tr>
                @endforeach

            </tbody>
        </table>





</div>


<!-- Modal with Folder Creation Form and Department Select -->
<div class="modal fade" id="addFolderModal" tabindex="-1" aria-labelledby="addFolderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFolderModalLabel">Add Folder</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('secretary.folders.create') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Folder Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="department_id" class="form-label">Department</label>
                        <input type="text" name="department_id" id="department_id" class="form-control" value="{{Auth::user()->department->name}}" readonly required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Folder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function(){

        $('#departmentsTable').DataTable();

    });
</script>







@endsection
