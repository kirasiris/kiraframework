<?php

/**
 * Get the base path
 * 
 * @param string $path
 * @return string
 */
function basePath($path = '')
{
    return __DIR__ . '/' . $path;
}

/**
 * Inspect a value(s)
 * 
 * @param mixed $value
 * @return void
 */
function inspect($value)
{
    $output = $value;
    if (is_array($output))
        $output = implode(",", $output);
    echo '<pre>';
    var_dump($output);
    echo '</pre>';
}

/**
 * Inspect a value(s) and die
 * 
 * @param mixed $value
 * @return void
 */
function inspectAndDie($value)
{
    $output = $value;
    if (is_array($output))
        $output = implode(",", $output);
    echo '<pre>' + die(var_dump($output)) + '</pre>';
}

/**
 * Load a partial
 * 
 * @param string $name
 * @return void
 * 
 */

function loadPartial($name, $data = [])
{
    $partialPath = basePath("app/views/partials/{$name}.php");

    if (file_exists($partialPath)) {
        extract($data);
        require $partialPath;
    } else {
        echo "Partial '{$name} not found!'";
    }
}

function loadView($name, $data = [])
{

    $viewPath = require basePath("app/views/{$name}.php");

    if (file_exists($viewPath)) {
        extract($data);
        require $viewPath;
    }
}

/**
 * Redirect to a given url
 * 
 * @param string $url
 * @return void
 */
function redirect($url)
{
    header("Location: {$url}");
    exit;
}

/**
 * Sanitize Data
 *
 * @param string $dirty
 * @return string
 */
function sanitize($dirty)
{
    return filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
}