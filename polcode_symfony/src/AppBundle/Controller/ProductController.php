<?php

namespace AppBundle\Controller;

use AppBundle\Form\ProductType;
use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
	/**
	 * @Route("/admin/manage_products", name="manage_products")
	 */
	public function manageProductsAction(Request $request)
	{
		$products = $this->getDoctrine()->getRepository('AppBundle:Product')->findAll();

		return $this->render('product/manage.html.twig', ['products' => $products]);
	}

	/**
	 * @Route("/admin/manage_products/add", name="add_product")
	 */
	public function createProductAction(Request $request)
	{
		$product = new Product();
		$form = $this->createForm(new ProductType(), $product);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($product);
			$em->flush();

			return $this->redirectToRoute('manage_products');
		}

		return $this->render('product/add.html.twig', ['form' => $form->createView()]);
	}

	/**
	 * @Route("/admin/manage_products/delete/{id}", name="delete_product")
	 */
	public function deleteProductAction(Request $request)
	{

	}

	/**
	 * @Route("/admin/manage_products/edit/{id}", name="edit_product")
	 */
	public function editProductAction(Request $request)
	{

	}
}