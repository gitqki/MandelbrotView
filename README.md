# MandelbrotView

### How to: View Mandelbrot?

1. Xampp oder PhpStorm starten. 
2. Das Projekt in das entsprechende Verzeichnis ablegen
3. *{ip-adresse}*/MandelbrotView/ 

### How to: Test?

1. Punkt 1 und 2 s.o.
2. *{ip-adresse}*/MandelbrotView/tests/

Durch ein vordefiniertes Mandelbrot-set, welches in einem JSON-File hinterlegt wurde, kann die Zeichnung
direkt durchgeführt werden, ohne dafür eine API ansprechen zu müssen.

*Verzeichnis: tests/*

### Post Request an eine API

Empfohlene API: [@BlackAlucarDs](https://github.com/BlackAlucarD/) [MandelbrotServer](https://github.com/BlackAlucarD/MandelBrotServer)

Die API erwartet ein JSON header mit einem POST Request mit folgenden Schlüsseln:

```
{
    "realFrom" : "-2",
    "realTo" : "2",
    "imaginaryFrom" : "-2",
    "imaginaryTo" : "2",
    "intervall" : "0.01",
    "maxIteration" : "255"
}
```

Diese Anfrage kann in der index.php bequem angepasst werden:

``` 
$mandelbrotCoordinates[] = array(
    "realFrom" => -1.1883796296296296,
    "realTo" => -1.1121425925925925,
    "imaginaryFrom" => 0.24499722222222214,
    "imaginaryTo" => 0.30217499999999997,
    "interval" => 0.003,
    "maxIteration" => 255
);
```

Zurück bekommen wir ein JSON-Objekt, welches wir als Array weiterverarbeiten.

### How to: View Anpassen ?

In der Klasse *DrawMandelbrot* kann folgende Funktion angepasst werden, um die ausgegebene Mandelbrotfarbe anzupassen:
```
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
```

## Example result:
![Example](https://user-images.githubusercontent.com/30159814/40937451-f646ece0-683e-11e8-8e46-0357a98975d8.png)