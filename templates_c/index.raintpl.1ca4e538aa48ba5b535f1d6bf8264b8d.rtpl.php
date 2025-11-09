<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
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
        <?php $counter1=-1; if( !is_null($cities) && is_array($cities) && sizeof($cities) ) foreach( $cities as $key1 => $value1 ){ $counter1++; ?>

            <li class="list-group-item bg-dark text-light border-0 border-bottom border-secondary d-flex justify-content-between align-items-center">
                <span class="fw-semibold"><?php echo $value1->getName();?></span>

                <div class="d-flex gap-2 ms-auto">
                    <a href="/index.php?name=<?php echo $value1->encodeCityName();?>&id=<?php echo $value1->getId();?>&api=OpenWeatherApi" 
                       class="btn btn-outline-info btn-sm">
                        Open Weather
                    </a>

                    <a href="/index.php?name=<?php echo $value1->encodeCityName();?>&id=<?php echo $value1->getId();?>&api=FreeWeatherApi" 
                       class="btn btn-outline-info btn-sm">
                        Free Weather
                    </a>
                </div>
            </li>
        <?php } ?>

        </ul>
    </div>

    <div class="text-center mt-4">
        <p class="text-muted">Select a city to view the latest weather 🌦️</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
