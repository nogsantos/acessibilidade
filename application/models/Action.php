<?php
/**
 *
 * Descrição:Classe Action
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 19-Sep-2013
 *
 * @version 1.0.0
 *
 */
class Application_Model_Action extends Zend_Db_Table_Abstract {
    /*
     * Atributos
     */
    protected $_name    = 'action';
    protected $_schema  = 'administrativo';
    protected $_primary = 'id_action';
    protected $_logName;
    protected $fkController;
    protected $codigoController;
    protected $nomeController;
    protected $idAction;
    protected $relController;
    protected $relAction;
    protected $classIcone;
    protected $nomeAction;
    protected $tipoAction;
    protected $tipoMenu;
    protected $descricaoAction;
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
    
    public function getFkController() {
        return $this->fkController;
    }

    public function setFkController($fkController) {
        $this->fkController = $fkController;
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

    public function getIdAction() {
        return $this->idAction;
    }

    public function setIdAction($idAction) {
        $this->idAction = $idAction;
    }

    public function getRelController() {
        return $this->relController;
    }

    public function setRelController($relController) {
        $this->relController = $relController;
    }

    public function getRelAction() {
        return $this->relAction;
    }

    public function setRelAction($relAction) {
        $this->relAction = $relAction;
    }

    public function getClassIcone() {
        return $this->classIcone;
    }

    public function setClassIcone($classIcone) {
        $this->classIcone = $classIcone;
    }

    public function getNomeAction() {
        return $this->nomeAction;
    }

    public function setNomeAction($nomeAction) {
        $this->nomeAction = $nomeAction;
    }

    public function getTipoAction() {
        return $this->tipoAction;
    }

    public function setTipoAction($tipoAction) {
        $this->tipoAction = $tipoAction;
    }

    public function getTipoMenu() {
        return $this->tipoMenu;
    }

    public function setTipoMenu($tipoMenu) {
        $this->tipoMenu = $tipoMenu;
    }
        
    public function getDescricaoAction() {
        return $this->descricaoAction;
    }

    public function setDescricaoAction($descricaoAction) {
        $this->descricaoAction = $descricaoAction;
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
        $this->dataBloqueio = $dataBloqueio;
    }
    /**
     * Retorna listagem das actions cadastradas.
     */
    public function listarActions() {
        try {
            $tipoAction = "
                case a.tipo_action 
                    when 'B' then 'Botão' 
                    when 'F' then 'Formulário'
                    when 'U' then 'Função' 
                end tipo_action
            ";
            $sSql = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('a' => $this->_name), array(
                        'fk_controller',
                        'id_action',
                        'rel_controller',
                        'rel_action',
                        'class_icone',
                        'nome_action',
                        'descricao_action',
                        'numero_ordem',
                        'data_cadastro' => 'to_char(a.data_cadastro,\'dd/mm/YYYY\')',
                        'data_bloqueio' => 'nvl(to_char(a.data_bloqueio,\'dd/mm/YYYY\'),\'Ativo\')',
                    ), $this->_schema                 
                )
               ->columns(new Zend_Db_Expr($tipoAction))
               ->join(array('c' => 'controller'), 
                       'c.id_controller = a.fk_controller',
                       array('controller' => 'nome_controller'),
                       $this->_schema
                );
            return $this->fetchAll($sSql);
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
     * Retorna menu dinâmico listagem
     * 
     * @param Integer $idController Controlador
     * @param String $tipoMenu Tipo do botão retornado, listagem ou formulário.
     */
    public function retornarMenuDinamico(){
        try{
            $sSql = $this->select()
                    ->setIntegrityCheck(false)
                    ->from(array('a' => $this->_name),
                           array(
                               'id_action',
                               'rel_controller',
                               'rel_action',
                               'class_icone',
                               'class_botao',
                               'nome_action',
                               'descricao_action',
                           ), $this->_schema)
                    ->join(array('c'=>'controller'), 
                            'c.id_controller = a.fk_controller',
                            array(
                                'codigo_controller',
                            ), $this->_schema)
                    ->where('a.data_bloqueio is null')
                    ->where('a.tipo_action = ?','B')
                    ->where('lower(c.codigo_controller) = ?', 
                        strtolower($this->codigoController)
                    )
                    ->where('a.tipo_menu = ?', $this->tipoMenu)
                    ->order(array('a.numero_ordem'))
            ;
            return $this->fetchAll($sSql);
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
}
