<template>
    <div class="panel panel-default prayer">
        <div class="panel-heading">
        	<div class="prayer-user" style="float: left; vertical-align: top; text-decoration: underline;">
                Anonymous
        	</div>
        	<div class="pull-right" title="">
                
            </div>
        	<br />
        </div>
        <div class="panel-body">
            <div>
            	<div class="prayer-text pull-left">
                	{{ prayer_text }}
                </div>
                <div class="prayalongdiv pull-right">
                	<span class="prayedalongcount small" data-id="1">
                    	Tests
                	</span>
                    <a role="button" class="btn btn-default btn-md prayNow" data-toggle="dropdown" title="Pray Along" data-id="1">
                        <img src="images/social-prayer-logo.png" height="20px" />
                    </a>
                </div>
            </div>
        </div>
        <div class="panel-info">
       	</div>
    </div>
</template>

<script>
    export default {
        data() {
            return { prayer_text: 'testing' };
        }
    }
</script>