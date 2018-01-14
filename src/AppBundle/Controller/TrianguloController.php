<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Triangulo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Triangulo controller.
 *
 * @Route("triangulo")
 */
class TrianguloController extends Controller
{
    /**
     * Lists all triangulo entities.
     *
     * @Route("/", name="triangulo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $triangulos = $em->getRepository('AppBundle:Triangulo')->findAll();

        return $this->render('triangulo/index.html.twig', array(
            'triangulos' => $triangulos,
        ));
    }

    /**
     * Creates a new triangulo entity.
     *
     * @Route("/new", name="triangulo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $triangulo = new Triangulo();
        $form = $this->createForm('AppBundle\Form\TrianguloType', $triangulo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($triangulo);
            $em->flush();

            return $this->redirectToRoute('triangulo_show', array('id' => $triangulo->getId()));
        }

        return $this->render('triangulo/new.html.twig', array(
            'triangulo' => $triangulo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a triangulo entity.
     *
     * @Route("/{id}", name="triangulo_show")
     * @Method("GET")
     */
    public function showAction(Triangulo $triangulo)
    {
        $deleteForm = $this->createDeleteForm($triangulo);

        return $this->render('triangulo/show.html.twig', array(
            'triangulo' => $triangulo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing triangulo entity.
     *
     * @Route("/{id}/edit", name="triangulo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Triangulo $triangulo)
    {
        $deleteForm = $this->createDeleteForm($triangulo);
        $editForm = $this->createForm('AppBundle\Form\TrianguloType', $triangulo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('triangulo_edit', array('id' => $triangulo->getId()));
        }

        return $this->render('triangulo/edit.html.twig', array(
            'triangulo' => $triangulo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a triangulo entity.
     *
     * @Route("/{id}", name="triangulo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Triangulo $triangulo)
    {
        $form = $this->createDeleteForm($triangulo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($triangulo);
            $em->flush();
        }

        return $this->redirectToRoute('triangulo_index');
    }

    /**
     * Creates a form to delete a triangulo entity.
     *
     * @param Triangulo $triangulo The triangulo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Triangulo $triangulo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('triangulo_delete', array('id' => $triangulo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
