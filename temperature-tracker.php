<?php

/*
Run php temperature-tracker.php in console to see the program
*/

class TemperatureTracker
{

    private $temperature;
    private $temperature_index;
    private $temperature_sum;
    private $max;
    private $min;
    private $avg;


    function __construct()
    {
        $this->temperature = [];
        $this->max = $this->min = null;
        $this->avg = $this->temperature_sum = $this->temperature_index  = 0; 
    }

    public function Update()
    {

        if ($this->max < $this->temperature[$this->temperature_index] ||  $this->temperature_index == 0) 
            $this->SetMax($this->temperature[$this->temperature_index]); 

        if ($this->min > $this->temperature[$this->temperature_index] || $this->temperature_index == 0)
            $this->SetMin($this->temperature[$this->temperature_index]); 

        $this->temperature_sum += $this->temperature[$this->temperature_index];
        $this->temperature_index += 1;
        $this->SetAvg();
    }

    public function GetTemperature()
    {
        return $this->temperature;
    }

    public function SetTemperature($temperature)
    {
        $this->temperature[] = $temperature;
    }

    public function GetMax()
    {
        return $this->max;
    }

    public function SetMax(&$temperature)
    {
        $this->max = &$temperature;
    }

    public function GetMin()
    {
        return $this->min;
    }

    public function SetMin(&$temperature)
    {
        $this->min = &$temperature;
    }

    public function GetAvg()
    {
        return $this->avg;
    }

    public function SetAvg()
    {
        $this->avg = $this->temperature_sum / $this->temperature_index;
    }
}

$temperature = null;

$TemperatureTracker = new TemperatureTracker();

do {

    if ($temperature) {

        echo "Show Temperature: " . $temperature . "\xC2\xB0";

        echo "\n\nTemperatures: \n";
        foreach ($TemperatureTracker->GetTemperature($temperature) as $index => $value) {
            $value = (($index + 1) % 10 == 0) ? $value . "\xC2\xB0\n" : $value . "\xC2\xB0, ";
            echo $value;
        }

        echo "\n\nMaximum: ";
        echo $TemperatureTracker->GetMax() . "\xC2\xB0";

        echo "\nMinimum: ";
        echo $TemperatureTracker->GetMin() . "\xC2\xB0";

        echo "\nAverage: ";
        echo $TemperatureTracker->GetAvg() . "\xC2\xB0";

        echo "\nCtrl+C to exit...\n";
    }

    echo "Insert a new temperature: ";
    fscanf(STDIN, "%d", $temperature);


    if (is_int($temperature)) {
        $TemperatureTracker->SetTemperature($temperature);
        $TemperatureTracker->Update();
    }
} while (1);
