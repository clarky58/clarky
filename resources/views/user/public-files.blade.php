@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="page-content">
    {{-- <div class="container"> --}}

        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#uploadFileModal">
            Upload File
        </button>



        <table class="table table-bordered table-responsive" id="filesTable" >
            <thead>
                <tr>

                    <th>File Name</th>
                    <th>Uploaded By</th>
                    <th>Access Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($files as $file)
                    <tr>

                        <td>{{ $file->name }} @if($file->is_locked)<span class="alert-danger">Locked</span>@endif</td>
                        <td>{{ $file->user->name }}</td>
                        <td>@if($file->type=='open')Public @else Private @endif</td>
                        <td>
                            @if ($file->status == 'active')
                            <span class="badge bg-success">Active</span>
                            @else
                            <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('users.files.download', $file->id) }}" class="btn btn-success btn-sm">
                               Download
                            </a>
                        </td>
                    <tr/>

                    @endforeach
            </tbody>
        </table>
</div>


<script type="text/javascript">
$(document).ready(function(){

    $('#filesTable').DataTable();

});
</script>


@endsection
