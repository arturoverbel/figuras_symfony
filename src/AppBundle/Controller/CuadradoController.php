<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cuadrado;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Cuadrado controller.
 *
 * @Route("cuadrado")
 */
class CuadradoController extends Controller
{
    /**
     * Lists all cuadrado entities.
     *
     * @Route("/", name="cuadrado_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cuadrados = $em->getRepository('AppBundle:Cuadrado')->findAll();

        return $this->render('cuadrado/index.html.twig', array(
            'cuadrados' => $cuadrados,
        ));
    }

    /**
     * Creates a new cuadrado entity.
     *
     * @Route("/new", name="cuadrado_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $cuadrado = new Cuadrado();
        $form = $this->createForm('AppBundle\Form\CuadradoType', $cuadrado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cuadrado);
            $em->flush();

            return $this->redirectToRoute('cuadrado_show', array('id' => $cuadrado->getId()));
        }

        return $this->render('cuadrado/new.html.twig', array(
            'cuadrado' => $cuadrado,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cuadrado entity.
     *
     * @Route("/{id}", name="cuadrado_show")
     * @Method("GET")
     */
    public function showAction(Cuadrado $cuadrado)
    {
        $deleteForm = $this->createDeleteForm($cuadrado);

        return $this->render('cuadrado/show.html.twig', array(
            'cuadrado' => $cuadrado,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cuadrado entity.
     *
     * @Route("/{id}/edit", name="cuadrado_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Cuadrado $cuadrado)
    {
        $deleteForm = $this->createDeleteForm($cuadrado);
        $editForm = $this->createForm('AppBundle\Form\CuadradoType', $cuadrado);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cuadrado_edit', array('id' => $cuadrado->getId()));
        }

        return $this->render('cuadrado/edit.html.twig', array(
            'cuadrado' => $cuadrado,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a cuadrado entity.
     *
     * @Route("/{id}", name="cuadrado_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Cuadrado $cuadrado)
    {
        $form = $this->createDeleteForm($cuadrado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cuadrado);
            $em->flush();
        }

        return $this->redirectToRoute('cuadrado_index');
    }

    /**
     * Creates a form to delete a cuadrado entity.
     *
     * @param Cuadrado $cuadrado The cuadrado entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Cuadrado $cuadrado)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cuadrado_delete', array('id' => $cuadrado->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
