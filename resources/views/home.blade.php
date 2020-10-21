@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard </h1>
    </div>

    <!-- Content Row -->
    <div class="row">

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"> {{ Auth::user()->role == ' admin'? 'Expenses' : 'My Expenses' }} </h6>

                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                      <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                      <div id="expense-list"></div>
                    </div>
                  </div>
                </div>
              </div>

                {{-- Expense Category --}}
                <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Expense Categories</div>
                          {{-- categories --}}
                          <div id="categories"></div>
                          {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div> --}}
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total</div>
                      <div id="totals"></div>
                      {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div> --}}
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

    </div>

</div>

<script type="text/javascript">

$( function() {

  $("#expense-list").html("")

  $.get('expense-chart', (res) => {

    console.log(res)

    for (let index = 0; index < res.length; index++) {
      const element = res[index];
      console.log(element.data)
      var html = `<span class="mr-2">
                      <i class="fas fa-circle text-info"></i> ${element.name}
              </span>`

      $("#expense-list").append(html)

      // categories
      var categories = `<div class="h5 mb-0 font-weight-bold text-gray-800">${element.name}</div>` 
      $("#categories").append(categories)

      // totals  
      var total = `<div class="h5 mb-0 font-weight-bold text-gray-800">${element.data}</div>`

      $("#totals").append(total)
      
    }


  

  })

})

</script>

@endsection
