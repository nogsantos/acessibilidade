<?php
/**
 *
 * Descrição: Controlador de autenticação no sistema.
 *
 * @author Fabricio Nogueira
 *
 * @since 22-Aug-2013
 *
 * @version 1.0.0
 *
 */
require_once 'MainController.php';
class AuthController extends MainController {
    /*
     * Atributos
     */
    protected $_logName;
    /**
     * Init
     */
    public function init(){
        parent::init();
        /*
         * Definição do nome do arquivo de log.
         */
        $this->_logName = '/'.__CLASS__.'_'.date('d-m-Y').'.log';
    }
    /**
     * View Index
     */
    public function indexAction() {
        return $this->_helper->redirector('login');
    }
    /**
     * Rotina de login
     */
    public function loginAction() {
        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $this->view->messages  = $this->_flashMessenger->getMessages();
        $form                  = new Form_Login();
        $this->view->form      = $form;
        /*
         * Verifica se existem dados de POST
         */
        try {
            if ($this->getRequest()->isPost()) {
                $data = $this->getRequest()->getPost();
                if ($form->isValid($data)) {
                    $login       = $form->getValue('login');
                    $senha       = sha1($form->getValue('senha'));
                    $organizacao = $form->getValue('organizacao');
                    $dbAdapter   = Zend_Db_Table::getDefaultAdapter();
                    /*
                     * Inicia o adaptador Zend_Auth para banco de dados
                     */
                    $authAdapter = new Zend_Auth_Adapter_DbTable(
                            $dbAdapter
                            , 'nome_login'
                            , 'nome_senha'
                            , 'cnpj_organizacao'
                    );
                    /*
                     * A consulta é realizada pela View vw_login_usuario.
                     */
                    $authAdapter->setTableName('vw_login_usuario')
                                ->setIdentityColumn('nome_login')
                                ->setCredentialColumn('nome_senha')
                    ;
                    /*
                     * Define os dados para processar o login
                     */
                    $authAdapter->setIdentity($login)
                                ->setCredential($senha)
                    ;
                    $select = $authAdapter->getDbSelect();
                    $select->where('cnpj_organizacao = ? ', (int) $organizacao);
                    /*
                     * Efetua o login
                     */
                    $auth   = Zend_Auth::getInstance();
                    $result = $auth->authenticate($authAdapter);
                    /*
                     * Verifica se o login foi efetuado com sucesso
                     */
                if ($result->isValid()) {
                        /*
                         * Armazena os dados do usuario em sessao, 
                         * apenas desconsiderando a senha do usuario
                         */
                        $info    = $authAdapter->getResultRowObject(null, 'nome_senha');
                        $storage = $auth->getStorage();
                        $storage->write($info);
                        /*
                         * Redireciona para o Controller protegido
                         */
                        return $this->_helper->redirector->goToRoute(
                            array('controller' => 'index'), null, true
                        );
                    } else {
                        /*
                         * Dados invalidos
                         */
                        $this->_helper->FlashMessenger('
                            <div class="alert alert-danger">
                                Usu&aacute;rio e/ou senha inv&aacute;lidos!
                            </div>
                        ');
                        $this->_redirect('/auth/login');
                    }
                } else {
                    /*
                     * Formulario preenchido de forma incorreta
                     */
                    $form->populate($data);
                }
            }
        } catch (Exception $exc) {
            /*
             * Grava no log os erros, caso hajam.
             */
            $writer = new Zend_Log_Writer_Stream(
                Custom_Path::LOG_PATH . $this->_logName
            );
            $logger = new Zend_Log($writer);
            $logger->crit($exc->getMessage());
            $this->_helper->FlashMessenger('
                <div class="alert alert-danger">
                    Erro::0001
                </div>
            ');
            $this->_redirect('/auth/login');
            return false;
        }
    }
    /**
     * Rotina de logout
     */
    public function logoutAction() {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        Zend_Session::destroy();
        return $this->_helper->redirector('index');
    }
}