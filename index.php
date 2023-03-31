<?php
// data-arr.php хранит массив $example_persons_array
require 'data-arr.php';
//print_r($example_persons_array);

// создаем массив только со значением  fullname из массива $example_persons_array
require 'namestring.php';

// ------------------------------------------------------------------------
//echo "\n количество элементов в массиве \$example_persons_array:\n";

// ***********************************************************************************************
// ******* Функция подсчета элементов в массиве ***********
function arrCount($arr)
{
    $arrCount = count($arr);
    return $arrCount;
}
// ------------------------------------------------------------------------
// echo "\n" . arrCount($example_persons_array) . "\n";
// ------------------------------------------------------------------------

// Создаем массив для создание ключей surname name patronomyc
// $initials = ['surname', 'name', 'patronomyc',];

// разбиваем строку ФИО на числовой массив 
// --- ПЕРЕМЕННАЯ $fullNameString из ФАЙЛА namestring.php ---
$surnameNamePatronomyc = explode(" ", $fullNameString[3]); // разбиваем строку ФИО на числовой массив
//print_r($surnameNamePatronomyc);

// ***********************************************************************************************
//  *****  принимает строку ФИО и возвращает массив из трех элементов Фамилия, Имя, Отчество  ***** 
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
$associativArrFullname = getPartsFromFullname($fullNameString[0]);
// выводим ассоциативный массив из функции getPartsFromFullname

// ------------------------------------------------------------------------
//  print_r("\n\n Вывод функции getPartsFromFullname \n");
//  print_r($associativArrFullname);
// ------------------------------------------------------------------------



// ***********************************************************************************************
//  *****  принимает три строки "Фамилия" "Имя" "Отчество" и склеивает в одну  ***** 
function getFullnameFromParts($surname, $name, $patronomyc)
{
    $stringFullname = $surname . " " . $name . " " . $patronomyc;
    return $stringFullname;
}

//--------------------------------------------------------------
// echo "\n\n Вывод функции getFullnameFromParts:\n";
// echo getFullnameFromParts($surnameNamePatronomyc[0], $surnameNamePatronomyc[1], $surnameNamePatronomyc[2]);
//--------------------------------------------------------------

// ***********************************************************************************************
//  ***** Функция возвращающая Имя и первую букву фамилии (Сокращенное ФИО)  ***** 
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

// ------------------------------------------------------------------------
// echo "\n\n Вывод функции getShortName:\n";
// echo getShortName($fullNameString[4]);
// ------------------------------------------------------------------------

// ***********************************************************************************************
// ***** Функция определения пола по ФИО ******
function getGenderFromName($nameString)
{
    // Получаем ассоциативный массив сформированный функцией getPartsFromFullname
    $arrNameString = getPartsFromFullname($nameString);
    // Начальное значение признака пола
    $gender = 0;

    // Проверка на мужские признаки
    if (mb_substr($arrNameString['patronomyc'], -2) == 'ич') {
        ++$gender;
    }
    if (mb_substr($arrNameString['name'], -1) == 'й' || mb_substr($arrNameString['name'], -1) == 'н') {
        ++$gender;
    }
    if (mb_substr($arrNameString['surname'], -1) == 'в') {
        ++$gender;
    }
    // Проверка на женские признаки
    if (mb_substr($arrNameString['patronomyc'], -3) == 'вна') {
        --$gender;
    }
    if (mb_substr($arrNameString['name'], -1) == 'а') {
        --$gender;
    }
    if (mb_substr($arrNameString['surname'], -1) == 'ва') {
        --$gender;
    }
    // echo $gender;
    // Выводим значение пола
    switch ($gender <=> 0) {
        case 1:
            return 'Мужчина';
            break;
        case -1:
            return 'Женщина';
            break;
        default:
            return 'Пол не определён';
    }
}

// ------------------------------------------------------------------------
// echo "\n\n Вывод функции getGenderFromName:\n";
// echo getGenderFromName($fullNameString[9]);
// ------------------------------------------------------------------------

// ***********************************************************************************************
// ***** Функция определения полового состава аудитории - getGenderDescription ******
function getGenderDescription($arr)
{
    $male = 0;
    $female = 0;
    $nogender = 0;

    // Считаем количесвто мужчин, женщин и неопределенных полов
    for ($i = 0; $i < count($arr); $i++) {
        if (getGenderFromName($arr[$i]) == 'Мужчина') {
            ++$male;
        }
        if (getGenderFromName($arr[$i]) == 'Женщина') {
            ++$female;
        }
        if (getGenderFromName($arr[$i]) == 'Пол не определён') {
            ++$nogender;
        }
    }

    // Считаем процентное соотношение по полам
    $roundMale = round($male / count($arr) * 100, 1);
    $roundFemale = round($female / count($arr) * 100, 1);
    $roundNogender = round($nogender / count($arr) * 100, 1);

    // формируем вывод результатов с помощью heredoc-синтаксиса
    $stats = <<< GENDERSTATS
  Гендерный состав аудитории:
  ---------------------------
  Мужчины - $roundMale %
  Женщины - $roundFemale %
  Не удалось определить - $roundNogender %
  GENDERSTATS;
    return $stats;
}

// ------------------------------------------------------------------------
// echo "\n\n Вывод функции getGenderDescription:\n";
// echo getGenderDescription($fullNameString);
// ------------------------------------------------------------------------

// ***********************************************************************************************
//  *****  Рандомная запись из массива $fullNameString ***** 
$randomFullNameString = (getPartsFromFullname($fullNameString[array_rand($fullNameString)]));
// print_r($ranndomFullNameString);

// ***********************************************************************************************
// ***** Функция идеальный подбор пары - getPerfectPartner ******

function getPerfectPartner($surname, $name, $patronomyc, $example_persons_array)
{
    // Приводим написание значений ФИО к нормальному регистру - Первая буква ПРОПИСНАЯ остальные строчные
    $surname = mb_convert_case($surname, MB_CASE_TITLE_SIMPLE);
    $name = mb_convert_case($name, MB_CASE_TITLE_SIMPLE);
    $patronomyc = mb_convert_case($patronomyc, MB_CASE_TITLE_SIMPLE);

    // Склеиваем ФИО в одну строку, используя функцию getFullnameFromParts
    $fullName = getFullnameFromParts($surname, $name, $patronomyc);

    // Проверяем пол для $fullName с помощью функции $getGenderFromName
    $fullNameGender = getGenderFromName($fullName);
    do {
        // 4 Рандомно выбираем ФИО человека из массива $example_persons_array
        $randomFullNameArr = $example_persons_array[array_rand($example_persons_array)]['fullname'];


        // Проверяем пол для randomFullNameArr с помощью функции $getGenderFromName
        $randomFullNameArrGender = getGenderFromName($randomFullNameArr);
        echo "fullName " . $fullName . "\n";
        echo $fullNameGender . "\n";
        echo "randomFullNameArr " . $randomFullNameArr . "\n";
        echo $randomFullNameArrGender . "\n";
    } while ($randomFullNameArrGender == $fullNameGender || $randomFullNameArrGender == 'Пол не определён' || $fullNameGender  == 'Пол не определён');

    // Обезличиваем ФИО с помощью функции $getShortName

    $fullNameShort = getShortName($fullName);
    $randomFullNameArrShort = getShortName($randomFullNameArr);

    // генерируем рандомное число - процент совпадения пары от 50 до 100
    $randomMatch = rand(5000, 10000) / 100;

    $pairMaleFemale = <<< PAIRMALEFEMALE
    Совместимость пары:
    ---------------------------
    $fullNameShort + $randomFullNameArrShort =
    \u{1F49F} Идеально на  $randomMatch %
    PAIRMALEFEMALE;
    return $pairMaleFemale;
}

// ------------------------------------------------------------------------
echo "\n\n Вывод функции getPerfectPartner:\n";
echo getPerfectPartner('рыков', 'ДЕНИС', 'нИколАевич', $example_persons_array);
//echo getPerfectPartner($getPartsFromFullname['surname'], $getPartsFromFullname['name'], $getPartsFromFullname['patronomyc'], $example_persons_array);


// echo getPerfectPartner('рыков', 'ДЕНИС', 'нИколАевич');
 // ------------------------------------------------------------------------

