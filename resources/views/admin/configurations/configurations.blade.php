
@extends('layouts.admin.app')
@section('title') Configurations @endsection
@section('page-title') Configurations @endsection
@section('content')

    <div class="row">
        <div class="add-listing-headline">
            <h3>Configurations</h3>
        </div>
        
      <div class="card w-100">
        <div class="card-body">
            <h4 class="mt-0 header-title">Manage Configurations</h4>
            @include("amicrud::amicrud.shared.alert")
            <div id="form-id">
                @include("amicrud::amicrud.shared.form-input")      
            </div>
        </div>
      </div>

    </div>


@endsection

@section('js')
<script src="{{asset('assets/admin/js/amicrud/forms.js')}}"></script>
<script>
    $(function(){
    'use strict';
    $('.edit_btn').prop('disabled', false);
    });
</script>
@endsection