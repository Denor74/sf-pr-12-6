<?php
// data-arr.php хранит массив $example_persons_array
require 'data-arr.php';
//print_r($example_persons_array);
// Создаем массив для создание ключей surname name patronomyc
require 'namestring.php';
// $initials = ['surname', 'name', 'patronomyc',];
// // создаем массив только со значением  fullname из массива $example_persons_array
// $fullNameString = [];
// foreach ($example_persons_array as $fullname) {
//     $fullNameString[] = $fullname['fullname'];
// }
// //print_r($fullNameString);
// //print_r($fullNameString[0]);

// разбиваем строку ФИО на числовой массив 
// --- ПЕРЕМЕННАЯ $fullNameString из ФАЙЛА namestring.php ---
$surnameNamePatronomyc = explode(" ", $fullNameString[3]); // разбиваем строку ФИО на числовой массив
 //print_r($surnameNamePatronomyc);

// принимает строку ФИО и возвращает массив из трех элементов Фамилия, Имя, Отчество
function getPartsFromFullname($nameString)
{ // Создаем массив для создание ключей surname name patronomyc
    $initials = ['surname', 'name', 'patronomyc',];
    $surnameNamePatronomyc = explode(" ", $nameString); // разбиваем строку ФИО на числовой массив
    //print_r($surnameNamePatronomyc);
    // Создаем ассоциативный массив с Именами
    $arrFulnameAssociative = array_combine($initials, $surnameNamePatronomyc);
    //print_r($arrFulnameAssociative);
    return $arrFulnameAssociative;
}

// Передаем строку с ФИО из массива $fullNameString в функцию getPartsFromFullname
$associativArrFullname = getPartsFromFullname($fullNameString[5]);
// выводим ассоциативный массив из функции getPartsFromFullname
//print_r($associativArrFullname);


// принимает три строки "Фамилия" "Имя" "Отчество" и склеивает в одну
function getFullnameFromParts($surname, $name, $patronomyc)
{
    $stringFullname = $surname . " " . $name . " " . $patronomyc;
    return $stringFullname;
}

//echo getFullnameFromParts($surnameNamePatronomyc[0], $surnameNamePatronomyc[1], $surnameNamePatronomyc[2]);

function getShortName()
{
    global $associativArrFullname;

    print_r($associativArrFullname);

}

getShortName();