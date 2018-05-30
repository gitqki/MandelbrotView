<?php
include_once 'calcMandelbrot.php';
class DrawMandelbrot
{
    public $set;
    public $res;
    public $real;
    public $steps;
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
        $x_steps = count(range($this->real, $this->real+$this->bsize, $this->res));
        $y_steps = count(range($this->imaginary, $this->imaginary+$this->bsize, $this->res));

        $res_x = ($x_steps);
        $res_y = ($y_steps);

        $im = @imagecreate($res_x, $res_y) or die("Cannot Initialize new GD image stream");

        // Färbt den Hintergrund
        $white_color = imagecolorallocate($im, 255, 255, 255);
        imagefill($im, 0, 0, $white_color);

        header("Content-Type: image/png");
        $black_color = imagecolorallocate($im, 0, 0, 0);

        $count_x = 0;
        $count_y = 0;
        foreach($this->set as $resp){
            $count_y++;
            if ($resp != 0) {
                echo $count_x;

                imagesetpixel($im, $count_x, $count_y, $black_color);
            }

            if($count_y >= $y_steps){
                $count_x++;
                $count_y = 0;
            }

        }
        imagepng($im);
        imagedestroy($im);
    }
}
new DrawMandelbrot(4, 0.05, -2, -2);
?>