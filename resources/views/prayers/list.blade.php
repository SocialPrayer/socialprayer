@extends('layouts.app')

@section('content')
	<section class="prayers-section col-centered">

        @include('vendor/flash/message')
        @include('prayers/create')
        <div class="prayers">
            @foreach ($prayers as $prayer)
                @include('prayers/prayer')
            @endforeach
        </div>
        {{$prayers->links()}}
    </section>
@endsection

@section('footer')
@include('javascript/prayers/list')
@endsection