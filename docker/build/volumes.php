<?php

chdir(__DIR__);

$dirs = [
    // '../../volumes',
    // '../../volumes/postgresql',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir);
    }
}
