<?php
try {
    $open_review_s_db = new PDO("sqlite:validations/open_review_s_sqlite.db");
    $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die($e->getMessage());
}

try {
    if (isset($_POST['query'])) {
        $inpText = $_POST['query'];

        // remove characters which can cause sql injection
        $cleaned = preg_replace("/[^A-Za-z0-9 ]/", "", $inpText);

        $res = $open_review_s_db->query("SELECT * FROM employer WHERE company_name LIKE '%$cleaned%' LIMIT 5");


        if ($res) {
            foreach ($res as $row) {
                echo '<a class="selectitem" style="cursor: pointer; margin: 5px">' . $row['company_name'] . '<input id="'.$row['company_name'].'" name="employerId" type="text" value=' . $row['employer_id'] . ' hidden="true"></a>';
            }
        } else {
            echo '<p>No Record</p>';
        }
    }



} catch (PDOException $e) {
    die($e->getMessage());
}