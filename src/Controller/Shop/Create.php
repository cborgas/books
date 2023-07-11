<?php

declare(strict_types=1);

namespace Books\Controller\Shop;

use Books\Entity\Shop;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class Create
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    #[Route('/api/shops', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $name = $data['name'] ?? '';

        $shop = new Shop();
        $shop->setName($name);

        $this->entityManager->persist($shop);
        $this->entityManager->flush();

        return new JsonResponse([
            'code' => 200,
            'message' => 'Shop created successfully',
            'data' => [
                'id' => $shop->getId()->toString(),
                'name' => $shop->getName(),
            ],
        ]);
    }
}
