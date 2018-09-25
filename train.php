<?php

$num_input = 1;
$num_output = 1;
$num_layers = 30;
$num_neurons_hidden = 3000;
$desired_error = 0.00001;
$max_epochs = 500000000;
$epochs_between_reports = 1000;

$layers = [$num_input];

for ($i = 2; $i < $num_layers; $i++) {
    $layers[] = $num_neurons_hidden;
}

$layers[] = $num_output;

$ann = fann_create_standard_array($num_layers, $layers);

if ($ann) {
    fann_set_activation_function_hidden($ann, FANN_SIGMOID);
    fann_set_activation_function_output($ann, FANN_THRESHOLD);

    $filename = dirname(__FILE__) . "/dataset/eapteka.xor.data";

    if (fann_train_on_file($ann, $filename, $max_epochs, $epochs_between_reports, $desired_error)) {
        $saveResult = fann_save($ann, dirname(__FILE__) . "/network/xor_float.net");
    }

    fann_destroy($ann);
}