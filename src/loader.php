<?php

$base = __DIR__ . '/../src/';

$folders = [
  'libs',
  'models',
  'controllers/v1',
  'middleware',
  'routes'
  'validation',
];

foreach ($folders as $folder) {
  foreach (glob($base.$folder.'/*.php') as $files => $fileName) {
    require $fileName;
  }
}


?>
