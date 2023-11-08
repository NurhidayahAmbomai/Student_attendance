<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Check-In</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #007bff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            text-align: center;
            padding: 8px;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .submit-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            float: right;
            margin-top: 20px;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
        .alert {
            background-color: #007bff;
            color: white;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Attendance Check-In</h1>
        <form action="<?php echo base_url('attendance/check_in'); ?>" method="post">
            <label for="class_id">Select Class:</label>
            <select name="class_id" id="class_id" required>
                <option value="">Select a class</option>
                <?php foreach ($classes as $class): ?>
                    <option value="<?php echo $class['class_id']; ?>" <?php echo ($class['class_id'] == $class_id) ? 'selected' : ''; ?>>
                        <?php echo $class['class_name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
        </form>
        <?php
            $checkin_time = date('Y-m-d H:i:s'); 
        ?>
        <p>Check-In Time: <?php echo $checkin_time; ?></p>

        <form action="<?php echo base_url('attendance/store'); ?>" method="post">
            <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
            <input type="hidden" name="checkin_time" value="<?php echo $checkin_time; ?>">
            <table>
                <tr>
                    <th>Student Name</th>
                    <th>Present</th>
                    <th>Absent</th>
                </tr>
                <?php if (is_array($students) && !empty($students)): ?>
                    <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($student['name']); ?></td>
                        <td>
                            <input type="radio" name="attendance[<?php echo $student['id']; ?>]" value="present" required>
                        </td>
                        <td>
                            <input type="radio" name="attendance[<?php echo $student['id']; ?>]" value="absent">
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No students found for this class.</td>
                    </tr>
                <?php endif; ?>

            </table>


            <button type="submit" class="submit-btn">Submit Attendance</button>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('class_id').addEventListener('change', function() {
                var selectedClassId = this.value;
                var form = this.closest('form');
                form.submit();
            });
        });
    </script>
</body>
</html>



