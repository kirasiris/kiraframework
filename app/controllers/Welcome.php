<?php
  class Welcome extends Controller{
    public function __construct(){
      if(isset($_SESSION['userId'])){
        redirect('posts');
      }
    }

    public function index(){
      // If logged in, redirect...

      // Set data
      $data = [
        'title' => FRAMEWORKNAME,
        'description' => FRAMEWORKDESCRIPTION
      ];

      // Load welcome/index view
      $this->view('welcome/index', $data);
    }
  }