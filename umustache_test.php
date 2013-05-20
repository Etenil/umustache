<?php

require('micromustache.php');

$tpl = file_get_contents('../../tfpaymentfconfirmation/tpl/tutoremail.mustache');
$vars = array(
  'tutor_name' => 'Guillaume',
  'lessons' => array(
    array('starttime' => '12:00'),
    array('starttime' => '13:00')
));

echo umustache_render($tpl, $vars);

