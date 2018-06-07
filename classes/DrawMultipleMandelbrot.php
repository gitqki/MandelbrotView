<?php

/**
 * Class DrawMandelbrot
 * @Author: Stefan Behnert
 * @Email: st.behnert@gmail.com
 */
class DrawMultipleMandelbrot
{
    private $sets;
    private $coord;

    public function __construct($coordinations, $sets)
    {
        $this->coord = $coordinations;
        $this->sets = $sets;
    }

    private function fillPixel($im, $count_x, $count_y, $depth, $maxIteration)
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
        if ($depth == $maxIteration) {
            $rgba_purple = imagecolorallocatealpha($im, 41, 128, 185, 0);
        } else {
            $rgba_purple = imagecolorallocatealpha($im, 41 / (($maxIteration) / $depth), 128 / (($maxIteration) / $depth), 185 / (($maxIteration) / $depth), 0);
        }

        // Set Pixel and keep alpha
        imagepalettetotruecolor($im);
        imagesetpixel($im, $count_x, $count_y, $rgba_purple);

    }

    public function DrawMultipleMandelbrot()
    {
        // Tell Site to be Type: Image
        header("Content-Type: image/png");

        $x_steps = array();
        $y_steps = array();

        for ($c = 0; $c <= count($this->sets) - 1;) {
            // merge all ranges from realFrom to realTo and imaginaryFrom to imaginaryTo
            $x_steps = array_merge($x_steps, range($this->coord[$c]["realFrom"], $this->coord[$c]["realTo"], $this->coord[$c]["interval"]));
            $y_steps = array_merge($y_steps, range($this->coord[$c]["imaginaryFrom"], $this->coord[$c]["imaginaryTo"], $this->coord[$c]["interval"]));
            $c++;
        }

        // Resolution for Image
        // Set array unique to remove all even entries
        $res_x = (count(array_unique($x_steps)));
        $res_y = (count(array_unique($y_steps)));

        // Create Image
        $im = @imagecreate($res_x, $res_y) or die("Cannot Initialize new GD image stream");

        // Set colors for the image
        $rgba_black = imagecolorallocatealpha($im, 0, 0, 0, 0);

        // Fill Image Background
        imagefill($im, 0, 0, $rgba_black);

        // Merge all sets together
        $complete_set = array();
        foreach ($this->sets as $set) {
            foreach ($set as $key => $s) {
                if (!isset($complete_set[$key])) {
                    $complete_set[$key] = array();
                }
                $complete_set[$key] += $s;
                ksort($complete_set[$key]);
            }
        }
        // Sort them for drawing purpose
        ksort($complete_set);

        // Draw set
        $count_x = 0;

        foreach ($complete_set as $key_x => $set_x) {
            $count_y = 0;
            foreach ($set_x as $key_y => $set_y) {
                if ($set_y != 0) {
                    // Draw points into image
                    $this->fillPixel($im, $count_x, $count_y, $set_y, $this->coord[0]["maxIteration"]);
                }
                $count_y++;
            }
            $count_x++;
        }
        imagepng($im);
        imagedestroy($im);
    }
}

?>