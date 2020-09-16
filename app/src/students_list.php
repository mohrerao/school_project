<?php

require "/app/app/vendor/autoload.php";
use School\Helper;
$msg = '';
//$result =[];

// Get school list
$schools = Helper::get_list('school', ['id', 'name']);
if (array_key_exists('school_id', $_GET)) {
    $classes = Helper::get_list_by_filter_key('class', ['id', 'name'], ['school_id' => $_GET['school_id']]);
    header('Content-Type: application/json');
    echo json_encode($classes);
    exit();
}
if (array_key_exists('class_id', $_GET)) {
    $sections = Helper::get_list_by_filter_key('section', ['id', 'name'], ['class_id' => $_GET['class_id']]);
    header('Content-Type: application/json');
    echo json_encode($sections);
    exit();
}
// Update school entity
if (!empty($_POST)) {
    $school = !empty($_POST['school']) ? $_POST['school'] : 0;
    $class_id = !empty($_POST['class_id']) ? $_POST['class_id'] : 0;
    $section_id = !empty($_POST['section_id']) ? $_POST['section_id'] : 0;
    $result = [];
    $result = Helper::get_student_list($school, $class_id, $section_id);
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        document.getElementById('school').onchange = function () {
            update_select_list('classes')
        };
        document.getElementById('class_id').onchange = function () {
            update_select_list('sections')
        };

        function update_select_list(list_box) {
            if (list_box == 'classes') {
                var id = document.getElementById('school').value;
                if (id != '') {
                    $.get('?school_id=' + id, function (data, status) {
                        if (status == 'success') {
                            var class_list = document.getElementById("class_id");
                            $('#class_id option').remove();

                            for (var key in data) {
                                var option = document.createElement("option");
                                option.text = data[key]['name'];
                                option.value = data[key]['id'];
                                class_list.add(option);
                            }
                        }
                    })
                }
            }
            if (list_box == 'sections') {
                var id = document.getElementById('class_id').value;
                if (id != '') {
                    $.get('?class_id=' + id, function (data, status) {
                        console.log(data);
                        if (status == 'success') {
                            var section_list = document.getElementById("section_id");
                            $('#section_id option').remove();
                            for (var key in data) {
                                var option = document.createElement("option");
                                option.text = data[key]['name'];
                                option.value = data[key]['id'];
                                section_list.add(option);
                            }
                        }
                    });
                }
            }
        }
    });
</script>
<body id="main_body">

<img id="top" src="top.png" alt="">
<div id="form_container">

    <h1><a>Students List</a></h1>
    <form id="form_119127" class="appnitro" method="post" action="">
        <div class="form_description">
            <h2>Students list</h2>
            <!--            <p>This is your form description. Click here to edit.</p>-->
        </div>
        <ul>

            <li id="li_1">
                <label class="description" for="school">School </label>
                <div>
                    <select class="element select medium" id="school" name="school">
                        <option selected value=''>Select</option>
                        <?php
                        foreach ($schools as $school) {
                            echo "<option value = {$school['id']}>{$school['name']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </li>
            <li id="li_2">
                <label class="description" for="class_id">Class </label>
                <div>
                    <select class="element select medium" id="class_id" name="class_id"></select>
                </div>
            </li>
            <li id="li_3">
                <label class="description" for="section_id">Section </label>
                <div>
                    <select class="element select medium" id="section_id" name="section_id">
                    </select>
                </div>
            </li>

            <li class="buttons">
                <input type="hidden" name="form_id" value="119127"/>

                <input id="saveForm" class="button_text" type="submit" name="submit" value="Submit"/>
            </li>
        </ul>
    </form>
    <?php
        if (count($result) > 0) {
            echo <<<TBL
                    <table id='student_list'><tbody>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Parent Name</th>
                            <th>Address</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>School</th>
                        </tr>
                    TBL;
            foreach ($result as $value) {
                echo <<<TRO
                        <tr>
                            <td>{$value['id']}</td>
                            <td>{$value['Student Name']}</td>
                            <td>{$value['Parent Name']}</td>
                            <td>{$value['Address']}</td>
                            <td>{$value['Section']}</td>
                            <td>{$value['Class']}</td>
                            <td>{$value['School']}</td>
                        </tr>
                        TRO;
            }
            echo <<<TBL
                    </tbody></table>
                TBL;
        }
    ?>
    <div id="footer">
        Generated by <a href="http://www.phpform.org">pForm</a>
    </div>
</div>
<img id="bottom" src="bottom.png" alt="">
</body>
</html>
