<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TwigTesterController extends AbstractController
{
    /**
     * @Route("/twig/{who}", name="twig_tester")
     */
    public function index($who, LoggerInterface $logger): Response
    {
        $dmp="Help! It is too furry!";
        dump($logger);
        $user = ["firstName"=>"ivan", "lastName"=>"Ivanov"];
        return $this->render("test.twig", ["who"=>$user]);
    }
}
