<?php

    $weather = "";
    $error = "";

    if($_GET['city']){

        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        https://api.openweathermap.org/data/2.5/weather?lat=35&lon=139&appid=bfcd1adf0a4360955d4aa4cb35b560d5
        $urlContents = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city']).",139&appid=bfcd1adf0a4360955d4aa4cb35b560d5" , false, stream_context_create($arrContextOptions));

        $weatherArray = json_decode($urlContents, true);

        if($weatherArray['cod'] == 200) {

        $weather = "The weather in ".$_GET['city']." is currently '".$weatherArray['weather'][0]['description']."'. ";

        $tempInCelcius = intval($weatherArray['main']['temp'] - 273);

        $weather .= "The temperature is ".$tempInCelcius."&deg;c and the wind speed is ".$weatherArray['wind']['speed'].".";
     
        } else{

            $error = "Could not find city - please try again.";
        }

    }

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Weather Scraper</title>

    <style type="text/css">

        html {
            background: url(background.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        body{
            background: none;
        }

        .container{

            text-align: center;
            margin-top: 200px;
            width: 500px;
        }

        input{
            margin: 20px 0;
        }

        #weather{
            margin-top:15px;
        }

    </style>
  </head>
  <body>
        
        <div class="container">

            <h1>What's The Weather?</h1>

            <form>

                <fieldset class="form-group">

                    <label for="city">Enter The name of a city.</lable>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Eg. Mumbai, Pune" value = "<?php echo $_GET['city']; ?>">

                </fieldset>

                <button type="submit" class="btn btn-primary">Submit</button>

            </form>

            <div id="weather">

                <?php
                if ($weather) {

                    echo '<div class="alert-success" role="alert">'.$weather.'</div>';
                }
                else if ($error) {

                    echo '<div class="alert-danger" role="alert">'.$error.'</div>';
                }
                ?>
            </div>

        </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>