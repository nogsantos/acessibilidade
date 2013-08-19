<?php
/**
 * Description of AuthController
 *
 * @author fabricionogueira
 */
class AuthController extends Zend_Controller_Action {

    public function init() {
        /*
         * Css e js para as atividades 
         */
        $this->view->css = array(
            'login',
        );
        $this->view->js = array(
            'login'
        );
    }

    public function indexAction() {
        return $this->_helper->redirector('login');
    }
    /**
     * Rotina de login
     */
    public function loginAction() {
        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $this->view->messages = $this->_flashMessenger->getMessages();
        $form = new Form_Login();
        $this->view->form = $form;
        /*
         * Verifica se existem dados de POST
         */
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            /*
             * Formulário corretamente preenchido?
             */
            if ($form->isValid($data)) {
                $login = $form->getValue('login');
                $senha = $form->getValue('senha');
                $dbAdapter = Zend_Db_Table::getDefaultAdapter();
                /*
                 * Inicia o adaptador Zend_Auth para banco de dados
                 */
                $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
                $authAdapter->setTableName('usuarios')
                            ->setIdentityColumn('login')
                            ->setCredentialColumn('senha')
                            ->setCredentialTreatment('SHA1(?)');
                /*
                 * Define os dados para processar o login
                 */
                $authAdapter->setIdentity($login)
                            ->setCredential($senha);
                /*
                 * Efetua o login
                 */
                $auth = Zend_Auth::getInstance();
                $result = $auth->authenticate($authAdapter);
                /*
                 * Verifica se o login foi efetuado com sucesso
                 */
                if ($result->isValid()) {
                    /*
                     * Armazena os dados do usuário em sessão, apenas desconsiderando                     
                     * a senha do usuário
                     */
                    $info = $authAdapter->getResultRowObject(null, 'senha');                                      
                    $storage = $auth->getStorage();
                    $storage->write($info);
                    /*
                     * Redireciona para o Controller protegido
                     */
                    return $this->_helper->redirector->goToRoute(array('controller' => 'index'), null, true);
                } else {
                    /*
                     * Dados inválidos
                     */
                    $this->_helper->FlashMessenger('Usu&aacute;rio ou senha inv&aacute;lidos!');
                    $this->_redirect('/auth/login');
                }
            } else {
                /*
                 * Formulário preenchido de forma incorreta
                 */
                $form->populate($data);
            }
        }
    }
    /**
     * Rotina de logout
     */
    public function logoutAction() {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        return $this->_helper->redirector('index');
    }
}