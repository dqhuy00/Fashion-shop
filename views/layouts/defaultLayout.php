<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="main">
        <header>
            <h1>header</h1>
        </header>
        <div>
            <?php View($content, $data); ?>
        </div>
        <footer>
            <h1>footer</h1>
        </footer>
    </div>
</body>

</html>