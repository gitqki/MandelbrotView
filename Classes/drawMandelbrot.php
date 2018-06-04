<?php
/**
 * Class DrawMandelbrot
 * @Author: Stefan Behnert
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
        /** Some Colors to play with **/
        // rgb(52,152,219)  - Light Blue
        // rgb(155,89,182)  - Light Purple
        // rgb(236,240,241) - Light Grey
        // rgb(46,204,113)  - Light Green
        // rgb(39,174,96)   - Dark Green
        // rgb(44,62,80)    - Dark Blue
        // rgb(41,128,185)  - Dark Purple

        // If $depth is 255 or greater, paint the pixel rgb(41,128,185)
        if (255 / (($this->maxIterationInSet) / $depth) >= 255) {
            $color = imagecolorallocatealpha($im, 41, 128, 185, 0);
        } else { // If $depth is less than 255, paint the pixel rgb(41,128,185) with division by $depth to get a lighter color
            $color = imagecolorallocatealpha($im, 41 / (($this->maxIterationInSet) / $depth), 128 / (($this->maxIterationInSet) / $depth), 185 / (($this->maxIterationInSet) / $depth), 0);
        }
        // Set Pixel and keep alpha
        imagepalettetotruecolor($im);
        imagesetpixel($im, $count_x, $count_y, $color);
    }

    public function DrawMandelbrot()
    {
        // Tell Site to be Type: Image
        header("Content-Type: image/png");

        $x_steps_full = 0;
        $y_steps_full = 0;

        for($c=0;$c<=count($this->sets)-1;) {
            $x_steps_full = count(range($this->coord[$c]["realFrom"], $this->coord[$c]["realTo"], $this->coord[$c]["interval"]));
            $y_steps_full = count(range($this->coord[$c]["imaginaryFrom"], $this->coord[$c]["imaginaryTo"], $this->coord[$c]["interval"]));
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

        // Fill image background
        imagefill($im, 0, 0, $black_color);

        $count_x = 0;
        $count_y = 0;

        for ($i = 0; $i <= count($this->sets) - 1;) {

            // If set doesn't have maxIteration as given, get highest iteration in set
            $this->maxIterationInSet = max($this->sets[$i]);

            foreach ($this->sets[$i] as $set) {
                if ($count_y >= $y_steps_full) {
                    $count_x++;
                    $count_y = 0;
                }
                if ($set != 0) {
                    // set pixel at the coordinate
                    $this->fillPixel($im, $count_x, $count_y, $set, false);
                }
                $count_y++;
            }
            $i++;
        }
        // Create image
        imagepng($im);
        // Delete image from cache
        imagedestroy($im);
    }
}

?>