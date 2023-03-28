<?php
// data-arr.php хранит массив $example_persons_array
require 'data-arr.php';
//print_r($example_persons_array);

// создаем массив только со начением  fullname из массива $example_persons_array

$fullName = [];
foreach($example_persons_array as $fullname) {
    $fullName[] = $fullname['fullname'];
}
//print_r($fullName);
print_r($fullName[0]);

// принимает строку ФИО и возвращает массив из трех элементов Фамилия, Ися, Отчество
function getPartsFromFullname() {}

// принимает три строки "Фамилия" "Имя" "Отчество" и склеивает в одну
function getFullnameFromParts() {

}

?>