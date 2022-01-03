<?php

namespace App\Controller;

use App\Entity\SampleComment;
use App\Entity\SampleImage;
use App\Entity\Tag;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        $tagFilter = ($request->get('tag_filter'))?? false;
        $user = $this->getUser();
        $samplesLikedByUser = null;
        $sampleRepository = $doctrine->getRepository(SampleImage::class);
        $tagRepository = $doctrine->getRepository(Tag::class);
        $tags = $tagRepository->findAll();
        if($user)
        {
            $samplesLikedByUser = $sampleRepository->findByJoinUser($user->getId());
        }
        if(!$tagFilter)
        {
            $sampleSearchOptions = [
                'isPublished'=>true
            ]
            ;
        } else {
            $sampleSearchOptions = [
                'isPublished'=>true,
                'tags' => $tagFilter
            ]
            ;
        }
        $samples = $sampleRepository->findBy($sampleSearchOptions);

        return $this->render('portfolio/index.html.twig', [
            'samples' => $samples,
            'samples_liked_by_user' => $samplesLikedByUser,
            'tags' => $tags,
            'tag_filter' => $tagFilter
        ]);
    }

    /**
     * @Route("/{id}", name="show")
     */
    public function show($id, ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();
        $samplesLikedByUser = null;
        $sampleRepository = $doctrine->getRepository(SampleImage::class);
        if($user)
        {
            $samplesLikedByUser = $sampleRepository->findByJoinUser($user->getId());
        }

        $sample = $sampleRepository->findOneBy([
            'id' => $id,
            'isPublished'=>true
        ]);

        $nextPost = $sampleRepository->getNextPost($id);
        $prevPost = $sampleRepository->getPreviousPost($id);

        return $this->render('portfolio/show.html.twig', [
            'sample' => $sample,
            'samples_liked_by_user' => $samplesLikedByUser,
            'sample_next' => $nextPost,
            'sample_prev' => $prevPost
        ]);
    }

    /**
     * @Route("/comment/add", name="comment_add")
     */
    public function addComment(Request $request, EntityManagerInterface $entityManager,ManagerRegistry $registry): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $registry->getRepository(User::class)->findOneBy(['email' => $this->getUser()->getUserIdentifier()]);
        $sampleImage = null;
        if($request->isMethod('post'))
        {
            $sampleImageId = $request->get('sample_image_id');
            $commentContent = $request->get("comment_{$sampleImageId}");
            $sampleImage = $registry->getRepository(SampleImage::class)
                ->findOneBy(['id' => $sampleImageId]);

            $comment = new SampleComment();
            $comment->setUser($user);
            $comment->setSampleImage($sampleImage);
            $comment->setContent($commentContent);
            $entityManager->persist($comment);
            $entityManager->flush();
            $this->addFlash('success','comment saved');
        } else {
            $this->addFlash('danger','comment not saved');
        }
        if($sampleImage)
        {
            return $this->redirectToRoute('portfolio_show',['id' => $sampleImage->getId()]);
        } else {
            return $this->redirectToRoute('portfolio_index');
        }

    }

}
