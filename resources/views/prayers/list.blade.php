@extends('layouts.app')

@section('content')
	<section id="prayersSection" class="prayers-section col-centered">

        @include('vendor/flash/message')
        @if (Auth::check() and $createPrayer)
            @include('prayers/create')
        @endif
        @if (isset($titleHeader))
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <h3>{{ $titleHeader }}</h3>
                </div>
            </div>
        @endif
        <prayers :Auth="{{ Auth::user() }}" :Friends="{{ Auth::user()->friends }}"></prayers>
    </section>
@endsection

@section('footer')
<script src="/js/vendor/jquery.ns-autogrow.js"></script>
@include('javascript/prayers/list')
@endsection