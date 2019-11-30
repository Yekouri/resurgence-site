<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Attunement;
use App\Entity\Rank;
use App\Entity\Profile;
use App\Service\ProfileInfoGenerator;


/**
 * @Route("/profile")
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("/create", name="profile_create", methods={"GET","POST"})
     */
    public function createProfile(ProfileInfoGenerator $info, Request $request)
    {
        $attunements = $this->getDoctrine()->getRepository
        (Attunement::class)->findAll();

        $ranks = $this->getDoctrine()->getRepository
        (Rank::class)->findAll();

        if ($request->isMethod('POST'))
        {
            $postdata = $request->request->all();

            $entityManager = $this->getDoctrine()->getManager();

            $profile = new Profile();
            $profile->setUser($this->getUser());
            $profile->setName($postdata['name']);
            $profile->setRace($postdata['race']);
            $profile->setClass($postdata['class']);
            $profile->setSpec($postdata['spec']);
            $profile->setJoinDate(new \DateTime($postdata['join_date']));
            $profile->setPvp(!empty($postdata['pvp']) ? true : false);
            $profile->setCurrentPvpRank(!empty($postdata['current_pvp_rank']) ? $postdata['current_pvp_rank'] : 0);
            $profile->setGoalPvpRank(!empty($postdata['goal_pvp_rank']) ? $postdata['goal_pvp_rank'] : 0);

            if (!empty($postdata['profession_A'])) {
                $profile->setProfessionA($postdata['profession_A']);
            }

            if (!empty($postdata['profession_B'])) {
                $profile->setProfessionB($postdata['profession_B']);
            }

            if (!empty($postdata['attunement'])) {
                foreach ($postdata['attunement'] as $key => $value) {
                    $profile->addAttunement($attunements[$key]);
                }
            }

            foreach ($ranks as $value) {
                if ($postdata['rank'] == $value->getName()){
                    $profile->setRank($value);
                }
            }

            try {
                $entityManager->persist($profile);
                $entityManager->flush();
            } catch (\Exception $e) {
                print_r($e->getMessage());
                die;
            }

            return $this->redirectToRoute('profile_my');
        }

        return $this->render('Profile/profile-create-form.html.twig', [
            'attunements' => $attunements,
            'ranks' => $ranks,
            'races' => $info->getRaces(),
            'classes' => $info->getClasses(),
            'professions' => $info->getProfessions(),
            'specs' => $info->getSpecs()
        ]);
    }

    /**
     * @Route("/", name="profile_my", methods={"GET"})
     */
    public function myProfile() {
        $repository = $this->getDoctrine()->getRepository(Profile::class);
        $results = $repository->findProfilesByUser($this->getUser()->getId());
      
        return $this->render('Profile/profile-my.html.twig', [
            'profiles' => $results
        ]);
    }

    /**
     * @Route("/edit", name="profile_edit", methods={"GET","POST"})
     */
    public function editProfile(ProfileInfoGenerator $info, Request $request) {
        $id = $request->query->get('id');

        $attunements = $this->getDoctrine()->getRepository
        (Attunement::class)->findAll();

        $ranks = $this->getDoctrine()->getRepository
        (Rank::class)->findAll();

        // Only find if profile id is linked to the user id
        $repository = $this->getDoctrine()->getRepository(Profile::class);
        $profile = $repository->findProfile($id, $this->getUser()->getId());

        if ($request->isMethod('POST'))
        {
            $postdata = $request->request->all();

            $entityManager = $this->getDoctrine()->getManager();

            $profile->setSpec($postdata['spec']);
            $profile->setJoinDate(new \DateTime($postdata['join_date']));
            $profile->setPvp(!empty($postdata['pvp']) ? true : false);
            $profile->setCurrentPvpRank(!empty($postdata['current_pvp_rank']) ? $postdata['current_pvp_rank'] : 0);
            $profile->setGoalPvpRank(!empty($postdata['goal_pvp_rank']) ? $postdata['goal_pvp_rank'] : 0);

            if (!empty($postdata['profession_A'])) {
                $profile->setProfessionA($postdata['profession_A']);
            }

            if (!empty($postdata['profession_B'])) {
                $profile->setProfessionB($postdata['profession_B']);
            }

            if (!empty($postdata['attunement'])) {
                foreach ($postdata['attunement'] as $key => $value) {
                    $profile->addAttunement($attunements[$key]);
                }
            }

            foreach ($ranks as $value) {
                if ($postdata['rank'] == $value->getName()){
                    $profile->setRank($value);
                }
            }

            try {
                $entityManager->persist($profile);
                $entityManager->flush();
            } catch (\Exception $e) {
                print_r($e->getMessage());
                die;
            }

            return $this->redirectToRoute('profile_my');
        }

        return $this->render('Profile/profile-edit-form.html.twig', [
            'profile' => $profile,
            'attunements' => $attunements,
            'ranks' => $ranks,
            'professions' => $info->getProfessions(),
            'specs' => $info->getSpecs()
        ]);
    }

    /**
     * @Route("/delete", name="profile_delete", methods={"DELETE"})
     */
    public function deleteProfile(Request $request) {
        $id = $request->query->get('id');
        
        // Only find if profile id is linked to the user id
        $repository = $this->getDoctrine()->getRepository(Profile::class);
        $profile = $repository->findProfile($id, $this->getUser()->getId());

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($profile);
        $entityManager->flush();

        return new Response();
    }
}