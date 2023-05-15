<?php
require '../vendor/autoload.php';

function e404()
{
    require '../public/404.php';
    exit();
}
function dd(...$var)
{
    foreach ($var as $v) {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }
}
function get_pdo(): PDO
{
    return $pdo = new PDO('mysql:host=localhost;dbname=calendar', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
}
function h(string $value): string
{
    if ($value === null) {
        return '';
    }
    return htmlentities($value);
}
function render(string $view, $parameters = [])
{
    extract($parameters);
    include '../views/' . $view . '.php';
}
function render_admin(string $view, $parameters = [])
{
    extract($parameters);
    include '../views/admin/' . $view . '.php';
}