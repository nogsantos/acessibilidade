<?php
/**
 *
 * Descrição:Classe Usuario
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 21-Aug-2013
 *
 * @version 1.0.0
 *
 */
class Application_Model_Usuario extends Zend_Db_Table_Abstract {
    /*
     * Atributos
     */
    protected $_name    = 'usuario';
    protected $_schema  = 'administrativo';
    protected $_primary = 'fk_pessoa';
    protected $_logName;
    protected $fkPessoa;
    protected $login;
    protected $senha;
    protected $dataCadastro;
    protected $nome;
    protected $perfil;
    
    function __construct() {
        parent::__construct();
        /*
         * Definição do nome do arquivo de log.
         */
        $this->_logName = '/'.__CLASS__.'_'.date('d-m-Y').'.log';
    }
    
    public function getFkPessoa() {
        return $this->fkPessoa;
    }

    public function setFkPessoa($fkPessoa) {
        $this->fkPessoa = $fkPessoa;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getDataCadastro() {
        return $this->dataCadastro;
    }

    public function setDataCadastro($dataCadastro) {
        $this->dataCadastro = $dataCadastro;
    }
    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getPerfil() {
        return $this->perfil;
    }

    public function setPerfil($perfil) {
        $this->perfil = $perfil;
    }
    /**
     * Cadastro
     */
    public function cadastrar(){
        
    }
    /**
     * Edição
     */
    public function editar(){
        
    }
    /**
     * Exclusão
     */
    public function excluir(){
        
    }
    /**
     * Consulta dados do usuário.
     */
    public function consultarDados(){
        try{
            $sSql = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('u'  =>'usuario'), array(), $this->_schema)
                ->join(array('p'  => 'pessoa'), 'p.id_pessoa = u.fk_pessoa', array(), 'pessoa')
                ->joinLeft(array('pf' => 'fisica'), 'pf.numero_cpf = u.fk_pessoa', array(), 'pessoa')
                ->joinLeft(array('pj' => 'juridica'), 'pj.numero_cnpj = u.fk_pessoa', array(), 'pessoa')
                ->join(array('pu' => 'perfil_usuario'), 'pu.fk_usuario = u.fk_pessoa', array(), $this->_schema)
                ->join(array('pe' => 'perfil'), 'pe.id_perfil = pu.fk_perfil', array('perfil' => 'nome_perfil'), $this->_schema)
                ->columns(array('nome' => 'nvl(pf.nome_pessoa_fisica, pj.nome_pessoa_juridica)'))
                ->where('u.fk_pessoa = ? ',  $this->getFkPessoa())
            ;
            $oDadosUsuario = $this->fetchRow($sSql);
            if($oDadosUsuario){
                return $oDadosUsuario;
            }else{
                return false;
            }
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
