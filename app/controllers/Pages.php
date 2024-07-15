<?php

namespace app\controllers;

use kira\core\Controller;
use kira\core\Database;

// use app\libraries\Error;

class Pages extends Controller
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    public function index()
    {
        // If logged in, redirect...

        // Set data
        $data = [
            'title' => 'Page Index',
            'description' => 'Page description'
        ];

        // Load welcome/index view
        $this->view('pages/index', $data);
    }

    public function about()
    {
        // If logged in, redirect...

        // Set data
        $data = [
            'title' => 'Page about',
            'description' => 'Page about description',
            'version' => '1.0.1'
        ];

        // Load welcome/index view
        $this->view('pages/about', $data);
    }
}