@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
          @yield('rightcontent')
        </div>
      </div>
    </div>
@endsection
