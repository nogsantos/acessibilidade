<?php
/**
 * Form Action
 *
 * @author fabricionogueira
 */
class Form_Action extends Zend_Form {

    public function init(){
        $this->setName('modulo');
        $id_controller = new Zend_Form_Element_Text('id_controller');
        $id_controller->addFilter('StripTags')
                      ->addFilter('StringTrim')
        ;
        $this->addElements(
            array(
                $id_controller,
            )
        );
    }
}