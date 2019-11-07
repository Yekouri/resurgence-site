<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use App\Entity\User;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();

        $lastUsername = $utils->getLastUsername();

        return $this->render('Security/login.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(){}

    /**
     * @Route("/user/edit", name="user_edit")
     */
    public function userUpdate(Request $request, UserPasswordEncoderInterface $encoder) {
        $user = $this->getUser(); 

        if ($request->isMethod('POST'))
        {
            $postdata = $request->request->all();

            if (strcmp($postdata['password'], $postdata['confirm_password']) != 0) 
            {
                return $this->render('Security/user_update.html.twig', [
                    'user' => $user,
                    'error' => 'Password does not match'
                ]);            
            }

            $entityManager = $this->getDoctrine()->getManager();

            $userEntity = $entityManager->getRepository
            (User::class)->find($user->getId());

            if (empty($user)) {
                return $this->render('Security/user_update.html.twig', [
                    'user' => $user,
                    'error' => 'Internal error. Could not find user'
                ]); 
            }

            $userEntity->setPassword(
                $encoder->encodePassword($userEntity, $postdata['password'])
            );

            $entityManager->persist($userEntity);
    
            $entityManager->flush();

            return $this->redirectToRoute('login');
        }

        return $this->render('Security/user_update.html.twig', [
            'user' => $user,
            'error' => ''
        ]);
    }
}
