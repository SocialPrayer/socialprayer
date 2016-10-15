@extends('layouts.app')

@section('content')
	<section class="prayers-section col-centered">

        @include('vendor/flash/message')
        @if (Auth::check())
            @include('prayers/create')
        @endif
        <div class="prayers">
            @foreach ($prayers as $prayer)
                @include('prayers/prayer')
            @endforeach
        </div>
    </section>
@endsection

@section('footer')
@include('javascript/prayers/list')
@endsection