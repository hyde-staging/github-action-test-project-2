<?php

$contents = file(__FILE__);
$exitCode = 0;

function verify(bool|Closure $result): void
{
    global $contents;
    global $exitCode;

    $line = trim($contents[debug_backtrace()[0]['line'] - 1]);
    $testName = substr($line, 7, strpos($line, ');') - 7);

    if ($result instanceof Closure) {
        $result = $result();
    }

    if (! $result) {
        $exitCode = 1;
    }

    echo $result ? 'passed' : 'failed' . ": $testName\n";
}

// TODO

exit($exitCode);
