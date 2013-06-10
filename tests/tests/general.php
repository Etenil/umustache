<?php

class General extends centrifuge\Test {
    function testPlaceholders() {
        $this->equals(
            umustache_render("{{foo}} {{bar}}", array(
                'foo' => 'bar',
                'bar' => 'baz'
            )),
            'bar baz'
        );
    }

    function testLoops() {
        $this->equals(
            umustache_render("{{foo}}- {{val}}{{/foo}}", array(
                'foo' => array(
                    array('val' => 'bar'),
                    array('val' => 'baz'),
                ),
            )),
            '- bar- baz'
        );
    }

    function testPseudoIfs() {
        $this->equals(
            umustache_render("{{foo}}foo{{/foo}}{{bar}}bar{{/bar}}", array(
                'foo' => array(true),
                'bar' => array(),
            )),
            'foo'
        );
    }

    function testEmptyRecursion() {
        $this->equals(
            umustache_render("Foo {{bar}}", array(
                'thing' => array(),
                'bar' => 'bar',
            )),
            'Foo bar'
        );
    }
}
