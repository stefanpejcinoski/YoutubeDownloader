<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>YtDownloader</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="http://code.jquery.com/jquery-3.3.1.min.js"
                integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                crossorigin="anonymous">
        </script>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
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

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        <script>
            jQuery(document).ready(function(){

                jQuery('#submit').click(function(e){
                    jQuery(document).append('<div class=\"spinner-border text-dark\"></div>');
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    jQuery.ajax({
                        url: "{{ url('/download') }}",
                        method: 'post',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "vid_url": jQuery('#url').val()
                        },
                        timeoutSeconds:5,
                        dataType:JSON,
                        success: function(data){
                            jQuery(".spinner-border").remove();



                            $(document).append(
                                  '<div class="row"> <div class="col xs"><img src=data.thumbnail_url height=data.thumbnail_height width=data.thumbnail_width> </div><div class="row"> </div> </div>'
                            );
                        },
                        error: function (){
                            jQuery(".spinner-border").remove();
                            jQuery(document).append('<div class="container"><h3> Cannot get video data </h3></div>');

                        }    });
                });
            });
        </script>
    </head>
    <body>

       <div class="content">
           <h1 class="title">Youtube video downloader</h1>
           <div class="m-b-md">
               <input id="url" class="text-center" style="width: 75vh;" type="text" id="vlink" placeholder="Paste video link here">
           </div>
           <div class="m-b-md">
               <button type="button" id="submit" class="btn btn-dark">Process video</button>
           </div>
       </div>

    </body>
</html>
