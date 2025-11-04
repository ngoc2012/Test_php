<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weather for {$city|escape}</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
    <h1>Weather for {$city|escape}</h1>

    <p>Temperature: {$weather.temperature} °C</p>
    <p>Humidity: {$weather.humidity}%</p>

    {if !empty($history)}
    <h2>Last Weather Records for {$city|escape}</h2>
        <ul>
        {foreach from=$history item=record}
            <li>
                {$record.date} {$record.time} - {$record.temperature} °C - {$record.humidity}%
            </li>
        {/foreach}
        </ul>
    {/if}
    <a href="index.php">Return to home</a>
</body>
</html>
