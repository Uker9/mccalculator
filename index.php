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

