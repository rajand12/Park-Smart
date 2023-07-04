<?php 
class LogisticRegression {
    private $weights;
    private $learningRate;
    private $numIterations;

    public function __construct($learningRate = 0.01, $numIterations = 1000) {
        $this->learningRate = $learningRate;
        $this->numIterations = $numIterations;
    }

    private function sigmoid($z) {
        return 1 / (1 + exp(-$z));
    }

    private function gradientDescent($X, $y) {
        $numSamples = count($X);
        $numFeatures = count($X[0]);
        $this->weights = array_fill(0, $numFeatures, 0);

        for ($i = 0; $i < $this->numIterations; $i++) {
            $predicted = array_fill(0, $numSamples, 0);

            for ($j = 0; $j < $numSamples; $j++) {
                $z = 0;

                for ($k = 0; $k < $numFeatures; $k++) {
                    $z += $this->weights[$k] * $X[$j][$k];
                }

                $predicted[$j] = $this->sigmoid($z);
                $error = $predicted[$j] - $y[$j];

                for ($k = 0; $k < $numFeatures; $k++) {
                    $this->weights[$k] -= $this->learningRate * $error * $X[$j][$k];
                }
            }
        }
    }

    public function train($X, $y) {
        // Add bias term to feature matrix
        $numSamples = count($X);
        $X = array_map(function ($row) {
            array_unshift($row, 1);
            return $row;
        }, $X);

        // Convert target values to 0 and 1
        $y = array_map(function ($val) {
            return (int) ($val === 1);
        }, $y);

        $this->gradientDescent($X, $y);
    }

    public function predict($X) {
        $numSamples = count($X);
        $X = array_map(function ($row) {
            array_unshift($row, 1); 
            return $row;
        }, $X);

        $predictions = array_fill(0, $numSamples, 0);

        for ($i = 0; $i < $numSamples; $i++) {
            $z = 0;

            for ($j = 0; $j < count($X[$i]); $j++) {
                $z += $this->weights[$j] * $X[$i][$j];
            }

            $predictions[$i] = $this->sigmoid($z) >= 0.5 ? 1 : 0;
        }

        return $predictions;
    }
}

// Example usage
$X = [  [17.99, 10.38, 122.8, 1001, 0.1184, 0.2776, 0.3001, 0.1471, 0.2419, 0.07871, 1.095, 0.9053, 8.589, 153.4, 0.006399, 0.04904, 0.05373, 0.01587, 0.03003, 0.006193, 25.38, 17.33, 184.6, 2019, 0.1622, 0.6656, 0.7119, 0.2654, 0.4601, 0.1189], 
        [20.57, 17.77, 132.9, 1326, 0.08474, 0.07864, 0.0869, 0.07017, 0.1812, 0.05667, 0.5435, 0.7339, 3.398, 74.08, 0.005225, 0.01308, 0.0186, 0.0134, 0.01389, 0.003532, 24.99, 23.41, 158.8, 1956, 0.1238, 0.1866, 0.2416, 0.186, 0.275, 0.08902], 
        [19.69, 21.25, 130, 1203, 0.1096, 0.1599, 0.1974, 0.1279, 0.2069, 0.05999, 0.7456, 0.7869, 4.585, 94.03, 0.00615, 0.04006, 0.03832, 0.02058, 0.0225, 0.004571, 23.57, 25.53, 152.5, 1709, 0.1444, 0.4245, 0.4504, 0.243, 0.3613, 0.08758], 
        [11.42, 20.38, 77.58, 386.1, 0.1425, 0.2839, 0.2414, 0.1052, 0.2597, 0.09744, 0.4956, 1.156, 3.445, 27.23, 0.00911, 0.07458, 0.05661, 0.01867, 0.05963, 0.009208, 14.91, 26.5, 98.87, 567.7, 0.2098, 0.8663, 0.6869, 0.2575, 0.6638, 0.173], 
        [20.29, 14.34, 135.1, 1297, 0.1003, 0.1328, 0.198, 0.1043, 0.1809, 0.05883, 0.7572, 0.7813, 5.438, 94.44, 0.01149, 0.02461, 0.05688, 0.01885, 0.01756, 0.005115, 22.54, 16.67, 152.2, 1575, 0.1374, 0.205, 0.4, 0.1625, 0.2364, 0.07678], 
        [12.45, 15.7, 82.57, 477.1, 0.1278, 0.17, 0.1578, 0.08089, 0.2087, 0.07613, 0.3345, 0.8902, 2.217, 27.19, 0.00751, 0.03345, 0.03672, 0.01137, 0.02165, 0.005082, 15.47, 23.75, 103.4, 741.6, 0.1791, 0.5249, 0.5355, 0.1741, 0.3985, 0.1244], 
        [18.25, 19.98, 119.6, 1040, 0.09463, 0.109, 0.1127, 0.074, 0.1794, 0.05742, 0.4467, 0.7732, 3.18, 53.91, 0.004314, 0.01382, 0.02254, 0.01039, 0.01369, 0.002179, 22.88, 27.66, 153.2, 1606, 0.1442, 0.2576, 0.3784, 0.1932, 0.3063, 0.08368], 
        [13.08, 15.71, 85.63, 520, 0.1075, 0.127, 0.04568, 0.0311, 0.1967, 0.06811, 0.1852, 0.7477, 1.383, 14.67, 0.004097, 0.01898, 0.01698, 0.00649, 0.01678, 0.002425, 14.5, 20.49, 96.09, 630.5, 0.1312, 0.2776, 0.189, 0.07283, 0.3184, 0.08183], 
        [9.504, 12.44, 60.34, 273.9, 0.1024, 0.06492, 0.02956, 0.02076, 0.1815, 0.06905, 0.2773, 0.9768, 1.909, 15.7, 0.009606, 0.01432, 0.01985, 0.01421, 0.02027, 0.002968, 10.23, 15.66, 65.13, 314.9, 0.1324, 0.1148, 0.08867, 0.06227, 0.245, 0.07773], 
        [15.34, 14.26, 102.5, 704.4, 0.1073, 0.2135, 0.2077, 0.09756, 0.2521, 0.07032, 0.4388, 0.7096, 3.384, 44.91, 0.006789, 0.05328, 0.06446, 0.02252, 0.03672, 0.004394, 18.07, 19.08, 125.1, 980.9, 0.139, 0.5954, 0.6305, 0.2393, 0.4667, 0.09946],
        [13.03, 18.42, 82.61, 523.8, 0.08983, 0.03766, 0.02562, 0.02923, 0.1467, 0.05863, 0.1839, 2.342, 1.17, 14.16, 0.004352, 0.004899, 0.01343, 0.01164, 0.02671, 0.001777, 13.3, 22.81, 84.46, 545.9, 0.09701, 0.04619, 0.04833, 0.05013, 0.1987, 0.06169]];
$y = [1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0];

$logisticRegression = new LogisticRegression();
$logisticRegression->train($X, $y);

$newX = [[13.61, 24.98, 88.05, 582.7, 0.09488, 0.08511, 0.08625, 0.04489, 0.1609, 0.05871, 0.4565, 1.29, 2.861, 43.14, 0.005872, 0.01488, 0.02647, 0.009921, 0.01465, 0.002355, 16.99, 35.27, 108.6, 906.5, 0.1265, 0.1943, 0.3169, 0.1184, 0.2651, 0.07397]];
$predictions = $logisticRegression->predict($newX);

print_r($predictions);

?>
