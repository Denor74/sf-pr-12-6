<?php

// создаем массив только со значением  fullname из массива $example_persons_array
$fullNameString = [];
foreach ($example_persons_array as $fullname) {
    $fullNameString[] = $fullname['fullname'];
}
//print_r($fullNameString);
//print_r($fullNameString[0]);