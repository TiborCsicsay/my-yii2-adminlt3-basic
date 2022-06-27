<?php

function enum_random($array){
    $min = 0;
    $max = count($array)-1;
    $i = rand($min, $max);
    if (!array_key_exists($i,$array))
        throw new \Exception('Associative array is not supported for enum_random');

    return $array[$i];
}