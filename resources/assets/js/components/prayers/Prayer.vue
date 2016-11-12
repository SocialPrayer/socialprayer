<template>
<div>
    <div v-for="prayer in prayerlist" class="panel panel-default prayer" :class="{ 'panel-success': (prayer.user.id === Auth.id), 'panel-info': (Friends.filter(function(f) { return f.pivot.friend_id == prayer.user.id || f.pivot.user_id == prayer.user.id })).length > 0 && prayer.user.id !== Auth.id }">
        <div class="panel-heading">
        	<div class="prayer-user" style="float: left; vertical-align: top; text-decoration: underline;">
                <span class="user-popover" 
                    data-toggle="popover"
                    data-html="true"
                    :title="'<b>' + prayer.user.name + '</b>'"
                    :data-content="'<span class=\'text-info\'>' + ((Friends.filter(function(f) { return f.pivot.friend_id == prayer.user.id || f.pivot.user_id == prayer.user.id })).length > 0 && prayer.user.id !== Auth.id ? 'Friends' : (prayer.user.id == Auth.id ? 'Me' : (prayer.user.id == 0 ? '' : '<button class=\'btn btn-primary addfriend\'  data-id=' + prayer.user.id + '>Add Friend</button>'))) + '</span>'"
                    style="cursor: pointer;">
                    {{ prayer.user.name }}
                </span>
        	</div>
        	<div class="pull-right" :title="prayer.created_at">
                {{ prayer.created_at | momentHuman }}
            </div>
        	<br />
        </div>
        <div class="panel-body">
            <div>
            	<div class="prayer-text pull-left">
                    {{ prayer.text }}
                </div>
                <div class="prayalongdiv pull-right">
                	<span class="prayedalongcount small" data-id="1">
                    	Tests
                	</span>
                    <div class="btn-group">
                        <a role="button" class="btn btn-default btn-md dropdown-toggle prayalong" data-toggle="dropdown" title="Pray Along" :data-id="prayer.id">
                            <img src="images/social-prayer-logo.png" height="20px" />
                            <span class="caret" style="margin-left: 5px;"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a href="javascript:;" class="prayNow" :data-id="prayer.id">
                                    Quick prayer now
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;" class="prayLater" :data-id="prayer.id">
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
                </div>
            </div>
        </div>
        <div class="panel-info">
       	</div>
    </div>
</div>
</template>

<script>
    import moment from 'moment/moment.js'
    export default {
        props: ['Auth','Friends'],
        data () {
            return {
                prayerlist: [],
            }
        },
        created: function () {
            this.fetchData()
        },
        filters: {
            momentHuman: function (date) {
                return moment(date).fromNow();
            },
            momentDate: function (date) {
                return moment(date).format('MMMM Do YYYY, h:mm a');
            }
        },
        methods: {
            fetchData: function () {
                this.$http.get('api/prayers').then(( response ) => {
                    this.prayerlist = response.data;
                    Vue.nextTick(function () {
                        $('[data-toggle="popover"]').popover({ trigger: "manual" , html: true, animation:false})
                            .on("click", function () {
                                var _this = this;
                                $(this).popover("show");
                                $(".popover").on("click", function () {
                                    setTimeout(function () {
                                        if (!$(".popover:hover").length) {
                                            $(_this).popover("hide");
                                        }
                                    }, 600);

                                });
                                $(".popover").on("mouseleave", function () {
                                    setTimeout(function () {
                                        if (!$(".popover:hover").length) {
                                            $(_this).popover("hide");
                                        }
                                    }, 600);
                                });
                                $(".container").on("mouseleave", function () {
                                    setTimeout(function () {
                                        if (!$(".popover:hover").length) {
                                            $(_this).popover("hide");
                                        }
                                    }, 600);
                                });
                            }).on("mouseleave", function () {
                                var _this = this;
                                setTimeout(function () {
                                    if (!$(".popover:hover").length) {
                                        $(_this).popover("hide");
                                    }
                                }, 600);
                        });
                        $(document).on("click", ".addfriend", function(){
                            var friend_id = $(this).data("id");
                            var $thisselector = $(this);
                            var popover = $(this).parents('.popover').siblings('.user-popover');
                            $.get('/user/addfriend/' + friend_id, function( data ) {
                                $thisselector.html('Friendship Requested');
                                popover.attr('data-content','Friendship Requested').data('bs.popover');
                                popover.$tip.addClass(popover.options.placement);
                            });
                        });
                        $('.prayNow').click(function(){
                            var prayer_id = $(this).data("id");
                            var $prayedAlongCount = $(this).parents('.prayalongdiv').children('.prayedalongcount');
                            // $(this).parents('.dropdown-menu').prev('.prayalong').addClass("disabled");
                            // $(this).parents('.dropdown-menu').prev('.prayalong').removeClass("btn-default");
                            // $(this).parents('.dropdown-menu').prev('.prayalong').addClass("btn-disabled");
                            $.get('/prayer/pray-along/' + prayer_id, function( data ) {
                                $prayedAlongCount.html(data);
                                var overlay = $('<div id="overlay" class="flex-center position-ref m-b-md full-height" style="text-align:center; font-size: 56px;">Amen!</div>');
                                overlay.appendTo('.prayers').delay(1000).fadeOut();
                            });
                        });
                        $('.prayLater').click(function(){
                            var prayer_id = $(this).data("id");
                            $(this).parent().addClass('disabled');
                            $.get('/prayer/pray-along/later/' + prayer_id, function() {

                                var currcount = parseInt($('.praylatercnt').html());
                                if(currcount==0){
                                    $('.praylaterlink').removeClass('hidden');
                                }
                                $('.praylatercnt').html(currcount+1);
                                var overlay = $('<div id="overlay" class="flex-center position-ref m-b-md full-height" style="text-align:center; font-size: 56px;">Prayer Added to<br />Prayer List for Later</div>');
                                overlay.appendTo('.prayers').delay(1000).fadeOut();
                            });
                        });
                    });
                }, (error) => {
                  console.log(error);
                });
            }
        }
    }
</script>