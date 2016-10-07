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

            .full-height {
                height: 100vh;
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
                background-color: #8E8E8E;
            }

            .content {
                text-align: center;
            }
            .title {
                font-size: 84px;
            }

            .tagline {
                margin-top: -35px;
                margin-bottom: 100px;
                font-size: 20px;
            }

            @media (max-width: 768px) {
                .title {
                    font-size: 50px;
                }
            }

            .pageTurner {
                position: relative;
                top: -40px;
                height: 100px;
                font-size: 20px;
            }

            .mainSummary {
                position: relative;
                top: 50px;
                font-size: 20px;
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
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
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
                    <a href="{{ url('/register') }}">Register</a>
                </div>

            </div>
        </div>
        <!--
        <div class="position-ref full-height page2">
            <div class="content">
                <img src="{{ asset('images/social-prayer-logo.png') }}" class="pageTurner" />
                <div class="row">
                    <div class="well col-xs-8 col-xs-offset-2 mainSummary">
                        <h3>SocialPrayer is a new online social network for prayer.</h3>
                        <h1>Just prayer</h1>
                    </div>
                </div>
            </div>
        </div>
        -->
    </body>
</html>
