<?php

Class CalcMandelbrot
{
    public $realTo;
    public $realFrom;
    public $imaginaryTo;
    public $imaginaryFrom;
    public $interval;
    public $maxIteration;
    public $multiDimensionalArraySet;

    /**
     * CalcMandelbrot constructor.
     * @param $realTo
     * @param $realFrom
     * @param $imaginaryTo
     * @param $imaginaryFrom
     * @param $interval
     * @param $maxIterarion
     */
    public function __construct($realFrom, $realTo, $imaginaryFrom, $imaginaryTo, $interval, $maxIteration)
    {
        $this->realFrom = $realFrom;
        $this->realTo = $realTo;
        $this->imaginaryFrom = $imaginaryFrom;
        $this->imaginaryTo = $imaginaryTo;
        $this->interval = $interval;
        $this->maxIteration = $maxIteration;
        $this->multiDimensionalArraySet = false;
    }

    //Returns of set of complex points within the Mandelbrot set
    public function defineSet()
    {
        $set = array();
        $rangex = range($this->realFrom, $this->realTo, $this->interval);
        $rangey = range($this->imaginaryFrom, $this->imaginaryTo, $this->interval);
        foreach ($rangex as $r) {
            foreach($rangey as $i) {
                $current = new complex();
                $current->real = $r;
                $current->imaginary = $i;
                if ($this->multiDimensionalArraySet) {
                    $set[$r . ""][$i . ""] = $this->inMandelbrot($current, $this->maxIteration);
                } else {
                    $set[] = $this->inMandelbrot($current, $this->maxIteration);
                }

            }
        }
        $result = $set;
        return $result;
    }
    function mandelbrot($z, $current)
    {
        return $z->times($z)->plus($current);
    }

    //Returns a 0 if point is in set (given escape depth); if not in set, returns the number of iterations before escaping
    public function inMandelbrot($point, $maxIteration)
    {
        $zn = new complex();
        $zn->real = 0;
        $zn->imaginary = 0;
        for ($i = 0; $i < $maxIteration; $i++) {
            $zn = $this->mandelbrot($zn, $point);
            if ($zn->magnitude() >= 2) {
                return $i;
            }
        }
        return $i;
    }
}

