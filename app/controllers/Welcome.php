<?php

namespace app\controllers;

use kira\core\Controller;
use kira\core\Database;

// use app\libraries\Error;

class Welcome extends Controller
{
  protected $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function index()
  {
    // If logged in, redirect...

    // Set data
    $data = [
      'title' => 'Kira',
      'description' => 'The lightest PHP Framework to Build Amazing Applications'
    ];

    // Load welcome/index view
    $this->view('welcome/index', $data);
  }
}