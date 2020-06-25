<?php

namespace SYM\RestauBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use SYM\RestauBundle\Entity\Supplement;

class DefaultController extends Controller
{
    private $res = array();
    private $em;
    private $supplementRepository;

    function __construct(){
        for($i=0;$i<=10;$i++){
            $this->res[] = array("id"=>"a$i", "nom"=>"Pizza", "price"=>"50", "sup"=>array(array("nom"=>"ketchup", "price"=>"5"), array("nom"=>"sauce", "price"=>"8")), "img"=>"https://images.pexels.com/photos/315755/pexels-photo-315755.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940");
            $this->res[] = array("id"=>"b$i", "nom"=>"Tacos", "price"=>"55", "sup"=>array(array("nom"=>"fromage", "price"=>"5"), array("nom"=>"frite", "price"=>"10")), "img"=>"https://img.cuisineaz.com/400x320/2019-04-17/i146583-tacos-poulet-curry.jpeg");
            $this->res[] = array("id"=>"c$i", "nom"=>"Tagine", "price"=>"30", "sup"=>array(), "img"=>"https://img.cuisineaz.com/610x610/2017-06-22/i129611-tagine-de-courgettes-aux-tomates.jpeg");
        }
    }
    /**
     * @Route("/", name="index")
     */
    public function indexAction()
    {
        return $this->render('@SYMRestau/Default/index.html.twig',["res"=>$this->res]);
    }

    /**
     * @Route("/showMenu/{id}", methods={"GET","HEAD"}, name="showMenu")
     */
    public function showMenu(string $id)
    {
        $item = array();
        foreach ($this->res as $el){
            if($el["id"]==$id){
                $item = $el;
                break;
            }
        }
        return $this->render('@SYMRestau/Default/showMenu.html.twig',["item"=>$item]);
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
        return $this->render('@SYMRestau/Default/manageMenu.html.twig',["res"=>$this->res]);
    }

    /**
     * @Route("/editMenu/{id}", methods={"GET","HEAD"}, name="editMenu")
     */
    public function editMenu(string $id)
    {
        
        return $this->render('@SYMRestau/Default/editMenu.html.twig',);
    }

    /**
     * @Route("/deleteMenu/{id}", methods={"GET","HEAD"}, name="deleteMenu")
     */
    public function deleteMenu(string $id)
    {
        return $this->redirectToRoute('manageMenu');
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
        $repository = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('SYMRestauBundle:Supplement')
        ;

        $listSupplements = $repository->findAll();
        return $this->render('@SYMRestau/Default/manageSupplement.html.twig',['listSupplements'=>$listSupplements]);
    }

    /**
     * @Route("/editSupplement/{id}", methods={"GET","HEAD"}, name="editSupplement")
     */
    public function editSupplement(string $id)
    {
        
        return $this->render('@SYMRestau/Default/editSupplement.html.twig',);
    }

    /**
     * @Route("/deleteSupplement/{id}", methods={"GET","HEAD"}, name="deleteSupplement")
     */
    public function deleteSupplement(string $id)
    {
        return $this->redirectToRoute('manageSupplement');
    }

    /**
     * @Route("/addSupplement", name="addSupplement")
     */
    public function addSupplement()
    {
        $supp = new Supplement();
        $supp->setNom("Fromage");
        $supp->setPrix(5);

        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getManager();

        // Étape 1 : On « persiste » l'entité
        $em->persist($supp);

        // Étape 2 : On « flush » tout ce qui a été persisté avant
        $em->flush();

        return $this->render('@SYMRestau/Default/addSupplement.html.twig',);
    }
}
