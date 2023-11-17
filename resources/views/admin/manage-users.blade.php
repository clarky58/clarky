@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-content">
        {{-- <div class="container"> --}}

        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add User
        </button>


        <table class="table table-bordered table-responsive" id="usersTable">
            <thead>
                <tr>

                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Phone</th>

                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>

                        <td><?= $user->name ?></td>
                        <td><?= $user->username ?></td>
                        <td><?= $user->email ?></td>
                        <td>
                            {{ $user->department->name ?? '____' }}
                        </td>




                        <td><?= $user->phone ?></td>

                        <td><?= $user->role ?></td>
                        <td><?= $user->status ?></td>
                        <td>
                            <a class="btn btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editUserModal{{ $user->id }}">
                                Edit
                            </a>
                            <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteUserModal{{ $user->id }}">
                                Delete
                            </a>
                        </td>
                        <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1"
                            aria-labelledby="deleteUserodalLabel{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteUserModalLabel{{ $user->id }}">Delete User
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this user?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <a href="{{ route('users.delete', $user->id) }}" class="btn btn-primary">Yes,
                                            delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1"
                            aria-labelledby="editUserodalLabel{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Edit User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('users.edit',$user) }}">
                                        @csrf
                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="name" class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        required value="{{$user->name}}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        required value="{{$user->email}}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="phone" class="form-label">Phone</label>
                                                    <input type="tel" class="form-control" id="phone"
                                                        name="phone" value="{{$user->phone}}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="department" class="form-label">Select Department</label>

                                                    <select class="form-select" id="department" name="department">
                                                        @foreach ($departments as $department)
                                                            <option value="{{ $department->id }}" @if ($user->department_id == $department->id)
                                                                selected @endif>{{ $department->name }}</option>
                                                        @endforeach


                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="role" class="form-label">Role</label>
                                                    <select class="form-select" id="role" name="role">
                                                        <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                                                        <option value="secretary" @if($user->role == 'secretary') selected @endif>Secretary</option>
                                                        <option value="user" @if($user->role == 'user') selected @endif>User</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save User</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('users.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="tel" class="form-control" id="phone" name="phone">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="department" class="form-label">Select Department</label>

                                    <select class="form-select" id="department" name="department">
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach


                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-select" id="role" name="role">
                                        <option value="admin">Admin</option>
                                        <option value="secretary">Secretary</option>
                                        <option value="user" selected>User</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    </div>

    <script type="text/javascript">
        $(document).ready(function() {

            $('#usersTable').DataTable();

        });
    </script>
@endsection
