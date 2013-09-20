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
class Custom_Menu_Listagem {
    static public function menu(){
        $oMenuForm             = new Application_Model_Action();
        $oMenuForm->setFkController(1);
        $oMenuForm->setTipoMenu('L');
        $vItensMenuForm        = $oMenuForm->retornarMenuDinamico();
        $itensMenu = $vItensMenuForm;
        
        $htmlMenu = '
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
            <button type="button" class="btn '.$vMenuItem['class_botao'].' navbar-btn" id=" '.$vMenuItem['id_action'].' " rel="" title=" '.$vMenuItem['descricao_action'].'"><i class="'.$vMenuItem['class_icone'].'"></i> '.$vMenuItem['nome_action'].' </button>
        ';
        }
        $htmlMenu .= '
                </div>
            </nav>
        ';
        return $htmlMenu;
    }
}
