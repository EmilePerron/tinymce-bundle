<?php

namespace App\Controller;

use EmilePerron\TinymceBundle\Form\Type\TinymceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TestController extends AbstractController
{
    #[Route('/test/template')]
    public function template(): Response
    {
        return $this->render("template.html.twig");
    }
    #[Route('/test/javascript')]
    public function javascript(): Response
    {
        return $this->render("javascript.html.twig");
    }

    #[Route('/test/form')]
    public function form(Request $request): Response
    {
		$initialData = ['comment' => '<p>Initial text value</p>'];
        $form = $this->createFormBuilder($initialData)
			->add('comment', TinymceType::class, [
				"attr" => [
					"toolbar" => "bold underline | bullist numlist",
				]
			])
			->add('submit', SubmitType::class)
			->getForm();
		$form->handleRequest($request);

		if ($form->isSubmitted()) {
			$data = $form->getData();

			return new Response("
				<h1>Submitted content</h1>
				<pre>{$data['comment']}</pre>
			");
		}

        return $this->render("form.html.twig", [
            'form' => $form->createView(),
        ]);
    }
}
