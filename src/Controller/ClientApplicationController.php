<?php

namespace App\Controller;

use App\Entity\Application;
use App\Entity\User;
use App\Form\ApplicationImageOnlyType;
use App\Form\ApplicationType;
use App\Repository\ApplicationRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/application", name="application_")
 */
class ClientApplicationController extends AbstractController
{

    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(ApplicationRepository $applicationRepository): Response
    {
        return $this->render('client_application/index.html.twig', [
            'applications' => $applicationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {
        $application = new Application();
        $form = $this->createForm(ApplicationImageOnlyType::class, $application);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $userRepository->find($this->getUser());
            $application->setUser($user);
            $entityManager->persist($application);
            $entityManager->flush();

            return $this->redirectToRoute('application_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('client_application/new.html.twig', [
            'application' => $application,
            'form' => $form,
        ]);
    }

}