@extends('layouts.admin')


@section('content')

<div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Properties</h5>
              
              <p class="card-text">number of properties: {{$propsCount}}</p>
             
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Home types</h5>
              
              <p class="card-text">number of home types: {{$modelsCount}}</p>
              
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Admins</h5>
              
              <p class="card-text">number of admins: {{ $adminsCount }}</p>
              
            </div>
          </div>
        </div>
      </div>

@endsection