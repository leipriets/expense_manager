@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <div id="popup"></div>
    
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

          <div class="mb-4">
              <button name="modal_add_user" id="modal_add_user" type="button" class="btn btn-success btn-icon-split" >
                <span class="icon text-white-50">
                  <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add User</span>
            </button>
          </div>

          <div class="card shadow mb-4" style="width: 100%">
            <div class="card-header py-3 inline">
              <h6 class="m-0 font-weight-bold text-primary">Users Data</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="expenses" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email Addess</th>
                      <th>Role</th>
                      <th>Created at</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($users as $user)
                        <tr>
                            <td> {{ $user->name }}</td>
                            <td> {{ $user->email }}</td>
                            <td> {{ $user->role }}</td>
                            <td> {{ $user->created_at }}</td>
                            <td> 

                                @if ($user->role == 'admin')
                                    &nbsp;
                                @else
                                    <button name="modal_edit_user" data-id="{{ $user->id }}"  action="update" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-role="{{ $user->role }}" id="modal_edit_expense" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                        <i class="fas fa-edit"></i>
                                        </span>
                                    </button>
                                @endif

                            </td>
                        </tr>
                      @endforeach

                  </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>
</div>

@include('scripts.user-script')

@endsection
