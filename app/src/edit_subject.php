<?php
require "/app/app/vendor/autoload.php";
// Create a school entity

$msg = '';
// Get school details from school id
if (isset($_GET['subject_id'])) {
    $subject = new subject();
    $msg = $subject->load_by_id('subject', $_GET['subject_id']);
//        print_r($subject);die();
}
if (!empty($_POST)) {
    if ($_POST['update'] == 'Update') {
        $subject = new subject();
        $subject->id = $_POST['subject_id'];
        $subject->name = $_POST['subject_name'];
        $subject->class_id = $_POST['class_id'];
        $msg = $subject->update('subject');
    }
    if ($_POST['delete'] == 'Delete') {
        $subject = new subject();
        $subject->id = $_POST['subject_id'];
        $subject->delete('subject');
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Edit / Update subject</title>
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
            <h2>Update / Delete subject</h2>
            <!--            <p>This is your form description. Click here to edit.</p>-->
        </div>
        <?php print("<input hidden id='subject_id' name='subject_id' class='element text medium' type='text' maxlength='255' value='{$subject->id}'>"); ?>
        <ul>
            <li id="li_2">
                <label class="description" for="element_2">subject Name </label>
                <div>
                    <?php
                    print ("<input id='subject_name' name='subject_name' class='element text medium' type='text' maxlength='255' value= '{$subject->name}'>");
                    ?>
                </div>
            </li>
            <li id="li_3">
                <label class="description" for="class_id">Class </label>
                <div>
                    <select class="element select medium" id="class_id" name="class_id">
                        <?php
                        $classes = Helper::get_list('class', array('id', 'name'), 0, 0, '', '');
                        foreach ($classes as $class) {
                            if ($class['id'] == $subject->class_id) {
                                print ("<option selected value = '{$class['id']}'>{$class['name']}</option>");
                            } else {
                                print ("<option value = '{$class['id']}'>{$class['name']}</option>");
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