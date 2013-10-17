<?php
/**
 *
 * Descrição:Classe ActionController
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 09-Oct-2013
 *
 * @version 1.0.0
 *
 */
require_once 'MainController.php';
class ActionController extends MainController {
    /**
     * Init
     */
    public function init(){
        parent::init();
    }
    /**
     * Salvar modulo
     */
    public function salvarActionAction(){
        Custom_Grass_Debug::debugValue('controller', true);
        /*
         * O formulário deve ser acessado apenas via modal.
         */
        if ($this->getRequest()->getMethod() === "GET"){
            throw new Exception(Custom_Mensagem::ERRO_ACESSO_INDEVIDO);
        }else{
            $this->disableViewAndLayout();
            $oAction = new Form_Controller();
            if ($this->getRequest()->isPost()) {
                $vDados = $this->getRequest()->getPost();
                if ($oAction->isValid($vDados)) {
                    $oController = new Application_Model_Controller();
                    $oController->setIdController(
                        $oAction->getValue('id_controller')
                    );
                    $oController->setCodigoController(
                        $oAction->getValue('codigo_controller')
                    );
                    $oController->setNomeController(
                        $oAction->getValue('nome_controller')
                    );
                    $oController->setDescricaoController(
                        $oAction->getValue('descricao_controller')
                    );
                    $oController->setNumeroOrdem(
                        $oAction->getValue('numero_ordem')
                    );
                    $oController->setDataBloqueio(
                        $oAction->getValue('data_bloqueio')
                    );
                    if(empty($oAction->getValue('id_controller'))){
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
                    $this->_helper->redirector('controller');
                }else{
                    /*
                     * Retorna para a listagem os erros não validados por js que
                     * foram encontrados pelo zend form.
                     */
                    foreach ($oAction->getMessages() as $campo => $valor) {
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
                    $this->_helper->redirector('controller');
                }
            }
        }
    }
}
