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

    $('#newPrayer').on('submit',function(e){
        $.ajaxSetup({
            header:$('meta[name="_token"]').attr('content')
        })
        e.preventDefault(e);
        $('#newPrayerSubmit').prop('disabled','disabled');

        $('.new-prayer-submit-text').html('Submitting Prayer...');
        var prayerText = $('#prayerText').val();
        $.post("/prayer", $(this).serialize(),  function(response) {
            //$('#success').html(response);
            //$('#success').hide('slow');
            var newPrayerDiv = $( ".prayer" ).first().clone();
            newPrayerDiv.removeClass('panel-info');
            newPrayerDiv.removeClass('panel-default');
            newPrayerDiv.addClass('panel-success');
            newPrayerDiv.find('.prayalong').data("id", 1);
            newPrayerDiv.find('.prayalong').removeClass("btn-info");
            newPrayerDiv.find('.prayalong').addClass("btn-default");
            newPrayerDiv.find('.prayalong').removeClass("disabled");
            newPrayerDiv.find('.prayer-user').html('<span data-toggle="popover" data-html="true" title="<b>{{ Auth::user()->name }}</b>" data-placement="top" data-content="" style="cursor: pointer;">{{ Auth::user()->name }}</span>');
            newPrayerDiv.find('.prayer-time').html('Now');
            newPrayerDiv.find('.prayer-text').html(prayerText);
            newPrayerDiv.prependTo(".prayers").hide().fadeIn('slow').slideDown('slow');
            $('#newPrayer')[0].reset();
            $('#newPrayerSubmit').prop('disabled','');
            $('.new-prayer-submit-text').html('Submit Prayer');

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
        });

        // $.ajax({

        //     type:"POST",
        //     url:'/prayer',
        //     data:$(this).serialize(),
        //     dataType: 'json',
        //     success: function(data){
        //         $('#newPrayer')[0].reset();
        //     },
        //     error: function(data){

        //     }
        // });
    });

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

        }
    });

    window.setTimeout(function() {
      $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
      });
    }, 1500);

});

</script>