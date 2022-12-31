<?php

chdir(__DIR__);

$dirs = [
    '../../volumes',
    '../../volumes/redis',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir);
    }
}
