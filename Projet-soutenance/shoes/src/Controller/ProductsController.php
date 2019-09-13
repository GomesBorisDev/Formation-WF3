<?php

namespace App\Controller;

use App\Entity\Products;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use Respect\Validation\Validator as v;
use Intervention\Image\ImageManagerStatic as Image;

use App\Repository\ProductsRepository;
use Symfony\Component\VarDumper\VarDumper;

use Symfony\Component\HttpFoundation\Session\Session;

class ProductsController extends AbstractController
{

    /************** Tableau de marques ****************/
    public $brands = [

        1 => 'nike',
        2 => 'jordan',
        3 => 'adidas',
        4 => 'yeezy',
        5 => 'reebok',
        6 => 'converse'

    ];

    /************** Tableau de tailles ****************/
    public $sizes = [

        1  => '5.5',
        2  => '6',
        3  => '6.5',
        4  => '7',
        5  => '7.5',
        6  => '8',
        7  => '8.5',
        8  => '9',
        9  => '9.5',
        10 => '10',
        11 => '10.5',
        12 => '11',
        13 => '11.5',
        14 => '12',
        15 => '12.5'


    ];

    /************** Tableau de couleurs ****************/
    public $colors = [

        'black'  => 'background-color: black',
        'white'  => 'background-color: white',
        'blue'   => 'background-color: blue',
        'red'    => 'background-color: red',
        'green'  => 'background-color: green',
        'yellow' => 'background-color: yellow',
        'grey'   => 'background-color: grey',
        'gold'   => 'background-color: goldenrod',
        'pink'   => 'background-color: pink',
        'purple' => 'background-color: purple',

    ];

    public $session;

    public function __construct()
    {

        $this->session = new Session();
    }

    /****************************************************************                                FONCTION AJOUT DE PRODUITS
     ***************************************************************/

    public function addProducts()
    {
        $errors = $errorsForm = $errorsImg = [];
        $maxSizeFile = 3 * 1000 * 1000;
        $uploadDir = 'img/shoes/';
        $allowMimes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];

        $brandValue = (isset($_POST['brand'])) ? $_POST['brand'] : null;
        $modelValue = (isset($_POST['model'])) ? $_POST['model'] : null;
        $skuValue = (isset($_POST['sku'])) ? $_POST['sku'] : null;
        $sizeValue = (isset($_POST['size'])) ? $_POST['size'] : null;
        $colorValue = (isset($_POST['color'])) ? $_POST['color'] : null;
        $priceValue = (isset($_POST['price'])) ? $_POST['price'] : null;

        if (!empty($_POST)) {
            $safe = array_map('trim', array_map('strip_tags', $_POST));

            $errors = [

                (!v::notEmpty()->in(array_keys($this->brands))->validate($safe['brand'])) ? 'Veuillez sélectionner une marque' : null,
                (!v::notEmpty()->length(0, 255)->validate($safe['model'])) ? 'Le nom du modèle doit comporter entre 1 et 255 caractères' : null,
                (!v::notEmpty()->length(0, 255)->validate($safe['sku'])) ? 'Le SKU doit comporter entre 1 et 255 caractères' : null,
                (!v::notEmpty()->in(array_values($this->sizes))->validate($safe['size'])) ? 'Veuillez sélectionner une taille' : null,
                (!v::notEmpty()->in(array_keys($this->colors))->validate($safe['color'])) ? 'Veuillez sélectionner une couleur' : null,

            ];

            if (!empty($_FILES['picture1'])) {

                if ($_FILES['picture1']['error'] == UPLOAD_ERR_OK) {

                    $img1 = Image::make($_FILES['picture1']['tmp_name']);

                    if ($img1->filesize() > $maxSizeFile) {
                        $errorsImg[] = 'Votre image1 ne doit pas excedér 3 Mo';
                    } elseif (!v::in($allowMimes)->validate($img1->mime())) {
                        $errorsImg[] = 'Votre fichier1 n\'est pas une image valide';
                    }
                } elseif ($_FILES['picture1']['error'] == UPLOAD_ERR_NO_FILE) {
                    $errorsImg[] = 'Aucun fichier1 n\'a été uploadé';
                } else {
                    $errorImg[] = 'Une erreur est survenue lors de l\'envoi de l\'image1';
                }
            }

            if (!empty($_FILES['picture2'])) {

                if ($_FILES['picture2']['error'] == UPLOAD_ERR_OK) {

                    $img2 = Image::make($_FILES['picture2']['tmp_name']);

                    if ($img2->filesize() > $maxSizeFile) {
                        $errorsImg[] = 'Votre image2 ne doit pas excedér 3 Mo';
                    } elseif (!v::in($allowMimes)->validate($img2->mime())) {
                        $errorsImg[] = 'Votre fichier2 n\'est pas une image valide';
                    }
                } elseif ($_FILES['picture2']['error'] == UPLOAD_ERR_NO_FILE) {
                    $errorsImg[] = 'Aucun fichier2 n\'a été uploadé';
                } else {
                    $errorImg[] = 'Une erreur est survenue lors de l\'envoi de l\'image2';
                }
            }

            if (!empty($_FILES['picture3'])) {

                if ($_FILES['picture3']['error'] == UPLOAD_ERR_OK) {

                    $img3 = Image::make($_FILES['picture3']['tmp_name']);

                    if ($img3->filesize() > $maxSizeFile) {
                        $errorsImg[] = 'Votre image3 ne doit pas excedér 3 Mo';
                    } elseif (!v::in($allowMimes)->validate($img3->mime())) {
                        $errorsImg[] = 'Votre fichier n\'est pas une image3 valide';
                    }
                } elseif ($_FILES['picture3']['error'] == UPLOAD_ERR_NO_FILE) {
                    $errorsImg[] = 'Aucun fichier3 n\'a été uploadé';
                } else {
                    $errorImg[] = 'Une erreur est survenue lors de l\'envoi de l\'image3';
                }
            }

            $errors = array_filter($errors);

            if (count($errors) == 0) {

                $path1 = pathinfo($_FILES['picture1']['name']);
                $path2 = pathinfo($_FILES['picture2']['name']);
                $path3 = pathinfo($_FILES['picture3']['name']);

                $filename1 = $safe["sku"];
                $filename2 = $safe["sku"];
                $filename3 = $safe["sku"];


                $filename1 = $filename1 . '_1' . '.' . $path1['extension'];
                $filename2 = $filename2 . '_2' . '.' . $path2['extension'];
                $filename3 = $filename3 . '_3' . '.' . $path3['extension'];

                $img1->save($uploadDir . $filename1);
                $img2->save($uploadDir . $filename2);
                $img3->save($uploadDir . $filename3);

                $success = true;

                $entityManager = $this->getDoctrine()->getManager();
                $product = new Products();
                $product->setBrand($safe['brand']);
                $product->setModel($safe['model']);
                $product->setSku($safe['sku']);
                $product->setShoeSize($safe['size']);
                $product->setColor($safe['color']);
                $product->setPrice($safe['price']);
                $product->setPicture1($uploadDir . $filename1);
                $product->setPicture2($uploadDir . $filename2);
                $product->setPicture3($uploadDir . $filename3);

                $entityManager->persist($product);

                $entityManager->flush();
            } else {
                $errorsForm = implode('<br>', $errors);
            }
        }


        return $this->render('products/add_products.html.twig', [
            'brands' => $this->brands,
            'sizes' => $this->sizes,
            'colors'  => $this->colors,
            'brandValue' => $brandValue,
            'modelValue' => $modelValue,
            'colorValue' => $colorValue,
            'skuValue' => $skuValue,
            'sizeValue' => $sizeValue,
            'priceValue' => $priceValue,
            'errors'     => $errorsForm ?? [],
            'success'    => $success ?? false
        ]);
    }

    /****************************************************************                                FONCTION DES PRODUITS
     ***************************************************************/

    public function showProducts(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $productsRequest = $em->getRepository(Products::class)->findAll();


        $current_url = $request->getPathInfo();

        $error = [];

        if (!empty($_GET)) {

            $get = array_map('trim', array_map('strip_tags', $_GET));

            $selectedBrand = $get['brand'] ?? 0;
            $selectedColor = $get['color'] ?? 0;
            $selectedSize = $get['size'] ?? 0;
            $selectedMinPrice = $get['pricemin'] ?? 0;
            $selectedMaxPrice = $get['pricemax'] ?? 0;

            if ((isset($get['pricemin']) && !empty($get['pricemin']) && isset($get['pricemax']) && !empty($get['pricemax'])) && ($get['pricemin'] > $get['pricemax'])) {
                $error[] = 'Le prix minimum doit être inférieur au prix maximum';
            } else {
                $em = $this->getDoctrine()->getManager();
                $product = $em->getRepository(Products::class)->findAllByBrandColorSizePrice($selectedBrand, $selectedSize, $selectedColor, $selectedMinPrice, $selectedMaxPrice);
            }
            $error = implode($error);
        }



        return $this->render('products/show.html.twig', [
            'brandsList'    => $this->brands,
            'sizesList'     => $this->sizes,
            'products'      => $productsRequest,
            "colors"  => $this->colors,
            'current_url' => $current_url,
            'selectedBrand' => $selectedBrand ?? 0,
            'selectedSize' => $selectedSize ?? 0,
            'selectedColor' => $selectedColor ?? 0,
            'searchResult' => $product ?? [],
            'error'     => $error ?? [],

        ]);
    }

    /****************************************************************                              FONCTION DETAIL DE PRODUIT
     ***************************************************************/

    public function viewDetails($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Products::class)->find($id);

        $this->addToCart();

        $current_cart = $this->session->get('cart');

        $totalPrice = $this->session->get('total_price');

        return $this->render('products/details.html.twig', [
            'brands'    => $this->brands,
            'products' => $product,
            'qtyCart' => count($this->current_cart ?? [])
        ]);
    }


    /****************************************************************                              FONCTION DE RECHERCHE DES PRODUITS
     ***************************************************************/
    public function searchProducts(Request $request)
    {

        $current_url = $request->getPathInfo();

        $error = [];

        if (!empty($_GET)) {

            $get = array_map('trim', array_map('strip_tags', $_GET));

            $selectedBrand = $get['brand'] ?? 0;
            $selectedColor = $get['color'] ?? 0;
            $selectedSize = $get['size'] ?? 0;
            $selectedMinPrice = $get['pricemin'] ?? 0;
            $selectedMaxPrice = $get['pricemax'] ?? 0;

            if ((isset($get['pricemin']) && !empty($get['pricemin']) && isset($get['pricemax']) && !empty($get['pricemax'])) && ($get['pricemin'] > $get['pricemax'])) {
                $error[] = 'Le prix minimum doit être inférieur au prix maximum';
            } else {
                $em = $this->getDoctrine()->getManager();
                $product = $em->getRepository(Products::class)->findAllByBrandColorSizePrice($selectedBrand, $selectedSize, $selectedColor, $selectedMinPrice, $selectedMaxPrice);
            }
            $error = implode($error);
        }

        return $this->render('products/search.html.twig', [
            "brands" => $this->brands,
            "sizes"  => $this->sizes,
            "colors"  => $this->colors,
            'current_url' => $current_url,
            'selectedBrand' => $selectedBrand ?? 0,
            'selectedSize' => $selectedSize ?? 0,
            'selectedColor' => $selectedColor ?? 0,
            'searchResult' => $product ?? [],
            'error'     => $error ?? [],

        ]);
    }

    /****************************************************************                            FONCTION DE MODIFICATION DES PRODUITS
     ***************************************************************/

    public function modifyProducts()
    {
        $em = $this->getDoctrine()->getManager();
        $productsRequest = $em->getRepository(Products::class)->findAll();

        return $this->render('products/modify.html.twig', [
            'products'   => $productsRequest,
            'brandsList' => $this->brands,
            'sizesList'  => $this->sizes,
            'colors'     => $this->colors,

        ]);
    }


    /****************************************************************                            FONCTION DE SUPPRESSION DES PRODUITS
     ***************************************************************/

    public function getProductsDeleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Products::class)->deleteProducts($id);

        $productsRequest = $em->getRepository(Products::class)->findAll();

        return $this->render('products/modify.html.twig', [
            'products'   => $productsRequest,
            'brandsList' => $this->brands,
            'sizesList'  => $this->sizes,
            'colors'     => $this->colors,
        ]);
    }


    /****************************************************************                             FONCTION AJOUT D'ARTICLES AU PANIER
     ***************************************************************/

    public function addToCart()
    {

        if (!empty($_POST) && isset($_POST['action']) && $_POST['action'] === 'add-to-cart') {

            $safe = array_map('trim', array_map('strip_tags', $_POST));

            if (is_numeric($safe['id_product'])) {

                $em = $this->getDoctrine()->getManager();

                $product = $em->getRepository(Products::class)->find($safe['id_product']);

                if (!empty($product)) {

                    // récupère les données dans la session  
                    $current_cart = $this->session->get('cart');

                    // ajoute l'article au tableau dans la session    
                    $current_cart[] = [
                        'id_product' => $product->getId(),
                        'brand'     => $product->getBrand(),
                        'model'     => $product->getModel(),
                        'sku'       => $product->getSku(),
                        'shoe_size' => $product->getShoeSize(),
                        'price' => $product->getPrice(),
                    ];

                    
                    // re stocke le tableau dans la session
                    $this->session->set('cart', $current_cart);


                    $totalPrice = $this->session->get('total_price');

                    $totalPrice[] = $product->getPrice();

                    // $totalPrice = array_map(function($item){
                    //     return (float) $item;
                    // }, $totalPrice);


                    $total_price = 0;
                        foreach ($totalPrice as $key => $value) {
                        $total_price += (float) $value;
                     }

                    var_dump($total_price);

                    // $totalPrice = (array_sum($totalPrice));

                    // $this->session->set('total_price', $totalPrice);


                }

            } 
        }
                    var_dump($total_price);   
                    echo '-----------------';
                    var_dump('ok');
                    echo '-----------------';
                    // var_dump($this->session->get('total_price'));   

        return $this->render('orders/cart_detail.html.twig', [
            'cart_items' => $this->session->get('cart') ?? [],
            'brandsList'    => $this->brands,
            'totalPrice' => $this->session->get('total_price') ?? 0
        ]);
    }

    public function deleteCartProduct()
    {

        $current_cart = $this->session->get('cart');

        $new_cart = [];

        foreach ($current_cart as $id => $val) { }

        $this->session->set('cart', $new_cart);

        return $this->render('orders/cart_detail.html.twig', [
            'cart_items' => $this->session->get('cart') ?? [],
            'id' => $id,
        ]);
    }

    public function cleanCart()
    {

        $this->session->set('cart', []);

        return $this->render('orders/cart_detail.html.twig', [
            'cart_items' => $this->session->get('cart') ?? [],
        ]);
    }

    public function addOrder()
    {
        $current_cart = $this->session->set('cart', []);

        

        $em = $this->getDoctrine()->getManager();

        $order = new Orders();
        $order->setBasket(json_encode($current_cart))
              ->setDate( new \DateTime('now') );
            //   ->setPrice();
            // ->setUserId();

        $em->persist($order);
        
        $em->flush();



        return $this->render('orders/cart_detail.html.twig', [
            'cart_items' => $this->session->get('cart') ?? [],
        ]);
    }


    public function loginToBuy()
    {
        return $this->render('security/login.html.twig', [

        ]);
    }

    public function ajaxEdit()
    {
        $errors = '';
        $success = '';
        // recuperation de la paire
        $em = $this->getDoctrine()->getManager();
        // recuperation des infos en base de données via $_POST['id']
        $product = $em->getRepository(Products::class)->find($_POST['id']);
        // J'ai mon produit, je créé un tableau qui me renvoit ces infos
        $my_product = [
            'brand' => $product->getBrand(),
            'model' => $product->getModel(),
            'sku' => $product->getSku(),
            'size' => $product->getShoeSize(),
            'color' => $product->getColor(),
            'price' => $product->getPrice(),
        ];
        // envoi des info dans la modal 
        return $this->json($my_product);


        if (!empty($_POST)) {
            // nettoyage
            $safe = array_map('trim', array_map('strip_tags', $_POST));
            // verifications des erreurs
            $errors = [
                (!v::notEmpty()->in(array_keys($this->brands))->validate($safe['brand'])) ? 'Veuillez sélectionner une marque' : null,
                (!v::notEmpty()->length(1, 255)->validate($safe['model'])) ? 'Le nom du modèle doit comporter entre 1 et 255 caractères' : null,
                (!v::notEmpty()->length(0, 255)->validate($safe['sku'])) ? 'Le SKU doit comporter entre 1 et 255 caractères' : null,
                (!v::notEmpty()->in(array_values($this->sizes))->validate($safe['size'])) ? 'Veuillez sélectionner une taille' : null,
                (!v::notEmpty()->in(array_keys($this->colors))->validate($safe['color'])) ? 'Veuillez sélectionner une couleur' : null,
                (!v::numeric()->validate($safe['price'])) ? 'Le prix doit être numérique ' : null,
            ];
            $errors = array_filter($errors);
            // si ok, on renvoi dans la bdd
            if (count($errors) == 0) {

                $product->setModel($safe['brand']);
                $product->setPrice($safe['model']);
                $product->setPrice($safe['sku']);
                $product->setPrice($safe['size']);
                $product->setPrice($safe['color']);
                $product->setPrice($safe['price']);

                $em->flush();
            } // if(count($errors)
        }  // if(!empty($_POST)
    } // function ajaxEdit()
}
