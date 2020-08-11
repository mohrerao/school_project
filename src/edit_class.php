<?php
require "vendor/autoload.php";
use School\SchoolClass;
// Create a school entity
include_once '/Users/kiran.rao/Sites/School_project/src/SchoolClass.php';
include_once '/Users/kiran.rao/Sites/School_project/src/Helper.php';
$msg = '';
// Get school details from school id
if (isset($_GET['class_id'])) {
    $class = new SchoolClass();
    $msg = $class->load_by_id('class', $_GET['class_id']);
}
if (!empty($_POST)) {
//        print_r($_POST);die();
    if ($_POST['update'] == 'Update') {
        $class = new SchoolClass();
        $class->id = $_POST['class_id'];
        $class->name = $_POST['class_name'];
        $class->school_id = $_POST['school_id'];
        $msg = $class->update('class');
    }
    if ($_POST['delete'] == 'Delete') {
        $class = new SchoolClass();
        $class->id = $_POST['class_id'];
        $class->delete('class');
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Untitled Form</title>
    <link rel="stylesheet" type="text/css" href="view.css" media="all">
    <script type="text/javascript" src="view.js"></script>

</head>
<body id="main_body">

<img id="top" src="top.png" alt="">
<div id="form_container">

    <h1><a>Create Class</a></h1>
    <?php
    if (!empty($msg)) {
        print("<div class='msg'>$msg</div>");
    }
    ?>
    <form id="form_119127" class="appnitro" method="post" action="">
        <div class="form_description">
            <h2>Upcate School</h2>
            <!--            <p>This is your form description. Click here to edit.</p>-->
        </div>
        <?php print("<input hidden id='class_id' name='class_id' class='element text medium' type='text' maxlength='255' value='{$class->id}'>"); ?>
        <ul>

            <!--            <li id="li_1" >-->
            <!--                <label class="description" for="element_1">Class ID * </label>-->
            <!--                <div>-->
            <!--                    <input hidden id="element_1" name="element_1" class="element text medium" type="text" maxlength="255" value=""/>-->
            <!--                </div>-->
            <!--            </li>		-->
            <li id="li_2">
                <label class="description" for="element_2">Class Name </label>
                <div>
                    <?php
                    print ("<input id='class_name' name='class_name' class='element text medium' type='text' maxlength='255' value= '{$class->name}'>");
                    ?>
                </div>
            </li>
            <li id="li_3">
                <label class="description" for="school_id">School </label>
                <div>
                    <select class="element select medium" id="school_id" name="school_id">
                        <?php
                        $schools = Helper::get_list('school', array('id', 'name'), 0, 0, '', '');
                        foreach ($schools as $school) {
                            if ($school['id'] == $class->school_id) {
                                print ("<option selected value = '{$school['id']}'>{$school['name']}</option>");
                            } else {
                                print ("<option value = '{$school['id']}'>{$school['name']}</option>");
                            }
                        }
                        ?>
                    </select>
                </div>
            </li>

            <li class="buttons">
                <input type="hidden" name="form_id" value="119127"/>
                <input id="update" class="button_text" type="submit" name="update" value="Update"/>
                <input id="saveForm" class="button_text" type="submit" name="delete" value="Delete"/>
            </li>
        </ul>
    </form>
    <div id="footer">
        Generated by <a href="http://www.phpform.org">pForm</a>
    </div>
</div>
<img id="bottom" src="bottom.png" alt="">
</body>
</html>