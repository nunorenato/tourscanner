<?php
echo Request::server('HTTP_ACCEPT_LANGUAGE');
preg_match_all('/(\W|^)([a-z]{2})([^a-z]|$)/six', Request::server('HTTP_ACCEPT_LANGUAGE')   , $m, PREG_PATTERN_ORDER);
$user_langs = $m[2];
print_r($user_langs);

