<?php
namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class RegistroType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder 
		-> add('bolMat', TextType::class, array(
			'label' => 'Boleta o Matricula'
		))
		-> add('nombre', TextType::class, array(
			'label' => 'Nombre'
		))
		-> add('apePat', TextType::class, array(
			'label' => 'Apellido Paterno'
		))
		-> add('apeMat', TextType::class, array(
			'label' => 'Apellido Materno'
		))
		-> add('pass', PasswordType::class, array(
			'label' => 'Contraseña'
		))
		-> add('email', EmailType::class, array(
			'label' => 'Email Institucional'
		))
		-> add('cel', TextType::class, array(
			'label' => 'Celular'
		))
		-> add('submit', SubmitType::class, array(
			'label' => 'Registrar'
		));
	}

}