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
                      <h6 class="card-title mb-0">All Folders</h6>
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
                      <h6 class="card-title mb-0">All Files</h6>
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
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Departments</h6>
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">{{$departments}}</h3>
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

                            <tr/>
                            @endforeach
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- row -->

        </div>
@endsection
