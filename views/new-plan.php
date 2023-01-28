<?php
/**
 * SDEV485
 * Names: Stephen Allen & Chisom
 *
 *
 */
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Student Plan: {{ @student_token }} </title>

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

        <!-- Styles -->
        <link rel="stylesheet" href="/485-advise-it/styles/styles.css">
    </head>
<body>
<div class="container">
    <div class="row pt-3">
        <div class="col">
            <!-- Return home button -->
            <a class="btn btn-primary mt-2 mb-2" href="/advise-it" role="button">Return</a>
            <!-- Display Student Token -->
            <h4 class="text-center">Student Token: {{ @student_token }}</h4>
        </div>
    </div>

    <!-- Form data to submit to -->
    <form action="/advise-it/view-plan/{{ @student_token }}" method="post">
        <!-- Hidden input for student token to be used on form submit -->
        <input type="hidden" name="student_token" id="student_token" value="{{ @student_token }}">
        <div class="row pb-4">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 text-center mx-auto">
                <div class="form-floating">
                    <!-- Advisor Name-->
                    <input
                            type="text"
                            class="form-control border-none shadow-sm"
                            value="{{ @advisor }}"
                            name="advisor"
                            id="advisor"
                    >
                    <label for="advisor">Advisor:</label>
                </div>
            </div>
        </div> <!-- </row> -->
        <!-- FALL QUARTER -->
        <div class="row justify-content-center pb-2">
            <div class="col-5 pe-5">
                <table id="date_table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2" class="text-center">Fall Quarter</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <textarea
                                        id="fallClasses"
                                        class="form-control"
                                        name="fallClasses"
                                        rows="6"
                                        placeholder="notes...">{{ @fallClasses }}</textarea>
                                <label for="fallClasses" style="display: none;"></label>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div> <!-- </col> -->
            <!-- WINTER QUARTER -->
            <div class="col-5 ps-5">
                <table id="editableTable" class="table table-bordered">
                    <thead>
                    <tr>
                        <th colspan="2" class="text-center">Winter Quarter</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="2">
                            <textarea id="winterClasses"
                                      class="form-control"
                                      name="winterClasses"
                                      rows="6"
                                      placeholder="notes...">{{ @winterClasses }}</textarea>
                            <label for="winterClasses" style="display: none;"></label>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div> <!-- </col> -->
        </div> <!-- </row> -->
        <!-- SPRING QUARTER -->
        <div class="row justify-content-center">
            <div class="col-5 pe-5">
                <table id="editableTable" class="table table-bordered">
                    <thead>
                    <tr>
                        <th colspan="2" class="text-center">Spring Quarter</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="2">
                            <textarea id="springClasses"
                                      class="form-control"
                                      name="springClasses"
                                      rows="6"
                                      placeholder="notes...">{{ @springClasses }}</textarea>
                            <label for="springClasses" style="display: none;"></label>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div> <!-- </col> -->
            <!-- SUMMER QUARTER -->
            <div class="col-5 ps-5">
                <table id="editableTable" class="table table-bordered">
                    <thead>
                    <tr>
                        <th colspan="2" class="text-center">Summer Quarter</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="2">
                            <textarea id="summerClasses"
                                      class="form-control"
                                      name="summerClasses"
                                      rows="6"
                                      placeholder="notes...">{{ @summerClasses }}</textarea>
                            <label for="summerClasses" style="display: none;"></label>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <!-- display the date and time when form was last submitted -->
                <h4 class="text-center">
                    <check if="{{ @dateTimeSaved }} != null">
                        Last Updated: {{ @dateTimeSaved }}
                    </check>
                </h4>
            </div> <!-- </col> -->
            <!-- Button to submit form -->
            <div class="d-flex justify-content-center">
                <button id="form-submit" type='submit' name='submit' class="btn btn-primary" value="submit">Save</button>
            </div>
        </div> <!-- </row> -->
    </form> <!-- </form> -->

    <div class="fixed-bottom m-4">
        <a href="" id="printBtn" onclick="print()" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
            </svg>
        </a>
    </div>
    <!-- Check that the form was submitted successfully -->
    <check if="{{ @isFormSubmitted }}">
    <!-- Check that the save went through successfully -->
    <check if="{{ @isSaveSuccess }}">
        <!-- If save was successful display success message on bottom corner -->
        <true>
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="saveNotification" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header text-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-square-fill me-2" viewBox="0 0 16 16">
                          <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z"/>
                        </svg>
                        <strong class="me-auto">Success!</strong>
                        <small>{{ @dateTimeSaved }}</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                            Plan successfully saved under Token ID: {{ @student_token }}
                    </div>
                </div>
            </div>
        </true>
        <!-- If save was unsuccessful, display error on bottom corner-->
        <false>
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="saveNotification" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header text-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-square-fill me-2" viewBox="0 0 16 16">
                          <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                        </svg>
                        <strong class="me-auto">Error!</strong>
                        <small>{{ @dateTimeSaved }}</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                            There was an error saving under Token ID: {{ @student_token }}
                    </div>
                </div>
            </div>
        </false>
    </check>
    </check>
</div> <!--Container -->

    <!-- JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <!-- Check if the form is submitted successfully. If true, then toggle popup on window load -->
    <check if="{{ @isFormSubmitted }}">
        <script src="../scripts/scripts.js"></script>;
    </check>
</body>
</html>