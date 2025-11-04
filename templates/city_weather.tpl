<!DOCTYPE html>
<html lang="en">
<head>
    <title>Weather for {$city_name|escape}</title>
</head>
<body>
    <h1>Weather for {$city_name|escape}</h1>

    {if isset($weather.main)}
        <p>Temperature: {$weather.main.temp} °C</p>
        <h2>Last Temperature Records for {$city_name}</h2>
            <ul>
            {foreach from=$history item=record}
                <li>
                    {$record.date} {$record.time} - {$record.temperature} °C
                </li>
            {/foreach}
            </ul>
    {else}
        <p>No weather data available.</p>
    {/if}

    <a href="index.php">Return to home</a>
</body>
</html>
