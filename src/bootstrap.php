<?php
require '../vendor/autoload.php';

function e404()
{
    require '../public/404.php';
    exit();
}
function dd(...$var) // dans le cas ou on doit tester une variable ou plusieures, au lieu de faire un classique var_dump, on peut juste faire dd($variables)
{
    foreach ($var as $v) {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }
}
function get_pdo(): PDO // fonction pour se connecter à la base de données c'est ici qu'on met l'adresse de la db
{
    return $pdo = new PDO('mysql:host=localhost;dbname=calendar', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
}
function h(string $value): string //pour remplacer le hmtl special char dans des posts
{
    if ($value === null) {
        return '';
    }
    return htmlentities($value);
}
function render(string $view, $parameters = []) //fonctions les plus importantes c'est içi qu'on appelle les modules
{
    extract($parameters);
    include '../views/' . $view . '.php';
}
function render_admin(string $view, $parameters = [])
{
    extract($parameters);
    include '../views/admin/' . $view . '.php';
}