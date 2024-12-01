<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-file Upload Test</title>
</head>
<body>
    <form action="uploadtest.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="testfiles[]" multiple>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
