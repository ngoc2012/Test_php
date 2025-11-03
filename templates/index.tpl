<html>
<head>
    <title>City List</title>
</head>
<body>
    <h1>All Cities</h1>
    <ul>
    {foreach from=$cities item=city}
        <li>
            <form method="post" action="city_weather.php" style="display:inline">
                <input type="hidden" name="city_name" value="{$city.city_name|escape}">
                <button type="submit">{$city.city_name|escape}</button>
            </form>
        </li>
    {/foreach}
    </ul>
</body>
</html>
