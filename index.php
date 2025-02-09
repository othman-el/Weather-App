<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather-App Morocco</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>WeatherAPP By Coding OTHMAN </h1>
    <form method="POST">
        <label for="city">CHOOSE A CITY</label>
        <select name="city" id="city">
            <option value="Tangier" <?php if(isset($_POST['city']) && isset($_POST['city']) == 'Tangier') echo 'selected'; ?>>Tangier</option>
            <option value="Casablanca" <?php if(isset($_POST['city']) && isset($_POST['city']) == 'Casablanca') echo 'selected'; ?>>Casablanca</option>
            <option value="Rabat" <?php if(isset($_POST['city']) && isset($_POST['city']) == 'Rabat') echo 'selected'; ?>>Rabat</option>
            <option value="Marrakesh" <?php if(isset($_POST['city']) && isset($_POST['city']) == 'Marrakesh') echo 'selected'; ?>>Marrakesh</option>
            <option value="Oujda" <?php if(isset($_POST['city']) && isset($_POST['city']) == 'Oujda') echo 'selected'; ?>>Oujda</option>
            <option value="Sale" <?php if(isset($_POST['city']) && isset($_POST['city']) == 'Sale') echo 'selected'; ?>>Sale</option>
            <option value="Khouribga" <?php if(isset($_POST['city']) && isset($_POST['city']) == 'Khouribga') echo 'selected'; ?>>Khouribga</option>
            <option value="Agadir" <?php if(isset($_POST['city']) && isset($_POST['city']) == 'Agadir') echo 'selected'; ?>>Agadir</option>
            <option value="Fes" <?php if(isset($_POST['city']) && isset($_POST['city']) == 'Fes') echo 'selected'; ?>>Fes</option>
            <option value="Tetouan" <?php if(isset($_POST['city']) && isset($_POST['city']) == 'Tetouan') echo 'selected'; ?>>Tetouan</option>
            <option value="EL jadida" <?php if(isset($_POST['city']) && isset($_POST['city']) == 'EL jadida') echo 'selected'; ?>>EL jadida</option>
        </select>
        <button type="submit" name="getWeather">SUBMIT</button>
    </form>
    <div id="result">
        <?php
        if (isset($_POST['getWeather'])) {
            $city = $_POST['city'];
            $apiKey = 'YOUR_API_KEY';
            $url = "https://api.openweathermap.org/data/2.5/weather?q=$city,MA&appid=$apiKey&units=metric";

            $request = curl_init();
            curl_setopt($request, CURLOPT_URL, $url);
            curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($request);
            curl_close($request);

            if ($response) {
                $data = json_decode($response, false);

                if (isset($data->main->temp)) {
                    $temp = $data->main->temp;
                    $description = $data->weather[0]->description;
                    $feels_like = $data->main->feels_like;

                    echo "<p>The temperature in $city is {$temp}°C with {$description} and feels like {$feels_like}°C.</p>";
                    If ($temp > 20) {
                        echo "<div class='sun-icon'>☀️</div>";
                    } else {
                    echo "<div class='sun-icon'>☁️</div>";
                    }
                }
                else { 
                    echo "There is something wrong while getting the data";
                }
            }
            else{
                    echo "There is something wrong with the API";
            }
         }
        ?>
    </div>

    <footer>
    <div class="container">
        <div class="info">
            <p class="label">Location</p>
            <p class="value">MOROCCO</p>
        </div>
        <div class="info">
            <p class="label">Local Time</p>
            <p class="value">
                <?php
                    date_default_timezone_set('Africa/Casablanca');
                    echo date("g:i A T");
                ?>
            </p>
        </div>
    </div>
    </footer>
</body>
</html>