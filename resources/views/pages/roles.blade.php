@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <div id="popup"></div>
    
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Roles</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

          <div class="mb-4">
              <button name="modal_add_role" id="modal_add_role" type="button" class="btn btn-success btn-icon-split" >
                <span class="icon text-white-50">
                  <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add Role</span>
            </button>
          </div>

          <div class="card shadow mb-4" style="width: 100%">
            <div class="card-header py-3 inline">
              <h6 class="m-0 font-weight-bold text-primary">Role Data</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="expenses" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Display Name</th>
                      <th>Description</th>
                      <th>Created at</th>
                      <th>Edit</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($roles as $role)
                        <tr>
                            <td> {{ $role->display_name }}</td>
                            <td> {{ $role->description }}</td>
                            <td> {{ $role->created_at }}</td>
                            <td> 

                                @if ($role->name == 'admin')
                                    &nbsp;
                                @else
                                    <button name="modal_edit_role" data-id="{{ $role->id }}"  action="update" data-name="{{ $role->display_name }}" data-desc="{{ $role->description }}" id="modal_edit_expense" class="btn btn-primary btn-icon-split">
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

@include('scripts.role-script')

@endsection
