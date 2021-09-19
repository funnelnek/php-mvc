#!/usr/bin/php
<?php
if ($argc == 1 || $argv[1] == '--help') : ?>
    This is a command line application use --help to get available commands
<?php
elseif ($argv[1] == '--create') :
    echo $argv[1];
    echo '\n';
endif;
