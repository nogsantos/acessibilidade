<?php
/**
 * Form Modulo
 *
 * @author fabricionogueira
 */
class Form_Modulo extends Zend_Form {

    public function init(){
        $this->setName('modulo');
        $id_modulo = new Zend_Form_Element_Text('id_modulo');
        $id_modulo->addFilter('StripTags')
                  ->addFilter('StringTrim')
        ;
        $codigo_modulo = new Zend_Form_Element_Text('codigo_modulo');
        $codigo_modulo->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')
        ;
        $nome_modulo = new Zend_Form_Element_Text('nome_modulo');
        $nome_modulo->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')
        ;
        $descricao_modulo = new Zend_Form_Element_Password('descricao_modulo');
        $descricao_modulo->addFilter('StripTags')
              ->addFilter('StringTrim')
        ;
        $numero_ordem = new Zend_Form_Element_Password('numero_ordem');
        $numero_ordem->addFilter('StripTags')
              ->addFilter('StringTrim')
        ;
        $data_bloqueio = new Zend_Form_Element_Password('data_bloqueio');
        $data_bloqueio->addFilter('StripTags')
              ->addFilter('StringTrim')
        ;
        $this->addElements(
            array(
                $id_modulo,
                $codigo_modulo,
                $nome_modulo,
                $descricao_modulo,
                $numero_ordem,
                $data_bloqueio,
            )
        );
    }
}