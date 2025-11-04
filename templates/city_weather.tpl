<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weather for {$city|escape}</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-sm p-4 mb-4">
        <h1 class="text-center mb-4">🌤️ Weather for {$city|escape}</h1>
        <p class="fs-5"><strong>Temperature:</strong> {$weather.temperature} °C</p>
        <p class="fs-5"><strong>Humidity:</strong> {$weather.humidity}%</p>
    </div>

    {if !empty($history)}
    <div class="card shadow-sm p-4">
        <h2 class="mb-3">Last Weather Records</h2>
        <ul class="list-group list-group-flush">
        {foreach from=$history item=record}
            <li class="list-group-item">
                <span class="text-muted">{$record.date} {$record.time}</span>
                <span class="ms-3">🌡️ {$record.temperature} °C</span>
                <span class="ms-3">💧 {$record.humidity}%</span>
            </li>
        {/foreach}
        </ul>
    </div>
    {/if}

    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-outline-secondary">← Return to Home</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
