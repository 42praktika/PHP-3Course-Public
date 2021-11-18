<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloWorldController
{
    /**
     * @return Response
     * @Route("/hello/{who}", name="HelloRoute")
     */
    public function world($what,$who)
    {
        return new Response(  	"<html><body>Hello, $who</body></html>"	);
    }
}