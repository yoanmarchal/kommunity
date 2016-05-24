<?php


/*  change le email from  */

add_filter('wp_mail_from', 'new_mail_from');

add_filter('wp_mail_from_name', 'new_mail_from_name');

function new_mail_from()
{
    return 'contact@pro87.com';
}

function new_mail_from_name()
{
    return '[pro87.com]';
}
