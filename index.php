<?php
/**
 * @Author: Stefan Behnert
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
// 83 Server - AN

/**
 * same value needed for interval and maxIteration
 */
$mandelbrotCoordinates[] = array("server" => "http://192.168.214.83:8080/", "realFrom" => -2,"realTo" => 1, "imaginaryFrom" => -1, "imaginaryTo" => 1, "interval" => 0.01, "maxIteration" => 255);

new GetMandelbrotSet($mandelbrotCoordinates);
