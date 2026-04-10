<?php

abstract class Controller {
    protected $baseUrl;
    
    public function __construct() {
        $this->baseUrl = BASE_URL;
    }
}
