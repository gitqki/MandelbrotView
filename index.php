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
// 85 Server - ?

$mandelbrotCoordinates[] = array(
    "server" => "http://192.168.214.83",
    "realFrom" => -2,
    "realTo" => 1,
    "imaginaryFrom" => -1,
    "imaginaryTo" => 1,
    "interval" => 0.1,
    "maxIteration" => 255
);

/**
 * DrawMandelbrot constructor.
 * @param array $mandelbrotCoordinates
 */
new GetMandelbrotSet($mandelbrotCoordinates);
