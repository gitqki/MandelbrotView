# MandelbrotView

### Prepare

1. Xampp oder PhpStorm starten. 
2. Das Projekt in das entsprechende Verzeichnis ablegen


### How to: Test?

1. Punkt 1 und 2 s.o.
2. *{ip-adresse}/MandelbrotView/tests/*

Durch ein vordefiniertes Mandelbrot-set, welches in einem JSON-File hinterlegt wurde, kann die Zeichnung
direkt durchgeführt werden, ohne dafür eine API ansprechen zu müssen.

### Single Post Request an eine API

1. Punkt 1 und 2 s.o.
2. *{ip-adresse}/MandelbrotView/*

*Empfohlene API: [MandelbrotServer](https://github.com/BlackAlucarD/MandelBrotServer)

Die API erwartet ein JSON header mit einem POST Request mit folgenden Schlüsseln:

```
{
    "realFrom" : "-2",
    "realTo" : "2",
    "imaginaryFrom" : "-2",
    "imaginaryTo" : "2",
    "interval" : "0.01",
    "maxIteration" : "255"
}
```

Diese Anfrage kann in der index.php bequem angepasst werden:

``` 
$mandelbrotCoordinates[] = array(
    "server" => "{server}"
    "realFrom" => -1.1883796296296296,
    "realTo" => -1.1121425925925925,
    "imaginaryFrom" => 0.24499722222222214,
    "imaginaryTo" => 0.30217499999999997,
    "interval" => 0.003,
    "maxIteration" => 255
);
```

### Multi Post requests an eine oder mehrere APIs

1. Punkt 1 und 2 s.o.
2. ```{ip-adresse}/MandelbrotView/multi/```

*Empfohlene API: [MandelbrotServer](https://github.com/BlackAlucarD/MandelBrotServer)

Die API erwartet ein JSON header mit einem POST Request mit folgenden Schlüsseln:


```
/**
 * same value needed for interval and maxIteration
 */
$getMandelbrotSet[] = array(
    "server" => "{server}", 
    "realFrom" => -2,
    "realTo" => 0, 
    "imaginaryFrom" => 0, 
    "imaginaryTo" => 2, 
    "interval" => 0.05, 
    "maxIteration" => 255
);
$getMandelbrotSet[] = array("server" => "http://192.168.214.83/multi", "realFrom" => 0,"realTo" => 1, "imaginaryFrom" => 0, "imaginaryTo" => 2, "interval" => 0.05, "maxIteration" => 255);
$getMandelbrotSet[] = array("server" => "http://192.168.214.83/multi", "realFrom" => -2,"realTo" => 0, "imaginaryFrom" => -2, "imaginaryTo" => 0, "interval" => 0.05, "maxIteration" => 255);
$getMandelbrotSet[] = array("server" => "http://192.168.214.83/multi", "realFrom" => 0,"realTo" => 1, "imaginaryFrom" => -2, "imaginaryTo" => 0, "interval" => 0.05, "maxIteration" => 255);
```

Wir erwarten als Antwort ein Multidimensionales array:

Bsp.:
```
{
 "0":
    {"-2":0,"-1.5":1,"-1":255,"-0.5":255,"0":255},
 "0.5":
    {"-2":0,"-1.5":1,"-1":1,"-0.5":4,"0":4},
 "1":
    {"-2":0,"-1.5":1,"-1":1,"-0.5":1,"0":1}
}
```
### How to: View Anpassen ?

In der Klasse *DrawMandelbrot* kann folgende Funktion angepasst werden, um die ausgegebene Mandelbrotfarbe anzupassen:

- *classes/DrawMandelbrot.php*
- *multi/classes/DrawMandelbrot.php*


### Example result:
![Example](https://user-images.githubusercontent.com/30159814/40937451-f646ece0-683e-11e8-8e46-0357a98975d8.png)