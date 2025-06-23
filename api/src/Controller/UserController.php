<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

final class UserController extends AbstractController
{
    #[Route('/api/register', name: 'api_register', methods: ['POST'])]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $user = new User();
        $user->setEmail($data['email']);
        $user->setPassword($passwordHasher->hashPassword($user, $data['password']));
        $user->setUsername($data['username']);
        $em->persist($user);
        $em->flush();
        return new JsonResponse(['status' => 'User created'], Response::HTTP_CREATED);
    }



    #[Route('/api/login', name: 'login', methods: ['POST'])]
    public function __invoke(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher,
        JWTTokenManagerInterface $JWTManager
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);
        $username = $data['username'] ?? null;
        $password = $data['password'] ?? null;

        if (!$username || !$password) {
            return new JsonResponse(['message' => 'Email and password required'], 400);
        }

        /** @var User|null $user */
        $user = $em->getRepository(User::class)->findOneBy(['username' => $username]);
        if (!$user || !$passwordHasher->isPasswordValid($user, $password)) {
            return new JsonResponse(['message' => 'Invalid creddentials'], 401);
        }
        $token = $JWTManager->create($user);

        return new JsonResponse(['token' => $token]);
    }
}
