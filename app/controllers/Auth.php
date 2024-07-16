<?php

namespace app\Controllers;

use kira\core\Controller;
use kira\core\Database;
use kira\libraries\Session;
use kira\libraries\Validation;

class Auth extends Controller
{
    protected $db;

    public function __construct()
    {

        $this->db = new Database();
    }

    /*
     * Profile page
     *
     */
    public function profile()
    {
        $data = Session::get('user');
        $this->view('auth/profile', $data);
    }

    /**
     * Show the login page
     * 
     * @return void
     */
    public function login()
    {
        $this->view('auth/login');
    }

    /**
     * Show the register page
     * 
     * @return void
     */
    public function register()
    {
        $this->view('auth/register');
    }

    /**
     * Store user in database
     * 
     * @return void
     */
    public function store()
    {
        $username = $_POST['username'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordConfirmation = $_POST['password_confirmation'];

        $errors = [];

        // Validation
        if (!Validation::string($username, 2, 50)) {
            $errors['username'] = 'Username must be between 2 and 50 characters';
        }

        if (!Validation::string($name, 2, 50)) {
            $errors['name'] = 'Username must be between 2 and 50 characters';
        }

        if (!Validation::email($email)) {
            $errors['email'] = 'Please enter a valid email address';
        }

        if (!Validation::string($password, 6, 50)) {
            $errors['password'] = 'Password must be at least 6 characters';
        }

        if (!Validation::match($password, $passwordConfirmation)) {
            $errors['password_confirmation'] = 'Passwords do not match';
        }

        if (!empty($errors)) {
            $this->view('/auth/register', [
                'errors' => $errors,
                'user' => [
                    'username' => $username,
                    'name' => $name,
                    'email' => $email,

                ]
            ]);
            exit;
        }

        // Check if email exists
        $params = [
            'email' => $email
        ];

        $user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();

        if ($user) {
            $errors['email'] = 'That email already exists';
            $this->view('/auth/register', [
                'errors' => $errors
            ]);
            exit;
        }

        // Create user account
        $params = [
            'username' => $username,
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        $this->db->query('INSERT INTO users (username, name, email, password) VALUES (:username, :name, :email, :password)', $params);

        // Get new user ID
        $userId = $this->db->connection->lastInsertId();

        // Set user session
        Session::set('user', [
            'id' => $userId,
            'username' => $username,
            'name' => $name,
            'email' => $email,
        ]);

        redirect('/auth/profile');
    }

    /**
     * Logout a user and kill session
     * 
     * @return void
     */
    public function logout()
    {
        Session::clearAll();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 86400, $params['path'], $params['domain']);

        redirect('/');
    }

    /**
     * Authenticate a user with email and password
     * 
     * @return void
     */
    public function authenticate()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $errors = [];

        // Validation
        if (!Validation::email($email)) {
            $errors['email'] = 'Please enter a valid email';
        }

        if (!Validation::string($password, 6, 50)) {
            $errors['password'] = 'Password must be at least 6 characters';
        }

        // Check for errors
        if (!empty($errors)) {
            $this->view('/auth/login', [
                'errors' => $errors
            ]);
            exit;
        }

        // Check for email
        $params = [
            'email' => $email
        ];

        $user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();

        if (!$user) {
            $errors['email'] = 'Incorrect credentials';
            $this->view('/auth/login', [
                'errors' => $errors
            ]);
            exit;
        }

        // Check if password is correct
        if (!password_verify($password, $user->password)) {
            $errors['email'] = 'Incorrect credentials';
            $this->view('/auth/login', [
                'errors' => $errors
            ]);
            exit;
        }

        // Set user session
        Session::set('user', [
            'id' => $user->id,
            'username' => $user->username,
            'name' => $user->name,
            'email' => $user->email,
        ]);

        redirect('/auth/profile');
    }
}