<?php

namespace DepotBundle\Controller;

use DepotBundle\Entity\Depot;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Depot controller.
 *
 * @Route("depot")
 */
class DepotController extends Controller
{
    /**
     * Lists all depot entities.
     *
     * @Route("/", name="depot_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $depots = $em->getRepository('DepotBundle:Depot')->findAll();


        return $this->render('@Depot/index.html.twig',array(
            'depots' => $depots,
        ));
    }

    /**
     *
     * @Route("/new", name="depot_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $depot = new Depot();

        $form = $this->createFormBuilder($depot)

            ->add('adresse', TextType::class,[
                'attr' => [
                    'placeholder' => 'Entrer Votre Adresse',

                ],
            ])
                ->add('surface', TextType::class,[
                'attr' => [
                    'placeholder' => 'Entrer Votre Surface',

                ],
            ])
            ->add('prix', TextType::class,[
                'attr' => [
                    'error_bubbling' => true,
                    'placeholder' => 'Entrer Votre Prix',

                ],
            ])


            ->add('etat',ChoiceType::class, [
                'choices'  => [
                    'Disponible' => 'dispo',
                    'Non Disponible' => 'indispo',

                ],
            ])
//            ->add('dueDate')
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($depot);
            $em->flush();

            return $this->redirectToRoute('depot_index');
        }

        return $this->render('@Depot/new.html.twig', array(
            'depot' => $depot,
            'form' => $form->createView(),
        ));
    }


    /**
     *
     * @Route("/{id}/edit", name="depot_edit")
     * @Method({"GET", "POST"})
     */

    public function editAction(Request $request, Depot $depot)
    {
//        $deleteForm = $this->createDeleteForm($employee);
        $editForm = $this->createFormBuilder($depot)

            ->add('adresse', TextType::class,[
                'attr' => [
                    'placeholder' => 'Entrer Votre Adresse',

                ],
            ])
            ->add('surface', TextType::class,[
                'attr' => [
                    'placeholder' => 'Entrer Votre Surface',

                ],
            ])
            ->add('prix', TextType::class,[
                'attr' => [
                    'error_bubbling' => true,
                    'placeholder' => 'Entrer Votre Prix',

                ],
            ])


            ->add('etat',ChoiceType::class, [
                'choices'  => [
                    'dispo' => 'Disponible',
                    'indispo' => 'Non disponible',

                ],
            ])
//            ->add('dueDate')
            ->getForm();
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('depot_index');
        }

        return $this->render('@Depot/edit.html.twig', array(
            'depot' => $depot,
            'edit_form' => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * @Route("/delete/{id}", name="depot_delete", methods={"GET"})
     */
    public function delete(Request $request, Depot $depot, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $depots = $entityManager->getRepository('DepotBundle:Depot')->find($id);
        $entityManager->remove($depots);
        $entityManager->flush();





        return $this->redirectToRoute('depot_index');
    }



}
