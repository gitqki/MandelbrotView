<?php
/**
 * @Author: Stefan Behnert
 * @Updated: 31.05.2018
 * @Email: st.behnert@gmail.com
 */
include_once 'calcMandelbrot.php';
include_once 'drawMandelbrot.php';
// Set timeout to X seconds
set_time_limit(300);
// Set memory limit to unlimited
ini_set('memory_limit', '-1');
//$calcMandelbrot = new CalcMandelbrot(-1.1883796296296296, -1.1121425925925925, 0.24499722222222214, 0.30217499999999997, 0.0001, 255);

$calcMandelbrot = new CalcMandelbrot(-1.1883796296296296, -1.1121425925925925, 0.24499722222222214, 0.30217499999999997, 0.0001, 255);
?>