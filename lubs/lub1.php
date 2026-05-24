<?php

// Завдання 1. Видалення всіх парних чисел із масиву.
echo "--- Завдання 1 ---\n";
$arr1 = [];
for ($i = 0; $i < 15; $i++) {
    $arr1[] = rand(1, 100);
}
echo "Початковий масив: " . implode(", ", $arr1) . "\n";
$filteredArr1 = array_filter($arr1, function($num) {
    return $num % 2 !== 0;
});
echo "Без парних чисел: " . implode(", ", $filteredArr1) . "\n\n";


// Завдання 2. Перевірити, чи масив є паліндромом.
echo "--- Завдання 2 ---\n";
$inputTask2 = "1, 2, 3, 2, 1";
$arr2 = explode(",", str_replace(" ", "", $inputTask2));
$isPalindrome = ($arr2 === array_reverse($arr2));
echo "Масив [$inputTask2] " . ($isPalindrome ? "Є паліндромом" : "НЕ є паліндромом") . "\n\n";


// Завдання 3. Порахувати кількість парних чисел у масиві.
echo "--- Завдання 3 ---\n";
$inputTask3 = [10, 15, 22, 33, 40, 50];
$evenCount = 0;
foreach ($inputTask3 as $num) {
    if ($num % 2 === 0) $evenCount++;
}
echo "Масив: " . implode(", ", $inputTask3) . "\n";
echo "Кількість парних елементів: $evenCount\n\n";


// Завдання 4. Знайти числа кратні 4 у діапазоні.
echo "--- Завдання 4 ---\n";
$sum4 = 0;
$multiplesOf4 = [];
for ($i = 100; $i <= 200; $i++) {
    if ($i % 4 === 0) {
        $multiplesOf4[] = $i;
        $sum4 += $i;
    }
}
echo "Числа кратні 4: " . implode(", ", $multiplesOf4) . "\n";
echo "Їх сума: $sum4\n\n";


// Завдання 5. Пошук другого за величиною елемента в масиві.
echo "--- Завдання 5 ---\n";
$arr5 = [];
for ($i = 0; $i < 10; $i++) {
    $arr5[] = rand(0, 50);
}
echo "Масив: " . implode(", ", $arr5) . "\n";
$uniqueArr5 = array_unique($arr5);
rsort($uniqueArr5);
if (count($uniqueArr5) > 1) {
    echo "Друге за величиною число: " . $uniqueArr5[1] . "\n\n";
} else {
    echo "В масиві всі числа однакові.\n\n";
}


// Завдання 6. Підрахунок добутку непарних чисел масиву.
echo "--- Завдання 6 ---\n";
$arr6 = [];
for ($i = 0; $i < 15; $i++) {
    $arr6[] = rand(1, 100);
}
$product6 = 1;
$hasOdd = false;
foreach ($arr6 as $num) {
    if ($num % 2 !== 0) {
        $product6 *= $num;
        $hasOdd = true;
    }
}
echo "Масив: " . implode(", ", $arr6) . "\n";
if ($hasOdd) {
    echo "Добуток непарних чисел: $product6\n\n";
} else {
    echo "Непарних чисел немає.\n\n";
}


// Завдання 7. Перетворення дати у текстовий формат.
echo "--- Завдання 7 ---\n";
$inputDate = "12.06.2025";
$months = [
    "01" => "січня", "02" => "лютого", "03" => "березня",
    "04" => "квітня", "05" => "травня", "06" => "червня",
    "07" => "липня", "08" => "серпня", "09" => "вересня",
    "10" => "жовтня", "11" => "листопада", "12" => "грудня"
];
$dateParts = explode(".", $inputDate);
if (count($dateParts) === 3) {
    $day = (int)$dateParts[0];
    $monthText = $months[$dateParts[1]] ?? "невідомого місяця";
    $year = $dateParts[2];
    echo "Форматована дата: {$day} {$monthText} {$year} року\n\n";
} else {
    echo "Неправильний формат дати.\n\n";
}


// Завдання 8. Знайти кількість елементів, кратних 100 у масиві.
echo "--- Завдання 8 ---\n";
$arr8 = [];
for ($i = 0; $i < 20; $i++) {
    $arr8[] = rand(50, 500);
}
$count100 = 0;
foreach ($arr8 as $num) {
    if ($num % 100 === 0) $count100++;
}
echo "Масив: " . implode(", ", $arr8) . "\n";
echo "Кількість чисел кратних 100: $count100\n\n";


// Завдання 9. Вивід чисел, що діляться на 5, та обчислення їхньої суми.
echo "--- Завдання 9 ---\n";
$sum9 = 0;
$divisibleBy5 = [];
for ($i = 20; $i <= 45; $i++) {
    if (fmod($i, 5) == 0) {
        $divisibleBy5[] = $i;
        $sum9 += $i;
    }
}
echo "Числа, що діляться на 5: " . implode(", ", $divisibleBy5) . "\n";
echo "Їхня сума: $sum9\n\n";


// Завдання 10 Симуляція світлофора за хвилиною години.
echo "--- Завдання 10 ---\n";
$minuteInput = 14;
$cycleMinute = $minuteInput % 5;

if ($cycleMinute >= 1 && $cycleMinute <= 3) {
    $color = "Зелений";
} else {
    $color = "Червоний";
}
echo "На $minuteInput хвилині горить: $color\n";
?>
