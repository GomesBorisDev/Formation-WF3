<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Respect\Validation\Validator as v;

class UsersController extends AbstractController
{
    /**
     * @Route("/users", name="users")
     */
    public function index()
    {
        return $this->render('users/index.html.twig', [
            'controller_name' => 'UsersController',
        ]);
    }

    public function addUser()
    {
    	$errors = $errorsForm = $errorsImg = [];

    	$usernameValue = (isset($_POST['username_input'])) ? $_POST['username_input'] : null;
    	$emailValue = (isset($_POST['email_input'])) ? $_POST['email_input'] : null;
    	$emailValue = (isset($_POST['pwd_input'])) ? $_POST['pwd_input'] : null;
    	$emailValue = (isset($_POST['pwd_confirm_input'])) ? $_POST['pwd_confirm_input'] : null;

    	if(!empty($_POST)){

    		$safe = array_map('trim', array_map('strip_tags', $_POST));

    		$errors = [
    			(!v::notEmpty()->length(5,15)->validate($safe['title'])) ? 'Username needs to be 5 caracters long min and 15 max !' : null,
    			(!v::notEmpty()->email()->validate($safe['email_input']);) ? 'Email is not valid !' : null,
    			(!v::notEmpty()->length(5,255)->validate($safe['pwd_input'])) ? 'Password needs to be 5 caracters long min and 255 max ! ' : null,

    		];
    	}

        return $this->render('users/add.html.twig', [
            // 'controller_name' => 'JOHNNY',
        ]);
    }
}
