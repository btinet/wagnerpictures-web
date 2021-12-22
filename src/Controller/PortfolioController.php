<?php

namespace App\Controller;

use App\Entity\SampleImage;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/portfolio", name="portfolio_")
 */
class PortfolioController extends AbstractController
{

    /**
     * @Route("/", name="index")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $samples = $doctrine->getRepository(SampleImage::class)->findBy(['isPublished'=>true]);
        return $this->render('portfolio/index.html.twig', [
            'samples' => $samples
        ]);
    }

}