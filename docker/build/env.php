<?php

chdir(__DIR__);

if (!file_exists('../.env')) {
    copy('../.env.example', '../.env');
}
