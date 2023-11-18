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
                            @else
                            <span class="badge bg-danger">Returned</span>
                            @endif
                        </td>
                        <td>
                            @if($request->status == 'pending' || $request->status == 'rejected')
                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#cancelFileRequestModal{{ $request->id }}">
                                Cancel Request
                            </a>
                            @else
                            <a href="{{route('users.files.download',$request->file_id)}}" class="btn btn-info btn-sm">
                                Download
                            </a>
                            @endif
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
                                    <a href="{{ route('users.files.request.delete', $request) }}" class="btn btn-primary">Yes, Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
            </tbody>
        </table>







<!-- Modal -->
<div class="modal fade" id="requestFileModal" tabindex="-1" aria-labelledby="requestFileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="requestFileModalLabel">Upload File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('users.files.request') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="file_id" class="form-label">Select File</label>
                        <select class="form-select" id="file_id" name="file_id" required>
                            <option value="" selected disabled>Select File</option>
                            @foreach ($files as $file)
                                <option value="{{ $file->id }}">{{ $file->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="reason" class="form-label">Reason</label>
                        <input type="text" class="form-control" id="reason" name="reason" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Request File</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>


<script type="text/javascript">
$(document).ready(function(){

    $('#filesTable').DataTable();

});
</script>


@endsection
