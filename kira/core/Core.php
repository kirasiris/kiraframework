<?php
/* 
 *  APP CORE CLASS
 *  Creates URL & Loads Core Controller
 *  URL Format - /controller/method/param1/param2/and so on
 */

namespace kira\core;

use kira\core\Database;

class Core
{

  protected $db;

  public function __construct()
  {
    $config = require basePath("config/db.php");
    $this->db = new Database($config);
  }

  public function model($model)
  {
    $model = require basePath("app/models/{$model}.php");

    if (file_exists($model)) {
      return new $model();
    } else {
      echo "Model: '{$model}' not found!";
    }
  }

  public function view($name, $data = [])
  {

    $viewPath = require basePath("app/views/{$name}.php");

    if (file_exists($viewPath)) {
      extract($data);
      require $viewPath;
    } else {
      echo "View {$name} not found!";
    }
  }

  public function controller($controller)
  {
    $viewPath = require basePath("app/controllers/{$controller}.php");

    if (file_exists($viewPath)) {
      require $viewPath;
    } else {
      echo "Model: '{$controller}' not found!";
    }
  }
}