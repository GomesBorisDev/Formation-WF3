<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Respect\Validation\Validator as v;

use Intervention\Image\ImageManagerStatic as Image;

use Behat\Transliterator\Transliterator as tr;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;


class ArticleController extends AbstractController
{

	// Définition de mes catégories (attention au mot clé "public")
	public $categoriesList = [
			'news' 		=> 'Actualités',
			'recipes'	=> 'Recettes',
			'love'		=> 'Coup de coeur',
		];


	/**
	 * @Route("/default", name="default")
	 */
	public function addArticle(){
		// Variables de configuration
		$errors = $errorsForm = $errorsImg = [];
		$maxSizeFile = 3 * 1000 * 1000; 
		$uploadDir = 'uploads/';
		$allowMimes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];

		$titleValue = (isset($_POST['title'])) ? $_POST['title'] : null;
       	$categoryValue = (isset($_POST['category'])) ? $_POST['category'] : null;
       	$contentValue = (isset($_POST['content'])) ? $_POST['content'] : null;


		if(!empty($_POST)){

			// Je nettoie les données reçues
			$safe = array_map('trim', array_map('strip_tags', $_POST));
			// J'effectue mes vérifications
			$errors = [
				(!v::notEmpty()->length(5,100)->validate($safe['title'])) ? 'Votre titre doit comporter entre 5 et 100 caractères' : null,
				// array_keys me retourne les clé d'un tabbleau
				(!v::notEmpty()->in(array_keys($this->categoriesList))->validate($safe['category'])) ? 'Votre catégorie est invalide' : null,
				(!v::notEmpty()->length(5)->validate($safe['content'])) ? 'Votre contenu doit comporter au moins 50 caractères' : null,


			];

			if(!empty($_FILES['picture'])){

					if($_FILES['picture']['error'] == UPLOAD_ERR_OK){

					// Je pré-fabrique mon image. Cela me permet d'effectuer quelques vériciations supplémentaires et de la sauvegarder ensuite
					$img = Image::make($_FILES['picture']['tmp_name']);
					if($img->filesize() > $maxSizeFile){
						$errorsImg[] = 'Votre image ne doit pas excedér 3 Mo';
					}
					elseif(!v::in($allowMimes)->validate($img->mime())){
						$errorsImg[] = 'Votre fichier n\'est pas une image valide';
					}
				}
				elseif($_FILES['picture']['error'] == UPLOAD_ERR_NO_FILE){
					$errorsImg[] = 'Aucun fichier n\'a été uploadé';
				}
				else {
					$errorImg[] = 'Une erreur est survenue lors de l\'envoi de l\'image';
				}

			}	

			// Je supprime les entrées vides de mon tableau
			$errors = array_filter($errors);

			if(count($errors) == 0){
				if(!is_dir($uploadDir)){
					if(!mkdir($uploadDir, 0777)){

					die('[ERREUR] Lors de la création du répertoire upload');
					}
				}

				$path = pathinfo($_FILES['picture']['name']);

				$filename = tr::transliterate(time().'-'.$path['filename']); 

				$filename = $filename.'.'.$path['extension']; 
				
				$img->save($uploadDir.$filename);

				$success = true;

			$entityManager = $this->getDoctrine()->getManager();
	       	$article = new Article();
	        $article->setTitle($safe['title']);
	        $article->setCategory($safe['category']);
	        $article->setContent($safe['content']);
	        $article->setPicture($uploadDir.$filename);

	        $entityManager->persist($article);//a la création de l'objet mais pas à ça modification(edit)

	        $entityManager->flush();

			}

			else {
				$errorsForm = implode('<br>', $errors);
			}
		
	        // return new Response('Congrats ... DUMBASS ! ');
		}

		return $this->render('article/add.html.twig', [
			'categories' => $this->categoriesList, // $this->categoriesList permet d'appeler la variable en dehors de la fonction addArticle()
			'success'	 => $success ?? false,
			// Je transmet mes variables à la vue. La variable $errorsForm deviendra la variable {{errors}} dans mon fichier de vue
			'errors'	 => $errorsForm ?? [],
			'titleValue' => $titleValue,
           	'catValue' => $categoryValue,
           	'contentValue' => $contentValue
		]);
	}


	public function editArticle($id){

		$safe = array_map('trim', array_map('strip_tags', $_POST));
		
       	// Variables de configuration
		$errors = $errorsForm = $errorsImg = [];
		$maxSizeFile = 3 * 1000 * 1000; 
		$uploadDir = 'uploads/';
		$allowMimes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
       	
       	$entityManager = $this->getDoctrine()->getManager();
	    $articleFound = $entityManager->getRepository(Article::class)->find($id);
		

	    // Soumission du formulaire
        if(!empty($_POST)){
            // Nettoyage des données
            $safe = array_map('trim', array_map('strip_tags', $_POST));

            $categoryValue = (isset($safe['category'])) ? $safe['category'] : null;

            // Vérification que le titre fasse au moins 5 caractères
            if(strlen($safe['title']) < 5){
                $errors[] = 'Votre titre doit comporter au moins 5 caractères';
            }

            // Vérification que le contenu fasse au moins 5 caractères
            if(strlen($safe['content']) < 25){
                $errors[] = 'Votre contenu doit comporter au moins 25 caractères';
            }

            if(!in_array($safe['category'], array_keys($this->categoriesList))){
                $errors[] = 'Votre catégorie est invalide';
            }

            if(!empty($_FILES['picture'])){

					if($_FILES['picture']['error'] == UPLOAD_ERR_OK){

					// Je pré-fabrique mon image. Cela me permet d'effectuer quelques vériciations supplémentaires et de la sauvegarder ensuite
					$img = Image::make($_FILES['picture']['tmp_name']);
					if($img->filesize() > $maxSizeFile){
						$errorsImg[] = 'Votre image ne doit pas excedér 3 Mo';
					}
					elseif(!v::in($allowMimes)->validate($img->mime())){
						$errorsImg[] = 'Votre fichier n\'est pas une image valide';
					}
				}
				elseif($_FILES['picture']['error'] == UPLOAD_ERR_NO_FILE){
					$errorsImg[] = 'Aucun fichier n\'a été uploadé';
				}
				else {
					$errorImg[] = 'Une erreur est survenue lors de l\'envoi de l\'image';
				}

			}	

			$errors = array_filter($errors);

			if(count($errors) == 0){
				if(!is_dir($uploadDir)){
					if(!mkdir($uploadDir, 0777)){

					die('[ERREUR] Lors de la création du répertoire upload');
					}
				}

				$path = pathinfo($_FILES['picture']['name']);

				$filename = tr::transliterate(time().'-'.$path['filename']); 

				$filename = $filename.'.'.$path['extension']; 
				
				$img->save($uploadDir.$filename);

				$success = true;

			$articleFound->setTitle($safe['title']);
		    $articleFound->setCategory($safe['category']);
		    $articleFound->setContent($safe['content']);
		    $article->setDatePublish(new \DateTime('now'));
		    $articleFound->setPicture($uploadDir.$filename);

		    $entityManager->flush();

			}

			else {
				$errorsForm = implode('<br>', $errors);
			}

		}

	    return $this->render('article/edit.html.twig', [
	    	'categories' => $this->categoriesList,
	    	'success'	 => $success ?? false,
			'errors'	 => $errorsForm ?? [],
			// 'catValue' => $categoryValue,
           	'article' => $articleFound
	    ]);

	    // return new Response('Congrats ... DUMBASS x2 ! ');

	}

	public function showArticle($id){

		$entityManager = $this->getDoctrine()->getManager();
	    $article = $entityManager->getRepository(Article::class)->find($id);

		return $this->render('article/show.html.twig', [
           	'article' => $article
		]);


	}

	public function listArticles(){

		$entityManager = $this->getDoctrine()->getManager();
		$articles = $entityManager->getRepository(Article::class)->findAll();

		return $this->render('article/list.html.twig', [
           	'articles' => $articles
		]);

	}
}
