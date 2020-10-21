@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <div id="popup"></div>
    
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Expenses</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

          <div class="mb-4">
              <button name="modal_add_expense" id="modal_add_expense" type="button" class="btn btn-success btn-icon-split" >
                <span class="icon text-white-50">
                  <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add Expense</span>
            </button>
          </div>

          <div class="card shadow mb-4" style="width: 100%">
            <div class="card-header py-3 inline">
              <h6 class="m-0 font-weight-bold text-primary">Expenses Data</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="expenses" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Expense Category</th>
                      <th>Amount</th>
                      <th>Entry Date</th>
                      <th>Created at</th>
                      <th>Edit</th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach ($expenses as $expense)
                        <tr>
                            <td> {{ $expense->category }} </td>
                            <td> {{ $expense->amount }} </td>
                            <td> {{ $expense->entry_date }} </td>
                            <td> {{ $expense->created_at }} </td>
                            <td>
                                <button name="modal_edit_expense" data-id="{{ $expense->id }}"  action="update" id="modal_edit_expense" class="btn btn-primary btn-icon-split">
                                    <span class="icon text-white-50">
                                    <i class="fas fa-edit"></i>
                                    </span>
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


@include('scripts.expense-script')

@endsection
