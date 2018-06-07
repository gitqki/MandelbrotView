<?php
Class Complex {

    public $real = 0;
    public $imaginary = 0;

    //Returns the product of two complex numbers
    public function times($other) {
        $result = new complex();
        $result->real = ($this->real*$other->real) - ($this->imaginary*$other->imaginary);
        $result->imaginary = ($this->real*$other->imaginary) + ($this->imaginary*$other->real);
        return $result;
    }

    //Returns the sum of two complex numbers
    public function plus($other) {
        $result = new complex();
        $result->real = $this->real+$other->real;
        $result->imaginary = $this->imaginary+$other->imaginary;
        return $result;
    }

    //Returns the Euclidean distance between the complex number and the origin on the complex plane
    public function magnitude() {
        return sqrt(pow($this->real, 2)+pow($this->imaginary, 2));
    }
}
