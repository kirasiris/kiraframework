<?php
/* 
 *  CORE VIEW CLASS
 *  Setup DB return types such as fetchAll, fetch, and so on
 */

namespace kira\core;

class View extends Core
{
    public function __construct($url)
    {
        $this->view($url);
    }
}