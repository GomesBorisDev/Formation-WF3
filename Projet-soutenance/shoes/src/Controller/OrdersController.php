<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Orders;
use Doctrine\ORM\EntityManagerInterface;

class OrdersController extends AbstractController
{


    /***************************************************************
                        FONCTION BASKET
     ***************************************************************/

    /**
     * @Route("/orders", name="orders")
     */
    public function basket()
    {
        return $this->render('orders/index.html.twig', [
            'controller_name' => 'OrdersController',
        ]);
    }

    /***************************************************************
                        FONCTION ORDERS USER
     ***************************************************************/

    public function userOrders()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $ordersFound = $em->getRepository(Orders::class)->findBy(['user_id' => $user->getId()]);

        for ($i = 0; $i < count($ordersFound); $i++) {
            $basket = $ordersFound[$i]->getBasket();
            var_dump($basket);
        }

        echo '<pre>';
        var_dump($ordersFound);
        echo '</pre>';

        return $this->render('orders/user_orders.html.twig', [
            'user' => $user,
            'orders' => $ordersFound,
            'basket' => $basket,
        ]);
    }

    /***************************************************************
                        FONCTION ORDERS ADMIN
     ***************************************************************/

    public function adminOrders()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $ordersFound = $em->getRepository(Orders::class)->findAll();

        for ($i = 0; $i < count($ordersFound); $i++) {
            $basket = $ordersFound[$i]->getBasket();
            var_dump($basket);
        }

        echo '<pre>';
        var_dump($ordersFound);
        echo '</pre>';

        return $this->render('orders/admin_orders.html.twig', [
            'user' => $user,
            'orders' => $ordersFound,
            'basket' => $basket,
        ]);
    }


    /***************************************************************
                        FONCTION BASKET
     ***************************************************************/

    public function createBasket()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        var_dump($user);

        return $this->render('orders/index.html.twig', [
            'controller_name' => 'OrdersController',
        ]);
    }
}
