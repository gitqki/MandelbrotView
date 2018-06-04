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

    private function fillPixel($im, $count_x, $count_y, $depth)
    {
        //echo "R: ".(85/((255 / $this->maxIterationInSet)*$depth)) . "G: "  .(255/((255 / $this->maxIterationInSet)*$depth)) . "B: " . (255/((255 / $this->maxIterationInSet)*$depth));echo "\n\f";
        // rgb(52,152,219)
        // rgb(155,89,182)
        $white_color = imagecolorallocatealpha($im, 155 / (($this->maxIterationInSet) / $depth), 89 / (($this->maxIterationInSet) / $depth), 182 / (($this->maxIterationInSet) / $depth), 0);
        imagepalettetotruecolor($im);
        imagesetpixel($im, $count_x, $count_y, $white_color);
    }

    public function DrawMandelbrot()
    {
        foreach()
        // Tell Site to be Type: Image
        header("Content-Type: image/png");
        $x_steps = count(range($this->coord[$i]["realFrom"], $this->coord[$i]["realTo"], $this->coord[$i]["interval"]));
        $y_steps = count(range($this->coord[$i]["imaginaryFrom"], $this->coord[$i]["imaginaryTo"], $this->coord[$i]["interval"]));

        // Resolution for Image
        $res_x = ($x_steps);
        $res_y = ($y_steps);

        // Create Image
        $im = @imagecreate($res_x, $res_y) or die("Cannot Initialize new GD image stream");

        // Set colors for the image
        $black_color = imagecolorallocatealpha($im, 0, 0, 0, 10);
        $white_color = imagecolorallocate($im, 187, 80, 13);

        imagefill($im, 0, 0, $black_color);

        // Fill Image Background

        $this->maxIterationInSet = max($this->sets[$i]);



        $count_x = 0;
        $count_y = 0;

        for ($i = 0; $i <= count($this->sets) - 1;) {




            // Resolution for Image
            $res_x = ($x_steps);
            $res_y = ($y_steps);

            // Set max Iteration found in Set
            $this->maxIterationInSet = max($this->sets[$i]);

            foreach ($this->sets[$i] as $set) {
                if ($count_y >= $y_steps) {
                    $count_x++;
                    $count_y = 0;
                }
                if ($set != 0) {
                    // Draw points into image
                    $this->fillPixel($im, $count_x, $count_y, $set);
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