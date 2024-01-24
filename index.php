<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // API endpoint URL
    $location = $_POST['location'];
    $api_key = '5e3de033140df25be08173aa435d5c27';
    $api_url = "https://api.openweathermap.org/data/2.5/weather?q=$location&appid=$api_key&units=metric";

    if ($jsonFile = file_get_contents($api_url)) {
        $data = json_decode($jsonFile);
    } else {
        error_reporting(0);
        ini_set('display_errors', 0);
        echo "error api call";
    }
} else {
    $location = 'Paris';
    $api_key = '5e3de033140df25be08173aa435d5c27';
    $api_url = "https://api.openweathermap.org/data/2.5/weather?q=$location&appid=$api_key&units=metric";

    $jsonFile = file_get_contents($api_url);
    $data = json_decode($jsonFile);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Use script tag for JavaScript files -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/style.css"> <!-- Remove double slash in the path -->
    <title>Meteo App</title>
</head>

<body>
    <div class="container-fluid px-1 px-sm-3 py-5 mx-auto">
        <div class="row d-flex justify-content-center">
            <h1>Weather App</h1>
            <div class="row card0">
                <div class="card1 col-lg-8 col-md-7 <?php if ($data->weather[0]->main == 'Snow') {
                                                        echo 'cardsnowy';
                                                    } elseif ($data->weather[0]->main == 'Rain') {
                                                        echo 'cardrainy';
                                                    } elseif ($data->weather[0]->main == 'Clouds') {
                                                        echo 'cardcloudy';
                                                    } else {
                                                        echo 'cardclear';
                                                    }
                                                    ?>">

                    <div class="d-flex justify-content-center">

                        <!--
                        <div>
                            <img class="image mt-5" src="https://i.ibb.co/2ssScsg/Plan-de-travail-5.png" alt="Weather Icon">
                        </div>
                        <div class="text-center">
                            <img class="image mt-5 " src="https://i.ibb.co/9ypcW7D/Plan-de-travail-5.png" alt=" Weather Icon">
                        </div> -->
                    </div>
                    <div class="row px-3 mt-5 mb-3">
                        <h1 class=" mr-3"><?php echo round($data->main->temp) ?>&#176;</h1>
                        <div class="d-flex flex-column mr-3">
                            <h2 class="mt-3 mb-0"><?php echo $data->name ?></h2>
                            <small><?php

                                    // Obtenez la date actuelle
                                    $dateActuelle = new DateTime();

                                    // Formatez la date selon le format 
                                    $dateFormatee = $dateActuelle->format('H:i - l, d M \'y');

                                    // Affichez la date formatée
                                    echo $dateFormatee;

                                    ?></small>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <h3 class=""><?php if ($data->weather[0]->main == 'Clear') {
                                                echo '<svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-sun" viewBox="0 0 16 16">
                                                    <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6m0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708"/>
                                                  </svg>';
                                            } elseif ($data->weather[0]->main == 'Clouds') {
                                                echo '<svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-clouds" viewBox="0 0 16 16">
                                <path d="M16 7.5a2.5 2.5 0 0 1-1.456 2.272 3.5 3.5 0 0 0-.65-.824 1.5 1.5 0 0 0-.789-2.896.5.5 0 0 1-.627-.421 3 3 0 0 0-5.22-1.625 5.6 5.6 0 0 0-1.276.088 4.002 4.002 0 0 1 7.392.91A2.5 2.5 0 0 1 16 7.5"/>
                                <path d="M7 5a4.5 4.5 0 0 1 4.473 4h.027a2.5 2.5 0 0 1 0 5H3a3 3 0 0 1-.247-5.99A4.5 4.5 0 0 1 7 5m3.5 4.5a3.5 3.5 0 0 0-6.89-.873.5.5 0 0 1-.51.375A2 2 0 1 0 3 13h8.5a1.5 1.5 0 1 0-.376-2.953.5.5 0 0 1-.624-.492z"/>
                              </svg>';
                                            } elseif ($data->weather[0]->main == 'Rain') {
                                                echo '<svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-cloud-drizzle" viewBox="0 0 16 16">
                                                    <path d="M4.158 12.025a.5.5 0 0 1 .316.633l-.5 1.5a.5.5 0 0 1-.948-.316l.5-1.5a.5.5 0 0 1 .632-.317m6 0a.5.5 0 0 1 .316.633l-.5 1.5a.5.5 0 0 1-.948-.316l.5-1.5a.5.5 0 0 1 .632-.317m-3.5 1.5a.5.5 0 0 1 .316.633l-.5 1.5a.5.5 0 0 1-.948-.316l.5-1.5a.5.5 0 0 1 .632-.317m6 0a.5.5 0 0 1 .316.633l-.5 1.5a.5.5 0 1 1-.948-.316l.5-1.5a.5.5 0 0 1 .632-.317m.747-8.498a5.001 5.001 0 0 0-9.499-1.004A3.5 3.5 0 1 0 3.5 11H13a3 3 0 0 0 .405-5.973M8.5 2a4 4 0 0 1 3.976 3.555.5.5 0 0 0 .5.445H13a2 2 0 0 1 0 4H3.5a2.5 2.5 0 1 1 .605-4.926.5.5 0 0 0 .596-.329A4 4 0 0 1 8.5 2"/>
                                                  </svg>';
                                            } elseif ($data->weather[0]->main == 'Snow') {
                                                echo '<svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-snow" viewBox="0 0 16 16">
                                                    <path d="M8 16a.5.5 0 0 1-.5-.5v-1.293l-.646.647a.5.5 0 0 1-.707-.708L7.5 12.793V8.866l-3.4 1.963-.496 1.85a.5.5 0 1 1-.966-.26l.237-.882-1.12.646a.5.5 0 0 1-.5-.866l1.12-.646-.884-.237a.5.5 0 1 1 .26-.966l1.848.495L7 8 3.6 6.037l-1.85.495a.5.5 0 0 1-.258-.966l.883-.237-1.12-.646a.5.5 0 1 1 .5-.866l1.12.646-.237-.883a.5.5 0 1 1 .966-.258l.495 1.849L7.5 7.134V3.207L6.147 1.854a.5.5 0 1 1 .707-.708l.646.647V.5a.5.5 0 1 1 1 0v1.293l.647-.647a.5.5 0 1 1 .707.708L8.5 3.207v3.927l3.4-1.963.496-1.85a.5.5 0 1 1 .966.26l-.236.882 1.12-.646a.5.5 0 0 1 .5.866l-1.12.646.883.237a.5.5 0 1 1-.26.966l-1.848-.495L9 8l3.4 1.963 1.849-.495a.5.5 0 0 1 .259.966l-.883.237 1.12.646a.5.5 0 0 1-.5.866l-1.12-.646.236.883a.5.5 0 1 1-.966.258l-.495-1.849-3.4-1.963v3.927l1.353 1.353a.5.5 0 0 1-.707.708l-.647-.647V15.5a.5.5 0 0 1-.5.5z"/>
                                                  </svg>';
                                            } else {
                                                echo '<svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-sun" viewBox="0 0 16 16">
                                                    <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6m0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708"/>
                                                  </svg>';
                                            }
                                            ?></h3>
                            <small><?php echo $data->weather[0]->main ?></small>
                        </div>
                    </div>
                </div>
                <div class="card2 col-lg-4 col-md-5">
                    <form action="" method="post">
                        <div class="row px-3">
                            <input type="text" name="location" placeholder="City name" class="mb-5" required>
                            <button type="submit" name="submit" class="fa fa-search mb-5 mr-0 text-center"></button>
                        </div>
                    </form>
                    <div class="mr-5">
                        <p>Weather Details</p>
                        <div class="row px-3">
                            <p class="light-text">Cloudy</p>
                            <p class="ml-auto"><?php echo $data->clouds->all ?>%</p>
                        </div>
                        <div class="row px-3">
                            <p class="light-text">Humidity</p>
                            <p class="ml-auto"><?php echo $data->main->humidity ?>%</p>
                        </div>
                        <div class="row px-3">
                            <p class="light-text">Wind</p>
                            <p class="ml-auto"><?php echo $data->wind->speed ?>km/h</p>
                        </div>
                        <div class="row px-3">
                            <p class="light-text">Pressure</p>
                            <p class="ml-auto"><?php echo $data->main->pressure ?>Pa</p>
                        </div>

                        <div class="line mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>