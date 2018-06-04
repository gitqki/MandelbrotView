<?php
/**
 * @Author: Stefan Behnert
 * @Email: st.behnert@gmail.com
 */

require_once "bootstrap.php";

// Set timeout to X seconds
set_time_limit(300);
// Set memory limit to unlimited
ini_set('memory_limit', '-1');

// The data to send to the API
// 59 Server - Chris
// 41 Server - Sasette
// 69 Server - ?
// 83 Server - AN

//$calcMandelbrot = new CalcMandelbrot(-1.1883796296296296, -1.1121425925925925, 0.24499722222222214, 0.30217499999999997, 0.0001, 255);

$calcMandelbrot[0] = array("realFrom" => -2,"realTo" => 1, "imaginaryFrom" => 0, "imaginaryTo" => 1, "interval" => 0.05, "maxIteration" => 255);
$calcMandelbrot[1] = array("realFrom" => -2,"realTo" => 1, "imaginaryFrom" => -1, "imaginaryTo" => 0, "interval" => 0.05, "maxIteration" => 255);

new CalcMandelbrot("http://192.168.1.6/", $calcMandelbrot);
