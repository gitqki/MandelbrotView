<?php
/**
 * Class CalcMandelbrot
 * @Author: Stefan Behnert
 * @Updated: 31.05.2018
 * @Email: st.behnert@gmail.com
 */
Class CalcMandelbrot /*
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
    public $realFrom;
    public $realTo;
    public $imaginaryFrom;
    public $imaginaryTo;
    public $intervall;
    public $maxIteration;
    public $set;
    /**
     * CalcMandelbrot constructor.
     * @param $realFrom
     * @param $realTo
     * @param $imaginaryFrom
     * @param $imaginaryTo
     * @param $intervall
     * @param $maxIteration
     */
    public function __construct($realFrom, $realTo, $imaginaryFrom, $imaginaryTo, $intervall, $maxIteration)
    {
        $this->realFrom = $realFrom;
        $this->realTo = $realTo;
        $this->imaginaryFrom = $imaginaryFrom;
        $this->imaginaryTo = $imaginaryTo;
        $this->intervall = $intervall;
        $this->maxIteration = $maxIteration;
        $this->init();
    }
    /**
     * @param $url -> String
     * @return mixed
     */
    private function curl_get_contents($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
    /**
     * @param $postData -> array()
     * @param $server -> String
     * @return mixed
     */
    private function curl_post_content($postData , $server)
    {
        // Setup cURL
        $ch = curl_init($server);
        curl_setopt_array($ch, array(CURLOPT_POST => TRUE, CURLOPT_RETURNTRANSFER => TRUE, CURLOPT_HTTPHEADER => array('Content-Type: application/json'), CURLOPT_POSTFIELDS => json_encode($postData)));
        // Send the request
        $response = curl_exec($ch);
        // Check for errors
        if ($response === FALSE) {
            die(curl_error($ch));
        }
        // Decode the response
        $json = json_decode($response, true);
        $this->set = $json;
        return $this->set;
    }
    /**
     *
     */
    private function init()
    {
        /**
         * Call API GET
         */
        $response = $this->curl_get_contents('http://192.168.214.83/api?realFrom=' . $this->realFrom . '&realTo=' . $this->realTo . '&imaginaryFrom=' . $this->imaginaryFrom . '&imaginaryTo=' . $this->imaginaryTo . '&intervall=' . $this->intervall . '&maxIteration=' . $this->maxIteration . '');
        //$this->set =  json_decode($response) ? json_decode($response) : die("Server not reachable.");;
        /**
         * Call API POST
         */
        // The data to send to the API
        // 59 Server - Chris
        // 41 Server - Sasette
        // 69 Server - ?
        $postServer = "localhost/mandelbrot";
        $postData = array(
            'realFrom' => $this->realFrom,
            'realTo' => $this->realTo,
            'imaginaryFrom' => $this->imaginaryFrom,
            'imaginaryTo' => $this->imaginaryTo,
            'intervall' => $this->intervall,
            'maxIteration' => $this->maxIteration
        );

        $this->curl_post_content($postData, $postServer);
        //var_dump($this->set);
        //exit;
        /**
         * DrawMandelbrot
         */
        $drawMandelbrot = new DrawMandelbrot($this->realFrom, $this->realTo, $this->imaginaryFrom, $this->imaginaryTo, $this->intervall, $this->maxIteration, $this->set);
        $drawMandelbrot->draw();
    }
}
?>