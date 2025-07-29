<?php
namespace App\Controller;

use App\Entity\Estimate;
use App\Form\EstimateType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EstimateController extends AbstractController
{
    /**
     * @Route("/estimate/new", name="estimate_new")
     */
    public function new(Request $request, EntityManagerInterface $em)
    {
        $estimate = new Estimate();
        $form = $this->createForm(EstimateType::class, $estimate);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($estimate->getEstimatedProducts() as $product) {
                $product->setEstimate($estimate);
            }
            $em->persist($estimate);
            $em->flush();

            $this->addFlash('success', 'Estimate saved successfully.');

            return $this->redirectToRoute('estimate_list');
        }

        return $this->render('estimate/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/estimates", name="estimate_list")
     */
    public function list(EntityManagerInterface $em)
    {
        $estimates = $em->getRepository(Estimate::class)->findAll();

        return $this->render('estimate/list.html.twig', [
            'estimates' => $estimates,
        ]);
    }
}
