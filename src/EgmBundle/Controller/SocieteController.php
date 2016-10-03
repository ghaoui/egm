<?php
namespace EgmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use EgmBundle\Entity\Societe;
use Symfony\Component\HttpFoundation\Session\Session;

class SocieteController extends Controller
{
    /**
     * @Route("/societe/add")
     */
    public function addAction(Request $request)
    {
    	$form = $this->createFormBuilder()
        ->add('name', TextType::class, array('label' => 'Nom * :'))
    	->getForm();
    	$form->handleRequest($request);
		$session = new Session();

    	if($form->isValid()){
    		$societe = new Societe();
            $name = $form->get('name')->getData();
            $societe->setName($name);
    		$em = $this->getDoctrine()->getManager();
        	$em->persist($societe);
        	$em->flush();

			$session->getFlashBag()->add('success', 'Société Ajouter');
    		return $this->redirectToRoute('show_societe');
    	}else{
    		
    	}
        return $this->render('EgmBundle:Societe:add.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/societe/show", name="show_societe")
     */
    public function showAction()
    {
    	$societes = $this->getDoctrine()
				        ->getRepository('EgmBundle:Societe')
				        ->findAll();

        return $this->render('EgmBundle:Societe:show.html.twig', array('societes'=> $societes));
    }

    /**
     * @Route("/societe/edit/{id}", name="editsociete")
     */
    public function editAction($id, Request $request)
    {
    	$form = $this->createFormBuilder()
    	->add('name', TextType::class, array('label' => 'Nom * :'))     
    	->getForm();
        
        $em = $this->getDoctrine()->getEntityManager();
        $societe = $em->getRepository('EgmBundle:Societe')->find($id);
        $form->get('name')->setData($societe->getName());
    	$form->handleRequest($request);
		$session = new Session();

    	if($form->isValid()){
            $name = $form->get('name')->getData();
            $societe->setName($name);
    		$em = $this->getDoctrine()->getManager();
        	$em->persist($societe);
        	$em->flush();
			$session->getFlashBag()->add('success', 'Société modifier');
    		return $this->redirectToRoute('show_societe');
    	}
        return $this->render('EgmBundle:Societe:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

        /**
     * @Route("/societe/delete/{id}", name="delete_societe")
     */
    public function deleteAction($id)
    {
        
        $em = $this->getDoctrine()->getEntityManager();
        $societe = $em->getRepository('EgmBundle:Societe')->find($id);
        $session = new Session();
        $em = $this->getDoctrine()->getManager();
        $em->remove($societe);
        $em->flush();
        $session->getFlashBag()->add('success', 'Societe Suprimer');
        return $this->redirectToRoute('show_societe');
    }
}