<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
			<section class="prayers-section col-centered">

			    @include('vendor/flash/message')
			    <div class="prayers">
			        @foreach ($prayers as $prayer)
			            @include('prayers/prayer')
			        @endforeach
			    </div>
			</section>
		</div>
	</div>
</div>

@include('javascript/prayers/list')
