<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="SocialPrayer is a new online social network for prayer. Just prayer. Pray together online, either with friends, anonymously, or just for yourself and God.">

        <title>SocialPrayer</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link href="/css/app.css" rel="stylesheet">

        <link rel="apple-touch-icon" href="/images/apple-touch-icon-iphone-retina.png">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .half-height {
                height: 90vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;

            }

            .page2 {
                background-color: #b4b9c4;
            }

            .content {
                text-align: center;
            }
            .title {
                font-size: 84px;
            }

            .tagline {
                margin-top: -35px;
                margin-bottom: 75px;
                font-size: 20px;
            }



            .pageTurner {
                position: relative;
                top: -20px;
                height: 60px;
                font-size: 20px;
            }

            .mainSummary {
                position: relative;
                top: 75px;
                margin-bottom: 40px;
                font-size: 16px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 16px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .links2 > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 8px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }


            .m-b-md {
                margin-bottom: 30px;
            }

            .prayers {
                margin-top: -50px;
            }

            .fade_line{
                display:block;
                border:none;
                color:white;
                height:2px;
                background:black;
                background: -webkit-gradient(radial, 50% 50%, 0, 50% 50%, 500, from(#949494), to(#fff));
            }
            @media (max-width: 768px) {
                .title {
                    font-size: 50px;
                }
                .tagline {
                    margin-bottom: 40px;
                }
                .mainSummary {
                    top: 40px;
                    margin-bottom: 40px;
                }
                .half-height {
                    height: 100vh;
                }
                .pageTurner {
                    position: relative;
                    top: -20px;
                    height: 60px;
                    font-size: 20px;
                }
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref half-height">
           <!--  <div class="top-right links2">
                <a href="{{ url('/privacy-policy') }}">Privacy Policy</a>
                <a href="{{ url('/terms-and-conditions') }}">Terms and Conditions</a>
            </div> -->

            <div class="content">
                <div class="title m-b-md">
                    <img src="{{ asset('images/social-prayer-logo.png') }}" style="height: 75px;" />
                    SocialPrayer
                </div>
                <div class="tagline">
                    If we pray together, there is nothing we cannot accomplish
                </div>
                <div class="links">
                    <a href="{{ url('/login') }}">Login</a>
                    <a href="{{ url('/register') }}">Join Now</a>
                </div>
                <div class="row">
                <div class="well mainSummary col-xs-10 col-xs-offset-1 col-md-pull-1 col-md-12">
                    <p>SocialPrayer is a new online social network for prayer. <b>Just prayer.</b></p>
                    <p>Pray together online, either with friends, anonymously, or just for yourself and God.</p>
                </div>
            </div>
            </div>
        </div>
        <div class="position-ref page2">
            <div class="content">
            <img src="{{ asset('images/social-prayer-logo.png') }}" class="pageTurner" />
            <!-- <h4>Latest Prayers</h1> -->
            @include('prayers/guest')
               <!--  <img src="{{ asset('images/social-prayer-logo.png') }}" class="pageTurner" />
                <div class="row">
                    <div class="well col-xs-8 col-xs-offset-2 mainSummary">
                        <h3>SocialPrayer is a new online social network for prayer.</h3>
                        <h1>Just prayer</h1>
                    </div>
                </div> -->
            </div>
        </div>
    </body>
</html>
