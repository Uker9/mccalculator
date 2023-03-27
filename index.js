function calculateDuty(cost, weight) {
  const costThreshold1 = 200;
  const costThreshold2 = 10000;
  const weightThreshold1 = 31;
  const weightThreshold2 = 50;

  let duty = 0;

  if (cost > costThreshold1 && weight > weightThreshold1) {
    const costExcess = Math.max(cost - costThreshold1, 0);
    const weightExcess = Math.max(weight - weightThreshold1, 0);

    if (cost > costThreshold2 && weight > weightThreshold2) {
      const dutyRate = 0.3;
      const minDutyPerKg = 4;
      const costDuty = costExcess * dutyRate;
      const weightDuty = weightExcess * minDutyPerKg;
      duty = Math.max(costDuty, weightDuty);
    } else {
      const dutyRate = 0.15;
      const minDutyPerKg = 2;
      const costDuty = costExcess * dutyRate;
      const weightDuty = weightExcess * minDutyPerKg;
      duty = Math.max(costDuty, weightDuty);
    }
  }

  return duty;
}
