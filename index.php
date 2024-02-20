<!DOCTYPE html>
<html lang="en">
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>5 day weather forecast</title>
  <link rel="stylesheet" href="weather.css">
</head>
<body>
  <div class="container" style="text-align: center;">
    <h1>5 day weather forecast in Dhaka, Bangladesh</h1>
    <p >by Ragib Yasar Alam </p>
    <div id="weatherInfo" class="grid-container">
      <?php
      getWeather();
      ?>
    </div>
  </div>
</body>
</html>

<?php
function getWeather() {
  $locationKey = '28143'; // Location code for Dhaka
  $apiKey = 'e6WqADCvrnxHiReEq1puTo9b1nVZYMTZ';
  $apiUrl = "http://dataservice.accuweather.com/forecasts/v1/daily/5day/$locationKey?apikey=$apiKey&metric=true";

  $response = file_get_contents($apiUrl);
  $data = json_decode($response, true);

  if (!empty($data) && !isset($data['Code'])) {
    foreach ($data['DailyForecasts'] as $forecast) {
      $date = date('d-M-Y', strtotime($forecast['Date']));
      $dayName = date('l', strtotime($date));
      echo '<div class="forecast-box">';
      echo '<h1 >' . $dayName . '</h1>';
      echo '<h1 class="day-title">' . $date . '</h1>';
      echo '<div class="forecast-items">';
      echo '<p>' . $forecast['Temperature']['Minimum']['Value'] . ' - ' . $forecast['Temperature']['Maximum']['Value'] . ' °C</p>';
      echo '<p>' . $forecast['Day']['IconPhrase'] . '</p>';
      echo '</div></div>';
    }
  } else {
    echo '<p>Error fetching weather data</p>';
  }
}
?>
