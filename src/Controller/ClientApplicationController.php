<?php

namespace App\Controller;

use App\Entity\Application;
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
            'applications' => $applicationRepository->findBy([
                'isComplete' => false
            ]),
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
            $images = $form->get('images');
            if($images->isEmpty())
            {
                $this->addFlash('warning','no images selected');
            } else {
                $user = $userRepository->find($this->getUser());
                $application->setUser($user);
                $entityManager->persist($application);
                $entityManager->flush();

                return $this->redirectToRoute('application_edit', ['id' => $application->getId()], Response::HTTP_SEE_OTHER);
            }
        }
        return $this->renderForm('client_application/new.html.twig', [
            'application' => $application,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(int $id, EntityManagerInterface $entityManager): Response
    {
        $application = $entityManager->find(Application::class,$id);
        return $this->render('client_application/show.html.twig', [
            'application' => $application,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, int $id, EntityManagerInterface $entityManager): Response
    {
        $application = $entityManager->find(Application::class,$id);
        if(!$application->getIsComplete())
        {
            $form = $this->createForm(ApplicationType::class, $application);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->flush();

                return $this->redirectToRoute('application_show', ['id'=>$application->getId()], Response::HTTP_SEE_OTHER);
            }

            return $this->renderForm('client_application/edit.html.twig', [
                'application' => $application,
                'form' => $form,
            ]);
        } else {
            return $this->redirectToRoute('application_show',['id' => $application->getId()]);
        }

    }

    /**
     * @Route("/{id}/submit", name="submit", methods={"POST"})
     */
    public function submit(Request $request, int $id, EntityManagerInterface $entityManager): Response
    {
        $application = $entityManager->find(Application::class,$id);
        if (
            $this->isCsrfTokenValid('submit'.$application->getId(), $request->request->get('_token'))
            and
            !empty($application->getModel())
        ) {
            $application->setIsComplete(true);
            $entityManager->persist($application);
            $entityManager->flush();
        }
        return $this->redirectToRoute('application_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, int $id, EntityManagerInterface $entityManager): Response
    {
        $application = $entityManager->find(Application::class,$id);
        if ($this->isCsrfTokenValid('delete'.$application->getId(), $request->request->get('_token'))) {
            $entityManager->remove($application);
            $entityManager->flush();
        }

        return $this->redirectToRoute('application_index', [], Response::HTTP_SEE_OTHER);
    }

}