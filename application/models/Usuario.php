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
    protected $_schema  = 'pessoa';
    protected $_primary = 'fk_pessoa';
    protected $sSql;
    protected $fkPessoa;
    protected $login;
    protected $senha;
    protected $dataCadastro;
    protected $nome;
    protected $perfil;
    
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
            $this->sSql = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('u'  =>'usuario'), array(), $this->_schema)
                ->join(array('p'  => 'pessoa'), 'p.id_pessoa = u.fk_pessoa', array(), $this->_schema)
                ->joinLeft(array('pf' => 'fisica'), 'pf.nr_cpf = u.fk_pessoa', array(), $this->_schema)
                ->joinLeft(array('pj' => 'juridica'), 'pj.nr_cnpj = u.fk_pessoa', array(), $this->_schema)
                ->join(array('pu' => 'perfil_usuario'), 'pu.fk_usuario = u.fk_pessoa', array(), $this->_schema)
                ->join(array('pe' => 'perfil'), 'pe.id_perfil = pu.fk_perfil', array('perfil' => 'nm_perfil'), $this->_schema)
                ->columns(array('nome' => 'nvl(pf.nm_pessoa, pj.nm_razao_social)'))
                ->where('u.fk_pessoa = ? ',  $this->getFkPessoa())
            ;
            $oDadosUsuario = $this->fetchRow($this->sSql);
            if($oDadosUsuario){
                return $oDadosUsuario;
            }else{
                return false;
            }
        } catch (Zend_Db_Table_Exception $exc) {
            return $exc->getMessage();
        }
    }
}
