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

    public function index(Request $req)
    {   
        //Rechaza cualquier conexión que no sea de un rol de usuario
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'Debes ser usuario registrado para ver el contenido');        

        $em = $this ->  getDoctrine()->getManager();

        $usuario_repo = $this -> getDoctrine()->getRepository(Usuario::class);
        $usuarios = $usuario_repo -> findAll();
        $rndm_users = $usuario_repo -> findBy(['rol' => 'ROLE_USERD']);
        shuffle($rndm_users);

        /*$usuarios = $usuario_repo -> findAll();
        $rndm_users = $usuario_repo -> findAll();
        shuffle($rndm_users);*/  /* NOTA: FUNCIONA BIEN EN ARRAYS NO MAYORES A 10K, DESPUES COMIENZA A RETRASAR LA PAGINA  */


        /*var_dump($rndm_users);        */



        if($req -> isMethod('POST'))
        {
            $buscar = $req -> get('buscar');
            $academia = $req -> get('academia');  
            $apellido = $req -> get('apellido');            
            /*var_dump($academia);*/

            if (empty($apellido) && empty($academia) && !empty($buscar)) {
                $asesor = $em -> getRepository(Usuario::class)->findBy(['nombre' => $buscar]);
            }
            elseif (empty($apellido) && !empty($academia) && empty($buscar)) {
                $asesor = $em -> getRepository(Usuario::class)->findBy(['acadmy' => $academia]);                  
            }
            elseif (empty($apellido) && !empty($academia) && !empty($buscar)) {
                $asesor = $em -> getRepository(Usuario::class)->findBy(['acadmy' => $academia, 'nombre' => $buscar]); 
            }
            elseif (!empty($apellido) && empty($academia) && empty($buscar)){
                $asesor =  $em -> getRepository(Usuario::class)->findBy(['apePat' => $apellido]); 
            }
            elseif (!empty($apellido) && empty($academia) && !empty($buscar)){
                $asesor = $em -> getRepository(Usuario::class)->findBy(['apePat' => $apellido, 'nombre' => $buscar]); 
            }
            elseif (!empty($apellido) && !empty($academia) && empty($buscar)){
                $asesor = $em -> getRepository(Usuario::class)->findBy(['acadmy' => $academia, 'apePat' => $apellido]);
            }
            elseif (!empty($apellido) && !empty($academia) && !empty($buscar)){
                $asesor = $em -> getRepository(Usuario::class)->findBy(['apePat' => $apellido, 'nombre' => $buscar, 'acadmy' => $academia]);    
            }
            else{
                return $this->render('home/index.html.twig', [
                    'usuarios' => $usuarios,
                    'random_users' => $rndm_users,
                ]);
            }

            
            return $this->render('home/index.html.twig', [
                'usuarios' => $asesor,
                'random_users' => $rndm_users,
            ]);   
        }
        /*
        000
        001
        010
        011
        100
        101
        110
        111*/

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

    public function buscaNombre(Request $req){
        $em = $this ->  getDoctrine()->getManager();
        $asesor = $em -> getRepository(Usuario::class)->findAll();
        if($req -> isMethod('POST'))
        {
            $buscar = $req -> get('buscar');            
            $asesor = $em -> getRepository(Usuario::class)->findBy(array('nombre' => $buscar));
        }

        /*var_dump($asesor);*/

        return $this->render('home/index.html.twig', [
            'usuarios' => $asesor,
            'random_users' => $asesor,
        ]);    
    }
}
