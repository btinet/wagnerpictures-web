<?php

namespace App\Controller;

use App\Form\AddressType;
use App\Repository\ProfileSettingRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profile", name="profile_")
 */
class ProfileController extends AbstractController
{

    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(UserRepository $userRepository, ProfileSettingRepository $settingRepository): Response
    {
        $this->denyAccessUnlessGranted("ROLE_USER");
        $currentSetting = null;
        $settings = $settingRepository->findAll();


        return $this->render('profile/index.html.twig', [
            'user' => $userRepository->find($this->getUser()),
            'settings' => $settings,
            'current_setting' => $currentSetting,
        ]);
    }

    /**
     * @Route("/{action}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(UserRepository  $userRepository, ProfileSettingRepository $settingRepository, $action): Response
    {
        $this->denyAccessUnlessGranted("ROLE_USER");

        $settings = $settingRepository->findAll();
        $currentSetting = null;
        $currentSetting = $settingRepository->findOneBy([
            'slug' => $action
        ]);
        $formClass = "App\\Form\\{$currentSetting->getForm()->getFormType()}";
        $form = $this->createForm($formClass);

        return $this->render('profile/index.html.twig', [
            'user' => $userRepository->find($this->getUser()),
            'settings' => $settings,
            'current_setting' => $currentSetting,
            'form' => $form->createView()
        ]);
    }

}