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
    private $maxIterationInSet;
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
        //echo "R: ".(85/((255 / $this->maxIterationInSet)*$depth)) . "G: "  .(255/((255 / $this->maxIterationInSet)*$depth)) . "B: " . (255/((255 / $this->maxIterationInSet)*$depth));echo "\n\f";
        // rgb(52,152,219)
        // rgb(155,89,182)
        $white_color = imagecolorallocatealpha($im, 155/(($this->maxIterationInSet)/$depth), 89/(($this->maxIterationInSet)/$depth), 182/(($this->maxIterationInSet)/$depth), 0);
        imagepalettetotruecolor ( $im );
        imagesetpixel($im, $count_x, $count_y, $white_color);
    }

    public function DrawMandelbrot()
    {
        // Tell Site to be Type: Image
        header("Content-Type: image/png");
        $x_steps = count(range($this->realFrom, $this->realTo, $this->intervall));
        $y_steps = count(range($this->imaginaryFrom, $this->imaginaryTo, $this->intervall));

        // Resolution for Image
        $res_x = ($x_steps);
        $res_y = ($y_steps);

        // Create Image
        $im = @imagecreate($res_x, $res_y) or die("Cannot Initialize new GD image stream");

        // Set colors for the image
        $black_color = imagecolorallocatealpha($im, 0, 0, 0, 10);
        $white_color = imagecolorallocate($im, 187, 80, 13);

        // Fill Image Background
        imagefill($im, 0, 0, $black_color);

        // Set max Iteration found in Set
        $this->maxIterationInSet = max($this->set);
        $count_x = 0;
        $count_y = 0;

        foreach ($this->set as $set)
        {
            //echo $set;
            if ($count_y >= $y_steps)
            {
                //echo "<br>";
                $count_x++;
                $count_y = 0;
            }
            if ($set != 0)
            {
                // Draw points into image
                $this->fillPixel($im, $count_x, $count_y, $set);
            }
            $count_y++;
        }
        imagepng($im);
        imagedestroy($im);
    }
}
?>