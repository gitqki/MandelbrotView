<?php
/**
 * Class GetMandelbrot
 * @Author: Stefan Behnert
 * @Email: st.behnert@gmail.com
 */

Class GetMandelbrotSet
{
    public $server;
    public $sets;
    public $coordinations;

    /**
     * GetMandelbrotSet constructor.
     * @param array $coordinations
     */
    public function __construct($coordinations)
    {
        $this->coordinations = $coordinations;
        $this->GetMandelbrotSet();
    }

    /**
     * @param String $url
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
     * @param array $postData
     * @param String $server
     * @return mixed
     */
    private function curl_post_content($postData, $server)
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
        return $json["response"];
    }

    /**
     * Get calculated SET of Mandelbrot from Server.
     * @return array
     */
    private function GetMandelbrotSet()
    {
        /**
         * GET request
         */
        //$response = $this->curl_get_contents({server});

        /**
         * POST request
         */
        foreach ($this->coordinations as $coordination) {
            $postData = array(
                'realFrom' => $coordination["realFrom"],
                'realTo' => $coordination["realTo"],
                'imaginaryFrom' => $coordination["imaginaryFrom"],
                'imaginaryTo' => $coordination["imaginaryTo"],
                'interval' => $coordination["interval"],
                'maxIteration' => $coordination["maxIteration"]
            );
            $response = $this->curl_post_content($postData, $coordination["server"]);
            $this->sets[] = $response;
        }

        /**
         * DrawMandelbrot
         * @param array $this->coordinations
         * @param array $this->sets
         */
        $drawMandelbrot = new DrawMandelbrot($this->coordinations, $this->sets);
        $drawMandelbrot->DrawMandelbrot();
    }
}

?>