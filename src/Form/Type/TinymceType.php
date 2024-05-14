<?php

namespace EmilePerron\TinymceBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TinymceType extends AbstractType
{
	public function configureOptions(OptionsResolver $resolver): void
	{
		$resolver->setDefaults([
			'compound' => false,
		]);
	}

	public function getParent(): string
	{
		return FormType::class;
	}

	public function getName(): string
	{
		return 'tinymce';
	}

	public function getBlockPrefix(): string
	{
		return 'tinymce';
	}

	public function test(): string
	{
		return 'tinymce';
	}
}
