<?php

$train_file = (dirname(__FILE__) . "/network/xor_float.net");
if (!is_file($train_file))
    die("The file xor_float.net has not been created! Please run simple_train.php to generate it");

//$input = array(-1, 1);

while (true) {
    $input = readline('Enter offer name: ');

    $ann = fann_create_from_file($train_file);

    if (!$ann) {
        die("ANN could not be created");
    }

    $calc_out = fann_run($ann, [$input]);

    echo sprintf("xor test (%s) -> %s\n", $input, reset($calc_out));
}

fann_destroy($ann);