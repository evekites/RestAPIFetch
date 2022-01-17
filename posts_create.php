<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crete Post</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <h1>Post: Create</h1>
    <a href="index.php">Terug</a>
    <br>
    <div class="container"></div>
    <label for="title">Title: </label><input type="text" name="title" id="title"><br>
    <label for="author">Author: </label><input type="text" name="author" id="author"><br>
    <label for="Body">Body: </label><textarea cols="40" rows="5" name="body" id="body"></textarea><br>
    <label for="category_id">Category: </label><div class="categoriesselect"></div>
    <button onclick="CreatePost(document.getElementById('title').value,
                                document.getElementById('author').value,
                                document.getElementById('body').value,
                                document.getElementById('category_id').value)">Maak record</button>
    <br><br><br>
    <a href="index.php">Terug</a>
    <script src="js/app.js"></script>
    <script>ListCategories();</script>
</body>
</html>
