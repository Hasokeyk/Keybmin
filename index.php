<?php
    
    session_start();
    ob_start();
    
    global $keybmin;
    
    require "48186.php";
    
    use Keybmin\keybmin;
    
    $keybmin = new keybmin('keybmin', [
        'test'    => true,
        'lang'    => 'tr_TR',
        'page'    => 'dashboard',
        'db_type' => 'mysqli',
        'db_name' => '',
        'db_user' => '',
        'db_pass' => '',
    ]);