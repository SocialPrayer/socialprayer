<?php if ($prayer->user->isFriend(Auth::id())) {$pannelclass = "panel-info";} elseif ($prayer->user->id == Auth::id()) {$pannelclass = "panel-me";} else { $pannelclass = "panel-default";}?>

    <div class="panel {{$pannelclass}} prayer">
        <div class="panel-heading">
        	<div class="prayer-user" style="float: left; vertical-align: top; text-decoration: underline;">
                @if ($prayer->user->isFriend(Auth::id()))
        		  <span class="user-popover" data-toggle="popover"
                     data-html="true"
                     title="<b>{{ $prayer->user->name }}</b>"
                     data-placement="top"
                     data-content="Friend of Yours!" style="cursor: pointer;">{{ $prayer->user->name }}</span>
                @elseif ($prayer->user->id == Auth::id())
                    <span class="user-popover" data-toggle="popover"
                     data-html="true"
                     title="<b>{{ $prayer->user->name }}</b>"
                     data-placement="top"
                     data-content="" style="cursor: pointer;">{{ $prayer->user->name }}</span>
                @elseif ($prayer->user->id == 0)
                    <span class="user-popover" data-toggle="popover"
                     data-html="true"
                     title="<b>{{ $prayer->user->name }}</b>"
                     data-placement="top"
                     data-content="" style="cursor: pointer;">{{ $prayer->user->name }}</span>
                @else
                    <span class="user-popover" data-toggle="popover"
                     data-html="true"
                     title="<b>{{ $prayer->user->name }}</b>"
                     data-placement="top"
                     data-content="<button class='btn btn-primary addfriend' data-id='{{ $prayer->user->id }}'>Add Friend</button>" style="cursor: pointer;">{{ $prayer->user->name }}</span>
                @endif
        	</div>
        	<div style="float: right;" class="prayer-time text-muted" title="{{ $prayer->created_at->format('M j, y g:i A') }}">
                {{ $prayer->created_at->diffForHumans() }}
            </div>
        	<br />
        </div>
        <div class="panel-body">
        	<div class="prayer-text" style="float: left;">
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