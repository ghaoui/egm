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
use EgmBundle\Entity\Setting;
use Symfony\Component\HttpFoundation\Session\Session;

class SettingController extends Controller
{

    /**
     * @Route("/setting", name="setting")
     */
    public function settingAction(Request $request)
    {
    	$form = $this->createFormBuilder()
        ->add('tva', TextType::class, array('label' => 'T.V.A * :'))     
        ->add('rg', TextType::class, array('label' => 'R.G * :'))     
        ->add('ras', TextType::class, array('label' => 'R.A.S * :'))     
        ->add('tva2', TextType::class, array('label' => 'T.V.A 2 * :'))     
        ->add('timbre', TextType::class, array('label' => 'Timbre fiscale * :'))     
    	->add('year', TextType::class, array('label' => 'Année en cours * :'))     
    	->getForm();        
        $em = $this->getDoctrine()->getEntityManager();
        $setting = $em->getRepository('EgmBundle:Setting')->find(1);
        $form->get('tva')->setData($setting->getTva());
        $form->get('rg')->setData($setting->getRg());
        $form->get('ras')->setData($setting->getRas());
        $form->get('tva2')->setData($setting->getTva2());
        $form->get('timbre')->setData($setting->getTimbre());
        $form->get('year')->setData($setting->getYear());
    	$form->handleRequest($request);
		$session = new Session();

    	if($form->isValid()){
    		//$facture = new Facture();
            $tva = $form->get('tva')->getData();
            $rg = $form->get('rg')->getData();
            $ras = $form->get('ras')->getData();
            $tva2 = $form->get('tva2')->getData();
            $timbre = $form->get('timbre')->getData();
            $year = $form->get('year')->getData();
            $setting->setTva($tva);
            $setting->setRg($rg);
            $setting->setRas($ras);
            $setting->setTva2($tva2);
            $setting->setTimbre($timbre);
            $setting->setYear($year);
    		$em = $this->getDoctrine()->getManager();
        	$em->persist($setting);
        	$em->flush();
			$session->getFlashBag()->add('success', 'Paramètre modifier');
    	}
        return $this->render('EgmBundle:Setting:index.html.twig', array(
            'form' => $form->createView()
        ));
    }
}