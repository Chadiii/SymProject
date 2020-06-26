<?php

namespace SYM\RestauBundle\Controller;

use SYM\RestauBundle\Entity\Supplement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Supplement controller.
 *
 * @Route("supplement")
 */
class SupplementController extends Controller
{
    /**
     * Lists all supplement entities.
     *
     * @Route("/", name="supplement_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        if( !$this->get('session')->get('isLogged'))
            return $this->redirectToRoute('not_logged');

        $em = $this->getDoctrine()->getManager();
        $supplements = $em->getRepository('SYMRestauBundle:Supplement')->findAll();

        return $this->render('@SYMRestau/supplement/index.html.twig', array(
            'supplements' => $supplements,
        ));
    }

    /**
     * Creates a new supplement entity.
     *
     * @Route("/new", name="supplement_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        if( !$this->get('session')->get('isLogged'))
            return $this->redirectToRoute('not_logged');

        $supplement = new Supplement();
        $form = $this->createForm('SYM\RestauBundle\Form\SupplementType', $supplement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($supplement);
            $em->flush();

            return $this->redirectToRoute('supplement_show', array('id' => $supplement->getId()));
        }

        return $this->render('@SYMRestau/supplement/new.html.twig', array(
            'supplement' => $supplement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a supplement entity.
     *
     * @Route("/{id}", name="supplement_show")
     * @Method("GET")
     */
    public function showAction(Supplement $supplement)
    {
        if( !$this->get('session')->get('isLogged'))
            return $this->redirectToRoute('not_logged');

        return $this->render('@SYMRestau/supplement/show.html.twig', array(
            'supplement' => $supplement,
        ));
    }

    /**
     * Displays a form to edit an existing supplement entity.
     *
     * @Route("/{id}/edit", name="supplement_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Supplement $supplement)
    {
        if( !$this->get('session')->get('isLogged'))
            return $this->redirectToRoute('not_logged');

        $editForm = $this->createForm('SYM\RestauBundle\Form\SupplementType', $supplement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('supplement_index');
        }

        return $this->render('@SYMRestau/supplement/edit.html.twig', array(
            'supplement' => $supplement,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a supplement entity.
     *
     * @Route("/delete/{id}", name="supplement_delete")
     * @Method("Get")
     */
    public function deleteAction(int $id)
    {
        if( !$this->get('session')->get('isLogged'))
            return $this->redirectToRoute('not_logged');
            
        $em = $this->getDoctrine()->getManager();

        $supplement = $em->getRepository('SYMRestauBundle:Supplement')->find($id);
  
        if (null != $supplement) {
            $em->remove($supplement);
            $em->flush();
        }
        return $this->redirectToRoute('supplement_index');
    }
}
