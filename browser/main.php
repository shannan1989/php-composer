<?php
require_once dirname(__FILE__) . '/../vendor/autoload.php';

ob_start();

$handle = fopen('./input', 'r');
while (!feof($handle)) {
    $ua = fgets($handle);
    echo $ua, PHP_EOL;

    /**
     * 最近更新 2020-02
     * https://github.com/ua-parser/uap-php
     */
    $r1 = UAParser\Parser::create()->parse($ua);
    echo 'UAParser', PHP_EOL;
    echo 'Browser Family: ', $r1->ua->family, PHP_EOL;
    echo 'Browser: ', $r1->ua->toString(), PHP_EOL;
    echo 'OS: ', $r1->os->toString(), PHP_EOL;
    echo 'Device: ', $r1->device->family, PHP_EOL;
    echo $r1->toString(), PHP_EOL;
    echo PHP_EOL;

    /**
     * 最新更新 2020-02
     * https://github.com/WhichBrowser/Parser-PHP
     */
    $r2 = new WhichBrowser\Parser($ua);
    echo 'WhichBrowser', PHP_EOL;
    echo 'Browser: ', $r2->browser->toString(), PHP_EOL;
    echo 'Engine: ', $r2->engine->toString(), PHP_EOL;
    echo 'OS: ', $r2->os->toString(), PHP_EOL;
    echo 'Device: ', $r2->device->toString(), PHP_EOL;
    echo $r2->toString(), PHP_EOL;
    echo PHP_EOL;

    echo PHP_EOL;
}
fclose($handle);

$content = ob_get_contents();
ob_end_clean();

if (file_exists('./ouput')) {
    unlink('./output');
}
file_put_contents('./output', $content);

die('done!');
