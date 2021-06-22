<?php

namespace ServiceApresVenteBundle\Controller;

use ServiceApresVenteBundle\Entity\Feedback;
use ServiceApresVenteBundle\Entity\Reclamation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@ServiceApresVente/Default/index.html.twig');


    }



    public function getNbrReclamationFeedbackAction() {
        $nbrFeed=$this->getDoctrine()->getManager()->getRepository(Feedback::class)->calculerTotalFeedback();
        $nbrRec=$this->getDoctrine()->getManager()->getRepository(Reclamation::class)->calculerTotalReclamation();

        $date = new  \DateTime();
        $date=$this->getDoctrine()->getManager()->getRepository(Reclamation::class)->findallReclamationydate($date);

        $total = $nbrFeed +$nbrRec;
        $nbrFeedParRapportRec = ($nbrFeed / $total)*100;
        $nbrRecParRapportFeed = ($nbrRec / $total)*100;

        return $this->render('@ServiceApresVente/Admin/index.html.twig',array('nbFeed'=>$nbrFeed,
            'nbRec'=>$nbrRec,'date'=>$date,"nbrFeedParRapportRec"=>$nbrFeedParRapportRec,
                "nbrRecParRapportFeed"=>$nbrRecParRapportFeed));

    }





//    public function AjouterCommandeAction(Request $request)
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $session = $request->getSession();
//        $panier = $session->get('panier');
//
//        $iduser = $request->get('userid');
//        $user = $em->getRepository(User::class)->find($iduser);
//        $total = $request->get('total');
//        $date = new \DateTime();
//
//        $commande = new Commande();
//
//
//        $commande->setUser($user);
//        $commande->setPrixTotal($total);
//        $commande->setDateCommande($date);
//        $commande->setEtatCommande(0);
//        $em->persist($commande);
//        $em->flush();
//        $em->clear();
//
//        $produits = $em->getRepository('ProduitBundle:Produit')->findArray(array_keys($panier));
//
//        for ($i = 0; $i < Count($produits); $i++) {
//
//            $ligneCmd = new LignesCommande();
//            $commande1= $em->getRepository(Commande::class)->find($commande->getIdCommande());
//            $ligneCmd->setIdCommande($commande);
//            $ligneCmd->setIdProduit($produits[$i]);
//            $ligneCmd->setQte($panier[$produits[$i]->getIdProduit()]);
//            $em->persist($ligneCmd);
//            $em->flush();
//        }
//
//        return $this->redirect($this->generateUrl('AjouterPaiement', array('id_commande' => $commande->getIdCommande())));
//
//
//
//    }
//


}