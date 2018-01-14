<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Fig;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Fig controller.
 *
 * @Route("fig")
 */
class FigController extends Controller
{
    /**
     * Lists all fig entities.
     *
     * @Route("/", name="fig_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $figs = $em->getRepository('AppBundle:Fig')->findAll();

        return $this->render('fig/index.html.twig', array(
            'figs' => $figs,
        ));
    }

    /**
     * Creates a new fig entity.
     *
     * @Route("/new", name="fig_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $fig = new Fig();
        $form = $this->createForm('AppBundle\Form\FigType', $fig);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fig);
            $em->flush();

            return $this->redirectToRoute('fig_show', array('id' => $fig->getId()));
        }

        return $this->render('fig/new.html.twig', array(
            'fig' => $fig,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a fig entity.
     *
     * @Route("/{id}", name="fig_show")
     * @Method("GET")
     */
    public function showAction(Fig $fig)
    {
        $deleteForm = $this->createDeleteForm($fig);

        return $this->render('fig/show.html.twig', array(
            'fig' => $fig,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing fig entity.
     *
     * @Route("/{id}/edit", name="fig_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Fig $fig)
    {
        $deleteForm = $this->createDeleteForm($fig);
        $editForm = $this->createForm('AppBundle\Form\FigType', $fig);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fig_edit', array('id' => $fig->getId()));
        }

        return $this->render('fig/edit.html.twig', array(
            'fig' => $fig,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a fig entity.
     *
     * @Route("/{id}", name="fig_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Fig $fig)
    {
        $form = $this->createDeleteForm($fig);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fig);
            $em->flush();
        }

        return $this->redirectToRoute('fig_index');
    }

    /**
     * Creates a form to delete a fig entity.
     *
     * @param Fig $fig The fig entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Fig $fig)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fig_delete', array('id' => $fig->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
