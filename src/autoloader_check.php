<?php
$autoloader = require "vendor/autoload.php";

dumpAutoloader($autoloader);

function dumpAutoloader( $autoloader ) {
    $opt = JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES;

    echo "-----------------------------------------\n";
    echo "# Autoloader setting\n";
    echo "- class name\n";
    echo get_class($autoloader) . "\n\n";

    echo "## getPrefixes\n";
    $results = $autoloader->getPrefixes();
    echo json_encode($results, $opt) . "\n\n";

    echo "## getPrefixesPsr4\n";
    $results = $autoloader->getPrefixesPsr4();
    echo json_encode($results, $opt) . "\n\n";

    echo "## FallbackDir\n";
    $results = $autoloader->getFallbackDirs();
    echo json_encode($results, $opt) . "\n\n";

    echo "## FallbackDirPsr4\n";
    $results = $autoloader->getFallbackDirsPsr4();
    echo json_encode($results, $opt) . "\n\n";

    echo "## ClassMap\n";
    $results = $autoloader->getClassMap();
    echo json_encode($results, $opt) . "\n\n";

    echo "## isClassMapAuthoritative\n";
    $results = $autoloader->isClassMapAuthoritative();
    echo json_encode($results, $opt) . "\n\n";

    echo "## UseIncludePath\n";
    $results = $autoloader->getUseIncludePath();
    echo json_encode($results, $opt) . "\n\n";

    echo "## ApcuPrefix\n";
    $results = $autoloader->getApcuPrefix();
    echo json_encode($results, $opt) . "\n\n";
}

