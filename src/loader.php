<?php

$base = __DIR__ . '/../src/';

$folders = [
  'libs',
  'models/v1',
  'validations/v1',
  'controllers/v1',
  'middleware',
  'routes'
];

foreach ($folders as $folder) {
  foreach (glob($base.$folder.'/*.php') as $files => $fileName) {
    require $fileName;
  }
}


?>
