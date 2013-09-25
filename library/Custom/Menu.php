<?php
/**
 *
 * Descrição:Classe MenuListagem
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 20-Sep-2013
 *
 * @version 1.0.0
 *
 */
class Custom_Menu {
    /**
     * Atributos
     */
    private $controller;
    private $idAction;
    private $tipoMenu;
    private $codigoAction;
    
    public function getController() {
        return $this->controller;
    }

    public function setController($controller) {
        $this->controller = $controller;
    }
    
    public function getTipoMenu() {
        return $this->tipoMenu;
    }

    public function setTipoMenu($tipoMenu) {
        $this->tipoMenu = $tipoMenu;
    }
    
    public function getIdAction() {
        return $this->idAction;
    }

    public function setIdAction($idAction) {
        $this->idAction = $idAction;
    }
    public function getCodigoAction() {
        return $this->codigoAction;
    }

    public function setCodigoAction($codigoAction) {
        $this->codigoAction = $codigoAction;
    }
    /**
     * Retorna menu
     */
    public function menu(){
        if(isset($this->controller)){
            $oMenuForm      = new Application_Model_Action();
            $oMenuForm->setCodigoController($this->controller);
            $oMenuForm->setTipoMenu($this->tipoMenu);
            $oMenuForm->setCodigoAction($this->codigoAction);
            $vItensMenuForm = $oMenuForm->retornarMenuDinamico();
            $itensMenu      = $vItensMenuForm;
            $htmlMenu       = '
                <nav class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex2-collapse">
                            <span class="sr-only">Alterar Navega&ccedil;&atilde;o</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                <div class="collapse navbar-collapse navbar-ex2-collapse">
            ';
            foreach ($itensMenu as $vMenuItem) {
                $htmlMenu .= '
                    <button type="button" class="btn '.$vMenuItem['class_botao'].' navbar-btn" id="'.$vMenuItem['id_action'].'" rel="/'.$vMenuItem['rel_controller'].'/'.$vMenuItem['rel_action'].'/" title=" '.$vMenuItem['descricao_action'].'">
                        <i class="'.$vMenuItem['class_icone'].'"></i> '.$vMenuItem['nome_action'].' 
                    </button>
                ';
            }
            $htmlMenu .= '
                    </div>
                </nav>
            ';
            return $htmlMenu;
        }else{
            return 'Controlador não informado';
        }
    }
}
