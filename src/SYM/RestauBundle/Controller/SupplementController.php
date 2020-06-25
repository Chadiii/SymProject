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
        $deleteForm = $this->createDeleteForm($supplement);

        return $this->render('@SYMRestau/supplement/show.html.twig', array(
            'supplement' => $supplement,
            'delete_form' => $deleteForm->createView(),
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
        $deleteForm = $this->createDeleteForm($supplement);
        $editForm = $this->createForm('SYM\RestauBundle\Form\SupplementType', $supplement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('supplement_index');
        }

        return $this->render('@SYMRestau/supplement/edit.html.twig', array(
            'supplement' => $supplement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
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
        $em = $this->getDoctrine()->getManager();

        $supplement = $em->getRepository('SYMRestauBundle:Supplement')->find($id);
  
        if (null != $supplement) {
            $em->remove($supplement);
            $em->flush();
        }
        return $this->redirectToRoute('supplement_index');
    }



    /**
     * Deletes a supplement entity.
     *
     * @Route("/{id}", name="supplement_delete1")
     * @Method("DELETE")
     */
    public function deleteAction1(Request $request, Supplement $supplement)
    {
        $form = $this->createDeleteForm($supplement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($supplement);
            $em->flush();
        }

        return $this->redirectToRoute('supplement_index');
    }

    /**
     * Creates a form to delete a supplement entity.
     *
     * @param Supplement $supplement The supplement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Supplement $supplement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('supplement_delete', array('id' => $supplement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
