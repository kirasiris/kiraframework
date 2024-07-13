<?php
  class Pages extends Controller{
    public function __construct(){
     
    }

    // Load Homepage
    public function index(){
      // If logged in, redirect to posts
      if(isset($_SESSION['userId'])){
        redirect('posts');
      }

      // Set Data
      $data = [
        'title' => FRAMEWORKNAME,
        'description' => FRAMEWORKDESCRIPTION
      ];

      // Load homepage/index view
      $this->view('pages/index', $data);
    }

    public function about(){
      //Set Data
      $data = [
        'version' => FRAMEWORKVERSION
      ];

      // Load about view
      $this->view('pages/about', $data);
    }
  }