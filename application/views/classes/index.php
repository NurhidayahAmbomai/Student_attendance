<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Class List</title>
</head>
<body>
	<h1>Class List</h1>
	<a href="URL_TO CREATE_CLASS_FORM">Create New Class</a>

	<table>
		<thead>
			<tr>
				<th>Class Name</th>
				<th>Date</th>
				<th>Time</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($classes as $class): ?>
				<tr>
					<td><?php echo htmlspecialchars($class['class_name'] ENT_QUOTES,'UTF-8'); ?>
					</td>
					<td><?php echo htmlspecialchars($class['date'] ENT_QUOTES,'UTF-8'); ?>
					</td>
					<td><?php echo htmlspecialchars($class['time'] ENT_QUOTES,'UTF-8'); ?>
					</td>
					<td>
					<a href="URL_TO_EDIT_CLASS_FORM/<?php echo $class['id]; ?>">Edit</a>
					<a href="URL_TO_DELETE_CLASS/<php echo $class['id']; ?>" onclick = "return confirm('Are you sure?')">Delere</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</body>
</html>
