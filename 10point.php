<?php
// data-arr.php хранит массив $example_persons_array
require 'data-arr.php';
//print_r($example_persons_array);

// создаем массив только со значением  fullname из массива $example_persons_array
require 'namestring.php';

// Создаем массив для создание ключей surname name patronomyc
// $initials = ['surname', 'name', 'patronomyc',];

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
print_r ("Вывод функции getPartsFromFullname \n");
print_r($associativArrFullname);


// принимает три строки "Фамилия" "Имя" "Отчество" и склеивает в одну
function getFullnameFromParts($surname, $name, $patronomyc)
{
    $stringFullname = $surname . " " . $name . " " . $patronomyc;
    return $stringFullname;
}
echo "\n Вывод функции getFullnameFromParts:\n";
echo getFullnameFromParts($surnameNamePatronomyc[0], $surnameNamePatronomyc[1], $surnameNamePatronomyc[2]);

// Функция возвращающая Имя и первую букву фамилии (Скокращенное ФИО)
function getShortName($nameString)
{
    // Получаем ассоциативный массив сформированный функцией getPartsFromFullname
    $arrNameString = getPartsFromFullname($nameString);
    //print_r($arrNameString);
    // Имя в отдельную переменную
    $name = $arrNameString['name'];
    // Получаем первую букву фамилии
    $surname = mb_substr($arrNameString['surname'], 0, 1);
    $shortName =  $name . " " . $surname . ".";
    //print_r($shortName);
    return $shortName;
}
echo "\n Вывод функции getShortName:\n";
echo getShortName($fullNameString[4]);