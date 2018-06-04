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
    public $set;
    public $sets;
    public $coord;

    public function __construct($server , $coord)
    {
        $this->server = $server;
        $this->coord = $coord;
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

        for($i=0;$i<=count($this->coord)-1;) {
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
            $this->sets[$i] = $json["response"];
            $i++;
        }

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

        for($i=0;$i<=count($this->coord)-1;){
            $postData[$i] = array(
                'realFrom' => $this->coord[$i]["realFrom"],
                'realTo' => $this->coord[$i]["realTo"],
                'imaginaryFrom' => $this->coord[$i]["imaginaryFrom"],
                'imaginaryTo' => $this->coord[$i]["imaginaryTo"],
                'interval' => $this->coord[$i]["interval"],
                'maxIteration' => $this->coord[$i]["maxIteration"]
            );

            $this->curl_post_content($postData[$i], $postServer);
            $i++;
        }

        /**
         * DrawMandelbrot
         */

        $drawMandelbrot = new DrawMandelbrot($this->coord, $this->sets);
        $drawMandelbrot->DrawMandelbrot();
    }
}
?>