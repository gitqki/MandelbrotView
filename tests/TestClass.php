<?php
/**
 * Class CalcMandelbrot
 * @Author: Stefan Behnert
 * @Email: st.behnert@gmail.com
 */
require_once "../autoloader.php";

Class TestMandelbrot
{
    public $set;
    public $coords;

    public function __construct(){}

    public function TestMandelbrot()
    {
        // These coordinates just work with the linked json file
        // tests/test.json
        $mandelbrotCoordinates[] = array(
            "realFrom" => -1.1883796296296296,
            "realTo" => -1.1121425925925925,
            "imaginaryFrom" => 0.24499722222222214,
            "imaginaryTo" => 0.30217499999999997,
            "interval" => 0.0005,
            "maxIteration" => 255
        );

        // Imitate response from Server for test purpose
        $response = file_get_contents("test.json");
        $json = json_decode($response, true);
        $this->set[] = $json["response"];

        /**
         * DrawMandelbrot constructor.
         * @String $mandelbrotCoordinates
         * @array $this->set
         */
        $drawMandelbrot = new DrawMandelbrot($mandelbrotCoordinates, $this->set);
        $drawMandelbrot->DrawMandelbrot();
    }
}

$testMandelbrot = new TestMandelbrot();
$testMandelbrot->TestMandelbrot();
