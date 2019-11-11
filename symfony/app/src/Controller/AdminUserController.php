<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use App\Entity\User;

/**
 * @Route("/admin/user")
 */
class AdminUserController extends AbstractController
{
    /**
     * @Route("/", name="admin_user_list")
     */
    public function userList()
    {
        $users = $this->getDoctrine()->getRepository
        (User::class)->findAll();

        return $this->render('Admin/User/user-list.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route("/create", name="admin_user_create", methods={"GET","POST"})
     */
    public function userCreate(Request $request, UserPasswordEncoderInterface $encoder) 
    {
        $message = '';
        $error = false;
        if ($request->isMethod('POST')) 
        {
            $postdata = $request->request->all();

            $entityManager = $this->getDoctrine()->getManager();

            $user = new User();
            $user->setUsername($postdata['username']);
            $user->setPassword(
                $encoder->encodePassword($user, $postdata['password'])
            );

            $roles = 'ROLE_ADMIN' == $postdata['roles'] ? ['ROLE_ADMIN'] : [];

            $user->setRoles($roles);
    
            try {
                $entityManager->persist($user);
                $entityManager->flush();
                $message = 'Created user with username: "'. $postdata['username'] . '"';
            } catch (UniqueConstraintViolationException $e) {
                $message = 'Failed: duplicate entry for user "'. $postdata['username'] . '"';
                $error = true;
            } catch (\Exception $e) {
                $message = 'Failed: creating user: "'. $postdata['username'] . '"';
                $error = true;
            }

        }

        return $this->render('Admin/User/user-create.html.twig', [
            'success_message' => $message,
            'error' => $error
        ]);
    }
}