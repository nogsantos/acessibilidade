<?php
/**
 * Form login
 *
 * @author fabricionogueira
 */
class Form_Login extends Zend_Form {

    public function init(){
        $this->setName('login');
        $login = new Zend_Form_Element_Text('login');
        $login->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')
        ;
        $senha = new Zend_Form_Element_Password('senha');
        $senha->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')
        ;
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Logar')
            ->setAttrib('id', 'submitbutton');
        $this->addElements(array($login, $senha, $submit));
    }
}