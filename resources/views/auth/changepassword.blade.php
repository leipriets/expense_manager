@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Change Password</h1>
    </div>

    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header"></div>

            <div class="card-body">
                <form method="POST" action="{{ route('change.password') }}">
                    @csrf 
                

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @else
                        <div class="alert alert-success">
                            @foreach ($errors->all() as $error)
                                <p class="text-danger">{{ $error }}</p>
                            @endforeach 
                        </div>
                    @endif

                    

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

                        <div class="col-md-6">
                            <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm Password</label>

                        <div class="col-md-6">
                            <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Update Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection