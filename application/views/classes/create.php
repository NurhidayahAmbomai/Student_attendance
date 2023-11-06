<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Class</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        h1 {
            color: #333;
            margin-top: 20px;
        }
        form {
    		max-width: 400px;
    		margin: 0 auto; 
    		padding: 20px;
    		background-color: #fff;
    		border-radius: 5px;
    		box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
		}
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"],
        input[type="time"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error {
            color: #ff0000;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <h1>Create a New Class</h1>
    <form action="<?php echo base_url('classes/store'); ?>" method="post" onsubmit="return validateForm()">
        <label for="class_name">Class Name:</label>
        <input type="text" id="class_name" name="class_name" placeholder="Class Name" required />

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required />

        <label for="time">Time:</label>
        <input type="time" id="time" name="time" required />

        <input type="hidden" name="teacher_id" value="<?php echo $this->session->userdata('teacher_id'); ?>" />

        <button type="submit">Create New Class</button>
    </form>

    <script>
        function validateForm() {
            var className = document.getElementById('class_name').value;
            var date = document.getElementById('date').value;
            var time = document.getElementById('time').value;

            if (className === "") {
                alert("Please enter a Class Name.");
                return false;
            }

            if (date === "") {
                alert("Please select a Date.");
                return false;
            }

            if (time === "") {
                alert("Please select a Time.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
