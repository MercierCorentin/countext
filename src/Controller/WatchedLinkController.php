<?php

namespace App\Controller;

use App\Entity\WatchedLink;
use App\Entity\Visit;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class WatchedLinkController extends AbstractController{

    public function create(){
        return $this->render("WatchedLink/create.html.twig");
    }
    public function store(Request $request){
        try{
            // Get entity manager
            $entityManager = $this->getDoctrine()->getManager();

            // Create Watched Link an set properties
            $watchedLink = new WatchedLink;
            $watchedLink->setSrcUrl(        $request->request->get("src-url"));
            $watchedLink->setdestUrl(       $request->request->get("dest-url"));
            $watchedLink->setDescription(   $request->request->get("description"));
            $watchedLink->setTitle(         $request->request->get("title"));
            $watchedLink->setNewUri();

            // Insert
            $entityManager->persist($watchedLink);
            $entityManager->flush();
        } catch (Exception $e) {
            // If it fails, redirect back with error message
            $this->get('session')->getFlashBag()->add("error", "Failed to register new watched link.");
            return $this->redirectToRoute("watched_link.create");
        }
        
        // If no exception, display newly created watched link
        return $this->redirectToRoute(
            "watched_link.show", 
            ["uri" => $watchedLink->getNewUri()]
        );
    }

    public function show(string $uri){
        // Get repository
        $watchedLinkRepository = $this->getDoctrine()->getRepository(WatchedLink::class);
        // Get watched link
        $watchedLink = $watchedLinkRepository->findOneBy(["newUri" => $uri]);

        // Request success test
        if(!empty($watchedLink)){
            // Success
            // Render watched link page
            return $this->render("WatchedLink/show.html.twig", [
                    "WatchedLink" => $watchedLink,
                    "visits"      => $watchedLink->getVisits()
                ]);
        }else{
            // Failure
            // TO DO: Ask for creation
            throw $this->createNotFoundException("Unable to find requested watched link");
        }
    }

    public function index(){
        $repository = $this->getDoctrine()->getRepository(WatchedLink::class);
        $watchedLinks = $repository->findBy( [], ["id" => "DESC"]);

        return $this->render("WatchedLink/index.html.twig", ["links" => $watchedLinks]);
    }
}

?>