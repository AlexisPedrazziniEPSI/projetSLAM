<?php

namespace App\Controller;

use App\Entity\Register;
use App\Form\RegisterType;
use App\Repository\RegisterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/register')]
final class RegisterController extends AbstractController
{
    #[Route(name: 'app_register_index', methods: ['GET'])]
    public function index(RegisterRepository $registerRepository): Response
    {
        return $this->render('register/index.html.twig', [
            'registers' => $registerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_register_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $register = new Register();
        $form = $this->createForm(RegisterType::class, $register);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($register);
            $entityManager->flush();

            return $this->redirectToRoute('app_register_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('register/new.html.twig', [
            'register' => $register,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_register_show', methods: ['GET'])]
    public function show(Register $register): Response
    {
        return $this->render('register/show.html.twig', [
            'register' => $register,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_register_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Register $register, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RegisterType::class, $register);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_register_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('register/edit.html.twig', [
            'register' => $register,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_register_delete', methods: ['POST'])]
    public function delete(Request $request, Register $register, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$register->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($register);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_register_index', [], Response::HTTP_SEE_OTHER);
    }
}
