<?php
/**
 *
 * Descrição:Classe AdministrativoController
 *
 *
 * @author Fabricio Nogueira
 *
 * @since 21-Aug-2013
 *
 * @version 1.0.0
 *
 */
class AdministrativoController extends MainController {
    
    protected $frontController;
    
    public function init(){
        parent::init();
    }
    /**
     * Index
     */
    public function indexAction(){
        /*
         * Monta o menu principal
         */
        $this->_helper->actionStack('navigation', 'Menu');
        $this->_redirect('index');
    }
    /**
     * Cadastro de modulos
     */
    public function moduloAction(){
      /*
       * Monta o menu principal
       */
       $this->_helper->actionStack('navigation', 'Menu');
       /*
        * Grid
        */
        $this->view->headLink()->setStylesheet(
            Zend_Controller_Front::getInstance()->getBaseUrl().
            '/DataTables-1.9.4/media/css/jquery.dataTables.css'
        );
        $this->view->headLink()->setStylesheet(
            Zend_Controller_Front::getInstance()->getBaseUrl().
            '/DataTables-1.9.4/media/css/jquery.dataTables_themeroller.css'
        );
         $this->view->headScript()->appendFile(
            Zend_Controller_Front::getInstance()->getBaseUrl().
            '/DataTables-1.9.4/media/js/jquery.dataTables.js'
        );
         /*
          * Paginador do grid
          */
         $this->view->headScript()->appendFile(
            Zend_Controller_Front::getInstance()->getBaseUrl().
            '/DataTables-1.9.4/media/js/paginador.js'
        );
         /*
          * Script da página
          */
         $this->view->headScript()->appendFile(
            Zend_Controller_Front::getInstance()->getBaseUrl().
            '/js/administrativo/modulo/modulo.js'
        );
        /*
         * Monta o menu do usuário
         */
//        $this->_helper->actionStack('usuario', 'Menu');
//         
//       /*
//        * Implementações GRID 
//        */  
//       /* 
//        * Array com as colunas visiveis do banco de dados que serão retornadas para o grid.
//        * Utilize um espaço para inserir um campo que não está no banco de dados
//        * um contador ou uma imagem estática, por exemplo.
//        */
//        $aColumns = array(
//            'codigo_modulo', 
//            'nome_modulo', 
//            'descricao_modulo', 
//            'numero_ordem', 
//            'data_cadastro',
//            'data_bloqueio',
//        );
//        /* 
//         * Indexed column (used for fast and accurate table cardinality) 
//         */
//	$sIndexColumn = 'id_modulo';
//        /*
//         *  DB table to use 
//         */
//	$sTable = 'ajax';
//        /* 
//	 * Paging
//	 */
//	$sLimit = "";
//	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' ){
//            $sLimit = "LIMIT ".
//                    intval( $_GET['iDisplayStart'] ).", ".
//                    intval( $_GET['iDisplayLength'] );
//	}
//	/*
//	 * Ordering
//	 */
//	$sOrder = "";
//	if ( isset( $_GET['iSortCol_0'] ) ){
//            $sOrder = "ORDER BY  ";
//            for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ ){
//                if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" ){
//                    $sOrder .= "`".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."` ".
//                    ($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
//                }
//            }
//            $sOrder = substr_replace( $sOrder, "", -2 );
//                if ( $sOrder == "ORDER BY" ){
//                    $sOrder = "";
//		}
//	}
//        /* 
//	 * Filtering
//	 * NOTE this does not match the built-in DataTables filtering which does it
//	 * word by word on any field. It's possible to do here, but concerned about efficiency
//	 * on very large tables, and MySQL's regex functionality is very limited
//	 */
//	$sWhere = "";
//	if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" ){
//            $sWhere = "WHERE (";
//            for ( $i=0 ; $i<count($aColumns) ; $i++ ){
//                $sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
//            }
//            $sWhere = substr_replace( $sWhere, "", -3 );
//            $sWhere .= ')';
//	}
//        /* 
//         * Individual column filtering 
//         */
//	for ( $i=0 ; $i<count($aColumns) ; $i++ ){
//            if ( isset($_GET['bSearchable_'.$i]) && 
//                    $_GET['bSearchable_'.$i] == "true" && 
//                    $_GET['sSearch_'.$i] != '' ){
//                if ( $sWhere == "" ){
//                    $sWhere = "WHERE ";
//                }else{
//                    $sWhere .= " AND ";
//                }
//                $sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
//            }
//	}
    }
    /**
     * 
     */
    public function moduloGridAction(){
//        $this->_helper->setParam('noViewRenderer', true);
//        $this->_helper->layout()->disableLayout();
        $this->disableViewAndLayout();
        echo '
            {
                "sEcho": 1,
                "iTotalRecords": "57",
                "iTotalDisplayRecords": "57",
                "aaData": [
                  [
                    "Gecko",
                    "Firefox 1.0",
                    "Win 98+ / OSX.2+",
                    "1.7",
                    "A",
                    "A"
                  ],
                  [
                    "Gecko",
                    "Firefox 1.5",
                    "Win 98+ / OSX.2+",
                    "1.8",
                    "A",
                    "A"
                  ],
                  [
                    "Gecko",
                    "Firefox 2.0",
                    "Win 98+ / OSX.2+",
                    "1.8",
                    "A",
                    "A"
                  ],
                  [
                    "Gecko",
                    "Firefox 3.0",
                    "Win 2k+ / OSX.3+",
                    "1.9",
                    "A",
                    "A"
                  ],
                  [
                    "Gecko",
                    "Camino 1.0",
                    "OSX.2+",
                    "1.8",
                    "A",
                    "A"
                  ],
                  [
                    "Gecko",
                    "Camino 1.5",
                    "OSX.3+",
                    "1.8",
                    "A",
                    "A"
                  ],
                  [
                    "Gecko",
                    "Netscape 7.2",
                    "Win 95+ / Mac OS 8.6-9.2",
                    "1.7",
                    "A",
                    "A"
                  ],
                  [
                    "Gecko",
                    "Netscape Browser 8",
                    "Win 98SE+",
                    "1.7",
                    "A",
                    "A"
                  ],
                  [
                    "Gecko",
                    "Netscape Navigator 9",
                    "Win 98+ / OSX.2+",
                    "1.8",
                    "A",
                    "A"
                  ],
                  [
                    "Gecko",
                    "Mozilla 1.0",
                    "Win 95+ / OSX.1+",
                    "1",
                    "A",
                    "A"
                  ]
                ]
              }
        ';
    }
    /**
     * Cadastro de módulo
     */
    public function cadModuloAction(){
        /*
         * O formulário deve ser acessado apenas via modal.
         */
        if ($this->getRequest()->getMethod() === "GET"){
            throw new Exception(Custom_Erros_Mensagens::ERRO_ACESSO_INDEVIDO);
        }else{
            $this->_helper->layout()->disableLayout();
        }
    }
    /**
     * Cadastro de Controllers
     */
    public function controllerAction(){
        
    }
    /**
     * Cadasro de Actions
     */
    public function actionAction(){
        /*
         * Monta o menu do usuário
         */
        $this->_helper->actionStack('usuario', 'Menu');
    }
    /**
     * 
     */
    public function usuarioAction(){
        
    }
   
}
