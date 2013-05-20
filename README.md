µMustache - Logic-less templates
================================

µMustache is an effort to implement a very minimal version of a Mustache-like templating language.

It all fits in a single function and only supports two types of constructs that should be sufficient in many situations.


Use-case
--------

The typical use-case for µMustache is something like an automated email template, where using a full-blown templating library is just overkill.


Usage
-----

Here is an example of how to use µMustache:

    $template = '{{var1}} {{var2}}{{subvar}}{{/var2}}';
    $processed = umustache_render($template, array(
        'var1' => 'foo',
        'var2' => array(
            array('subvar' => 'bar'),
            array('subvar' => 'baz'),
        ),
    ));

Here we are passing the template and an associative array of parameters to the **umustache_render** function. The {{placeholders}} are then replaced by their values. One of the values is an array of associative arrays, which are then processed in a loop.


Constructs
----------

µMustache only supports two constructs at this time, the variable placeholder and the section placeholder.

### Variables
Variables are names within two sets of curly braces, like so:

    {{name}}

A placeholder is simply replaced by a values associated to its name. If no value was provided for a placeholder, it is simply omitted.

### Sections
Sections are loops on an array of data. Assuming the following array of data:

    array(
        'myarray' => array(
            array('value' => 'foo'),
            array('value' => 'bar')
        ),
    );

We can display it in the following section:

    Behold the values:
    {{myarray}}
      o {{value}}
    {{/myarray}}

Which will generate:

    Behold the values:
      o foo
      o bar

Note that the section tags have no effect in the whitespace.

Section tags can also be (mis)used as an if block like so:

    array('true' => array(true), 'false' => array())

    {{true}}
        Yes that's true!
    {{/true}}
    {{false}}
        Nope that's wrong.
    {{/false}}

Note that if it looks ugly to you, that's a normal thing. Improvement needed.

