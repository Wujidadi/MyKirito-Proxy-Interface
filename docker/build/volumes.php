<?php

chdir(__DIR__);

$dirs = [
    //
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir);
    }
}
