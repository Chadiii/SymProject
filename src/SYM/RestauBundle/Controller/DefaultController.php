<?php

namespace SYM\RestauBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use SYM\RestauBundle\Entity\Menu;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $menus = $em->getRepository('SYMRestauBundle:Menu')->findAll();

        return $this->render('@SYMRestau/Default/index.html.twig', array(
            'menus' => $menus,
        ));
    }

    /**
     * Finds and displays a menu entity.
     *
     * @Route("/show/{id}", name="show")
     * @Method("GET")
     */
    public function showAction(Menu $menu)
    {
        return $this->render('@SYMRestau/Default/show.html.twig', array(
            'menu' => $menu,
        ));
    }

    /**
     * @Route("/login", name="login")
     */
    public function login()
    {
        $request = Request::createFromGlobals();
        $login = $request->request->get('login');
        $password = $request->request->get('password');
        if($login != null && $password != null){
            if($login == "admin" && $password == "admin"){
                $this->get('session')->set('isLogged', true);

                return $this->redirectToRoute('menu_index');
            }
            else
            return $this->render('@SYMRestau/Default/login.html.twig', ["errorMessage"=>"Identifiants incorrects"]);
        }
        return $this->render('@SYMRestau/Default/login.html.twig', ["errorMessage"=>null]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        $this->get('session')->set('isLogged', false);
        return $this->redirectToRoute('index');
    }

    /**
     * @Route("/not_logged", name="not_logged")
     */
    public function notLogged()
    {
        return $this->render('@SYMRestau/Default/notLogged.html.twig');
    }
}
