<?php
include_once '/Users/kiran.rao/Sites/School_project/src/Helper.php';
include_once '/Users/kiran.rao/Sites/School_project/Database/DataLayer.php';
$sc_list = Helper::get_list('school', array('id', 'name'), 0, 0, '', '');
print_r($sc_list);