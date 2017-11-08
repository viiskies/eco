<?php
$start = microtime(true);

require "vendor/autoload.php";

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$app = new App();

echo "<div style='position: absolute; right: 0; top: 0; padding: 6px; background-color: rgba(252,57,0,0.8); font-family: Verdana; color: white'>";
echo round((microtime(true) - $start)*1000, 2) . " ms.";
echo "<br>" . round(memory_get_peak_usage()/(1024*1024), 2) . " MB.";
echo "</div>";
?>