<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Profile;
use App\Entity\Rank;
use App\Service\ProfileInfoGenerator;

class RosterController extends AbstractController
{
    /**
     * @Route("/roster", name="roster", methods={"GET","POST"})
     */
    public function index(ProfileInfoGenerator $info, Request $request)
    {
        $selected = [];
        $ranks = $this->getDoctrine()->getRepository
        (Rank::class)->findAll();

        if ($request->isMethod('POST'))
        {
            $postdata = $request->request->all();

            $filterRank = '';
            if (!empty($postdata['rank'])) {
                foreach ($ranks as $value) {
                    if ($postdata['rank'] == $value->getName()){
                        $filterRank = $value;
                    }
                }
            }

            $repository = $this->getDoctrine()->getRepository(Profile::class);
            $profiles = $repository->findAllProfilesFilter(
                !empty($filterRank) ? $filterRank : null, 
                !empty($postdata['class']) ? $postdata['class'] : null, 
                !empty($postdata['spec']) ? $postdata['spec'] : null
            );

            $selected = [
                'class' => $postdata['class'],
                'rank' => $postdata['rank'],
                'spec' => $postdata['spec'],
            ];
        }
        else {
            $repository = $this->getDoctrine()->getRepository(Profile::class);
            $profiles = $repository->findAllProfilesFilter();
        }


        return $this->render('Roster/roster.html.twig', [
            'ranks' => $ranks,
            'selected' => $selected,
            'classes' => $info->getClasses(),
            'specs' => $info->getSpecs(),
            'profiles' => $profiles,
        ]);
    }
}
