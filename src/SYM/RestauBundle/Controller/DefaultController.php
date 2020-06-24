<?php

namespace SYM\RestauBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction()
    {
        $res = array();
        for($i=0;$i<=10;$i++){
            $res[] = array("nom"=>"Pizza", "price"=>"50", "sup"=>array(array("nom"=>"ketchup", "price"=>"5"), array("nom"=>"sauce", "price"=>"8")), "img"=>"https://images.pexels.com/photos/315755/pexels-photo-315755.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940");
            $res[] = array("nom"=>"Tacos", "price"=>"55", "sup"=>array(array("nom"=>"fromage", "price"=>"5"), array("nom"=>"frite", "price"=>"10")), "img"=>"https://img.cuisineaz.com/400x320/2019-04-17/i146583-tacos-poulet-curry.jpeg");
            $res[] = array("nom"=>"Tagine", "price"=>"30", "sup"=>array(), "img"=>"https://img.cuisineaz.com/610x610/2017-06-22/i129611-tagine-de-courgettes-aux-tomates.jpeg");
        }
        return $this->render('@SYMRestau/Default/index.html.twig',["res"=>$res]);
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
            if($login == "admin" && $password == "admin")
                return $this->redirectToRoute('manageMenu');
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
        //return $this->indexAction();
        return $this->redirectToRoute('index');
    }

    /**
     * @Route("/manageMenu", name="manageMenu")
     */
    public function manageMenu()
    {
        $res = array();
        for($i=0;$i<=10;$i++){
            $res[] = array("nom"=>"Pizza", "price"=>"50", "sup"=>array(array("nom"=>"ketchup", "price"=>"5"), array("nom"=>"sauce", "price"=>"8")), "img"=>"https://images.pexels.com/photos/315755/pexels-photo-315755.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940");
            $res[] = array("nom"=>"Tacos", "price"=>"55", "sup"=>array(array("nom"=>"fromage", "price"=>"5"), array("nom"=>"frite", "price"=>"10")), "img"=>"https://img.cuisineaz.com/400x320/2019-04-17/i146583-tacos-poulet-curry.jpeg");
            $res[] = array("nom"=>"Tagine", "price"=>"30", "sup"=>array(), "img"=>"https://img.cuisineaz.com/610x610/2017-06-22/i129611-tagine-de-courgettes-aux-tomates.jpeg");
        }
        return $this->render('@SYMRestau/Default/manageMenu.html.twig',["res"=>$res]);
    }

    /**
     * @Route("/addMenu", name="addMenu")
     */
    public function addMenu()
    {
        return $this->render('@SYMRestau/Default/addMenu.html.twig',);
    }

    /**
     * @Route("/manageSupplement", name="manageSupplement")
     */
    public function manageSupplement()
    {
        return $this->render('@SYMRestau/Default/manageSupplement.html.twig',);
    }

    /**
     * @Route("/addSupplement", name="addSupplement")
     */
    public function addSupplement()
    {
        return $this->render('@SYMRestau/Default/addSupplement.html.twig',);
    }
}
