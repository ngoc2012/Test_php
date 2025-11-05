<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weather for {$city|escape}</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container py-5">
    <div class="card bg-transparent text-light shadow-sm p-4 mb-4 border-2">
        <h1 class="text-center mb-4">🌤️ Weather for {$city|escape}</h1>
        <p class="fs-5"><strong>API:</strong> {$weather.api|escape}</p>
        <p class="fs-5"><strong>Temperature:</strong> {$weather.temperature} °C</p>
        <p class="fs-5"><strong>Humidity:</strong> {$weather.humidity}%</p>
    </div>

    {if !empty($history)}
    <div class="card bg-transparent text-light shadow-sm p-4 border-2">
        <h2 class="mb-4">Recent Weather Records</h2>
        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle mb-0">
                <thead class="table-dark text-light">
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">API</th>
                        <th scope="col">Temperature</th>
                        <th scope="col">Humidity</th>
                    </tr>
                </thead>
                <tbody>
                {foreach from=$history item=record}
                    <tr>
                        <td class="text-info">{$record.created_at}</td>
                        <td>{$record.api|escape}</td>
                        <td>🌡️ {$record.temperature} °C</td>
                        <td>💧 {$record.humidity}%</td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
        </div>
    </div>
    {/if}

    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-outline-light">← Return to Home</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
