<?php

/**
 * Class CalcMandelbrot
 * @Author: Stefan Behnert
 * @Updated: 31.05.2018
 * @Email: st.behnert@gmail.com
 */
Class CalcMandelbrot
/*
 * Test Content
 * $this->set = array(
 * 0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,2,2,3,3,0,0,0,0,0,0,0,
 * 0,0,0,0,0,1,1,2,2,2,3,3,3,0,0,0,0,0,0,0,0,0,0,1,1,2,2,2,2,2,3,3,5,0,0,0,0,0,0,0,0,1,1,1,2,2,2,2,2,2,3,4,5,0,0,0,0,
 * 0,0,0,1,1,1,1,2,2,2,2,2,3,4,4,6,0,0,0,0,0,0,1,1,1,1,2,2,2,2,2,2,4,4,5,11,0,0,0,0,0,1,1,1,1,2,2,2,2,2,2,3,6,6,7,13,
 * 0,0,0,0,1,1,1,1,1,2,2,2,2,2,2,4,6,15,17,0,0,0,0,0,1,1,1,1,2,2,2,2,2,2,3,4,6,11,0,0,0,0,0,1,1,1,1,1,2,2,2,2,2,3,3,
 * 4,6,0,0,0,0,0,0,1,1,1,1,1,2,2,2,2,3,3,4,4,6,10,0,0,0,0,1,1,1,1,1,1,2,2,2,3,3,3,4,5,6,8,14,0,0,0,1,1,1,1,1,2,2,2,2,
 * 3,3,4,5,7,10,0,0,0,0,1,1,1,1,1,1,2,2,2,3,3,3,6,11,11,0,0,0,0,0,1,1,1,1,1,1,2,2,3,3,3,4,7,0,0,0,0,0,0,0,1,1,1,1,1,
 * 1,2,2,3,3,4,5,7,0,0,0,0,0,0,0,1,1,1,1,1,1,2,2,3,4,5,7,9,0,0,0,0,0,0,0,1,1,1,1,1,1,1,2,18,6,8,0,0,0,0,0,0,0,0,0,
 * 1,1,1,1,1,1,1,2,4,8,0,0,0,0,0,0,0,0,0
 * )
 */
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
     */
    public function __construct($bsize, $res, $real, $imaginary)
    {
        $this->bsize = $bsize;
        $this->res = $res;
        $this->real = $real;
        $this->imaginary = $imaginary;
        $this->init();
    }

    /**
     * @param $url -> String
     * @return mixed
     */
    function curl_get_contents($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    function init()
    {


        /**
         * Call API
         */
        $response = $this->curl_get_contents
        (
            'http://localhost:63342/MandelbrotServer/content/index.php?RESTurl=api&real='
            . $this->real . '&imaginary='
            . $this->imaginary . '&bsize='
            . $this->bsize . '&resolution='
            . $this->res . ''
        );
        $this->set = json_decode($response);

        /**
         * DrawMandelbrot
         */
        $drawMandelbrot = new DrawMandelbrot($this->bsize, $this->res, $this->real, $this->imaginary, $this->set);
        $drawMandelbrot->draw();

    }
}

?>