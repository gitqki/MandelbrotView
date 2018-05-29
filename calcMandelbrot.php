<?php

Class CalcMandelbrot
{
    public $bsize;
    public $res;
    public $real;
    public $imaginary;
    public $steps;
    public $set;

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

        //echo "Steps: " . $this->steps;
        //echo "<br/>";

        /*
        * Call API for calculation of Mandelbrot set
        */
        //$response = file_get_contents('http://192.168.214.83/index.php?RESTurl=api&real=' . $this->real . '&imaginary=' . $this->imaginary . '&bsize=' . $this->bsize . '&resolution=' . $this->res . '');
        $this->set = array(
            0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2, 2, 3, 0, 0, 0, 0, 0, 0, 1, 2, 2, 2, 4, 0, 0, 0, 0, 1, 1, 2, 2, 2, 4, 5, 0,
            0, 0, 0, 1, 1, 2, 2, 2, 6, 17, 0, 0, 0, 1, 1, 2, 2, 2, 3, 6, 0, 0, 0, 1, 1, 1, 2, 2, 3, 4, 6, 14, 0, 0, 1, 1, 1, 2, 3, 3, 11, 0, 0, 0,
            0, 1, 1, 1, 2, 3, 5, 25, 0, 0, 0, 0, 1, 1, 1, 2, 6, 0, 0, 0, 0, 0, 0, 1, 1, 1, 2, 43, 17, 0, 0, 0, 0);

    }
}

$cb = new CalcMandelbrot(2, 0.1, -2, -2);
$cb->calc();
?>