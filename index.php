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

$calcMandelbrot = new CalcMandelbrot(-2, 2, -2, 2, 0.05, 100);

?>