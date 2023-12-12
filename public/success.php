<!-- success.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success Page</title>
</head>

<body>
    <div>
        <h1>Data Entered Successfully!</h1>
        <p>Your success message here.</p>
        <button onclick="redirectToMain()">Make another entry</button>
    </div>

    <script>
        function redirectToMain() {
            window.location.href = 'index.php'; // Change 'index.php' to the actual main page URL
        }
    </script>
</body>

</html>