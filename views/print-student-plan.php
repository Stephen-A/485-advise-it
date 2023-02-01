<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Student Plan: {{ @student_token }} </title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Styles -->
    <link rel="stylesheet" href="/485-advise-it/styles/styles.css">
</head>
<body>
    <div class="container">
    <h1>Student Token: {{ @student_token }}</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="col-1">Advisor</th>
                    <th scope="col" class="col-2">Fall</th>
                    <th scope="col" class="col-2">Winter</th>
                    <th scope="col" class="col-2">Spring</th>
                    <th scope="col" class="col-2">Summer</th>
                    <th scope="col" class="col-4">Time Saved</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ @advisor }}</td>
                    <td>{{ @fallClasses }}</td>
                    <td>{{ @winterClasses }}</td>
                    <td>{{ @springClasses }}</td>
                    <td>{{ @summerClasses }}</td>
                    <td>{{ @dateTimeSaved }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>