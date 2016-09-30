@extends('layouts.app')

@section('content')
	<section class="prayers-section col-centered">
        @if (session()->has('flash_notification.message'))
            <div class="alert alert-{{ session('flash_notification.level') }}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                {!! session('flash_notification.message') !!}
            </div>
        @endif
        <div>
            <form class="form" action="/prayer" method="POST">
            <div class="panel panel-default">
                <div class="panel-body">
	                <div class="form-group prayerText">
	                	<textarea class="form-control" name="prayerText" rows="2" placeholder="New Prayer" required="required" style="border-color: #5CACEE;"></textarea>
	                </div>
	                <div class="form-inline text-right">
	                	<div class="form-group">
			                <select class="form-control" name="privacy" style="margin-right: 5px;" required="required">
			                	<option value="" disabled selected>Select Privacy Level</option>
			                	@foreach ($privacysettings as $privacysetting)
									<option value="{{ $privacysetting->id }}">{{ $privacysetting->name }}</option>
								@endforeach
							</select>
                        </div>
		                <button type="submit" class="btn btn-info btn-md">
		                	<img src="{{ asset('images/social-prayer-logo.png') }}" height="20px" />
		                	Submit Prayer
		                </a>
	                </div>
	                {{ csrf_field() }}
	            </div>
	        </div>
            </form>
        </div>
        <div class="prayers">
            @foreach ($prayers as $prayer)
                <?php if ($prayer->user->isFriend(Auth::id())) {$pannelclass = "panel-success";} elseif ($prayer->user->id == Auth::id()) {$pannelclass = "panel-info";} else { $pannelclass = "panel-default";}?>

                <div class="panel {{$pannelclass}} prayer">
                    <div class="panel-heading">
                    	<div class="h5" style="float: left; vertical-align: middle;">
                    		<span class="text-muted">Prayer From: </span>
                            @if ($prayer->user->isFriend(Auth::id()))
                    		  <span data-toggle="popover"
                                 data-html="true"
                                 title="<b>{{ $prayer->user->name }}</b>"
                                 data-placement="top"
                                 data-content="Friend of Yours!" style="border-bottom: 1px dashed #BDBDBD; cursor: pointer;">{{ $prayer->user->name }}</span>
                            @elseif ($prayer->user->id == Auth::id())
                                <span data-toggle="popover"
                                 data-html="true"
                                 title="<b>{{ $prayer->user->name }}</b>"
                                 data-placement="top"
                                 data-content="" style="border-bottom: 1px dashed #BDBDBD; cursor: pointer;">{{ $prayer->user->name }}</span>
                            @else
                                <span data-toggle="popover"
                                 data-html="true"
                                 title="<b>{{ $prayer->user->name }}</b>"
                                 data-placement="top"
                                 data-content="<button class='btn btn-primary addfriend' data-id='{{ $prayer->user->id }}'>Add Friend</button>" style="border-bottom: 1px dashed #BDBDBD; cursor: pointer;">{{ $prayer->user->name }}</span>
                            @endif
                    	</div>
                    	<div style="float: right;" class="text-muted h6">{{ $prayer->created_at->format('M j, y g:i A') }}</div>
                    	<br />
                    </div>
                    <div class="panel-body">
                    	<div style="float: left;">
                        	{{ $prayer->text }}
                        </div>
                        <div style="float: right;">
                        	<span class="prayedalongcount small" data-id="{{ $prayer->id }}">
                        	@php ($buttonclass = "btn-default")
                        	@foreach ($prayer->prayalong as $prayalong)
                        		@if ($prayalong->user_id == Auth::id() )
                        			@php ($buttonclass = "btn-info disabled")
                        			You
                        		@endif
                        	@endforeach

                        	@if (count($prayer->prayalong) == 1)
                        		@if ($buttonclass == "btn-info disabled")
                        			prayed along
                        		@else
                        			{{ count($prayer->prayalong) }} person prayed along
                        		@endif
                        	@elseif (count($prayer->prayalong) == 2)
                        		@if ($buttonclass == "btn-info disabled")
                        			and
                        			{{ count($prayer->prayalong)-1 }} person prayed along
                        		@else
                        			{{ count($prayer->prayalong) }} people prayed along
                        		@endif
                        	@elseif (count($prayer->prayalong) > 2)
                        		@if ($buttonclass == "btn-info disabled")
                        			and
                        			{{ count($prayer->prayalong)-1 }} people prayed along
                        		@else
                        			{{ count($prayer->prayalong) }} people prayed along
                        		@endif
                        	@endif
                        	</span>
    	                    <a href="#" role="button" class="btn {{ $buttonclass }} btn-md prayalong" data-toggle="tooltip" data-placement="bottom" title="Pray Along" data-id="{{ $prayer->id }}">
    		                	<img src="{{ asset('images/social-prayer-logo.png') }}" height="20px" />
    		                </a>
    		            </div>
                    </div>
                    <div class="panel-info">
                   	</div>
                </div>
            @endforeach
        </div>
        {{$prayers->links()}}
    </section>
@endsection

@section('footer')
<script src="/js/vendor/jquery.ns-autogrow.js"></script>
<!-- <script src="/js/vendor/bootstrap/tooltip.js"></script>
<script src="/js/vendor/bootstrap/popover.js"></script> -->
<script src="/js/vendor/jquery.jscroll.min.js"></script>
<script>
$(function(){
    $('[data-toggle="popover"]').popover({ trigger: "manual" , html: true, animation:false})
        .on("click", function () {
            var _this = this;
            $(this).popover("show");
            $(".popover").on("click", function () {
                $(_this).popover('hide');
            });
            $(".popover").on("mouseleave", function () {
                $(_this).popover('hide');
            });
            $(".container").on("mouseleave", function () {
                $(_this).popover('hide');
            });
        }).on("mouseleave", function () {
            var _this = this;
            setTimeout(function () {
                if (!$(".popover:hover").length) {
                    $(_this).popover("hide");
                }
            }, 300);
    });
	$('[data-toggle="tooltip"]').tooltip();
	$('.prayerText textarea').autogrow({vertical: true, horizontal: false});
    //hides the default paginator
    $('ul.pagination:visible:first').hide();

    //init jscroll and tell it a few key configuration details
    //nextSelector - this will look for the automatically created
    //contentSelector - this is the element wrapper which is cloned and appended with new paginated data
    $('.prayers-section').jscroll({
        debug: true,
        autoTrigger: true,
        loadingHtml: '<div style="text-align: center;"><img src="/images/loading.gif" alt="Loading" height="75px" /></div>',
        nextSelector: '.pagination li.active + li a',
        contentSelector: '.prayers',
        callback: function() {

            //again hide the paginator from view
            $('ul.pagination:visible:first').hide();

        }
    });

    window.setTimeout(function() {
      $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
      });
    }, 1500);

    $('.prayalong').click(function(){
        var prayer_id = $(this).data("id");
        var $thisselector = $(this);
        $(this).addClass("disabled");
        $(this).removeClass("btn-default");
        $(this).addClass("btn-info");
        $.get('/prayer/pray-along/' + prayer_id, function( data ) {
            $thisselector.prev('.prayedalongcount').html(data);
        });
    });

    $(document).on("click", ".addfriend", function(){
        var friend_id = $(this).data("id");
        var $thisselector = $(this);
        $(this).addClass("disabled");
        $.get('/user/addfriend/' + friend_id, function( data ) {
            $thisselector.html('Friendship Requested');
        });
    });
});

</script>
@endsection