<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="http://example.com/favicon.png">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
            integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
        </script>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html,
            body {
                background-color: rgba(55, 51, 88, 0.5);
                color: #ffffff;

                font-weight: 200;
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




            .links>a {
                color: #eff4f7;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .footer {
                position: fixed;
                left: 0;
                bottom: 0;
                width: 100%;
                /* background-color: red; */
                color: white;
                text-align: center;
            }

        </style>
        <title>SITEMANAGEER</title>
    </head>
    <body onload="typeWriter()">
        <div class="fixed-top" style="background-color: #424b50;text-align:center">Please Note: Sending Emails
            Functionallity is turned
            off. For Queries <a href="mailto:samkitbhai@gmail.com"
                style="color:rgb(228, 212, 250);text-decoration:underline">Contact
                Us</a></div>
        <div class="flex-center position-ref full-height">


            <div class="container" style="padding-left: 15%">

                <div>
                    <h1 id="name" style="padding:0px;margin:0px;font-family:Comic Sans MS, cursive, sans-serif">
                    </h1>
                    <p style="font-size: 25px"> Save your links and Get it Whenever you wish to browse</p>
                    <ul class="list-group">
                        <li>Register yourself and Login</li>
                        <li>Add the links that you wish to save.</li>
                        <li>And you are done your links will be saved</li>
                        <li>Search it whenever you wish to browse</li>

                    </ul>
                </div>
                @if(Route::has('login'))
                    <div class="top-right links">
                        @auth
                            <a class="btn btn-outline-dark " href="{{ url('/home') }}">Home</a>
                        @else
                            <a class="btn btn-outline-dark " href="{{ route('login') }}">Login</a>

                            @if(Route::has('register'))
                                <a class="btn btn-outline-dark"
                                    href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif

            </div>

        </div>
        <div class="footer">
            <p>Developed By <a href="https://www.linkedin.com/in/samkithshah" target="_blank"
                    style="color: black;font-weight:550">Samkit Shah</a></p>
        </div>

        <script>
            var i = 0;
            var txt = 'MY SITE MANAGER';
            var speed = 80;

            function typeWriter() {
                if (i < txt.length) {
                    document.getElementById("name").innerHTML += txt.charAt(i);
                    i++;
                    setTimeout(typeWriter, speed);
                }
            }

        </script>
    </body>
</html>
