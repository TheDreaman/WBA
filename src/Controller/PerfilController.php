<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Usuario;
use App\Form\PerfilType;

class PerfilController extends AbstractController
{
    public function perfil(UserInterface $usuario)
    {     

        return $this->render('perfil/perfilPrivado.html.twig', [
            'users' => $usuario,
        ]);
    }

    public function verPerfil(Request $request, Usuario $usuario)
    {
        if (!$usuario) {
            return $this -> redirectToRoute('index');
        }

        return $this -> render('perfil/perfilPrivado.html.twig', [
            'users' => $usuario,
        ]);
    }

    public function editarPerfil(Request $request, Usuario $user, UserInterface $usuario)
    {        
        if (!$usuario || $usuario->getId() != $user -> getId()) {
            return $this -> redirectToRoute('perfil');
        }

        $form = $this -> createForm(PerfilType::Class, $user);

        $form -> handleRequest($request);

        if ($form -> isSubmitted() && $form -> isValid()) {

            $em = $this ->  getDoctrine()->getManager();
            $em -> persist($user);
            $em -> flush();

            return $this -> redirect(
                $this -> generateUrl('perfil')
            );
        }

        return $this->render('perfil/perfilPrivado.html.twig', [
            'users' => $user,
            'edit' => true,
            'form' => $form -> createView()
        ]);
    }
}
