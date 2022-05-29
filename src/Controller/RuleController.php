<?php

namespace App\Controller;

use App\Entity\Rule;
use Doctrine\ORM\EntityManagerInterface;
use App\Helper\RuleFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RuleController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private RuleFactory $ruleFactory
    ) {
    }
    /**
     * @Route("/rule", methods={"POST"})
     */
    public function createRule(Request $request): Response
    {
        $query = $request->getContent();
        $rule = $this->ruleFactory->ruleDecoded($query);

        $this->entityManager->persist($rule);
        $this->entityManager->flush();

        return new JsonResponse($rule);
    }

    /**
     * @Route("/rule", methods={"GET"})
     */
    public function getRules(): Response
    {
        $ruleRespository = $this->entityManager->getRepository(Rule::class);
        $ruleList = $ruleRespository->findAll();
        return new JsonResponse($ruleList);
    }

    /**
     * @Route("/rule/{id}", methods={"GET"})
     */
    public function getOneRule(int $id): Response
    {
        $ruleSearched = $this->searchRule($id);
        return new JsonResponse($ruleSearched);
    }


    /**
     * @Route("/rule/{id}", methods={"PUT"})
     */
    public function updateRule(int $id, Request $request): Response
    {
        $ruleSearched = $this->searchRule($id);
        if (is_null($ruleSearched)) {
            return new JsonResponse($ruleSearched, Response::HTTP_NOT_FOUND);
        }

        $query = $request->getContent();
        $ruleUpdated = $this->ruleFactory->ruleDecoded($query);
        $ruleSearched->name = $ruleUpdated->name;
        $this->entityManager->flush();

        return new JsonResponse($ruleSearched, Response::HTTP_OK);
    }

    /**
     * @Route("/rule/{id}", methods={"DELETE"})
     */
    public function deleteRule($id){
        $ruleToDelete = $this->searchRule($id); 
        if (is_null($ruleToDelete)) {
            return new JsonResponse("Id not found", Response::HTTP_NOT_FOUND);
        }
        $this->entityManager->remove($ruleToDelete);
        $this->entityManager->flush();
        return new JsonResponse(`Rule ${id} removed`, Response::HTTP_NO_CONTENT);
    }

    private function searchRule(int $id)
    {
        $ruleRepository = $this->entityManager->getRepository(Rule::class);
        $ruleSearched = $ruleRepository->find($id);
        return $ruleSearched;
    }
}
