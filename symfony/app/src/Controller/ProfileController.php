<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Attunement;
use App\Entity\Rank;
use App\Entity\Profile;


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
            $profile->setJoinDate($postdate['join_date']);
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

        }

        return $this->render('Profile/profile-create-form.html.twig', [
            'attunements' => $attunements,
            'ranks' => $ranks,
            'professions' => $this->getProfessions(),
            'specs' => $this->getSpecs()
        ]);
    }

    /**
     * @Route("/", name="profile_my")
     */
    public function myProfile() {
        $repository = $this->getDoctrine()->getRepository(Profile::class);
        $results = $repository->findProfilesByUser($this->getUser()->getId());
      
        return $this->render('Profile/profile-my.html.twig', [
            'profiles' => $results
        ]);
    }

    /**
     * @Route("/edit", name="profile_edit")
     */
    public function editProfile(Request $request) {
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
        }

        return $this->render('Profile/profile-edit-form.html.twig', [
            'profile' => $profile,
            'attunements' => $attunements,
            'ranks' => $ranks,
            'races' => $this->getRaces(),
            'classes' => $this->getClasses(),
            'professions' => $this->getProfessions(),
            'specs' => $this->getSpecs()
        ]);
    }

    private function getRaces() {
        return [
            'Human',
            'Dwarf',
            'Night Elf',
            'Gnome'
        ];
    }

    private function getClasses() {
        return [
            'Druid',
            'Hunter',
            'Mage',
            'Paladin',
            'Priest',
            'Rogue',
            'Warlock',
            'Warrior',
        ];
    }

    private function getSpecs() {
        return [
            'Dps',
            'Tank',
            'Healer',
        ];
    }

    private function getProfessions() {
        return [
            '',
            'Alchemy',
            'Blacksmithing (Armour)',
            'Blacksmithing (Weapon)',
            'Enchanting',
            'Engineering (Gnomish)',
            'Engineering (Goblin)',
            'Herbalism',
            'Leatherworking',
            'Mining',
            'Skinning',
            'Tailoring',
        ];
    }
}