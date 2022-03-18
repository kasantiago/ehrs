<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>{{env('PROJECT_DESCRIPTION') }}</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('DOH.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="{{ asset('admin-assets/css/googleapis.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin-assets/css/fonts.googleapis.css') }}" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('admin-assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('admin-assets/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('admin-assets/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet">
</head>

<body class="login-page bg-light-green">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">
                <img src="{{ asset('e-logo.png')}}" alt="e-logo" height="30" width="100">
            </a>
            <small><b>{{env('PROJECT_DESCRIPTION') }}</b></small>
        </div>
        <div class="card">
            <div class="body">
             



                    <div class="container">

                      <h1 id="ipa"></h1>
                      <h1 id="lat"></h1>
                      <h1 id="lng"></h1>

                    <!--   <form id="geocoding_form" class="form-horizontal">
                        <div class="form-group">
                          <div class="col-xs-12 col-md-6 col-md-offset-3">
                            <button type="button" class="find-me btn btn-info btn-block">Find My Location</button>
                          </div>
                        </div>
                      </form>

                      <p class="no-browser-support">Sorry, the Geolocation API isn't supported in Your browser.</p>
                      <p class="coordinates">Latitude: <b class="latitude">42</b> Longitude: <b class="longitude">32</b></p>

                      <div class="map-overlay">
                        <div id="map"></div>
                      </div>

                    </div>





                      <button id="find_btn">Find Me</button>
                      <div id="result"></div>
 -->




                        <button id="find_btn">Find Me</button>
                        <div id="result"></div>


            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('admin-assets/plugins/node-waves/waves.js') }}"></script>

    <!-- Validation Plugin Js -->
    <script src="{{ asset('admin-assets/plugins/jquery-validation/jquery.validate.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('admin-assets/js/admin.js') }}"></script>
    <script src="{{ asset('admin-assets/js/pages/examples/sign-in.js') }}"></script>



    <script type="text/javascript">

           




       $.getJSON('https://api.ipify.org?format=jsonp&callback=?', function(data) {
        console.log(data);
          console.log(JSON.stringify(data.ip, null, 2));

            $.get("http://api.ipstack.com/"+data.ip+"?access_key=3406095c6d3b7e083f34ca36ad266dc0", function (response) {
                  console.log(response);
                $('#ipa').html(data.ip);
                $('#lat').html(response.latitude);
                $('#lng').html(response.longitude);

             }, "jsonp");
        });

      


        var findMeButton = $('.find-me');

            // Check if the browser has support for the Geolocation API
            if (!navigator.geolocation) {

              findMeButton.addClass("disabled");
              $('.no-browser-support').addClass("visible");

            } else {

              findMeButton.on('click', function(e) {

                e.preventDefault();

                navigator.geolocation.getCurrentPosition(function(position) {

                  // Get the coordinates of the current possition.
                  var lat = position.coords.latitude;
                  var lng = position.coords.longitude;

                  $('.latitude').text(lat.toFixed(3));
                  $('.longitude').text(lng.toFixed(3));
                  $('.coordinates').addClass('visible');

                  // Create a new map and place a marker at the device location.
                  // var map = new GMaps({
                  //   el: '#map',
                  //   lat: lat,
                  //   lng: lng
                  // });

                  // map.addMarker({
                  //   lat: lat,
                  //   lng: lng
                  // });

                });

              });

            }





    $("#find_btn").click(function () { //user clicks button
        if ("geolocation" in navigator){ //check geolocation available 
            //try to get user current location using getCurrentPosition() method
            navigator.geolocation.getCurrentPosition(function(position){ 
                    $("#result").html("Found your location <br />Lat : "+position.coords.latitude+" </br>Lang :"+ position.coords.longitude);
                });
        }else{
            console.log("Browser doesn't support geolocation!");
        }
    });

    </script>


    <script type="text/javascript">
        
    </script>



</body>

</html>