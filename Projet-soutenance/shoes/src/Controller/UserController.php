<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Respect\Validation\Validator as v;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;

class UserController extends AbstractController
{

    /***************************************************************
                        FONCTION SESSION USER
     ***************************************************************/
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        return $this->render('user/index.html.twig', [
            'user' => $user,
        ]);
    }

    /***************************************************************
                         FONCTION SESSION INSCRIPTION
     ***************************************************************/
    /**
     * @Route("/register", name="app_register")
     */
    public function addUser()
    {
        $errors = '';
        $msg = '';


        if (!empty($_POST)) {
            $safe = array_map('trim', array_map('strip_tags', $_POST));
            $em = $this->getDoctrine()->getManager();
            $usersFound = $em->getRepository(Users::class)->findBy(['email' => $safe['email']]);

            $errors = [
                (!v::length(2, 50)->validate($safe['name'])) ? 'Le nom doit comporter entre 2 et 50 caractères ' : null,
                (v::numeric()->validate($safe['name'])) ? 'Le nom ne peut être numérique ' : null,
                (!v::length(2, 50)->validate($safe['firstname'])) ? 'Le prénom doit comporter entre 2 et 50 caractères ' : null,
                (v::numeric()->validate($safe['firstname'])) ? 'Le prénom ne peut être numérique ' : null,
                (!v::length(5, 120)->validate($safe['address'])) ? 'L\'adresse est invalide ' : null,
                (!v::postalCode('FR')->validate($safe['pC'])) ? 'Code postal invalide ' : null,
                (!v::length(2, 120)->validate($safe['city'])) ? 'La ville n\'est pas valide ' : null,
                (v::numeric()->validate($safe['city'])) ? 'La ville n\'est pas valide ' : null,
                (!v::phone()->validate($safe['phone'])) ? 'Le numéro de téléphone n\'est pas valide ' : null,
                (!v::email()->validate($safe['email'])) ? 'L\'email n\'est pas valide ' : null,
                (v::notEmpty()->validate($usersFound)) ? 'Cet email existe déjà' : null,
                (!$this->verifPassword($safe['pwd'])) ? 'Le mot de passe doit comporter 1 maj, 1 chiffre, 8 caractères min' : null,
                (!v::equals($safe['pwd'])->validate($safe['pwdVerif'])) ? 'Les mots de passe ne sont pas identiques' : null,
            ];

            $errors = array_filter($errors);


            if (count($errors) == 0) {
                $hash = password_hash($safe['pwd'], PASSWORD_DEFAULT);

                $entityManager = $this->getDoctrine()->getManager();

                $user = new Users();
                $user->setLastName($safe['name']);
                $user->setFirstName($safe['firstname']);
                $user->setAddress($safe['address']);
                $user->setAdditionalAddress($safe['complement']);
                $user->setPostalCode($safe['pC']);
                $user->setCity($safe['city']);
                $user->setPhoneNumber($safe['phone']);
                $user->setEmail($safe['email']);
                $user->setPassword($hash);
                $user->setRoles(['ROLE_USER']);

                $entityManager->persist($user);
                // insert in BDD
                $entityManager->flush();
                $msg = 'Votre inscription est validé, bienvenu chez South-West-Store';
            }
        } // if !empty($_POST)

        return $this->render('user/register.html.twig', [
            'erreur'     =>   $errors,
            'msg'        =>   $msg,
        ]);
    } // fonction addUser

    // Vérification des mots de passe (1 maj, 1 chiffre, 8 caractères min)
    public function verifPassword($pwd)
    {
        $cptInt = $cptMaj = 0;
        // longueur du mot de passe
        $longueur = strlen($pwd);
        // une chaine est aussi un tableau...
        for ($i = 0; $i < $longueur; $i++) {

            //Est-ce un nombre?
            if (is_numeric($pwd[$i]))
                $cptInt++;

            // Y-a-il une majuscule
            else if (strtoupper($pwd[$i]) == $pwd[$i])
                $cptMaj++;
        }
        if ($longueur >= 8 and $cptInt >= 1 and $cptMaj >= 1) {
            return true;
        } else return false;
    } // fin function verifPassword

}
