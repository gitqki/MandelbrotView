<?php
/**
 * Class CalcMandelbrot
 * @Author: Stefan Behnert
 * @Updated: 31.05.2018
 * @Email: st.behnert@gmail.com
 */
Class CalcMandelbrot
{
    public $server;
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
    public function __construct($server ,$realFrom, $realTo, $imaginaryFrom, $imaginaryTo, $intervall, $maxIteration)
    {
        $this->server = $server;
        $this->realFrom = $realFrom;
        $this->realTo = $realTo;
        $this->imaginaryFrom = $imaginaryFrom;
        $this->imaginaryTo = $imaginaryTo;
        $this->intervall = $intervall;
        $this->maxIteration = $maxIteration;
        $this->CalcMandelbrot();
    }
    /**
     * @param $url -> String
     * @return mixed
     */
    private function curl_get_contents($url)
    {
        // Setup cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        // Send request
        $data = curl_exec($ch);
        curl_close($ch);
        // Return data
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
    }
    /**
     *
     */
    private function CalcMandelbrot()
    {
        /**
         * Call API GET
         */
        //$response = $this->curl_get_contents('http://192.168.214.83/api?realFrom=' . $this->realFrom . '&realTo=' . $this->realTo . '&imaginaryFrom=' . $this->imaginaryFrom . '&imaginaryTo=' . $this->imaginaryTo . '&intervall=' . $this->intervall . '&maxIteration=' . $this->maxIteration . '');

        /**
         * Call API POST
         */
        $postServer = $this->server;
        $postData = array(
            'realFrom' => $this->realFrom,
            'realTo' => $this->realTo,
            'imaginaryFrom' => $this->imaginaryFrom,
            'imaginaryTo' => $this->imaginaryTo,
            'intervall' => $this->intervall,
            'maxIteration' => $this->maxIteration
        );

        $this->curl_post_content($postData, $postServer);

        /**
         * DrawMandelbrot
         */
        $drawMandelbrot = new DrawMandelbrot($this->realFrom, $this->realTo, $this->imaginaryFrom, $this->imaginaryTo, $this->intervall, $this->maxIteration, $this->set);
        $drawMandelbrot->DrawMandelbrot();
    }
}
?>