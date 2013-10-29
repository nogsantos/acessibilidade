<?php
/**
 * Form Action
 *
 * @author fabricionogueira
 */
class Form_Action extends Zend_Form {
    /*
     * 
     */
    public function init(){
        /*
         * 
         */
        $this->setName('action');
        /*
         * Fk Controller
         */
        $fk_controller = new Zend_Form_Element_Text('fk_controller');
        /*
         * id_action
         */
        $id_action = new Zend_Form_Element_Text('id_action');
        $id_action->addFilter('StripTags')
                  ->addFilter('StringTrim')
                  ->addValidator('StringLength', true, array(1,50))
                  ->addValidator('NotEmpty', false,array('messages'=>array('isEmpty'=>'Campo Obrigat&oacute;rio')))
                  ->setRequired(true)
        ;
        /*
         * codigo_action
         */
        $codigo_action = new Zend_Form_Element_Text('codigo_action');
        $codigo_action->addFilter('StripTags')
                      ->addFilter('StringTrim')
                      ->addValidator('StringLength', true, array(1,250))
                      ->addValidator('NotEmpty', false,array('messages'=>array('isEmpty'=>'Campo Obrigat&oacute;rio')))
                      ->setRequired(true)
        ;
        /*
         * rel_controller
         */
        $rel_controller = new Zend_Form_Element_Text('rel_controller');
        $rel_controller->addFilter('StripTags')
                       ->addFilter('StringTrim')
                       ->addValidator('StringLength', true, array(0,100))
        ;
        /*
         * rel_action
         */
        $rel_action = new Zend_Form_Element_Text('rel_action');
        $rel_action->addFilter('StripTags')
                   ->addFilter('StringTrim')
                   ->addValidator('StringLength', true, array(0,100))
        ;
        /*
         * class_icone
         */
        $class_icone = new Zend_Form_Element_Text('class_icone');
        $class_icone->addFilter('StripTags')
                    ->addFilter('StringTrim')
                    ->addValidator('StringLength', true, array(0,100))
        ;
        /*
         * class_botao
         */
        $class_botao = new Zend_Form_Element_Text('class_botao');
        $class_botao->addFilter('StripTags')
                    ->addFilter('StringTrim')
                    ->addValidator('StringLength', true, array(0,100))
        ;
        /*
         * nome_action
         */
        $nome_action = new Zend_Form_Element_Text('nome_action');
        $nome_action->addFilter('StripTags')
                    ->addFilter('StringTrim')
                    ->addValidator('StringLength', true, array(1,300))
                    ->addValidator('NotEmpty', false,array('messages'=>array('isEmpty'=>'Campo Obrigat&oacute;rio')))
                    ->setRequired(true)
        ;
        /*
         * tipo_action
         */
        $tipo_action = new Zend_Form_Element_Text('tipo_action');
        $tipo_action->addFilter('StripTags')
                    ->addFilter('StringTrim')
                    ->addValidator('StringLength', true, array(0,1))
        ;
        /*
         * tipo_menu
         */
        $tipo_menu = new Zend_Form_Element_Text('tipo_menu');
        $tipo_menu->addFilter('StripTags')
                  ->addFilter('StringTrim')
                  ->addValidator('StringLength', true, array(0,1))
        ;
        /*
         * descricao_action
         */
        $descricao_action = new Zend_Form_Element_Text('descricao_action');
        $descricao_action->addFilter('StripTags')
                         ->addFilter('StringTrim')
                         ->addValidator('StringLength', true, array(0,500))
        ;
        /*
         * numero_ordem
         */
        $numero_ordem = new Zend_Form_Element_Text('numero_ordem');
        $numero_ordem->addFilter('StripTags')
                     ->addFilter('StringTrim')
                     ->addValidator('Digits')
                     ->addErrorMessage('Somente n&uacute;meros')
        ;
        /*
         * data_bloqueio
         */
        $data_bloqueio = new Zend_Form_Element_Text('data_bloqueio');
        $data_bloqueio->addFilter('StripTags')
                      ->addFilter('StringTrim')
        ;
        /*
         * 
         */
        $this->addElements(
            array(
                $fk_controller,
                $id_action,
                $codigo_action,
                $rel_controller,
                $rel_action,
                $class_icone,
                $class_botao,
                $nome_action,
                $tipo_action,
                $tipo_menu,
                $descricao_action,
                $numero_ordem,
                $data_bloqueio,
            )
        );
    }
}