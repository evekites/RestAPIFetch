<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Single Post</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <h1>Post: Read Single</h1>
    <a href="index.php">Terug</a>
    <br>
    <div class="container"></div>
    <label for="id">Welk record wil je zien?</label>
    <input type="numeric" name="id" id="id" >
    <button onclick="ReadSinglePost()">Vind record</button>
    <br>
    <a href="index.php">Terug</a>
    <script src="js/app.js"></script>
</body>
</html>
