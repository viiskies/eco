<!DOCTYPE html>
<html>
<head>
    <title><?= $data['title']; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <style>
        .header {
            font-family: 'Oswald', sans-serif;
            background-color: gray;
            color: white;
            padding: 50px 5px 10px 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row header">
        <div class="col">
            <h1><?= $data['header']; ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $data['body']; ?>
        </div>
        <div class="col">
            <?php
                if (isset($data['users'])) {
                    echo "<pre>";
                    foreach ($data['users'] as $user) {
                        print_r($user) ;
                    }
                    echo "</pre>";
                }
            ?>
        </div>
        <div class="col">
            <?php
                if (isset($data['games'])) {
                    echo "<pre>";
                    foreach ($data['games'] as $game) {
                        print_r($game) ;
                    }
                    echo "</pre>";
                }
            ?>
        </div>
    </div>
</div>
</body>
</html>