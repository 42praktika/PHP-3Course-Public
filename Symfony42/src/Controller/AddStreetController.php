<?php

namespace App\Controller;

use App\Entity\Streets;
use App\Repository\StreetsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AddStreetController extends AbstractController
{
    /**
     * @Route("/streets/add", name="add_street")
     */
    public function add(Request $request, EntityManagerInterface $manager, ValidatorInterface $validator): Response
    {
        $name = $request->query->get("street_name");
        $zip = $request->query->get("zipcode");
        $entity = new Streets();
        $entity
            ->setIndex($zip)
            ->setName($name);
        $errors = $validator->validate($entity);
        if (count($errors) > 0) {
            return new Response((string)$errors, 400);
        }
        $manager->persist($entity);
        $manager->flush();
        return new Response();
    }

    /**
     * @Route("/street", name="street_form")
     */
    public function index(): Response
    {
        return $this->render('add_street/index.html.twig', [
            'controller_name' => 'AddStreetController',
        ]);
    }

    /**
     * @Route("/streets/{id}", name="street_")
     */
    public function getstreet(string $id, StreetsRepository $repository): Response
    {
        $entities=$repository->getByIndex($id);
        return $this->render('add_street/street.html.twig', [
            'controller_name' => 'AddStreetController',
            'streets' => $entities
        ]);
    }

}
