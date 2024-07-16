<?php

namespace app\controllers;

use kira\core\Database;

class Error
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    /*
     * 404 not found error
     * 
     * @return void
     */
    public static function notFound($message = 'Resource not found')
    {
        http_response_code(404);

        $data = [
            'status' => '404',
            'message' => $message
        ];

        loadView('error', $data);

    }

    /*
     * 403 unauthorized error
     * 
     * @return void
     */
    public static function unauthorized($message = 'You are not authorized to view this resource')
    {
        http_response_code(403);

        $data = [
            'status' => '403',
            'message' => $message
        ];

        loadView('error', $data);
    }
}