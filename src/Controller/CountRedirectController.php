<?php

namespace App\Controller;

use App\Entity\WatchedLink;
use App\Entity\Visit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CountRedirectController extends AbstractController{

    public function countRedirect($link_id){

        $repository = $this->getDoctrine()->getRepository(WatchedLink::class);
        $watchedLink = $repository->findOneBy(["newUri" => $link_id]);

        if(!empty($watchedLink)){

            $entityManager = $this->getDoctrine()->getManager();

            $visit = new Visit;
            $visit->setwatchedLink($watchedLink);
            $visit->setTime();
            
            $entityManager->persist($visit);
            $entityManager->flush();
            return $this->redirect($watchedLink->getdestURL());
        }else{
            throw $this->createNotFoundException("The requested link does not exist.");
        }



    }
}

?>