<?php
/**
 *
 * Descrição:Classe Empresa
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 26-Aug-2013
 *
 * @version 1.0.0
 *
 */
class Application_Model_Empresa extends Zend_Db_Table_Abstract {
    /*
     * Atributos
     */
    protected $_name    = 'empresa';
    protected $_schema  = 'administrativo';
    protected $_primary = 'id_empresa';
    protected $idEmpresa;
    protected $nmEmpresa;
    protected $razaoSocial;
    protected $nrCnpj;
    protected $empresaMatriz;
    protected $fkMatriz;
    protected $prioridadeExibicao;
    protected $dataCadastro;
    protected $dataBloqueio;
    
    public function getIdEmpresa() {
        return $this->idEmpresa;
    }

    public function setIdEmpresa($idEmpresa) {
        $this->idEmpresa = $idEmpresa;
    }

    public function getNmEmpresa() {
        return $this->nmEmpresa;
    }

    public function setNmEmpresa($nmEmpresa) {
        $this->nmEmpresa = $nmEmpresa;
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

    public function getEmpresaMatriz() {
        return $this->empresaMatriz;
    }

    public function setEmpresaMatriz($empresaMatriz) {
        $this->empresaMatriz = $empresaMatriz;
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
     * Lista as empresas cadastradas no sistema onde a data de bloqueio é nulo.
     */
    public function listar(){
        try{
            $sSql = $this->select()
                    ->setIntegrityCheck(false)
                    ->from(array('m' => $this->_name),
                           array(
                               'id_empresa',
                               'nm_empresa',
                           ), $this->_schema)
                    ->where('data_bloqueio is null')
                    ->order('prioridade_exibicao')
            ;
            return $this->fetchAll($sSql);
        } catch (Zend_Db_Table_Exception $exc) {
            return $exc->getMessage();
        }
    }
    /**
     * Consultar dados de todas as empresas cadastradas não bloqueadas.
     */
    public function consultarDados(){
        try {
            $sSql = $this->select()
                    ->setIntegrityCheck(false)
                    ->from(array('e' => $this->_name),
                           array(
                               'id_empresa',
                               'nm_empresa',
                               'razao_social',
                               'nr_cnpj',
                               'data_cadastro',
                           ), $this->_schema)
                    ->joinLeft(array('m'=>'empresa'), 'm.id_empresa = e.fk_matriz', 
                            array(
                                'id_matriz' => 'id_empresa',
                                'nm_matriz' => 'nm_empresa',
                            ) ,$this->_schema)
                    ->where('e.data_bloqueio is null')
                    ->order('e.prioridade_exibicao')
            ;
            if(!empty($this->getIdEmpresa())){
                $sSql->where('e.id_empresa = ?', $this->getIdEmpresa());
            }
            if($this->getEmpresaMatriz()){
                $sSql->where('e.empresa_matriz = true');
            }
            return $this->fetchAll($sSql);
        } catch (Zend_Db_Table_Exception $exc) {
            return $exc->getMessage();
        }
    }
}
