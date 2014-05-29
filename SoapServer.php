<?php

require 'init_autoloader.php';

require_once realpath('Comment.php');

/*
* Check to see if soap call is to be handled
* or if the WSDL should be displayed
*/
if(isset($_GET['wsdl']))
{
    // Autogenerate wsdl file
    $autodiscover = new Zend\Soap\AutoDiscover();
    $autodiscover->setClass('Comment')
                 ->setUri( 'http://' . $_SERVER["SERVER_NAME"] .
    $_SERVER['PHP_SELF']);
    echo $autodiscover->toXml();
    // $autodiscover->dump('comments.wsdl');
}
else
{

    $wsdl = 'http://' . $_SERVER["SERVER_NAME"] .
    $_SERVER['PHP_SELF'] . '?wsdl';

    // Create and set server

    $server = new Zend\Soap\Server($wsdl);

    $server->setClass('Comment');

    $server->handle();
}
