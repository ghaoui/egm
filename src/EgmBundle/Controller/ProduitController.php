<?php
namespace EgmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
/*use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;*/
use Symfony\Component\Form\Extension\Core\Type\TextType;
use EgmBundle\Entity\Produit;
use Symfony\Component\HttpFoundation\Session\Session;

class ProduitController extends Controller
{
    /**
     * @Route("/produit/add")
     */
    public function addAction(Request $request)
    {
    	$form = $this->createFormBuilder()
    	//->setAction('/facture/add')
        ->add('ref', TextType::class, array('label' => 'Référence * :'))
        ->add('name', TextType::class, array('label' => 'Nom * :'))
        ->add('unit', TextType::class, array('label' => 'Unité * :'))
    	->add('price', TextType::class, array('label' => 'Prix Unitaire * :'))
    	//->add('name',TextType::class, array('label' => 'Cdreate Task'))

    	->getForm();
    	$form->handleRequest($request);
		$session = new Session();

    	if($form->isValid()){
    		$produit = new Produit();
            $ref = $form->get('ref')->getData();
            $name = $form->get('name')->getData();
            $unit = $form->get('unit')->getData();
    		$price = $form->get('price')->getData();
            $produit->setRef($ref);
            $produit->setName($name);
            $produit->setUnit($unit);
    		$produit->setPrice($price);
    		$em = $this->getDoctrine()->getManager();
        	$em->persist($produit);
        	$em->flush();
			//$session->start();
			$session->getFlashBag()->add('success', 'Produit Ajouter');
    		return $this->redirectToRoute('show_produit');
    	}else{
    		
    	}
        return $this->render('EgmBundle:Produit:add.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/produit/show", name="show_produit")
     */
    public function showAction()
    {
    	$produits = $this->getDoctrine()
				        ->getRepository('EgmBundle:Produit')
				        //->find($productId);
				        ->findAll();

        return $this->render('EgmBundle:Produit:show.html.twig', array('produits'=> $produits));
    }

    /**
     * @Route("/produit/edit/{id}", name="editproduit")
     */
    public function editAction($id, Request $request)
    {
    	$form = $this->createFormBuilder()
        ->add('ref', TextType::class, array('label' => 'Référence * :'))
    	->add('name', TextType::class, array('label' => 'Nom * :'))
        ->add('unit', TextType::class, array('label' => 'Unité * :'))
        ->add('price', TextType::class, array('label' => 'Prix Unitaire * :'))        
    	->getForm();
        
        $em = $this->getDoctrine()->getEntityManager();
        $produit = $em->getRepository('EgmBundle:Produit')->find($id);
//print_r($facture);exit;
        $form->get('name')->setData($produit->getName());
        $form->get('unit')->setData($produit->getUnit());
        $form->get('price')->setData($produit->getPrice());
        $form->get('ref')->setData($produit->getPrice());
    	$form->handleRequest($request);
		$session = new Session();

    	if($form->isValid()){
    		//$facture = new Facture();
            $ref = $form->get('ref')->getData();
            $name = $form->get('name')->getData();
            $unit = $form->get('unit')->getData();
            $price = $form->get('price')->getData();
            $produit->setRef($ref);
            $produit->setName($name);
            $produit->setUnit($unit);
            $produit->setPrice($price);
    		$em = $this->getDoctrine()->getManager();
        	$em->persist($produit);
        	$em->flush();
			//$session->start();
			$session->getFlashBag()->add('success', 'Produit modifier');
    		return $this->redirectToRoute('show_produit');
    	}
        return $this->render('EgmBundle:Produit:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

        /**
     * @Route("/produit/delete/{id}", name="delete_produit")
     */
    public function deleteAction($id)
    {
        
        $em = $this->getDoctrine()->getEntityManager();
        $produit = $em->getRepository('EgmBundle:Produit')->find($id);
        $session = new Session();
        $em = $this->getDoctrine()->getManager();
        $em->remove($produit);
        $em->flush();
        //$session->start();
        $session->getFlashBag()->add('success', 'Produit Suprimer');
        return $this->redirectToRoute('show_produit');
    }
}