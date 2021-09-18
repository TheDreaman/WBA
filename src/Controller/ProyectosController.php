<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Proyecto;
use App\Entity\Usuario;
use App\Form\ProyectoType;

class ProyectosController extends AbstractController
{
    public function index(): Response
    {
        //Prueba de entidades y relaciones
        
        
        $proyect_repo = $this -> getDoctrine()->getRepository(Proyecto::class);
        $proyectos = $proyect_repo -> findAll();



        /*foreach ($proyectos as $proyecto) {
            echo $proyecto -> getUsuario() -> getNombre(). $proyecto -> getUsuario() -> getApePat().' '.$proyecto -> getTitulo()."<br/>";
        }*/

        /*$usuario_repo = $this -> getDoctrine()->getRepository(Usuario::class);
        $usuarios = $usuario_repo -> findAll();

        foreach ($usuarios as $usuario) 
        {
            echo "<h2> {$usuario -> getNombre()} {$usuario -> getApePat()} {$usuario -> getApeMat()} </h2>";

            foreach ($usuario -> getProyectos() as $proyecto) 
            {
                echo $proyecto -> getTitulo()."<br/>";
            }
        }*/

        return $this->render('proyectos/index.html.twig', [
            'proyectos' => $proyectos,
        ]);
    }

    public function crear(Request $request, UserInterface $usuario)
    {
        //Si el usuario ya tiene un proyecto lo redirige a su proyecto
        if (count($usuario -> getProyectos())>0) {
            return $this -> redirectToRoute('mi_proyecto');
        }

        $proyecto = new Proyecto();
        $form = $this -> createForm(ProyectoType::Class, $proyecto);

        $form -> handleRequest($request);

        if ($form -> isSubmitted() && $form -> isValid()) {
            $proyecto -> setUsuario($usuario);

            $em = $this ->  getDoctrine()->getManager();
            $em -> persist($proyecto);
            $em -> flush();

            return $this -> redirect(
                $this -> generateUrl('mi_proyecto'/*, ['id' => $proyecto -> getId()]*/)
            );
        }

        return $this->render('proyectos/crear.html.twig', [
            'form' => $form -> createView()
        ]);
    }

    public function miProyecto(UserInterface $usuario)
    {
        $proyecto = $usuario -> getProyectos();
        /*if (count($proyecto)<1) {
            $proyecto = null;    
        }*/
        
        
        /*var_dump($proyecto);*/

        return $this -> render('proyectos/mi-proyecto.html.twig', [
            'proyecto' => $proyecto 
        ]);
    }

    public function editarProyecto(Request $request, UserInterface $usuario, Proyecto $proyecto)
    {
        if (!$usuario || $usuario->getId() != $proyecto -> getUsuario() -> getId()) {
            return $this -> redirectToRoute('mi_proyecto');
        }

        $form = $this -> createForm(ProyectoType::Class, $proyecto);

        $form -> handleRequest($request);

        if ($form -> isSubmitted() && $form -> isValid()) {
            //$proyecto -> setUsuario($usuario);

            $em = $this ->  getDoctrine()->getManager();
            $em -> persist($proyecto);
            $em -> flush();

            return $this -> redirect(
                $this -> generateUrl('mi_proyecto'/*, ['id' => $proyecto -> getId()]*/)
            );
        }

        return $this -> render('proyectos/crear.html.twig', [
            'edit' => true,
            'form' => $form -> createView()
        ]);
    }

    public function borrarProyecto(Proyecto $proyecto, UserInterface $usuario)
    {
        if (!$usuario || $usuario->getId() != $proyecto -> getUsuario() -> getId()) {
            return $this -> redirectToRoute('mi_proyecto');
        }
        if (!$proyecto) {
            return $this -> redirectToRoute('mi_proyecto');
        }

        $em = $this -> getDoctrine() -> getManager();
        $em -> remove($proyecto);
        $em -> flush();

        return $this -> redirectToRoute('mi_proyecto');
    }

    public function verUsuarios(): Response
    {
        //Prueba de entidades y relaciones

        $usuario_repo = $this -> getDoctrine()->getRepository(Usuario::class);
        $usuarios = $usuario_repo -> findAll();

        /*foreach ($usuarios as $usuario) 
        {
            echo "<h2> {$usuario -> getNombre()} {$usuario -> getApePat()} {$usuario -> getApeMat()} </h2>";

            foreach ($usuario -> getProyectos() as $proyecto) 
            {
                echo $proyecto -> getTitulo()."<br/>";
            }
        }*/

        return $this->render('usuarios/devuser.html.twig', [
            'usuarios' => $usuarios
        ]);
    }
}
