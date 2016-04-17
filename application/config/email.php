<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| E-mail configuration
|--------------------------------------------------------------------------
| 
| E-mail configuration :
| See https://www.codeigniter.com/user_guide/libraries/email.html
| 
| 
|
| 
| 
|
| 
| 
*/
$config['protocol'] = 'smtp';
//$config['mailpath'] = '/usr/sbin/sendmail';
$config['smtp_host'] = '127.0.0.1';
//$config['smtp_user'] = '';
//$config['smtp_pass'] = '';
$config['smtp_port'] = '25';
$config['charset'] = 'utf-8';
//$config['wordwrap'] = TRUE;
$config['mailtype'] = 'html';

