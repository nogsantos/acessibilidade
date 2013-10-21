<?php
/**
 * Classe: ControllerController. Crud e regras de negocio.
 *
 * @author Fabricio Nogueira
 * 
 * @since Oct 18, 2013
 * 
 * @version 1.0.0
 */
require_once 'MainController.php';
class ControladorController extends MainController {
    /**
     * Init
     */
    public function init(){
        parent::init();
    }
    /**
     * Salvar Controller Ediçao ou cadastro.
     */
    public function salvarAction(){
        /*
         * O formulário deve ser acessado apenas via modal.
         */
        if ($this->getRequest()->getMethod() === "GET"){
            throw new Exception(Custom_Mensagem::ERRO_ACESSO_INDEVIDO);
        }else{
            $this->disableViewAndLayout();
            $oControllerForm = new Form_Controller();
            if ($this->getRequest()->isPost()) {
                $vDados = $this->getRequest()->getPost();
                if ($oControllerForm->isValid($vDados)) {
                    $oController = new Application_Model_Controller();
                    $oController->setIdController(
                        $oControllerForm->getValue('id_controller')
                    );
                    $oController->setCodigoController(
                        $oControllerForm->getValue('codigo_controller')
                    );
                    $oController->setNomeController(
                        $oControllerForm->getValue('nome_controller')
                    );
                    $oController->setDescricaoController(
                        $oControllerForm->getValue('descricao_controller')
                    );
                    $oController->setNumeroOrdem(
                        $oControllerForm->getValue('numero_ordem')
                    );
                    $oController->setDataBloqueio(
                        $oControllerForm->getValue('data_bloqueio')
                    );
                    $idController = $oControllerForm->getValue('id_controller');
                    if(empty($idController)){
                        /*
                         * Cadastro
                         */
                        $retorno = $oController->cadastrar();
                    }else{
                        /*
                         * Edição
                         */
                        $retorno = $oController->editar();
                    }
                    if(!$retorno){
                        $this->_helper->flashMessenger->addMessage('
                            <div class="alert alert-danger">
                                '.$retorno.'
                            </div>
                        ');
                    }else{
                        $this->_helper->flashMessenger->addMessage('
                            <div class="alert alert-success">
                                '.Custom_Mensagem::ACAO_SUCESSO.'
                            </div>
                        ');
                    }
                    /*
                     * Redirecionamento para a listagem
                     */
                    $this->_redirect('/administrativo/controller');
                }else{
                    /*
                     * Retorna para a listagem os erros não validados por js que
                     * foram encontrados pelo zend form.
                     */
                    foreach ($oControllerForm->getMessages() as $campo => $valor) {
                        $nomeCampo = strstr($campo,'_',true) ;
                        foreach ($valor as $mensagem) {
                            $erros .='<i class="icon-caret-right"></i> Campo: <b>'.strtoupper($nomeCampo).'</b> Mensagem: '.$mensagem.'. <br />';
                        }
                    }
                    $this->_helper->flashMessenger->addMessage('
                        <div class="alert alert-danger">
                            <i class="icon-exclamation-sign"></i> Erros<br />'.$erros.'
                        </div>
                    ');
                    /*
                     * Redirecionamento para a listagem
                     */
                    $this->_redirect('/administrativo/controller');
                }
            }
        }
    }
    /**
     * Excluir Controller
     */
    public function excluirAction(){
        /*
         * O formulário deve ser acessado apenas via modal.
         */
        if ($this->getRequest()->getMethod() === 'GET'){
            throw new Exception(Custom_Mensagem::ERRO_ACESSO_INDEVIDO);
        }else{
            $this->disableViewAndLayout();
            $oController = new Application_Model_Controller();
            $oController->setIdController($this->getParam('id_controller'));
            $retorno = $oController->excluir();
            if(!$retorno){
                $this->_helper->flashMessenger->addMessage('
                    <div class="alert alert-danger">
                        ' . $retorno . '
                    </div>
                ');
            } else {
                $this->_helper->flashMessenger->addMessage('
                    <div class="alert alert-success">
                        '.Custom_Mensagem::ACAO_SUCESSO.'
                    </div>
                ');
            }
        }
    }
}

