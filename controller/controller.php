<?php

// Create PDO for Database access
require_once $_SERVER["DOCUMENT_ROOT"].'/../config.php';
include('model/functions.php');

class Controller
{
    // FIELDS //
    private $_f3;

    /**
     * Constructor for Controller object
     * @param $f3 object used for controlling Fat-Free
     */
    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    /**
     * Display the home page
     */
    function home()
    {
        $view = new Template();
        echo $view->render('views/home.php');
    }

    /**
     * Display (empty) new plan
     */
    function createNewStudentPlan()
    {
        try {
            $bytes = random_bytes(3);
        } catch (Exception $e) {
            echo $e;
        }

        $student_token = bin2hex($bytes);
        while (validateToken($student_token)) {
            $student_token = bin2hex($bytes);
        }

        $this->_f3->set('student_token', $student_token);

        $this->_f3->set('isFormSubmitted', false);
        $this->_f3->set('isSaveSuccess', false);

        $view = new Template();
        echo $view->render('views/new-plan.php');
    }

    /**
     * Displays a previously created plan if a valid token is passed in
     */
    function viewStudentPlan($student_token)
    {
        // If token is invalid, redirect to home
        if (validateToken($student_token))
        {
            header('location: /');
        }

        // Initialize variables being used to submit form data
        $dateTimeSaved= null;
        $isFormSubmitted = false;
        $isSaveSuccess = false;
        $advisor = "";
        $fallClasses = "";
        $winterClasses = "";
        $springClasses = "";
        $summerClasses = "";

        // Check if form was submitted without empty data
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST))
        {
            $isFormSubmitted = true;

            // Store current token (if valid)
            if (validateToken($_POST['student_token']))
            {
                $student_token = $_POST['student_token'];
            }

            if (is_array(getStudentPlan($student_token)))
            {
                $isSaveSuccess = updateStudentPlan($student_token);
            }
            else
            {
                $isSaveSuccess = saveStudentPlan($student_token);
            }

            $currentPlan = getStudentPlan($student_token);
            $dateTimeSaved = gmdate('Y-m-d h:i:s');
            $advisor = $currentPlan['advisor'];
            $fallClasses = $currentPlan['fall_classes'];
            $winterClasses = $currentPlan['winter_lasses'];
            $springClasses = $currentPlan['spring_classes'];
            $summerClasses = $currentPlan['summer_classes'];
        }
        else
        {
            $currentPlan = getStudentPlan($student_token);

            // If the student token was passed in
            if (!empty($currentPlan['student_token']))
            {
                // Assign variables to their values inside the database
                $student_token = $currentPlan['student_token'];
                $dateTimeSaved = gmdate('Y-m-d h:i:s');
                $advisor = $currentPlan['advisor'];
                $fallClasses = $currentPlan['fall_classes'];
                $winterClasses = $currentPlan['winter_classes'];
                $springClasses = $currentPlan['spring_classes'];
                $summerClasses = $currentPlan['summer_classes'];
            }
            else
            {
                header('location: ../');
            }
        }
        // Pass data through F3 and display data on current page
        $this->_f3->set('student_token', $student_token);
        $this->_f3->set('dateTimeSaved', $dateTimeSaved);
        $this->_f3->set('isFormSubmitted', $isFormSubmitted);
        $this->_f3->set('isSaveSuccess', $isSaveSuccess);
        $this->_f3->set('advisor', $advisor);
        $this->_f3->set('fallClasses', $fallClasses);
        $this->_f3->set('winterClasses', $winterClasses);
        $this->_f3->set('springClasses', $springClasses);
        $this->_f3->set('summerClasses', $summerClasses);

        // Render new-plan page
        $view = new Template();
        echo $view->render('views/new-plan.php');
    }
}