<?php
function calculate_duty($cost, $weight) {
  $cost_threshold1 = 200;
  $cost_threshold2 = 10000;
  $weight_threshold1 = 31;
  $weight_threshold2 = 50;

  $duty = 0;

  if ($cost > $cost_threshold1  $weight > $weight_threshold1) {
    $cost_excess = max($cost - $cost_threshold1, 0);
    $weight_excess = max($weight - $weight_threshold1, 0);

    if ($cost > $cost_threshold2  $weight > $weight_threshold2) {
      $duty_rate = 0.3;
      $min_duty_per_kg = 4;
    } else {
      $duty_rate = 0.15;
      $min_duty_per_kg = 2;
    }

    $cost_duty = $cost_excess * $duty_rate;
    $weight_duty = $weight_excess * $min_duty_per_kg;
    $duty = max($cost_duty, $weight_duty);
  }

  return $duty;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $cost = $_POST['cost'];
  $weight = $_POST['weight'];
  $duty = calculate_duty($cost, $weight);
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Калькулятор размера пошлины в странах ЕС</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<html>
<head>
  <title>Калькулятор пошлины</title>
</head>
<body>
  <form method="post">
    <label for="cost">Введите стоимость товара в евро:</label>
    <input type="text" id="cost" name="cost">

    <label for="weight">Введите вес товара в кг:</label>
    <input type="text" id="weight" name="weight">

    <button type="submit">Рассчитать пошлину</button>
  </form>

  <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
    <p>Пошлина за товар составляет: <?php echo $duty ?> евро.</p>
  <?php endif ?>
</body>
</html>