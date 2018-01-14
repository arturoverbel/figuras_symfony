<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Hexagono;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Hexagono controller.
 *
 * @Route("hexagono")
 */
class HexagonoController extends Controller
{
    /**
     * Lists all hexagono entities.
     *
     * @Route("/", name="hexagono_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $hexagonos = $em->getRepository('AppBundle:Hexagono')->findAll();

        return $this->render('hexagono/index.html.twig', array(
            'hexagonos' => $hexagonos,
        ));
    }

    /**
     * Creates a new hexagono entity.
     *
     * @Route("/new", name="hexagono_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $hexagono = new Hexagono();
        $form = $this->createForm('AppBundle\Form\HexagonoType', $hexagono);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($hexagono);
            $em->flush();

            return $this->redirectToRoute('fig_show', array('id' => $hexagono->getId()));
        }

        return $this->render('hexagono/new.html.twig', array(
            'hexagono' => $hexagono,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a hexagono entity.
     *
     * @Route("/{id}", name="hexagono_show")
     * @Method("GET")
     */
    public function showAction(Hexagono $hexagono)
    {
        $deleteForm = $this->createDeleteForm($hexagono);

        return $this->render('hexagono/show.html.twig', array(
            'hexagono' => $hexagono,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing hexagono entity.
     *
     * @Route("/{id}/edit", name="hexagono_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Hexagono $hexagono)
    {
        $deleteForm = $this->createDeleteForm($hexagono);
        $editForm = $this->createForm('AppBundle\Form\HexagonoType', $hexagono);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fig_show', array('id' => $hexagono->getId()));
        }

        return $this->render('hexagono/edit.html.twig', array(
            'hexagono' => $hexagono,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a hexagono entity.
     *
     * @Route("/{id}", name="hexagono_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Hexagono $hexagono)
    {
        $form = $this->createDeleteForm($hexagono);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($hexagono);
            $em->flush();
        }

        return $this->redirectToRoute('fig_index');
    }

    /**
     * Creates a form to delete a hexagono entity.
     *
     * @param Hexagono $hexagono The hexagono entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Hexagono $hexagono)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('hexagono_delete', array('id' => $hexagono->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
