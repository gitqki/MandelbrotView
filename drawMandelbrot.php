<?php

/**
 * Class DrawMandelbrot
 * @Author: Stefan Behnert
 * @Updated: 31.05.2018
 * @Email: st.behnert@gmail.com
 */
class DrawMandelbrot
{

    private $set;
    private $realFrom;
    private $realTo;
    private $imaginaryFrom;
    private $imaginaryTo;
    private $intervall;
    private $maxIteration;


    /**
     * DrawMandelbrot constructor.
     * @param $realFrom
     * @param $realTo
     * @param $imaginaryFrom
     * @param $imaginaryTo
     * @param $intervall
     * @param $maxIteration
     * @param $set
     */
    public function __construct($realFrom, $realTo, $imaginaryFrom, $imaginaryTo, $intervall, $maxIteration, $set)
    {
        $this->realFrom = $realFrom;
        $this->realTo = $realTo;
        $this->imaginaryFrom = $imaginaryFrom;
        $this->imaginaryTo = $imaginaryTo;
        $this->intervall = $intervall;
        $this->maxIteration = $maxIteration;
        $this->set = $set;
    }
    private function fillPixel($im, $count_x, $count_y, $depth) {
        $white_color = imagecolorallocatealpha($im, 198, 40, 40, ($depth * $this->maxIteration/100));
        imagepalettetotruecolor ( $im );
        imagesetpixel($im, $count_x, $count_y, $white_color);
    }
    /**
     *
     */
    public function draw()
    {
        // Tell Site to be Type: Image
        header("Content-Type: image/png");

        $x_steps = count(range($this->realFrom, $this->realTo, $this->intervall));
        $y_steps = count(range($this->imaginaryFrom, $this->imaginaryTo, $this->intervall));

        // Resolution for Image
        $res_x = ($x_steps);
        $res_y = ($y_steps);

        $im = @imagecreate($res_x, $res_y) or die("Cannot Initialize new GD image stream");

        // Color for Image
        $black_color = imagecolorallocatealpha($im, 0, 0, 0, 10);
        $white_color = imagecolorallocate($im, 255, 255, 255);

        imagefill($im, 0, 0, $black_color);



        $count_x = 0;
        $count_y = 0;

        foreach ($this->set as $set)
        {
            //echo $set;
            if ($count_y >= $y_steps)
            {
               // echo "<br>";
                $count_x++;
                $count_y = 0;
            }
            if ($set != 0)
            {
                // Draw Mandelbrot points
                $this->fillPixel($im, $count_x, $count_y, $set);
            }
            $count_y++;
        }
        imagepng($im);
        imagedestroy($im);
    }
}

?>