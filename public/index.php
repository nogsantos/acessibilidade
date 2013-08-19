<?php
call_user_func(function() {

    require_once '../library/autoload.php';

    // Create application, bootstrap, and run
    $application = new Zend_Application(
            APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini'
    );
    $application->bootstrap()
            ->run();
});
