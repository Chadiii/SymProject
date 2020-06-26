<?php

namespace SYM\RestauBundle\Controller;

use SYM\RestauBundle\Entity\Menu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Menu controller.
 *
 * @Route("menu")
 */
class MenuController extends Controller
{
    /**
     * Lists all menu entities.
     *
     * @Route("/", name="menu_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        if( !$this->get('session')->get('isLogged'))
            return $this->redirectToRoute('not_logged');

        $em = $this->getDoctrine()->getManager();
        $menus = $em->getRepository('SYMRestauBundle:Menu')->findAll();

        return $this->render('@SYMRestau/menu/index.html.twig', array(
            'menus' => $menus,
        ));
    }

    /**
     * Creates a new menu entity.
     *
     * @Route("/new", name="menu_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        if( !$this->get('session')->get('isLogged'))
            return $this->redirectToRoute('not_logged');

        $menu = new Menu();
        $form = $this->createForm('SYM\RestauBundle\Form\MenuType', $menu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($menu);
            $em->flush();

            return $this->redirectToRoute('menu_show', array('id' => $menu->getId()));
        }

        return $this->render('@SYMRestau/menu/new.html.twig', array(
            'menu' => $menu,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a menu entity.
     *
     * @Route("/{id}", name="menu_show")
     * @Method("GET")
     */
    public function showAction(Menu $menu)
    {
        if( !$this->get('session')->get('isLogged'))
            return $this->redirectToRoute('not_logged');

        return $this->render('@SYMRestau/menu/show.html.twig', array(
            'menu' => $menu,
        ));
    }

    /**
     * Displays a form to edit an existing menu entity.
     *
     * @Route("/{id}/edit", name="menu_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Menu $menu)
    {
        if( !$this->get('session')->get('isLogged'))
            return $this->redirectToRoute('not_logged');

        $editForm = $this->createForm('SYM\RestauBundle\Form\MenuType', $menu);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('menu_index');
        }

        return $this->render('@SYMRestau/menu/edit.html.twig', array(
            'menu' => $menu,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a menu entity.
     *
     * @Route("/delete/{id}", name="menu_delete")
     * @Method("Get")
     */
    public function deleteAction(int $id)
    {
        if( !$this->get('session')->get('isLogged'))
            return $this->redirectToRoute('not_logged');

        $em = $this->getDoctrine()->getManager();

        $menu = $em->getRepository('SYMRestauBundle:Menu')->find($id);
  
        if (null != $menu) {
            $em->remove($menu);
            $em->flush();
        }
        return $this->redirectToRoute('menu_index');
    }
}
