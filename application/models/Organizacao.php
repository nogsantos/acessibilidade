<?php
/**
 *
 * Descrição:Model Organização
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 26-Aug-2013
 *
 * @version 1.0.0
 *
 */
class Application_Model_Organizacao extends Zend_Db_Table_Abstract {
    /*
     * Atributos
     */
    protected $_name    = 'organizacao';
    protected $_schema  = 'administrativo';
    protected $_primary = 'cnpj_organizacao';
    protected $_logName;
    protected $idOrganizacao;
    protected $nmOrganizacao;
    protected $razaoSocial;
    protected $nrCnpj;
    protected $organizacaoMatriz;
    protected $fkMatriz;
    protected $prioridadeExibicao;
    protected $dataCadastro;
    protected $dataBloqueio;
    
    function __construct() {
        parent::__construct();
        /*
         * Definição do nome do arquivo de log.
         */
        $this->_logName = '/'.__CLASS__.'_'.date('d-m-Y').'.log';
    }
    
    public function getIdOrganizacao() {
        return $this->idOrganizacao;
    }

    public function setIdOrganizacao($idOrganizacao) {
        $this->idOrganizacao = $idOrganizacao;
    }

    public function getNmOrganizacao() {
        return $this->nmOrganizacao;
    }

    public function setNmOrganizacao($nmOrganizacao) {
        $this->nmOrganizacao = $nmOrganizacao;
    }

    public function getRazaoSocial() {
        return $this->razaoSocial;
    }

    public function setRazaoSocial($razaoSocial) {
        $this->razaoSocial = $razaoSocial;
    }

    public function getNrCnpj() {
        return $this->nrCnpj;
    }

    public function setNrCnpj($nrCnpj) {
        $this->nrCnpj = $nrCnpj;
    }

    public function getOrganizacaoMatriz() {
        return $this->organizacaoMatriz;
    }

    public function setOrganizacaoMatriz($organizacaoMatriz) {
        $this->organizacaoMatriz = $organizacaoMatriz;
    }

    public function getFkMatriz() {
        return $this->fkMatriz;
    }

    public function setFkMatriz($fkMatriz) {
        $this->fkMatriz = $fkMatriz;
    }

    public function getPrioridadeExibicao() {
        return $this->prioridadeExibicao;
    }

    public function setPrioridadeExibicao($prioridadeExibicao) {
        $this->prioridadeExibicao = $prioridadeExibicao;
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
        $this->dataBloqueio = $dataBloqueio;
    }
    /**
     * Lista as organização cadastradas no sistema onde a data de bloqueio é nulo.
     */
    public function listar(){
        try{
            $sSql = $this->select()
                    ->setIntegrityCheck(false)
                    ->from(array('m' => $this->_name),
                           array(
                               'cnpj_organizacao',
                               'nome_organizacao',
                           ), $this->_schema)
                    ->where('data_bloqueio is null')
                    ->order('prioridade_exibicao')
            ;
            return $this->fetchAll($sSql);
        } catch (Zend_Db_Table_Exception $exc) {
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
     * Consultar dados de todas as organizações cadastradas não bloqueadas.
     */
    public function consultarDados(){
        try {
            $sSql = $this->select()
                    ->setIntegrityCheck(false)
                    ->from(array('o' => $this->_name),
                           array(
                               'cnpj_organizacao',
                               'nome_organizacao',
                               'razao_social',
                               'data_cadastro',
                           ), $this->_schema)
                    ->joinLeft(array('m'=>'organizacao'), 'm.cnpj_organizacao = o.fk_matriz', 
                            array(
                                'id_matriz'   => 'cnpj_organizacao',
                                'nome_matriz' => 'nome_organizacao',
                            ) ,$this->_schema)
                    ->where('o.data_bloqueio is null')
                    ->order('o.prioridade_exibicao')
            ;
            if(!empty($this->getIdOrganizacao())){
                $sSql->where('o.cnpj_organizacao = ?', $this->getIdOrganizacao());
            }
            return $this->fetchAll($sSql);
        } catch (Zend_Db_Table_Exception $exc) {
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
}
