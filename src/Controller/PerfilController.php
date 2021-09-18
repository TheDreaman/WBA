<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PerfilController extends AbstractController
{
    public function perfil(): Response
    {
        return $this->render('perfil/index.html.twig', [
            'controller_name' => 'PerfilController',
        ]);
    }

    public function verPerfil(Request $request, UserInterface $usuario, Proyecto $proyecto)
    {
        /*if (!$usuario || $usuario->getId() != $proyecto -> getUsuario() -> getId()) {
            return $this -> redirectToRoute('mi_proyecto');
        }*/

        $form = $this -> createForm(ProyectoType::Class, $proyecto);

        $form -> handleRequest($request);

        if ($form -> isSubmitted() && $form -> isValid()) {
            //$proyecto -> setUsuario($usuario);

            $em = $this ->  getDoctrine()->getManager();
            $em -> persist($proyecto);
            $em -> flush();

            return $this -> redirect(
                $this -> generateUrl('ver_perfil', ['id' => $proyecto -> getId()])
            );
        }

        return $this -> render('perfil/index.html.twig', [
            'edit' => true,
            'form' => $form -> createView()
        ]);
    }
}
