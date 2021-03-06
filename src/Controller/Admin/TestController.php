<?php

namespace App\Controller\Admin;

use App\Entity\Test;
use App\Form\TestType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{
    /**
     * @Route("/admin/test", name="test")
     */
    public function index()
    {
        return $this->render('test/index.html.twig', [

        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/admin/test/create", name="test_create")
     */
    public function create(Request $request)
    {
        $test = new Test();
        $form = $this->createForm(TestType::class, $test);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($test);
            $em->flush();

            return $this->redirectToRoute('test');
        }

        return $this->render('admin/test/create.html.twig',[
            'form' => $form->createView(),
        ]);
    }
}
