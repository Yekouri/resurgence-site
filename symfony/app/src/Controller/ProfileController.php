<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/profile")
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("/create", name="profile_create")
     */
    public function createProfile(Request $request)
    {
        return $this->render('Profile/profile-form.html.twig', [
        ]);
    }
}