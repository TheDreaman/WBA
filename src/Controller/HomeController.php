<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Entity\Usuario;

class HomeController extends AbstractController
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function index(): Response
    {   
        //Rechaza cualquier conexión que no sea de un rol de usuario
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'Debes ser usuario registrado para ver el contenido');        

        $em = $this ->  getDoctrine()->getManager();

        $usuario_repo = $this -> getDoctrine()->getRepository(Usuario::class);
        $usuarios = $usuario_repo -> findAll();
        $rndm_users = $usuario_repo -> findAll();
        shuffle($rndm_users);  /* NOTA: FUNCIONA BIEN EN ARRAYS NO MAYORES A 10K, DESPUES COMIENZA A RETRASAR LA PAGINA  */


        /*var_dump($rndm_users);        */
        

        /*$my_array = array("red","green","blue","yellow","purple");
        shuffle($my_array);
        var_dump($my_array);*/

        //foreach ($usuarios as $usuario) 
       // {
            //echo "<h2> {$usuario -> getNombre()} {$usuario -> getApePat()} {$usuario -> getApeMat()} </h2>";

            /*foreach ($usuario -> getProyectos() as $proyecto) 
            {
                echo $proyecto -> getTitulo()."<br/>";
            }*/
        //}

        return $this->render('home/index.html.twig', [
            'usuarios' => $usuarios,
            'random_users' => $rndm_users,
        ]);
    }
}
