<?php

/**
 * Class DrawMandelbrot
 * @Author: Stefan Behnert
 * @Updated: 31.05.2018
 * @Email: st.behnert@gmail.com
 */
class DrawMandelbrot
{
    private $sets;
    private $maxIterationInSet;

    public function __construct($coord, $sets)
    {
        $this->sets = $sets;
        $this->coord = $coord;
    }

    private function fillPixel($im, $count_x, $count_y, $depth, $skip)
    {
        //echo "R: ".(85/((255 / $this->maxIterationInSet)*$depth)) . "G: "  .(255/((255 / $this->maxIterationInSet)*$depth)) . "B: " . (255/((255 / $this->maxIterationInSet)*$depth));echo "\n\f";
        // rgb(52,152,219)
        // rgb(155,89,182)
        if($skip) {
            $white_color = imagecolorallocatealpha($im, 0, 0, 0, 0);
            imagepalettetotruecolor($im);
            imagesetpixel($im, $count_x, $count_y, $white_color);
        } else {
            $white_color = imagecolorallocatealpha($im, 155 / (($this->maxIterationInSet) / $depth), 89 / (($this->maxIterationInSet) / $depth), 182 / (($this->maxIterationInSet) / $depth), 0);
            imagepalettetotruecolor($im);
            imagesetpixel($im, $count_x, $count_y, $white_color);
        }
    }

    public function DrawMandelbrot()
    {
        // Tell Site to be Type: Image
        header("Content-Type: image/png");

        $x_steps_full = 0;
        $y_steps_full = 0;

        for($c=0;$c<=count($this->sets)-1;) {
            $x_steps_full += count(range($this->coord[$c]["realFrom"], $this->coord[$c]["realTo"], $this->coord[$c]["interval"]));
            $y_steps_full += count(range($this->coord[$c]["imaginaryFrom"], $this->coord[$c]["imaginaryTo"], $this->coord[$c]["interval"]));
            $c++;
        }

        // Resolution for Image
        $res_x = ($x_steps_full);
        $res_y = ($y_steps_full);

        // Create Image
        $im = @imagecreate($res_x, $res_y) or die("Cannot Initialize new GD image stream");

        // Set colors for the image
        $black_color = imagecolorallocatealpha($im, 0, 0, 0, 0);
        $white_color = imagecolorallocate($im, 187, 80, 13);

        imagefill($im, 0, 0, $black_color);

        // Fill Image Background

        $count_x = 0;
        $count_y = 0;

        for ($i = 0; $i <= count($this->sets) - 1;) {

            $this->maxIterationInSet = max($this->sets[$i]);
            $x_steps = count(range($this->coord[$i]["realFrom"], $this->coord[$i]["realTo"], $this->coord[$i]["interval"]));
            $y_steps = count(range($this->coord[$i]["imaginaryFrom"], $this->coord[$i]["imaginaryTo"], $this->coord[$i]["interval"]));

            foreach ($this->sets[$i] as $set) {
                if ($count_y >= $y_steps_full) {
                    $count_x++;
                    $count_y = 0;
                }
                if ($set != 0) {
                    // Draw points into image
                    $this->fillPixel($im, $count_x, $count_y, $set, false);
                }
                $count_y++;
            }
            $i++;
        }
        imagepng($im);
        imagedestroy($im);
    }
}

?>