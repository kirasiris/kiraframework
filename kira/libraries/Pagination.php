<?php
/* 
 *  PAGINATION CLASS
 *  URL: https://www.udemy.com/course/object-oriented-php-mvc/learn/lecture/8287310#questions/3016766
 *  Example: https://www.udemy.com/course/object-oriented-php-mvc/learn/lecture/8287310#questions/3016766
 *  Author: https://www.udemy.com/user/6ea1a271-8fe0-4ed0-930e-947cb0ebad42/
 */

namespace kira\libraries;

class Pagination
{

    public $current_page;
    public $per_page;
    public $total_count;

    public function __construct($page = 1, $per_page = 20, $total_count)
    {
        $this->current_page = (int) $page;
        $this->per_page = (int) $per_page;
        $this->total_count = isset($total_count->numevents) ? (int) $total_count->numevents : 0;
    }

    public function offset()
    {
        return $this->per_page * ($this->current_page - 1);
    }

    public function total_pages()
    {
        return ceil($this->total_count / $this->per_page);
    }

    public function next_page()
    {
        $next = $this->current_page + 1;
        return ($next <= $this->total_pages()) ? $next : false;
    }

    public function previous_page()
    {
        $prev = $this->current_page - 1;
        return ($prev > 0) ? $prev : false;
    }
}