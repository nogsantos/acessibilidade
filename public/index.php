<?php
call_user_func(function() {
    try {
        require_once '../library/autoload.php';
        // Create application, bootstrap, and run
        $application = new Zend_Application(
                APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini'
        );
        $application->bootstrap()
                ->run();
    } catch (Zend_Db_Select_Exception $exc) {
        echo '
            <div style="width:100%;text-align:center;font-weight:bold;padding-top: 150px;color: #FF0000;">
                <h1>Erro:: 0001 - Contate o administrador do sistema.</h1>
            </div>
        ' . $exc->getMessage() ;
    }
});
