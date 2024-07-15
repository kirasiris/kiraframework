<?php
/* 
 *  CORE MODEL CLASS
 *  Setup DB logic
 */

namespace kira\core;

class Model extends Core
{
    public function __construct($name)
    {
        $this->model($name);
    }
}