<?php

use Phalcon\Mvc\Controller;

class IndexController extends ControllerBase 
{

	public function indexAction()
	{
		$this->view->setVar('Type', 1);
		$this->view->setVar('Auth', $this->session->get('auth'));

		$today = date("Y-m-d");
		$export = Export::find(array("date = '$today'", "order" => "datetime DESC", "limit" => 10));
		$import = Import::find(array("date = '$today'", "order" => "datetime DESC", "limit" => 10));

		$this->statistics();
		$this->view->setVar('Export', $export);
		$this->view->setVar('Import', $import);

	}
}
