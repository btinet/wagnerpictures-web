<?php

namespace App\Controller;

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
     * @Route("/", name="index")
     */
    public function application(Request $request): Response
    {
        if($request->isMethod('post'))
        {
            $files = $request->get('file');
            $filepath = $request->get('application_images');
            die(print_r($files));
        }
        return $this->render('client_application/index.html.twig', [

        ]);
    }

}