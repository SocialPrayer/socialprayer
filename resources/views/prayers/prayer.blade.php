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
                <div class="prayalongdiv pull-right">
                	<span class="prayedalongcount small" data-id="{{ $prayer->id }}">
                    @var ($youPrayed = 0)
                	@foreach ($prayer->prayedalong as $prayedalong) 
                		@if ($prayedalong->user_id == Auth::id() and $youPrayed == 0)
                			You
                            @var ($youPrayed = 1)
                		@endif
                	@endforeach
                	@if (count($prayer->prayedalong) == 1)
                		@if ($prayedalong->user_id == Auth::id() )
                			prayed along
                		@else
                			{{ count($prayer->prayedalong) }} person prayed along
                		@endif
                	@elseif (count($prayer->prayedalong) == 2)
                		@if ($prayedalong->user_id == Auth::id() )
                			and
                			{{ count($prayer->prayedalong)-1 }} person prayed along
                		@else
                			{{ count($prayer->prayedalong) }} people prayed along
                		@endif
                	@elseif (count($prayer->prayedalong) > 2)
                		@if ($prayedalong->user_id == Auth::id() )
                			and
                			{{ count($prayer->prayedalong)-1 }} people prayed along
                		@else
                			{{ count($prayer->prayedalong) }} people prayed along
                		@endif
                	@endif
                	</span>
                    @if(Auth::check())
                        @if (isset($titleHeader) and $titleHeader=='Saved Prayers For Later')
                        <a role="button" class="btn btn-default btn-md prayNow" data-toggle="dropdown" title="Pray Along" data-id="{{ $prayer->id }}">
                            <img src="{{ asset('images/social-prayer-logo.png') }}" height="20px" />
                        </a>
                        @else
                        <div class="btn-group">
                            <a role="button" class="btn btn-default btn-md dropdown-toggle prayalong" data-toggle="dropdown" title="Pray Along" data-id="{{ $prayer->id }}">
                            	<img src="{{ asset('images/social-prayer-logo.png') }}" height="20px" />
                                <span class="caret" style="margin-left: 5px;"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a href="javascript:;" class="prayNow" data-id="{{ $prayer->id }}">
                                        Quick prayer now
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;" class="prayLater" data-id="{{ $prayer->id }}">
                                        Remind me to pray later
                                    </a>
                                </li>
                                <!--
                                <li>
                                    <a href="#" class="prayResponse">
                                        Write a prayer response
                                    </a>
                                </li>
                                -->
                            </ul>
                        </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="panel-info">
       	</div>
    </div>