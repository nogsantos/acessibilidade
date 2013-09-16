<?php

/**
 *
 * Descrição:Classe Modulo
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 22-Aug-2013
 *
 * @version 1.0.0
 *
 */
class Application_Model_Modulo extends Zend_Db_Table_Abstract {
    /*
     * Atributos
     */
    protected $_name    = 'modulo';
    protected $_schema  = 'administrativo';
    protected $_primary = 'id_modulo';
    protected $sSql;
    protected $idModulo;
    protected $codigoModulo;
    protected $nomeModulo;
    protected $descricaoModulo;
    protected $numeroOrdem;
    protected $dataCadastro;
    protected $dataBloqueio;
    
    public function getIdModulo() {
        return $this->idModulo;
    }

    public function setIdModulo($idModulo) {
        $this->idModulo = $idModulo;
    }

    public function getCodigoModulo() {
        return $this->codigoModulo;
    }

    public function setCodigoModulo($codigoModulo) {
        $this->codigoModulo = $codigoModulo;
    }

    public function getNomeModulo() {
        return $this->nomeModulo;
    }

    public function setNomeModulo($nomeModulo) {
        $this->nomeModulo = $nomeModulo;
    }

    public function getDescricaoModulo() {
        return $this->descricaoModulo;
    }

    public function setDescricaoModulo($descricaoModulo) {
        $this->descricaoModulo = $descricaoModulo;
    }
    public function getNumeroOrdem() {
        return $this->numeroOrdem;
    }

    public function setNumeroOrdem($numeroOrdem) {
        $this->numeroOrdem = $numeroOrdem;
    }

    public function getDataCadastro() {
        return $this->dataCadastro;
    }

    public function setDataCadastro($dataCadastro) {
        $this->dataCadastro = $dataCadastro;
    }

    public function getDataBloqueio() {
        return $this->dataBloqueio;
    }

    public function setDataBloqueio($dataBloqueio) {
        if($dataBloqueio !== 'on'){
            $this->dataBloqueio = 'now()';
        }
    }
    /**
     * Consulta os controllers por módulo
     */
    public function retornarMenuDinamico(){
        try{
            $this->sSql = $this->select()
                    ->setIntegrityCheck(false)
                    ->from(array('m' => $this->_name),
                           array(
                               'modulo' => 'nome_modulo',
                               'codigo_modulo',
                           ), $this->_schema)
                    ->join(array('c'=>'controller'), 
                            'c.fk_modulo = m.id_modulo',
                            array(
                                'controller'=> 'nome_controller',
                                'codigo_controller',
                                'id_controller',
                            ), $this->_schema)
                    ->order(array('m.numero_ordem', 'c.numero_ordem'))
            ;
            return $this->fetchAll($this->sSql);
        } catch (Zend_Db_Exception $e) {
            /*
             * Grava no log os erros, caso hajam.
             */
            $writer = new Zend_Log_Writer_Stream('../data/logs/application.log');
            $logger = new Zend_Log($writer);            
            $logger->crit($e->getMessage());
            return Custom_Mensagens::ERRO_DADOS;
        }
    }
    /**
     * Retorna listagem de modulos
     */
    public function listarModulos(){
        try {
            $this->sSql = $this->select()
                    ->setIntegrityCheck(false)
                    ->from($this->_name,
                            array(
                                'id_modulo',
                                'codigo_modulo',
                                'nome_modulo',
                                'descricao_modulo',
                                'numero_ordem',
                                'data_cadastro' => 'to_char(data_cadastro,\'dd/mm/YYYY\')',
                                'data_bloqueio' => 'nvl(to_char(data_bloqueio,\'dd/mm/YYYY\'),\'Ativo\')',
                            ),
                            $this->_schema
                    );
            return $this->fetchAll($this->sSql);
        } catch (Zend_Db_Exception $e) {
            /*
             * Grava no log os erros, caso hajam.
             */
            $writer = new Zend_Log_Writer_Stream('../data/logs/application.log');
            $logger = new Zend_Log($writer);            
            $logger->crit($e->getMessage());
            return Custom_Mensagens::ERRO_DADOS;
        }
    }
    /**
     * 
     */
    public function consultarModulo(){
        try {
            $this->sSql = $this->select()
                    ->setIntegrityCheck(false)
                    ->from($this->_name,
                            array(
                                'id_modulo',
                                'codigo_modulo',
                                'nome_modulo',
                                'descricao_modulo',
                                'numero_ordem',
                                'data_cadastro' => 'to_char(data_cadastro,\'dd/mm/YYYY\')',
                                'data_bloqueio' => 'nvl(to_char(data_bloqueio,\'dd/mm/YYYY\'),\'Ativo\')',
                            ),
                            $this->_schema
                    )
                    ->where('id_modulo = ?', (int) $this->idModulo)
            ;
            return $this->fetchRow($this->sSql);
        } catch (Zend_Db_Exception $e) {
            /*
             * Grava no log os erros, caso hajam.
             */
            $writer = new Zend_Log_Writer_Stream('../data/logs/application.log');
            $logger = new Zend_Log($writer);            
            $logger->crit($e->getMessage());
            return Custom_Mensagens::ERRO_DADOS;
        }
    }
    /**
     * Cadastrar
     */
    public function cadastrar(){
        try {
            $vDados = array(
                'codigo_modulo'    => $this->codigoModulo,
                'nome_modulo'      => $this->nomeModulo,
                'descricao_modulo' => $this->descricaoModulo,
                'numero_ordem'     => $this->numeroOrdem,
                'data_bloqueio'    => empty($this->dataBloqueio) ? null : $this->dataBloqueio,
            );
            return $this->insert($vDados);
        } catch (Zend_Db_Exception $e) {
            /*
             * Grava no log os erros, caso hajam.
             */
            $writer = new Zend_Log_Writer_Stream('../data/logs/application.log');
            $logger = new Zend_Log($writer);            
            $logger->crit($e->getMessage());
            return Custom_Mensagens::ERRO_DADOS;
        }
    }
    /**
     * Editar
     */
    public function editar(){
        try {
            $vDados = array(
                'codigo_modulo'    => $this->codigoModulo,
                'nome_modulo'      => $this->nomeModulo,
                'descricao_modulo' => $this->descricaoModulo,
                'numero_ordem'     => $this->numeroOrdem,
                'data_bloqueio'    => empty($this->dataBloqueio) ? null : $this->dataBloqueio,
            );
            return $this->update($vDados, 'id_modulo = '.(int) $this->idModulo);
        } catch (Zend_Db_Exception $e) {
            /*
             * Grava no log os erros, caso hajam.
             */
            $writer = new Zend_Log_Writer_Stream('../data/logs/application.log');
            $logger = new Zend_Log($writer);            
            $logger->crit($e->getMessage());
            return Custom_Mensagens::ERRO_DADOS;
        }
    }
    /**
     * Excluir
     */
    public function excluir(){
        try {
           return $this->delete("id_modulo = ".(int) $this->idModulo);
        } catch (Zend_Db_Exception $e) {
            /*
             * Grava no log os erros, caso hajam.
             */
            $writer = new Zend_Log_Writer_Stream('../data/logs/application.log');
            $logger = new Zend_Log($writer);            
            $logger->crit($e->getMessage());
            return Custom_Mensagens::ERRO_DADOS;
        }
    }
}
