<?php
include_once 'calcMandelbrot.php';

class DrawMandelbrot
{
    public $set;
    public $res;
    public $real;
    public $bsize;
    public $imaginary;
    public $post_res_x;
    public $post_res_y;

    function __construct($bsize, $res, $real, $imaginary)
    {

        $calcMb = new CalcMandelbrot($bsize, $res, $real, $imaginary);
        $calcMb->calc();
        $this->set = $calcMb->set;
        $this->real = $calcMb->real;
        $this->bsize = $calcMb->bsize;
        $this->imaginary = $calcMb->imaginary;
        $this->post_res_x = $calcMb->res;
        $this->post_res_y = $calcMb->res;
        $this->res = $calcMb->res;
        self::draw();
    }

    function draw()
    {

        $res_x = ($this->post_res_x * 800);
        $res_y = ($this->post_res_y * 600);

        $im = @imagecreate($res_x, $res_y) or die("Cannot Initialize new GD image stream");
        //header("Content-Type: image/png");
        $black_color = imagecolorallocate($im, 0, 0, 0);
        $white_color = imagecolorallocate($im, 255, 255, 255);

        $y_set = range($this->real, $this->bsize, $this->res);
        $o = count($y_set);

        for ($i = 0; $i <= $o - 1; $i++) {

            $x = $this->set[$i];
            $y = $y_set[$i];

            imagesetpixel($im, $x, $y, $white_color);

        }

        imagepng($im);
        imagedestroy($im);
    }

}

new DrawMandelbrot(2, 0.1, -2, -2);
?>