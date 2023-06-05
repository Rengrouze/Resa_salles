<?php



use Calendar\{
    Clients,
};

$validator = new \App\Validator();


$errors = [];



// check if the user is already logged in
if (isset($_SESSION['auth'])) {
    header('Location: /public/index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = $_POST;


    $validator = new Calendar\SignupValidator();
    $errors = $validator->validates($_POST);
    if (empty($errors)) {


        $clients = new Clients(get_pdo());
        $client = $clients->hydrate(new \Calendar\Client(), $_POST);
        try {

            $clientId = $clients->create($client);
            // add the id to the client object
            $client->setId($clientId);



            header('Location: /public/waiting-validation.php?email=' . $_POST['email']);

        } catch (\Exception $e) {
            // if the user does not exist, show an error
            $errors['email'] = "Cet email est déjà utilisé";
            var_dump($e->getMessage());
        }
    }

}