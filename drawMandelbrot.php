<?php

/**
 * Class DrawMandelbrot
 * @Author: Stefan Behnert
 * @Updated: 31.05.2018
 * @Email: st.behnert@gmail.com
 */
class DrawMandelbrot
{

    public $set;
    public $res;
    public $real;
    public $bsize;
    public $imaginary;

    /**
     * DrawMandelbrot constructor.
     * @param $bsize
     * @param $res
     * @param $real
     * @param $imaginary
     */
    function __construct($bsize, $res, $real, $imaginary, $set)
    {
        $this->bsize = $bsize;
        $this->res = $res;
        $this->real = $real;
        $this->imaginary = $imaginary;
        $this->set = $set;
    }

    /**
     *
     */
    function draw()
    {
        // Tell Site to be Type: Image
        header("Content-Type: image/png");

        // Resolution for Image
        $res_x = (4.5 / $this->res);
        $res_y = (4.5 / $this->res);

        $im = @imagecreate($res_x, $res_y) or die("Cannot Initialize new GD image stream");

        // Color for Image
        $black_color = imagecolorallocate($im, 0, 0, 0);
        $white_color = imagecolorallocate($im, 255, 255, 255);

        imagefill($im, 0, 0, $black_color);

        $x_steps = count(range($this->real, $this->real + $this->bsize, $this->res));
        $y_steps = count(range($this->imaginary, $this->imaginary + $this->bsize, $this->res));

        $count_x = 0;
        $count_y = 0;

        foreach ($this->set as $set)
        {
            if ($count_y >= $y_steps)
            {
                $count_x++;
                $count_y = 0;
            }
            if ($set != 0)
            {
                // Draw Mandelbrot points
                imagesetpixel($im, $count_x, $count_y, $white_color);
            }
            $count_y++;
        }
        imagepng($im);
        imagedestroy($im);
    }
}

?>