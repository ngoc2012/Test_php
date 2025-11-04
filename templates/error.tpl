<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light d-flex align-items-center" style="height:100vh;">

<div class="container text-center">
    <div class="card bg-secondary text-light shadow-sm p-5 mx-auto border-0" style="max-width: 500px;">
        <h1 class="text-danger mb-3">⚠️ Error</h1>
        <p class="lead">{$errorMessage|escape}</p>
        <a href="index.php" class="btn btn-outline-light mt-3">Return to Home</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
