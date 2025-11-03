<html>
<head><title>City List</title></head>
<body>
    <h1>All Cities</h1>
    <ul>
    {foreach from=$cities item=city}
        <li>{$city.city_name|escape}</li>
    {/foreach}
    </ul>
</body>
</html>
