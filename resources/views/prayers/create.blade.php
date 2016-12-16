<div>
    <form class="form" id="newPrayer" action="/prayer" method="POST">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group">
                <div class="input-group prayerText">
                	<textarea class="form-control" name="prayerText" id="prayerText" rows="2" placeholder="New Prayer" required="required" style="border-color: #5CACEE;"></textarea>
                    <span class="input-group-addon btn btn-danger" id="newPrayerVoice"><img src="{{ asset('images/icons/microphone-icon.png') }}" width="24" /></span>
                </div>
            </div>
            <div class="form-inline text-right">
            	<div class="form-group">
	                <select class="form-control" name="privacy" id="privacy" style="margin-right: 5px;" required="required">
	                	<option value="" disabled selected>Select Privacy Level</option>
	                	@foreach ($privacysettings as $privacysetting)
							<option value="{{ $privacysetting->id }}">{{ $privacysetting->name }}</option>
						@endforeach
					</select>
                </div>
                <button type="submit" id="newPrayerSubmit" class="btn btn-info btn-md">
                	<img src="{{ asset('images/social-prayer-logo.png') }}" height="20px" />
                	<span class="new-prayer-submit-text">Submit Prayer</span>
                </button>
            </div>
            {{ csrf_field() }}
        </div>
    </div>
    </form>
</div>
