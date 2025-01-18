<!-- resources/views/unauthorized.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unauthorized Access</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }
        h1 {
            color: red;
        }
        p {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <h1>Unauthorized Access</h1>
    <p>You do not have permission to access this page.</p>
    <a href="{{ url('/') }}">Go back to the homepage</a>
</body>
</html>
