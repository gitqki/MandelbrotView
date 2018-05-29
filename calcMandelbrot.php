<?php

Class CalcMandelbrot
{
    public $bsize;
    public $res;
    public $real;
    public $imaginary;
    public $steps;

    /**
     * CalcMandelbrot constructor.
     * @param $bsize
     * @param $res
     * @param $real
     * @param $imaginary
     * @param $steps
     */
    public function __construct($bsize, $res, $real, $imaginary)
    {
        $this->bsize = $bsize;
        $this->res = $res;
        $this->real = $real;
        $this->imaginary = $imaginary;
        $this->steps = 0;
    }

    function calc()
    {
        /*
        * Calculate steps
        */
        $y = 0;
        while ($this->bsize >= $y) {
            $this->steps += $y;
            $y += $this->res;
        }

        echo "Steps: " . $this->steps;
        echo "<br/>";

        /*
        * Call API for calculation of Mandelbrot set
        */
        $response = file_get_contents('http://192.168.214.83/index.php?RESTurl=api&real=' . $this->real . '&imaginary=' . $this->imaginary . '&bsize=' . $this->bsize . '&resolution=' . $this->res . '');

        //print_r(array_chunk($res, $steps, true));
        //$res = array_chunk($res, $this->steps);

        /* for ($o=1; $o < $this->steps-1; $o++) {
            for ($i=0; $i < $this->steps-1; $i++) {
                echo json_decode($res[$o][$i]);
            }
            echo "<br/>";
        } */

        $x = 0;
        $con = $this->steps;
        echo $response;

        /* while ($con > $x) {
            //echo json_encode($res[$x]);
            $x++;
        } */
    }
}
$cb = new CalcMandelbrot(2,0.1,-2,-2);
$cb->calc();
?>