<?php
/* 
 *  CORE CONTROLLER CLASS
 *  Setup DB return types such as fetchAll, fetch, and so on
 */

namespace kira\core;

class Controller extends Core
{
   public function __construct($name)
   {
      $this->controller($name);
   }
}