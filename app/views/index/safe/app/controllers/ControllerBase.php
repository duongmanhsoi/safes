<?php

use Phalcon\Tag;

class ControllerBase extends \Phalcon\Mvc\Controller
{
    protected function forward($uri)
    {
        $uriParts = explode('/', $uri);
        return $this->dispatcher->forward(
            array(
                'controller' => $uriParts[0],
                'action' => $uriParts[1]
            )
        );
    }

    protected function statistics()
    {

        $Export = $this->modelsManager->createQuery("SELECT export.user, SUM(export.l500000) AS l500000, SUM(export.l200000) AS l200000, SUM(export.l100000) AS l100000, SUM(export.l50000) AS l50000, SUM(export.l20000) AS l20000, SUM(export.l10000) AS l10000, SUM(export.l5000) AS l5000, SUM(export.l2000) AS l2000, SUM(export.l1000) AS l1000 FROM export");
        $Export = $Export->execute();

        $Import = $this->modelsManager->createQuery("SELECT import.user, SUM(import.l500000) AS l500000, SUM(import.l200000) AS l200000, SUM(import.l100000) AS l100000, SUM(import.l50000) AS l50000, SUM(import.l20000) AS l20000, SUM(import.l10000) AS l10000, SUM(import.l5000) AS l5000, SUM(import.l2000) AS l2000, SUM(import.l1000) AS l1000 FROM import");
        $Import = $Import->execute();

        $s500000 = $Import[0]['l500000'] - $Export[0]['l500000'];
        $s200000 = $Import[0]['l200000'] - $Export[0]['l200000'];
        $s100000 = $Import[0]['l100000'] - $Export[0]['l100000'];
        $s50000 = $Import[0]['l50000'] - $Export[0]['l50000'];
        $s20000 = $Import[0]['l20000'] - $Export[0]['l20000'];
        $s10000 = $Import[0]['l10000'] - $Export[0]['l10000'];
        $s5000 = $Import[0]['l5000'] - $Export[0]['l5000'];
        $s2000 = $Import[0]['l2000'] - $Export[0]['l2000'];
        $s1000 = $Import[0]['l1000'] - $Export[0]['l1000'];
        $totals = ($s500000*500000)+($s200000*200000)+($s100000*100000)+($s50000*50000)+($s20000*20000)+($s10000*10000)+($s5000*5000)+($s2000*2000)+($s1000*1000);

        $setVar = $this->view->setVar('s500000', $s500000);
        $setVar = $this->view->setVar('s200000', $s200000); 
        $setVar = $this->view->setVar('s100000', $s100000); 
        $setVar = $this->view->setVar('s50000',  $s50000); 
        $setVar = $this->view->setVar('s20000', $s20000); 
        $setVar = $this->view->setVar('s10000', $s10000); 
        $setVar = $this->view->setVar('s5000', $s5000);
        $setVar = $this->view->setVar('s2000', $s2000);  
        $setVar = $this->view->setVar('s1000', $s1000); 
        $setVar = $this->view->setVar('stotals', $totals); 

        return $setVar;

    }
    
}