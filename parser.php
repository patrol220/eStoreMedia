<?php

require __DIR__ . '/vendor/autoload.php';

$parser = new \App\Parser\Parser();

$parser->parseAndSaveData();
