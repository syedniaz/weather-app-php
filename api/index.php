<?php
function fetchData($city, $lat, $lon){
    $url = "https://api.openweathermap.org/data/2.5/forecast?q=$city&units=metric&lat=$lat&lon=$lon&appid=35e5e4078db3c3c084586b5a1257dc19";
    $contents = file_get_contents($url);
    return json_decode($contents);
}

$city = $_GET['city'] ?? 'Dhaka';

$climate = fetchData($city, "", "");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Today!</title>
    <link rel="stylesheet" href="../css/style.css">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body class="text-white">
    <h4 class="text-center display-3 py-1">Weather Today</h4>
    <p class="text-center fs-6 fw-light fst-italic pb-1"><a class="text-white link-light link-underline-opacity-0 link-underline-opacity-100-hover" href="https://www.pexels.com/photo/island-during-golden-hour-and-upcoming-storm-1118873/">Background Image From Pexels</a></p>
    <div class="container py-1">
        <form action="" method="get">
            <input type="text" class="form-control" list="datalistOptions" id="city" name="city" placeholder="Type in your city" required>
            <datalist id="datalistOptions">
                <option value="Dhaka">
                <option value="Chittagong">
                <option value="New York">
                <option value="Kolkata">
                <option value="Delhi">
            </datalist>
            <button class="btn btn-outline-light my-3" type="submit">Search</button>
        </form>
    </div>

    <div class="container mb-2">
        <h3 class="display-4">
            <?php
                echo $climate->city->name . ", " . $climate->city->country;
            ?>
        </h3>
    </div>

    <div class="container mb-4">
      <div class="row-cols-1">
        <div class="card bg-transparent text-light border-white p-4">
          <h3 class="card-title fw-bold h3">Today's Weather</h3>
          <div class="row">
            <div class="col-6">
              <p class="card-text lead">Date: 
                <?php 
                  echo date("d M Y", $climate->list[0]->dt);
                ?>
              </p>
              <p class="card-text lead">Temperature : 
                <?php 
                  echo number_format($climate->list[0]->main->temp, 1);
                ?> °C
              </p>
              <p>
                <?php
                  echo ucwords($climate->list[0]->weather[0]->description);
                  echo '<img class="" src="http://openweathermap.org/img/wn/' . $climate->list[0]->weather[0]->icon . '@2x.png" style="height:10vh;" alt="weather-icon">';
                ?>
              </p>
            </div>
            <div class="col-6 text-end">
              <p class="card-text">Feels like: 
                <?php 
                  echo number_format($climate->list[0]->main->feels_like, 1);
                ?> °C
              </p>
              <p class="card-text">Min Temperature: 
                <?php 
                  echo number_format($climate->list[0]->main->temp_min, 1);
                ?> °C 
              </p>
              <p class="card-text">Max Temperature: 
                <?php 
                  echo number_format($climate->list[0]->main->temp_max, 1);
                ?> °C 
              </p>
              <p class="card-text">Wind Speed: 
                <?php 
                  $windSpeedKmh = $climate->list[0]->wind->speed * 3.6;
                  echo number_format($windSpeedKmh, 1);
                ?> km/h
              </p>
              <p class="card-text">Humidity: 
                <?php 
                  echo number_format($climate->list[0]->main->humidity, 1);
                ?> %
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container mb-4"><h3 class="display-6">Daily</h3></div>

    <div class="container">
      <div class="row row-cols-md-4 row-cols-2 g-3">
        <div class="col">
          <div class="card bg-transparent text-light border-white">
            <div class="card-body text-center">
              <p class="card-text">
                <?php 
                  echo date("d M Y", $climate->list[8]->dt);
                ?>
              </p>
              <p class="card-text display-6">
                <?php 
                  echo number_format($climate->list[8]->main->temp, 1);
                ?> °C
              </p>
              <p class="card-text">
                <?php
                  echo '<img class="" src="http://openweathermap.org/img/wn/' . $climate->list[8]->weather[0]->icon . '@2x.png" style="height:10vh;" alt="weather-icon">';
                ?>
              </p>
              <p class="card-text">
                <?php
                  echo ucwords($climate->list[8]->weather[0]->description);
                ?>
              </p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card bg-transparent text-light border-white">
            <div class="card-body text-center">
              <p class="card-text">
                <?php 
                  echo date("d M Y", $climate->list[16]->dt);
                ?>
              </p>
              <p class="card-text display-6">
                <?php 
                  echo number_format($climate->list[16]->main->temp, 1);
                ?> °C
              </p>
              <p class="card-text">
                <?php
                  echo '<img class="" src="http://openweathermap.org/img/wn/' . $climate->list[16]->weather[0]->icon . '@2x.png" style="height:10vh;" alt="weather-icon">';
                ?>
              </p>
              <p class="card-text">
                <?php
                  echo ucwords($climate->list[16]->weather[0]->description);
                ?>
              </p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card bg-transparent text-light border-white">
            <div class="card-body text-center">
              <p class="card-text">
                <?php 
                  echo date("d M Y", $climate->list[24]->dt);
                ?>
              </p>
              <p class="card-text display-6">
                <?php 
                  echo number_format($climate->list[24]->main->temp, 1);
                ?> °C
              </p>
              <p class="card-text">
                <?php
                  echo '<img class="" src="http://openweathermap.org/img/wn/' . $climate->list[24]->weather[0]->icon . '@2x.png" style="height:10vh;" alt="weather-icon">';
                ?>
              </p>
              <p class="card-text">
                <?php
                  echo ucwords($climate->list[24]->weather[0]->description);
                ?>
              </p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card bg-transparent text-light border-white">
            <div class="card-body text-center">
              <p class="card-text">
                <?php 
                  echo date("d M Y", $climate->list[32]->dt);
                ?>
              </p>
              <p class="card-text display-6">
                <?php 
                  echo number_format($climate->list[32]->main->temp, 1);
                ?> °C
              </p>
              <p class="card-text">
                <?php
                  echo '<img class="" src="http://openweathermap.org/img/wn/' . $climate->list[32]->weather[0]->icon . '@2x.png" style="height:10vh;" alt="weather-icon">';
                ?>
              </p>
              <p class="card-text">
                <?php
                  echo ucwords($climate->list[32]->weather[0]->description);
                ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    
</body>
</html>