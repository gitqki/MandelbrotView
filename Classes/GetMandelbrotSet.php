<?php
/**
 * Class CalcMandelbrot
 * @Author: Stefan Behnert
 * @Email: st.behnert@gmail.com
 */
Class GetMandelbrotSet
{
    public $server;
    public $sets;
    public $coord;

    /**
     * GetMandelbrotSet constructor.
     * @String $server
     * @array $coord
     */
    public function __construct($server , $coord)
    {
        $this->server = $server;
        $this->coord = $coord;
        $this->GetMandelbrotSet();
    }
    /**
     * @String $url
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
     * @array $postData
     * @String $server
     * @return mixed
     */
    private function curl_post_content($postData , $server)
    {
        // Setup cURL
        $ch = curl_init($server);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
            CURLOPT_POSTFIELDS => json_encode($postData))
        );
        // Send the request
        $response = curl_exec($ch);
        // Check for errors
        if ($response === FALSE) {
            die(curl_error($ch));
        }
        // Decode the response
        $json = json_decode($response, true);
        return $json["response"];
    }

    /**
     * Get calculated SET of Mandelbrot
     * from Server.
     * @return array
     */
    private function GetMandelbrotSet()
    {
        /**
         * Call API GET
         */
        //$response = $this->curl_get_contents('http://192.168.214.83/api' .
        // '?realFrom=' . $this->realFrom .
        // '&realTo=' . $this->realTo .
        // '&imaginaryFrom=' . $this->imaginaryFrom .
        // '&imaginaryTo=' . $this->imaginaryTo .
        // '&intervall=' . $this->intervall .
        // '&maxIteration=' . $this->maxIteration . '');

        /**
         * Call API POST
         */
        $postServer = $this->server;

        foreach($this->coord as $coord) {
            $postData = array(
                'realFrom' => $coord["realFrom"],
                'realTo' => $coord["realTo"],
                'imaginaryFrom' => $coord["imaginaryFrom"],
                'imaginaryTo' => $coord["imaginaryTo"],
                'interval' => $coord["interval"],
                'maxIteration' => $coord["maxIteration"]
            );
            $response = $this->curl_post_content($postData, $postServer);
            $this->sets[] = $response;
        }

        /**
         * DrawMandelbrot
         * @array $this->coord
         * @array $this->sets
         */
        $drawMandelbrot = new DrawMandelbrot($this->coord, $this->sets);
        $drawMandelbrot->DrawMandelbrot();
    }
}
?>