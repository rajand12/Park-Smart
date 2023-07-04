<?php 
// Sample input data (x, y)
$data = array(
    array(1, 3),
    array(2, 5),
    array(3, 7),
    array(4, 9),
    array(5, 11)
);

// Calculate the sum of x, y, and x*y
$sumX = 0;
$sumY = 0;
$sumXY = 0;

foreach ($data as $point) {
    $x = $point[0];
    $y = $point[1];
    
    $sumX += $x;
    $sumY += $y;
    $sumXY += $x * $y;
}

// Calculate the average of x and y
$avgX = $sumX / count($data);
$avgY = $sumY / count($data);

// Calculate the slope (m) and y-intercept (b) of the regression line
$slope = ($sumXY - (count($data) * $avgX * $avgY)) / ($sumX - (count($data) * pow($avgX, 2)));
$intercept = $avgY - ($slope * $avgX);

// Print the equation of the regression line
echo "Regression line equation: y = " . $slope . "x + " . $intercept . "\n";

?>
