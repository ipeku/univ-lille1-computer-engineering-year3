<?php
spl_autoload_register(function ($className) { 
    include ("lib/{$className}.class.php");
});

require('lib/authent_lib.php'); 

session_name('my_session');
session_start();
session_unset();
session_destroy();

require('views/pageLogout.php');

?>
