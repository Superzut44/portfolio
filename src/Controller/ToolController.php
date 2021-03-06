<?php

namespace App\Controller;

use App\Entity\Tool;
use App\Form\ToolType;
use App\Repository\ToolRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/tool')]
class ToolController extends AbstractController
{
    #[Route('/index', name: 'app_tool_index', methods: ['GET'])]
    public function index(ToolRepository $toolRepository): Response
    {
        return $this->render(
            'tool/index.html.twig',
            [
            'tools' => $toolRepository->findAll(),
            ]
        );
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/new', name: 'app_tool_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ToolRepository $toolRepository): Response
    {
        $tool = new Tool();
        $form = $this->createForm(ToolType::class, $tool);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $toolRepository->add($tool);
            return $this->redirectToRoute('app_tool_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm(
            'tool/new.html.twig',
            [
            'tool' => $tool,
            'form' => $form,
            ]
        );
    }

    #[Route('/{id}', name: 'app_tool_show', methods: ['GET'])]
    public function show(Tool $tool): Response
    {
        return $this->render(
            'tool/show.html.twig',
            [
            'tool' => $tool,
            ]
        );
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/edit', name: 'app_tool_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tool $tool, ToolRepository $toolRepository): Response
    {
        $form = $this->createForm(ToolType::class, $tool);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $toolRepository->add($tool);
            return $this->redirectToRoute('app_tool_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm(
            'tool/edit.html.twig',
            [
            'tool' => $tool,
            'form' => $form,
            ]
        );
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_tool_delete', methods: ['POST'])]
    public function delete(Request $request, Tool $tool, ToolRepository $toolRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $tool->getId(), $request->request->get('_token'))) {
            $toolRepository->remove($tool);
        }

        return $this->redirectToRoute('app_tool_index', [], Response::HTTP_SEE_OTHER);
    }
}
