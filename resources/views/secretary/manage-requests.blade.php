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
                            <span class="badge bg-warning">Pending</span>
                            @elseif ($request->status == 'approved')
                            <span class="badge bg-success">Approved</span>
                            @elseif ($request->status == 'rejected')
                            <span class="badge bg-danger">Rejected</span>
                            @else
                            <span class="badge bg-danger">Returned</span>
                            @endif
                        </td>
                        <td>
                            @if($request->status == 'pending')
                            <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#approveFileRequestModal{{ $request->id }}">
                                Approve Request
                            </a>
                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectFileRequestModal{{ $request->id }}">
                                Reject Request
                            </a>
                            @else
                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#cancelFileRequestModal{{ $request->id }}">
                                Cancel Request
                            </a>
                            @endif
                        </td>
                    <tr/>
                    <div class="modal fade" id="approveFileRequestModal{{ $request->id }}" tabindex="-1" aria-labelledby="approveFileRequestModalLabel{{ $request->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="approveFileModalLabel{{ $request->id }}">Approve Request</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to approve this request?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="{{ route('secretary.file.requests.approve', $request) }}" class="btn btn-primary">Yes, Approve</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="rejectFileRequestModal{{ $request->id }}" tabindex="-1" aria-labelledby="cancelFileRequestModalLabel{{ $request->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="rejectFileModalLabel{{ $request->id }}">Reject Request</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to reject this request?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="{{ route('secretary.file.requests.reject', $request) }}" class="btn btn-primary">Yes, Reject</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="cancelFileRequestModal{{ $request->id }}" tabindex="-1" aria-labelledby="cancelFileRequestModalLabel{{ $request->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="rejectFileModalLabel{{ $request->id }}">Reject Request</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this request?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="{{ route('secretary.file.requests.cancel', $request) }}" class="btn btn-primary">Yes, Delete</a>
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
