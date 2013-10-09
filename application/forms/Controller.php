<?php
/**
 * Form Controller
 *
 * @author fabricionogueira
 */
class Form_Controller extends Zend_Form {

    public function init(){
        $this->setName('modulo');
        $id_controller = new Zend_Form_Element_Text('id_controller');
        $id_controller->addFilter('StripTags')
                      ->addFilter('StringTrim')
        ;
        $codigo_controller = new Zend_Form_Element_Text('codigo_controller');
        $codigo_controller->setRequired(true)
                          ->addFilter('StripTags')
                          ->addFilter('StringTrim')
                          ->addValidator('NotEmpty')
        ;
        $nome_controller = new Zend_Form_Element_Text('nome_controller');
        $nome_controller->setRequired(true)
                        ->addFilter('StripTags')
                        ->addFilter('StringTrim')
                        ->addValidator('NotEmpty')
        ;
        $descricao_controller = new Zend_Form_Element_Text('descricao_controller');
        $descricao_controller->addFilter('StripTags')
                             ->addFilter('StringTrim')
        ;
        $numero_ordem = new Zend_Form_Element_Text('numero_ordem');
        $numero_ordem->addFilter('StripTags')
                     ->addFilter('StringTrim')
                     ->addValidator('Digits')
        ;
        $data_bloqueio = new Zend_Form_Element_Text('data_bloqueio');
        $data_bloqueio->addFilter('StripTags')
                      ->addFilter('StringTrim')
        ;
        $this->addElements(
            array(
                $id_controller,
                $codigo_controller,
                $nome_controller,
                $descricao_controller,
                $numero_ordem,
                $data_bloqueio,
            )
        );
    }
}