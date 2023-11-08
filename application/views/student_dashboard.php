<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Student Dashboard</title>
    <style>
        body {
            background-color: #f7f7f7;
        }
        #dashboard {
            margin-top: 50px;
            text-align: center;
        }
        .btn-dashboard {
            margin: 10px;
        }
    </style>
</head>
<body>

    <div id="dashboard" class="container">
        <h1>Welcome to Student Dashboard</h1>
        <?php
        if ($this->session->userdata('UserLoginSession')) {
            $udata = $this->session->userdata('UserLoginSession');
            echo '<p class="lead">Hello, ' . htmlspecialchars($udata['username']) . '!</p>';
            echo '<a href="' . base_url('student/view_my_attendance') . '" class="btn btn-primary btn-dashboard">View My Attendance</a><br>';

        } else {
            redirect(base_url('welcome/login'));
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
        crossorigin="anonymous"></script>
</body>
</html>
