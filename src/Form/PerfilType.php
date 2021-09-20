<?php 

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class PerfilType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder 
		-> add('cel', TextType::class, array(
			'label' => 'Celular'
		))
		-> add('descripcion', TextareaType::class, array(
			'label' => 'Descripción'
		))
		-> add('estudios', TextareaType::class, array(
			'label' => 'Estudios'
		))
		-> add('acadmy', ChoiceType::class, array(
			'label' => 'Academia',
			'choices' => array(
				'Comunicacionees y Electronica' => 'Comunicacionees y Electronica',
				'Informática' => 'Informática',
				'Micro procesadores' => 'Micro procesadores',
				'Ingenieria y Sociedad' => 'Ingenieria y Sociedad',
				'Matemáticas y Física' => 'Matemáticas y Física',
				'Computación' => 'Computación',
				'Química' => 'Química',
			)
		))
		-> add('disponible', ChoiceType::class, array(
			'label' => 'Disponibilidad',
			'choices' => array(
				'No disponible' => false,
				'Disponible' => true,
			)
		))
		-> add('lugarAt', TextareaType::class, array(
			'label' => 'Lugar de atención'
		))
		-> add('submit', SubmitType::class, array(
			'label' => 'Guardar'
		));
	}

}