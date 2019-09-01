<?php

namespace App\Controller;

use App\Entity\WatchedLink;
use App\Entity\Visit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;


class CountRedirectController extends AbstractController{

    public function countRedirect(SymfonyRequest $request, $link_id){

        $repository = $this->getDoctrine()->getRepository(WatchedLink::class);
        $watchedLink = $repository->findOneBy(["newUri" => $link_id]);

        if(!empty($watchedLink)){

            $entityManager = $this->getDoctrine()->getManager();

            $visit = new Visit;
            $visit->setwatchedLink($watchedLink);
            $visit->setTime();
            
            $entityManager->persist($visit);
            $entityManager->flush();

            // Get query parameters 
            $paramsNumber = count($request->query->all());
            $params = '';
            if($paramsNumber > 0){
                $params = "?";
                $i = 1;
                print_r($request->query->all());
                echo("<br>");
                foreach ($request->query->all() as $key => $param) {
                    $params .= $key . "=" . $param;
                    if($i != $paramsNumber){
                        $params .= "&";
                    }
                    $i++;
                }
            }
            return $this->redirect($watchedLink->getdestURL().$params);
        }else{
            throw $this->createNotFoundException("The requested link does not exist.");
        }



    }
}

?>