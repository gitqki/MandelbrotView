<?php
Class CalcMandelbrot
{
    public $bsize;
    public $res;
    public $real;
    public $imaginary;
    public $set;

    /**
     * CalcMandelbrot constructor.
     * @param $bsize
     * @param $res
     * @param $real
     * @param $imaginary
     * @param $set
     */
    public function __construct($bsize, $res, $real, $imaginary)
    {
        $this->bsize = $bsize;
        $this->res = $res;
        $this->real = $real;
        $this->imaginary = $imaginary;
    }
    function calc()
    {
        /*
        * Call API for calculation of Mandelbrot set
        */
        $response = file_get_contents('http://192.168.214.83/index.php?RESTurl=api&real=' . $this->real . '&imaginary=' . $this->imaginary . '&bsize=' . $this->bsize . '&resolution=' . $this->res . '');
        $this->set = json_decode($response);
        //$this->set = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,2,2,3,3,0,0,0,0,0,0,0,0,0,0,0,0,1,1,2,2,2,3,3,3,0,0,0,0,0,0,0,0,0,0,1,1,2,2,2,2,2,3,3,5,0,0,0,0,0,0,0,0,1,1,1,2,2,2,2,2,2,3,4,5,0,0,0,0,0,0,0,1,1,1,1,2,2,2,2,2,3,4,4,6,0,0,0,0,0,0,1,1,1,1,2,2,2,2,2,2,4,4,5,11,0,0,0,0,0,1,1,1,1,2,2,2,2,2,2,3,6,6,7,13,0,0,0,0,1,1,1,1,1,2,2,2,2,2,2,4,6,15,17,0,0,0,0,0,1,1,1,1,2,2,2,2,2,2,3,4,6,11,0,0,0,0,0,1,1,1,1,1,2,2,2,2,2,3,3,4,6,0,0,0,0,0,0,1,1,1,1,1,2,2,2,2,3,3,4,4,6,10,0,0,0,0,1,1,1,1,1,1,2,2,2,3,3,3,4,5,6,8,14,0,0,0,1,1,1,1,1,2,2,2,2,3,3,4,5,7,10,0,0,0,0,1,1,1,1,1,1,2,2,2,3,3,3,6,11,11,0,0,0,0,0,1,1,1,1,1,1,2,2,3,3,3,4,7,0,0,0,0,0,0,0,1,1,1,1,1,1,2,2,3,3,4,5,7,0,0,0,0,0,0,0,1,1,1,1,1,1,2,2,3,4,5,7,9,0,0,0,0,0,0,0,1,1,1,1,1,1,1,2,18,6,8,0,0,0,0,0,0,0,0,0,1,1,1,1,1,1,1,2,4,8,0,0,0,0,0,0,0,0,0);
        }
}

?>