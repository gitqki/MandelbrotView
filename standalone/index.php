<?php
/**
 * @Author: Stefan Behnert
 * @Updated: 31.05.2018
 * @Email: st.behnert@gmail.com
 */

require_once "../autoloader.php";

// Set timeout to X seconds
set_time_limit(300);

// Set memory limit to unlimited
ini_set('memory_limit', '-1');

$mandelbrotCoordinates[] = array("realFrom" => -2, "realTo" => 1, "imaginaryFrom" => -1, "imaginaryTo" => 1, "interval" => 0.002, "maxIteration" => 255);

$set = array();
foreach ($mandelbrotCoordinates as $m) {
    $calcMandelbrot = new CalcMandelbrot($m["realFrom"], $m["realTo"], $m["imaginaryFrom"], $m["imaginaryTo"], $m["interval"], $m["maxIteration"]);
    $set[] = $calcMandelbrot->defineSet();
}

$draw = new DrawMandelbrot($mandelbrotCoordinates, $set);
$draw->DrawMandelbrot();