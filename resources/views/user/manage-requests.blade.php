@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="page-content">
    {{-- <div class="container"> --}}

        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#requestFileModal">
            Request File
        </button>



        <table class="table table-bordered table-responsive" id="filesTable" >
            <thead>
                <tr>
                    <th>Date Requested</th>
                    <th>File Name</th>
                    <th>Uploaded By</th>
                    <th>Access Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($requests as $request)
                    <tr>

                        <td>{{ $request->created_at }}</td>
                        <td>{{ $request->file->name }}</td>
                        <td>{{ $request->file->user->name}}</td>
                        <td>{{ $request->file->type}}</td>
                        <td>
                            @if ($request->status == 'pending')
                            <span class="badge bg-success">Pending</span>
                            @elseif ($file->status == 'rejected')
                            <span class="badge bg-warning">Rejected</span>
                            @else
                            <span class="badge bg-danger">unknown</span>
                            @endif
                        </td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editFileModal{{ $request->file->id }}">
                                Cancel Request
                            </a>

                        </td>
                    <tr/>

                    <div class="modal fade" id="cancelFileRequestModal{{ $request->id }}" tabindex="-1" aria-labelledby="cancelFileRequestModalLabel{{ $request->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteFileModalLabel{{ $request->id }}">Cancel Request</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to cancel this request?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="{{ route('users.files.delete', $request->id) }}" class="btn btn-primary">Yes, Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>

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
