@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
      <div>
        <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
      </div>
      <div class="d-flex align-items-center flex-wrap text-nowrap">
        <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
          <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle><i data-feather="calendar" class="text-primary"></i></span>
          <input type="text" class="form-control bg-transparent border-primary" placeholder="Select date" data-input>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow-1">
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Department Users</h6>
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">{{$users}}</h3>
                        <div class="d-flex align-items-baseline">
                          <p class="text-success">
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Department Folders</h6>
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">{{$folders}}</h3>
                        <div class="d-flex align-items-baseline">
                          <p class="text-success">
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Department Files</h6>
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">{{$files}}</h3>
                        <div class="d-flex align-items-baseline">
                          <p class="text-success">
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>
      </div>
    </div> <!-- row -->

    <div class="row">
      <div class="col-lg-12 col-xl-12 stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline mb-2">
              <h6 class="card-title mb-0">File Requests</h6>
            </div>
            <div class="table-responsive">
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
          </div>
        </div>
      </div>
    </div> <!-- row -->

        </div>
        <script type="text/javascript">
            $(document).ready(function(){

                $('#filesTable').DataTable();

            });
            </script>

@endsection
