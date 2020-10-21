@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Expense Categories</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

          <div class="mb-4">
              <button  action="add" name="modal_add_ec" id="modal_add_ec" type="button" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add Category</span>
            </button>
          </div>

          <div class="card shadow mb-4" style="width: 100%">
            <div class="card-header py-3 inline">
              <h6 class="m-0 font-weight-bold text-primary">Expenses Categories Data</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable-expense-cat" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Display Name</th>
                      <th>Description</th>
                      <th>Created at</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>{{ $category->created_at }}</td>
                            <td>
                                <button name="modal_edit_ec" this-id="{{ $category->id }}" this-desc="{{ $category->description }}" this-name="{{ $category->name }}" action="update" id="modal_edit_ec" class="btn btn-primary btn-icon-split">
                                    <span class="icon text-white-50">
                                    <i class="fas fa-edit"></i>
                                    </span>
                                    <span class="text">Edit</span>
                                </button>
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

  @include('includes.expense_cat.expense-cat-form')

  @include('scripts.expense_categories')

@endsection
