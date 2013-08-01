<?php
set_time_limit(0);

require_once("nusoap.php");
$namespace = "http://localhost/soapWS/index.php";
$serviceName = "generateArrayNames";

$server = new soap_server();
$server->configureWSDL($serviceName, $namespace);

$server->wsdl->addComplexType(
                        'arrayname', 
                        'complexType', 
                        'array',
                        'sequence', 
                        '',
                        array(
                            'arrayname'=>array('name'=>'arrayname','type'=>'xsd:string'))
    ); 

$server->register($serviceName, 
                    array("name" => "xsd:int"),
                    array("return" => "tns:arrayname"), 
                    "http://localhost/soapWS/soapserver.php", 
                    "http://localhost/soapWS/soapserver.php#generateArrayNames");

function generateArrayNames($count)
{
    $arrayname = array();

    while ($count > 0)
    {
        $arrayname[$count] = "abcdefghij";
        $count--;
    }

    return array("arrayname" => $arrayname); 
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>
