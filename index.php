<?php
/**
 * @Author: Stefan Behnert
 * @Updated: 31.05.2018
 * @Email: st.behnert@gmail.com
 */

require_once "autoloader.php";

// Set timeout to X seconds
set_time_limit(300);

// Set memory limit to unlimited
ini_set('memory_limit', '-1');

// The data to send to the API
// 59 Server - Chris
// 41 Server - Sasette
// 69 Server - ?
// 83 Server - Thien-An

$mandelbrotCoordinates[] = array(
    "realFrom" => -1.1883796296296296,
    "realTo" => -1.1121425925925925,
    "imaginaryFrom" => 0.24499722222222214,
    "imaginaryTo" => 0.30217499999999997,
    "interval" => 0.003,
    "maxIteration" => 255
);

/**
 * DrawMandelbrot constructor.
 * @String $mandelbrotCoordinates
 * @array $this->set
 */
new GetMandelbrotSet("http://192.168.1.6/", $mandelbrotCoordinates);
