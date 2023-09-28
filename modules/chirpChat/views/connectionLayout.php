<?php

namespace ChirpChat\Views\HomePage;

class MainLayout {

public function __construct(private string $title, private string $content) { }

public function show() : void {
?><!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $this->title?></title>
</head>
<body>
<?= $this->content; ?>
</body>
</html>
<?php
}
}