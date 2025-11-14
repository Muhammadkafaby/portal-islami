<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Occurred</title>
</head>
<body>
    <h1>Error</h1>
    <p>Status Code: <?php echo $statusCode ?? 'Unknown'; ?></p>
    <p>Message: <?php echo esc($message ?? 'An error occurred'); ?></p>
    <p>File: <?php echo esc($file ?? ''); ?></p>
    <p>Line: <?php echo $line ?? ''; ?></p>
</body>
</html>
