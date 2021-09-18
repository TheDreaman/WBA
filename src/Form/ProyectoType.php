<?php
namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ProyectoType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder 
		-> add('titulo', TextType::class, array(
			'label' => 'Título'
		))
		-> add('descripcion', TextareaType::class, array(
			'label' => 'Descripción'
		))
		-> add('submit', SubmitType::class, array(
			'label' => 'Guardar'
		));
	}

}