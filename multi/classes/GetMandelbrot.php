<?php
/**
 * Class GetMandelbrot
 * @Author: Stefan Behnert
 * @Updated: 31.05.2018
 * @Email: st.behnert@gmail.com
 */
Class GetMandelbrot
{
    public $server;
    public $set;
    public $sets;
    public $coordinations;

    public function __construct($coordinations)
    {
        $this->coordinations = $coordinations;
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
     * @param $postData
     * @param $server
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
        return $json["response"];

    }

    private function CalcMandelbrot()
    {
        /**
         * Get request
         */
        //$response = $this->curl_get_contents({server});

        /**
         * Post request
         */
        foreach($this->coordinations as $coordination) {
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
         */
        $drawMandelbrot = new DrawMandelbrot($this->coordinations, $this->sets);
        $drawMandelbrot->DrawMandelbrot();
    }
}
?>