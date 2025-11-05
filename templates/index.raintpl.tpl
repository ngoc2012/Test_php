<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weather</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container py-5">
    <h1 class="text-center mb-4">🌍 All Cities</h1>

    <div class="card bg-transparent text-light shadow-sm p-4 border-2">
        <ul class="list-group list-group-flush">
        {loop="cities"}
            <li class="list-group-item bg-dark text-light border-0 border-bottom border-secondary d-flex justify-content-between align-items-center">
                <span class="fw-semibold">{$value->getName()}</span>

                <div class="d-flex gap-2 ms-auto">
                    <form method="post" action="city_weather.php" class="m-0">
                        <input type="hidden" name="name" value="{$value->getName()}">
                        <input type="hidden" name="api" value="OpenWeatherApi">
                        <input type="hidden" name="id" value="{$value->getId()}">
                        <button type="submit" class="btn btn-outline-info btn-sm">Open Weather</button>
                    </form>

                    <form method="post" action="city_weather.php" class="m-0">
                        <input type="hidden" name="name" value="{$value->getName()}">
                        <input type="hidden" name="api" value="FreeWeatherApi">
                        <input type="hidden" name="id" value="{$value->getId()}">
                        <button type="submit" class="btn btn-outline-info btn-sm">Free Weather</button>
                    </form>
                </div>
            </li>
        {/loop}
        </ul>
    </div>

    <div class="text-center mt-4">
        <p class="text-muted">Select a city to view the latest weather 🌦️</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
