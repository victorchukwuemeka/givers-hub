@extends('layouts.admin.app')
@section('title', "Dashboard")
@section('page-title')  @endsection
@section('content')

        <div class="row">
            <div class="col">
                <div class="h-100">

                 <div id="stats">
                    {{-- @include('admin.dashboard.stats',['interval'=>'weekly']) --}}
                 </div>
                

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card" id="revenue-chart">
                 
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <!-- end col -->
                    </div>
      


                <div class="card">
                    <div class="row">

                        <div class="col-xl-4" id="customer-type-sales">
                
                        </div>

                        <div class="col-xl-8" id="recent-sales">
             
                        </div>

                    </div> <!-- end row-->
                  </div>
                </div> <!-- end .h-100-->

            </div> <!-- end col -->
        </div>




@endsection
@section("js")

 
@endsection
