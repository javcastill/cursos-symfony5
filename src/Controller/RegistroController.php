<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Form\UsuarioType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\BrowserKit\Request;

class RegistroController extends AbstractController
{
    /**
     * @Route("/registro", name="registro")
     */
    public function index(Request $request): Response
    {
        $user= new Usuario();
        $form=$this->createForm(UsuarioType::class,$user);
        $form->handleRequest($request);

        if($form->handleRequest($request) && $form->isValid()){
            $en= $this->getDoctrine()->getManager();
            $en->persist($user);
            $en->flush();
            return $this->redirectToRoute('registro');
            $this->addFlash( 'exito', 'se ha registrado exitosamente');
            
        }else{

        }
        return $this->render('registro/index.html.twig', [
            'controller_name' => 'HolaMundo',
            'usuario' => 'Hola mundo',
            'formulario'=>$form->createView()
        ]);
    }
}
