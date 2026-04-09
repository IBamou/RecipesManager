<?php

abstract class Controller {
    protected $baseUrl;
    
    public function __construct() {
        define('BASE_URL', 'http://localhost/recipesManager');
        $this->baseUrl = BASE_URL;
    }
}