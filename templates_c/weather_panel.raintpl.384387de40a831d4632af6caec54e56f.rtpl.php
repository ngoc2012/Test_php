<?php if(!class_exists('raintpl')){exit;}?><div class="panel panel-default" style="background-color: transparent; border: 2px solid #ccc;">
    <div style="background-color: transparent;color: #343a40;" class="panel-heading text-center">
        <h1>🌤️ Weather for <?php echo $city->getName();?></h1>
    </div>
    <div class="panel-body">
        <p><strong>API:</strong> <?php echo $history->getApi();?></p>
        <p><strong>Temperature:</strong> <?php echo $history->getTemperature();?> °C</p>
        <p><strong>Humidity:</strong> <?php echo $history->getHumidity();?>%</p>
    </div>
</div>
