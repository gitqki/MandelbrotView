<?php
include_once 'calcMandelbrot.php';
class DrawMandelbrot
{
    public $post_res_x;
    public $post_res_y;
    public $min_x;
    public $min_y;
    public $max_x;
    public $max_y;

    function __construct($bsize, $res, $real, $imaginary)
    {

        $calcMb = new CalcMandelbrot($bsize, $res, $real, $imaginary);
        $this->post_res_x = $calcMb->res;
        $this->post_res_y = $calcMb->res;
        $this->min_x = $calcMb->real;
        $this->min_y = $calcMb->imaginary;
        $this->max_x = $calcMb->bsize;
        $this->max_y = $calcMb->bsize;
        self::draw();
    }

    function draw()
    {

        $res_x = ($this->post_res_x * 100);
        $res_y = ($this->post_res_y * 100);

        $im = @imagecreate($res_x, $res_y) or die("Cannot Initialize new GD image stream");
        header("Content-Type: image/png");
        $black_color = imagecolorallocate($im, 0, 0, 0);
        $white_color = imagecolorallocate($im, 255, 255, 255);

        for ($y = 0; $y <= $res_y; $y++) {
            for ($x = 0; $x <= $res_x; $x++) {
                $c1 = $this->min_x + ($this->max_x - $this->min_x) / $res_x * $x;
                $c2 = $this->min_y + ($this->max_y - $this->min_y) / $res_y * $y;

                $z1 = 0;
                $z2 = 0;

                for ($i = 0; $i < 100; $i++) {
                    $new1 = $z1 * $z1 - $z2 * $z2 + $c1;
                    $new2 = 2 * $z1 * $z2 + $c2;
                    $z1 = $new1;
                    $z2 = $new2;
                    if ($z1 * $z1 + $z2 * $z2 >= 4) {
                        break;
                    }
                }
                if ($i < 100) {

                    echo $y;
                    //imagesetpixel($im, $x, $y, $white_color);
                }
            }
        }

        imagepng($im);
        imagedestroy($im);
    }

}
new DrawMandelbrot(2,0.1,-2,-2);
?>