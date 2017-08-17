<?php

namespace App;

trait MagicSetterAndGetter {

    public function __set(String $property, $value) {
        $this->$property = $value;
        return $this;
    }

    public function __get(String $property) {
        return $this->$property;
    }
}
