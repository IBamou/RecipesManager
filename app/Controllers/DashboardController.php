<?php

class DashboardController extends Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        include __DIR__ . '/../Views/dashboard/index.php';
    }
}
