<?php
/**
 * Created by PhpStorm.
 * User: Stefan Behnert
 * Date: 04.06.2018
 * Time: 09:26
 */

spl_autoload_register(function ($class_name) {
    include "classes/".$class_name . '.php';
});