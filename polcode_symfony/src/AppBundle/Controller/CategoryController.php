<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Form\CategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
	/**
	 * @Route("/admin/manage_categories", name="manage_categories")
	 */
	public function manageCategoriesAction()
	{
		$categories = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();

		return $this->render('category/manage.html.twig', ['categories' => $categories]);
	}

	/**
	 * @Route("/admin/manage_categories/add", name="add_category")
	 */
	public function createCategoryAction(Request $request)
	{
		$category = new Category();
		$form = $this->createForm(new CategoryType(), $category);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($category);
			$em->flush();

			return $this->redirectToRoute('manage_categories');
		}

		return $this->render('category/add.html.twig', ['form' => $form->createView()]);
	}

	/**
	 * @Route("/admin/manage_categories/edit/{id}", name="edit_category")
	 */
	public function editCategoryAction($id, Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$category = $em->getRepository('AppBundle:Category')->find($id);

		if (! $category) {
			throw $this->createNotFoundException(
				'No category found for id ' . $id
			);
		}

		$form = $this->createForm(new CategoryType(), $category);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em->flush();

			return $this->redirectToRoute('manage_categories');
		}

		return $this->render('category/add.html.twig', ['form' => $form->createView()]);
	}

	/**
	 * @Route("/admin/manage_categories/delete/{id}", name="delete_category")
	 */
	public function deleteCategoryAction($id, Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$category = $em->getRepository('AppBundle:Category')->find($id);

		if (! $category) {
			throw $this->createNotFoundException(
				'No category found for id ' . $id
			);
		}

	}
}