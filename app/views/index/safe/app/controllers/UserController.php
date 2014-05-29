<?php

use Phalcon\Tag as Tag;

class UserController extends ControllerBase
{

    public function indexAction()
    {
        $Export = $this->modelsManager->createQuery("SELECT export.user, SUM(export.l500000) AS l500000, SUM(export.l200000) AS l200000, SUM(export.l100000) AS l100000, SUM(export.l50000) AS l50000, SUM(export.l20000) AS l20000, SUM(export.l10000) AS l10000, SUM(export.l5000) AS l5000, SUM(export.l2000) AS l2000, SUM(export.l1000) AS l1000 FROM export");
        $Export = $Export->execute();

        $Import = $this->modelsManager->createQuery("SELECT import.user, SUM(import.l500000) AS l500000, SUM(import.l200000) AS l200000, SUM(import.l100000) AS l100000, SUM(import.l50000) AS l50000, SUM(import.l20000) AS l20000, SUM(import.l10000) AS l10000, SUM(import.l5000) AS l5000, SUM(import.l2000) AS l2000, SUM(import.l1000) AS l1000 FROM import");
        $Import = $Import->execute();
 
        $this->statistics();
        $this->view->setVar('Export', $Export);
        $this->view->setVar('Import', $Import);
    }

   public function insertAction()
    {
        if ($this->request->isPost()) {

            $type = $this->request->getPost('type');
            $login = $this->request->getPost('login', 'alphanum');
            $password = $this->request->getPost('password');
            $repeatPassword = $this->request->getPost('repeatPassword');

            if ($password != $repeatPassword) {
                $this->flash->error('Passwords are diferent');
                return false;
            }

            $user = new Users();
            $user->type = $type;
            $user->login = $login;
            $user->password = $password;
            if (!$user->validation() || !$user->save()) {
                foreach ($user->getMessages() as $message) {
                    $this->flash->error((string)$message);
                }
            } else {
                Tag::setDefault('login', '');
                Tag::setDefault('password', '');
                $this->response->redirect("");
            }
        }
    }

    private function _registerSession($user)
    {
        $this->session->set(
            'auth',
            array(
                'id' => $user->id,
                'login' => $user->login
            )
        );
    }

    public function selectAction()
    {
        if ($this->request->isPost()) {
            $login = $this->request->getPost('login', 'alphanum');

            $password = $this->request->getPost('password');

            $user = Users::findFirst("login='$login'");
            if ($user != false && $user->checkPassword($password)) {
                $this->_registerSession($user);
                $this->flash->success('Welcome ' . $user->login);
                return $this->forward('index/index');
            }

            $this->flash->error('Wrong email/password');
        }

        return $this->forward('session/index');
    }

    public function endAction()
    {
        $this->session->remove('auth');
        $this->flash->success('Goodbye!');
        return $this->forward('index/index');
    }


}
