<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController{

    public function home(){
        return $this->render("home.html.twig");
    }

    public function about(){
        return $this->render("about.html.twig");
    }
}

?>