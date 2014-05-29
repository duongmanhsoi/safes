<?php

use Phalcon\Mvc\Controller;

class ImportController extends ControllerBase 
{

    public function indexAction()
    {
        define('actionForm', 'insert');
        $this->statistics();
        $this->view->setVar('Type', 'import');
        $this->view->setVar('Import', Import::find(array("order" => "datetime DESC"))); 
    }

    public function insertAction()
    {
        $Auth = $this->session->get('auth');
        if ($this->request->isPost() AND $this->request->getPost('import') AND $Auth) {
            
            $this->view->disable();  
            $import = $this->request->getPost('import');
            $l500000 = $this->request->getPost('l500000');
            $l200000 = $this->request->getPost('l200000');
            $l100000 = $this->request->getPost('l100000');
            $l50000 = $this->request->getPost('l50000');
            $l20000 = $this->request->getPost('l20000');
            $l10000 = $this->request->getPost('l10000');
            $l5000 = $this->request->getPost('l5000');
            $l2000 = $this->request->getPost('l5000');
            $l1000 = $this->request->getPost('l1000');
            $totals = ($l500000 * 500000) + ($l200000 * 200000) + ($l100000 * 100000) + ($l50000 * 50000) + ($l20000 * 20000) + ($l10000 * 10000) + ($l5000 * 5000) + ($l2000 * 2000) + ($l1000 * 1000);
               
            $find = new Import();
            $find->user = $Auth['login'];
            $find->import = $import;
            $find->totals = $totals;
            $find->year = date("Y");
            $find->month = date("m");
            $find->day = date("d");
            $find->week = date("W");
            $find->date = date("Y-m-d");
            $find->datetime = date("Y-m-d H:i:s");
            $find->l500000 = $l500000;
            $find->l200000 = $l200000;
            $find->l100000 = $l100000;
            $find->l50000 = $l50000;
            $find->l20000 = $l20000;
            $find->l10000 = $l10000;
            $find->l5000 = $l5000;
            $find->l2000 = $l2000;
            $find->l1000 = $l1000;
            $save = $find->save();

        }

        $this->response->redirect("import/"); 

    }

    public function updateAction($id)
    {
        $Auth = $this->session->get('auth');
        if ($this->request->isPost() AND $this->request->getPost('import') AND $Auth) {
            
            $this->view->disable();
            $import = $this->request->getPost('import');
            $l500000 = $this->request->getPost('l500000');
            $l200000 = $this->request->getPost('l200000');
            $l100000 = $this->request->getPost('l100000');
            $l50000 = $this->request->getPost('l50000');
            $l20000 = $this->request->getPost('l20000');
            $l10000 = $this->request->getPost('l10000');
            $l5000 = $this->request->getPost('l5000');
            $l2000 = $this->request->getPost('l5000');
            $l1000 = $this->request->getPost('l1000');
            $totals = ($l500000 * 500000) + ($l200000 * 200000) + ($l100000 * 100000) + ($l50000 * 50000) + ($l20000 * 20000) + ($l10000 * 10000) + ($l5000 * 5000) + ($l2000 * 2000) + ($l1000 * 1000);
            //       
            $find = Import::findFirst($this->request->getPost('id'));
            $find->user = $Auth['login'];
            $find->import = $import;
            $find->totals = $totals;
            $find->l500000 = $l500000;
            $find->l200000 = $l200000;
            $find->l100000 = $l100000;
            $find->l50000 = $l50000;
            $find->l20000 = $l20000;
            $find->l10000 = $l10000;
            $find->l5000 = $l5000;
            $find->l2000 = $l2000;
            $find->l1000 = $l1000;
            $save = $find->save();

        }

        $this->response->redirect("import/");

    }

    public function editAction($id)
    {
        define('actionForm', 'update');
        $find = Import::findFirst($id);
        foreach ($find  as $key => $value) {
            $this->view->setVar($key, $value);
        }
        $this->forward('import/index');
    }

    public function deleteAction($id)
    {
        $this->view->disable(); 
        $find = Import::findFirst($id);
        $find->delete();
        $this->response->redirect("import/");
    }

}
