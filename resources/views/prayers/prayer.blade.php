<?php
if (Auth::check()) {
	if ($prayer->user->isFriend(Auth::id())) {
		$pannelclass = "panel-info";
	} elseif ($prayer->user->id == Auth::id()) {
		$pannelclass = "panel-success";
	} else {
		$pannelclass = "panel-default";
	}
} else {
	$pannelclass = "panel-default";
}
?>
    <div class="panel {{$pannelclass}} prayer">
        <div class="panel-heading">
        	<div class="prayer-user" style="float: left; vertical-align: top; text-decoration: underline;">
                @if (!Auth::check())
                    {{ $prayer->user->name }}
                @elseif ($prayer->user->isFriend(Auth::id()))
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
        	<div class="pull-right" title="{{ $prayer->created_at->format('M j, y g:i A') }}">
                {{ $prayer->created_at->diffForHumans() }}
            </div>
        	<br />
        </div>
        <div class="panel-body">
            <div>
            	<div class="prayer-text pull-left">
                	{{ $prayer->text }}
                </div>
                <div class="pull-right">
                	<span class="prayedalongcount small" data-id="{{ $prayer->id }}">
                	@php ($buttonclass = "btn-default")
                	@foreach ($prayer->prayedalong as $prayedalong)
                		@if ($prayedalong->user_id == Auth::id() )
                			@php ($buttonclass = "btn-disabled disabled")
                			You
                		@endif
                	@endforeach

                	@if (count($prayer->prayedalong) == 1)
                		@if ($buttonclass == "btn-disabled disabled")
                			prayed along
                		@else
                			{{ count($prayer->prayedalong) }} person prayed along
                		@endif
                	@elseif (count($prayer->prayedalong) == 2)
                		@if ($buttonclass == "btn-disabled disabled")
                			and
                			{{ count($prayer->prayedalong)-1 }} person prayed along
                		@else
                			{{ count($prayer->prayedalong) }} people prayed along
                		@endif
                	@elseif (count($prayer->prayedalong) > 2)
                		@if ($buttonclass == "btn-disabled disabled")
                			and
                			{{ count($prayer->prayedalong)-1 }} people prayed along
                		@else
                			{{ count($prayer->prayedalong) }} people prayed along
                		@endif
                	@endif
                	</span>
                    @if(Auth::check())
                        <div class="btn-group">
                            <a role="button" class="btn {{ $buttonclass }} btn-md dropdown-toggle prayalong" data-toggle="dropdown" data-placement="right" title="Pray Along" data-id="{{ $prayer->id }}">
                            	<img src="{{ asset('images/social-prayer-logo.png') }}" height="20px" />
                                <span class="caret" style="margin-left: 5px;"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="javascript:;" class="prayNow">
                                        Quick prayer now
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;" class="prayLater">
                                        Remind me to pray later
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="prayResponse">
                                        Write a prayer response
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="panel-info">
       	</div>
    </div>