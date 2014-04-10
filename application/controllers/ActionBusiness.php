<?php
/**
 * Classe: Regras de negócio Action
 *
 * @author Fabricio Nogueira
 * @since Apr 10, 2014
 */
class ActionBusiness{
    
    /**
     * Implementação das regras de negócio para cadastro
     */
    public function cadastrar(Array $vDados){
        $oAction = new Application_Model_Action();
        $oAction->setFkController($vDados['fk_controller']);
        $oAction->setCodigoAction($vDados['codigo_action']);
        $oAction->setTipoAction($vDados['tipo_action']);
        $oAction->setTipoMenu($vDados['tipo_menu']);
        $oAction->setNomeAction($vDados['nome_action']);
        $oAction->setIdAction($vDados['id_action']);
        $oAction->setRelController($vDados['rel_controller']);
        $oAction->setRelController($vDados['rel_controller']);
        $oAction->setRelAction($vDados['rel_action']);
        if (isset($vDados['class_botao_other']) && 
                $vDados['class_botao_other'] !="") {
            $sClasseBotao = $vDados['class_botao_other'];
        }else if(isset($vDados['class_botao']) && 
                $vDados['class_botao']!=""){
            $sClasseBotao = $vDados['class_botao'];
        }else{
            $sClasseBotao = 'botao_padrao';
        }
        $oAction->setClassBotao($sClasseBotao);
        if(isset($vDados['class_icone_other']) && 
                trim($vDados['class_icone_other']) !=""){
            $sClasseIcone = $vDados['class_icone_other'];
        }else if(isset($vDados['class_icone']) && 
                trim($vDados['class_icone']) !=""){
            $sClasseIcone = $vDados['class_icone'];
        }else{
            $sClasseIcone = 'icone_padrao';
        }
        $oAction->setClassIcone($sClasseIcone);
        $oAction->setDescricaoAction($vDados['descricao_action']);
        $oAction->setNumeroOrdem($vDados['numero_ordem']);
        /*
         * Cadastro
         */
        return $oAction->cadastrar();
        
    }
    
}
