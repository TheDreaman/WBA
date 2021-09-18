<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Usuario;
use App\Entity\Boleta;
use App\Entity\Matricula;
use App\Form\RegistroType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UsuariosController extends AbstractController
{
    public function registro(Request $request, UserPasswordEncoderInterface $encoder)
    {
        //Crea formulario
        $usuario = new Usuario();
        $form = $this -> createForm(RegistroType::class, $usuario);

        //Rellena el objeto con los datos del formulario
        $form -> handleRequest($request);

        $BolMat = $usuario -> getBolMat();        
        //Comprueba si el form se envió 
        if ($form -> isSubmitted() && $form -> isValid()) {
            //Checa si la boleta o matricula ingresada existen en la BDD
            $BolMat = $usuario -> getBolMat();            
            $matriculas_repo = $this -> getDoctrine() 
            -> getRepository(Matricula::class)
            -> findBy(array('matriculas' => $BolMat));
            $boletas_repo = $this -> getDoctrine()
            -> getRepository(Boleta::class)
            -> findBy(array('boleta' => $BolMat));

            //Asigna roles de Alumno o Docente
            if ($boletas_repo) {
                $usuario -> setRol('ROLE_USERA');
            }
            elseif ($matriculas_repo) {
                $usuario -> setRol('ROLE_USERD');  
            }
            else
            {                
                return $this->render('usuarios/registro.html.twig', [
                    'form' => $form -> createView(),
                    'bolError' => 'No existe ningun alumno o docente con ese numero'
                ]);
            }

            //Modifica el objeto para guardarlo
            //$usuario -> setRol('ROLE_USER');            
            $usuario -> setFechaCreado(new \DateTime('now'));

            //Cifra la contraseña con el algoritmo seleccionado (bcrypt)
            $encoded = $encoder -> encodePassword($usuario, $usuario -> getPassword());
            $usuario -> setPass($encoded);

            //Guardar usuario
            $em = $this -> getDoctrine() -> getManager();
            $em -> persist($usuario);
            $em -> flush();

            return $this -> redirectToRoute('index');
        }

        return $this->render('usuarios/registro.html.twig', [
            'form' => $form -> createView()
        ]);
    }

    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils -> getLastAuthenticationError();
        $lastUsername = $authenticationUtils -> getLastUsername();

        

        return $this -> render('usuarios/login.html.twig', array(
            'error' => $error,
            'last_username' => $lastUsername
        ));
    }
}
