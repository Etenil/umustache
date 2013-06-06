<?php

function assertEqual($val1, $val2) {
    if($val1 != $val2) {
        echo "Test failed!\n";
        echo "'$val1' not equal to '$val2'";
    } else {
        echo 'ok';
    }
}

function printpad($value, $width=60) {
    echo PHP_EOL;
    echo $value;
    for($i = strlen($value); $i < $width; $i++) {
        echo ' ';
    }
}

require('micromustache.php');

echo "Running tests for uMustache.";
printpad("Testing variables...");
assertEqual(
    umustache_render("{{foo}} {{bar}}", array(
        'foo' => 'bar',
        'bar' => 'baz'
    )),
    'bar baz'
);

printpad("Testing looping sections...");
assertEqual(
    umustache_render("{{foo}}- {{val}}{{/foo}}", array(
        'foo' => array(
            array('val' => 'bar'),
            array('val' => 'baz'),
        ),
    )),
    '- bar- baz'
);

printpad("Testing pseudo-ifs sections...");
assertEqual(
    umustache_render("{{foo}}foo{{/foo}}{{bar}}bar{{/bar}}", array(
        'foo' => array(true),
        'bar' => array(),
    )),
    'foo'
);

printpad("Testing empty recursive...");
assertEqual(
    umustache_render("Foo {{bar}}", array(
        'thing' => array(),
        'bar' => 'bar',
    )),
    'Foo bar'
);

echo PHP_EOL;

