<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
	/**
	 * @Route("/admin/", name="admin_panel")
	 */
	public function indexAction()
	{
		return $this->render('admin/admin_panel.html.twig');
	}
}