<?php
set_time_limit(0);
ini_set("memory_limit", "512M");
$StartALL = getTime();
require_once('../nusoap.php');
require_once("../../soaparser/parser.class.php");
require_once("simplesax.class.php");

function getTime()
{
    $a = explode(' ', microtime());
    return(double) $a[0] + $a[1];
}

$iteracyAverage = 1;
$tests = array();
/*$tests[] = 10;
$tests[] = 100;
$tests[] = 1000;*/
$tests[] = 10000;/*
$tests[] = 100000;
$tests[] = 1000000;*/
/*
echo "<h1>PHP SAX parser </h1>";
echo "<table><tr><th>Count</th><th>Server</th><th>Client</th><th>Total</th></tr>";
foreach ($tests as $count)
{
    $totalTime = 0;
    $parseTime = 0;
    for ($i = 0; $i < $iteracyAverage; ++$i)
    {
        $Start = getTime();

        $url = "http://localhost/soapWS/soapserver.php?wsdl";

        $client = new nusoap_client($url);

        $client->call('generateArrayNames', array('name' => $count));

        $start_ParseTime = getTime();

        $xml_parser = new Simple_Parser;
        $xml_parser->parse($client->responseData);

        $End = getTime();

        $parseTime += $End - $start_ParseTime;
        $totalTime += $End - $Start;
    }

    echo "<tr><td>" . $count . "</td><td>" . number_format((($totalTime - $parseTime) / $iteracyAverage), 5) . "</td><td>" . number_format(($parseTime / $iteracyAverage), 5) . "</td><td><b>" . number_format(($totalTime / $iteracyAverage), 5) . "</b></td><tr/>";
}
echo "</table>";
flush();

echo "<h1>SimpleXML parser (DOM)</h1>";
echo "<table><tr><th>Count</th><th>Server</th><th>Client</th><th>Total</th></tr>";
foreach ($tests as $count)
{
    $totalTime = 0;
    $parseTime = 0;
    for ($i = 0; $i < $iteracyAverage; ++$i)
    {
        $Start = getTime();

        $url = "http://localhost/soapWS/soapserver.php?wsdl";

        $client = new nusoap_client($url);

        $client->call('generateArrayNames', array('name' => $count));

        $start_ParseTime = getTime();
        simplexml_load_string($client->responseData);
        $End = getTime();

        $parseTime += $End - $start_ParseTime;
        $totalTime += $End - $Start;
    }

    echo "<tr><td>" . $count . "</td><td>" . number_format((($totalTime - $parseTime) / $iteracyAverage), 5) . "</td><td>" . number_format(($parseTime / $iteracyAverage), 5) . "</td><td><b>" . number_format(($totalTime / $iteracyAverage), 5) . "</b></td><tr/>";
}
echo "</table>";
flush();


*/
echo "<h1>Custom parser </h1>";
echo "<table><tr><th>Count</th><th>Server</th><th>Client</th><th>Total</th></tr>";
foreach ($tests as $count)
{
    $totalTime = 0;
    $parseTime = 0;
    for ($i = 0; $i < $iteracyAverage; ++$i)
    {
        $Start = getTime();

        $url = "http://localhost/soapWS/soapserver.php?wsdl";

        $client = new nusoap_client($url);

        $client->call('generateArrayNames', array('name' => $count));

        $start_ParseTime = getTime();
        new Parser($client->responseData);

        $End = getTime();

        $parseTime += $End - $start_ParseTime;
        $totalTime += $End - $Start;
    }

    echo "<tr><td>" . $count . "</td><td>" . number_format((($totalTime - $parseTime) / $iteracyAverage), 5) . "</td><td>" . number_format(($parseTime / $iteracyAverage), 5) . "</td><td><b>" . number_format(($totalTime / $iteracyAverage), 5) . "</b></td><tr/>";
}
echo "</table><hr/>";

echo "<i> Total Processing Time <b>" . number_format((getTime() - $StartALL), 5) . " seconds </b></i><br/>";
echo "<i> Iteracy of processes by <b>" . $iteracyAverage . " loops </b></i><br/>";
?>
<style>
    * {font-family: calibri, tahoma}
    td { width: 100px; text-align: center}
    th { background: #DDD}
</style>