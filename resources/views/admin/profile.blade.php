@extends('layouts.admin.app')
@section('title', "Profile")
@section('page-title') Profile @endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="h-100">
                <div class="row mb-3 justify-content-center">
                  <div class="col-md-10">
                    <div class="card">
                      <div class="card-body">
                          <h4 class="mt-0 header-title">Edit Profile</h4>
                          @include("amicrud::amicrud.shared.alert")
                          <form method="post" action="{{route('admin.profile.update')}}" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="row justify-content-center">
                           <div class="col-md-8">
                               <div class="form-group">
                                   <label>Name:</label>
                                   <input type="text" class="form-control" readonly value="{{ user()->name }}">
                               </div>
                               <div class="form-group">
                                   <label>Email:</label>
                                   <input type="text" readonly class="form-control" value="{{user()->email }}">
                               </div>
    
                               <div id="changePassword">
                                   <div class="form-group mt-5">
                                    <p class="text-muted mb-1">Leave the password field blank to maintain password</p>
                                       <label>Current Password:</label>
                                     <input type="password" class="form-control" name="current-password" >
                                   </div>
                                   <div class="form-group">
                                    <label>New Password:</label>
                                    <input type="password" class="form-control" name="password" >
                                </div>
                                <div class="form-group">
                                    <label>Confirm New Password:</label>
                                    <input type="password" class="form-control" name="password_confirmation" >
                                </div>
                               </div>

                               <div class="row justify-content-end">
                               
                                <div class="col-6">
                                  @if (user()->photo)
                                      <img src="{{asset(user()->photo)}}" alt="{{asset(user()->full_name)}}" style="width: 50px;">
                                  @endif
                                </div>

                                <div class="col-6">
                                  <div class="form-group">
                                    <label>Profile Picture:</label>
                                    <input type="file" class="form-control" name="photo" >
                                  </div>
                                </div>
                               </div>
                             

                               <div class="form-group mb-0 row">
                                   <div class="col-12 mt-2">
                                       <button class="btn btn-primary waves-effect waves-light" type="submit">Save Changes <i class="fas fa-sign-in-alt ml-1"></i></button>
                                   </div>
                               </div>
                           </div>
                          </div>
                        </form>
  
                      </div>
                    </div>
                  </div>
                </div>
            </div> <!-- end .h-100-->
        </div> <!-- end col -->
    </div>

@endsection
@section("js")
 
@endsection
