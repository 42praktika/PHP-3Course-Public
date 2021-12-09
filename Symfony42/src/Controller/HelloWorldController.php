<?php
namespace App\Controller;
use App\Service\GreetingGenerator;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloWorldController extends AbstractController
{
    /**
     * @param ContainerInterface $container
     * @param string $who
     * @return Response
     * @Route("/hello/{who}", name="HelloRoute")
     */
    public function world(ContainerInterface $container, $who="World")
    {
        $gen1 = $container->get("greeting");
        return new Response(  	"<html><body>".$gen1->getGreeting().", $who</body></html>"	);
    }
}