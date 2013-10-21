<?php
/**
 *
 * Descrição:Classe Controller
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 22-Aug-2013
 *
 * @version 1.0.0
 *
 */
class Application_Model_Controller extends Zend_Db_Table_Abstract {
    /*
     * Atributos
     */
    protected $_name    = 'controller';
    protected $_schema  = 'administrativo';
    protected $_primary = 'id_controller';
    protected $_logName;
    protected $sSql;
    protected $idController;
    protected $codigoController;
    protected $nomeController;
    protected $descricaoController;
    protected $numeroOrdem;
    protected $dataCadastro;
    protected $dataBloqueio;
    
    function __construct() {
        parent::__construct();
        /*
         * Definição do nome do arquivo de log.
         */
        $this->_logName = '/'.__CLASS__.'_'.date('d-m-Y').'.log';
    }

    public function getIdController() {
        return $this->idController;
    }

    public function setIdController($idController) {
        $this->idController = $idController;
    }

    public function getCodigoController() {
        return $this->codigoController;
    }

    public function setCodigoController($codigoController) {
        $this->codigoController = $codigoController;
    }

    public function getNomeController() {
        return $this->nomeController;
    }

    public function setNomeController($nomeController) {
        $this->nomeController = $nomeController;
    }

    public function getDescricaoController() {
        return $this->descricaoController;
    }

    public function setDescricaoController($descricaoController) {
        $this->descricaoController = $descricaoController;
    }
    public function getNumeroOrdem() {
        return $this->numeroOrdem;
    }

    public function setNumeroOrdem($numeroOrdem) {
        if(!empty($numeroOrdem)){
            $this->numeroOrdem = $numeroOrdem;
        }else{
            $this->numeroOrdem = 0;
        }
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
                    ->from(array('c' => $this->_name),
                           array(
                               'controller' => 'nome_controller',
                               'codigo_controller',
                               'descricao_controller',
                           ), $this->_schema)
                    ->join(array('a'=>'action'), 
                            'a.fk_controller = c.id_controller',
                            array(
                                'action'=> 'nome_action',
                                'id_action',
                                'descricao_action',
                            ), $this->_schema)
                    ->where('c.data_bloqueio is null')
                    ->where('a.data_bloqueio is null')
                    ->where('a.tipo_action = ? ','F')
                    ->order(array('c.numero_ordem'))
            ;
            return $this->fetchAll($this->sSql);
        } catch (Zend_Db_Exception $exc) {
            /*
             * Grava no log os erros, caso hajam.
             */
            $writer = new Zend_Log_Writer_Stream(
                Custom_Path::LOG_PATH . $this->_logName
            );
            $logger = new Zend_Log($writer);            
            $logger->crit($exc->getMessage());
            return Custom_Mensagem::ERRO_DADOS;
        }
    }
    /**
     * Retorna listagem dos controllers
     */
    public function listarControllers(){
        try {
            $this->sSql = $this->select()
                    ->setIntegrityCheck(false)
                    ->from($this->_name,
                            array(
                                'id_controller',
                                'codigo_controller',
                                'nome_controller',
                                'descricao_controller',
                                'numero_ordem',
                                'data_cadastro' => 'to_char(data_cadastro,\'dd/mm/YYYY\')',
                                'data_bloqueio' => 'nvl(to_char(data_bloqueio,\'dd/mm/YYYY\'),\'Ativo\')',
                            ),
                            $this->_schema
                    );
            return $this->fetchAll($this->sSql);
        } catch (Zend_Db_Exception $exc) {
            /*
             * Grava no log os erros, caso hajam.
             */
            $writer = new Zend_Log_Writer_Stream(
                Custom_Path::LOG_PATH . $this->_logName
            );
            $logger = new Zend_Log($writer);            
            $logger->crit($exc->getMessage());
            return Custom_Mensagem::ERRO_DADOS;
        }
    }
    /**
     * 
     */
    public function consultarController(){
        try {
            $this->sSql = $this->select()
                    ->setIntegrityCheck(false)
                    ->from($this->_name,
                            array(
                                'id_controller',
                                'codigo_controller',
                                'nome_controller',
                                'descricao_controller',
                                'numero_ordem',
                                'data_cadastro' => 'to_char(data_cadastro,\'dd/mm/YYYY\')',
                                'data_bloqueio' => 'nvl(to_char(data_bloqueio,\'dd/mm/YYYY\'),\'Ativo\')',
                            ),
                            $this->_schema
                    )
                    ->where('id_controller = ?', (int) $this->idController)
            ;
            return $this->fetchRow($this->sSql);
        } catch (Zend_Db_Exception $exc) {
            /*
             * Grava no log os erros, caso hajam.
             */
            $writer = new Zend_Log_Writer_Stream(
                Custom_Path::LOG_PATH . $this->_logName 
            );
            $logger = new Zend_Log($writer);            
            $logger->crit($exc->getMessage());
            return Custom_Mensagem::ERRO_DADOS;
        }
    }
    /**
     * Cadastrar
     */
    public function cadastrar(){
        try {
            $vDados = array(
                'codigo_controller'    => $this->codigoController,
                'nome_controller'      => $this->nomeController,
                'descricao_controller' => $this->descricaoController,
                'numero_ordem'         => $this->numeroOrdem,
                'data_bloqueio'        => empty($this->dataBloqueio) ? null : $this->dataBloqueio,
            );
            $this->insert($vDados);
            return true;
        } catch (Zend_Db_Exception $exc) {
            /*
             * Grava no log os erros, caso hajam.
             */
            $writer = new Zend_Log_Writer_Stream(
                Custom_Path::LOG_PATH . $this->_logName
            );
            $logger = new Zend_Log($writer);            
            $logger->crit($exc->getMessage());
            return Custom_Mensagem::ERRO_DADOS;
        }
    }
    /**
     * Editar
     */
    public function editar(){
        try {
            $vDados = array(
                'codigo_controller'    => $this->codigoController,
                'nome_controller'      => $this->nomeController,
                'descricao_controller' => $this->descricaoController,
                'numero_ordem'         => $this->numeroOrdem,
                'data_bloqueio'        => empty($this->dataBloqueio) ? null : $this->dataBloqueio,
            );
            $this->update($vDados, 'id_controller = '.(int) $this->idController);
            return true;
        } catch (Zend_Db_Exception $exc) {
            /*
             * Grava no log os erros, caso hajam.
             */
            $writer = new Zend_Log_Writer_Stream(
                Custom_Path::LOG_PATH . $this->_logName
            );
            $logger = new Zend_Log($writer);            
            $logger->crit($exc->getMessage());
            return Custom_Mensagem::ERRO_DADOS;
        }
    }
    /**
     * Excluir
     */
    public function excluir(){
        try {
            $this->delete('id_controller = '.(int) $this->idController);
            return true;
        } catch (Zend_Db_Exception $exc) {
            /*
             * Grava no log os erros, caso hajam.
             */
            $writer = new Zend_Log_Writer_Stream(
                Custom_Path::LOG_PATH . $this->_logName
            );
            $logger = new Zend_Log($writer);            
            $logger->crit($exc->getMessage());
            return Custom_Mensagem::ERRO_DADOS;
        }
    }
    /*
     * 
     */
}
