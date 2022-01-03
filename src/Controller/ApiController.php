<?php

namespace App\Controller;

use App\Entity\SampleImage;
use App\Entity\SampleLike;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api", name="api_")
 */
class ApiController extends AbstractController
{

    /**
     * @Route("/add/like", name="add_like")
     * @param Request $request
     * @return Response|null
     */
    public function addLike(Request $request, ManagerRegistry $registry, EntityManagerInterface $entityManager): ?Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $sampleImageRepository = $registry->getRepository(SampleImage::class);
        $data = json_decode($request->getContent(),true);
        $id = $data['id'];

        if ($request->isMethod('post')) {
            $user = $registry->getRepository(User::class)->findOneBy([
                'email' => $this->getUser()->getUserIdentifier()
            ]);
            $sampleImage = $sampleImageRepository->findOneBy([
                'id' => $id
            ]);
            $like = $sampleImageRepository->findOneLikeByUser($id,$user->getId());
            if(!$like)
            {
                $SampleLike = new SampleLike();
                $SampleLike->addSample($sampleImage);
                $SampleLike->addUser($user);
                $entityManager->persist($SampleLike);
                $entityManager->flush();
                $sampleHasLike = true;
            } else
            {
                $sampleImageLike = $registry->getRepository(SampleLike::class)->findOneByUserLike(
                $user,
                $id
                );
                if($sampleImageLike)
                {
                    $entityManager->remove($sampleImageLike);
                    $entityManager->flush();
                }
                $sampleHasLike = false;
            }
            $likes = $sampleImageRepository->countLikes($id);
            return new JsonResponse([
                'likes' => $likes,
                'sampleHasLike' => $sampleHasLike
            ]);
        }
        return new JsonResponse('fehler');
    }
}
