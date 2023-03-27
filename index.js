function calculate_duty(cost, weight) {
  const cost_threshold1 = 200;
  const cost_threshold2 = 10000;
  const weight_threshold1 = 31;
  const weight_threshold2 = 50;

  let duty = 0;

  if (cost > cost_threshold1 && weight > weight_threshold1) {
    const cost_excess = Math.max(cost - cost_threshold1, 0);
    const weight_excess = Math.max(weight - weight_threshold1, 0);

    if (cost > cost_threshold2 && weight > weight_threshold2) {
      const duty_rate = 0.3;
      const min_duty_per_kg = 4;
      const cost_duty = cost_excess * duty_rate;
      const weight_duty = weight_excess * min_duty_per_kg;
      duty = Math.max(cost_duty, weight_duty);
    } else {
      const duty_rate = 0.15;
      const min_duty_per_kg = 2;
      const cost_duty = cost_excess * duty_rate;
      const weight_duty = weight_excess * min_duty_per_kg;
      duty = Math.max(cost_duty, weight_duty);
    }
  }

  return duty;
}

const form = document.querySelector('form');
const result = document.querySelector('#result');

form.addEventListener('submit', (event) => {
  event.preventDefault();

  const cost = parseInt(document.querySelector('#cost').value);
  const weight = parseInt(document.querySelector('#weight').value);
  const duty = calculate_duty(cost, weight);

  result.innerHTML = `Пошлина за товар составляет: ${duty} евро.`;
});
