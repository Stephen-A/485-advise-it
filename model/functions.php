<?php

function validateToken(String $student_token): bool
{
    if (strlen($student_token != 6))
    {
        return false;
    }
    if (!ctype_alnum($student_token))
    {
        return false;
    }

    return true;
}

function printStudentPlan(String $student_token)
{
    global $dbh;

    $sql = "SELECT * FROM advise_it_plans WHERE student_token = :student_token";
    $sql = $dbh->prepare($sql);
    $sql->bindParam(':student_token', $student_token, PDO::PARAM_STR);
    $sql->execute();

    return $sql->fetch(PDO::FETCH_ASSOC);
}

function getStudentPlan(string $student_token)
{
    // Access PDO from globals
    global $dbh;

    $sql = "SELECT * FROM advise_it_plans WHERE student_token = :student_token";
    $sql = $dbh->prepare($sql);
    $sql->bindParam(':student_token', $student_token, PDO::PARAM_STR);
    $sql->execute();

    return $sql->fetch(PDO::FETCH_ASSOC);
}

function saveStudentPlan($student_token) : bool
{

    global $dbh;

    $sql = "INSERT INTO advise_it_plans(
                 student_token, fall_classes, winter_classes, spring_classes, summer_classes, date_time_saved, advisor)
        VALUES(:student_token, :fallClasses, :winterClasses, :springClasses, :summerClasses, :dateTimeSaved, :advisor)";

    return sqlPrepareExecute($dbh, $sql, $student_token);
}

/**
 * @param $student_token
 * token that was generated
 * @return bool
 */
function updateStudentPlan($student_token): bool {
    // Access PDO from globals
    global $dbh;

    // Attempt to insert
    $sql = "UPDATE advise_it_plans
            SET fall_classes = :fallClasses, 
                winter_classes = :winterClasses, 
                spring_classes = :springClasses, 
                summer_classes = :summerClasses, 
                date_time_saved = :dateTimeSaved, 
                advisor = :advisor
            WHERE student_token = :student_token";

    return sqlPrepareExecute($dbh, $sql, $student_token);
}

/**
 * @param $dbh
 * used to connect to database
 * @param string $sql
 * used to prepare a statement to send information to database
 * @param $student_token
 * token that was generated
 * @return mixed
 */
function sqlPrepareExecute($dbh, string $sql, $student_token)
{
    $sql = $dbh->prepare($sql);

    $fallClasses = $_POST['fallClasses'];
    $winterClasses = $_POST['winterClasses'];
    $springClasses = $_POST['springClasses'];
    $summerClasses = $_POST['summerClasses'];
    $dateTimeSaved = date('Y-m-d h:i:s');
    $advisor = $_POST['advisor'];

    $sql->bindParam(':student_token', $student_token, PDO::PARAM_STR);
    $sql->bindParam(':fallClasses', $fallClasses, PDO::PARAM_STR);
    $sql->bindParam(':winterClasses', $winterClasses, PDO::PARAM_STR);
    $sql->bindParam(':springClasses', $springClasses, PDO::PARAM_STR);
    $sql->bindParam(':summerClasses', $summerClasses, PDO::PARAM_STR);
    $sql->bindParam(':dateTimeSaved', $dateTimeSaved, PDO::PARAM_STR);
    $sql->bindParam(':advisor', $advisor, PDO::PARAM_STR);


    return $sql->execute();
}