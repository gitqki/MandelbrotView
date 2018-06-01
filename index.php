<?php
/**
 * @Author: Stefan Behnert
 * @Updated: 31.05.2018
 * @Email: st.behnert@gmail.com
 */

include_once 'calcMandelbrot.php';
include_once 'drawMandelbrot.php';

set_time_limit(300);
$calcMandelbrot = new CalcMandelbrot(-2, 2, -2, 2, 0.1, 500);

?>