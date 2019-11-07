<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Controller that handles the homepage
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index() {
        $stuff = $this->getDoctrine()->getManager(); // actually connect to mysql DB
        $number = random_int(0, 1000);

        return $this->render('Homepage/index.html.twig', 
            [
                'number' => $number
            ]
        );
    }
}