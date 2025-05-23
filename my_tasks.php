<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<!-- My CSS -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/test.css">

	<title>AdminHub</title>
</head>
<body>
		<?php include 'includes/sidebar.php'; ?>
	    <?php include 'includes/header.php'; ?>

		<!-- MAIN -->

		 <section id="content">
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Tasks</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">My tasks</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">All</a>
						</li>
					</ul>
				</div>
            </div>
<div class="filters">
            <input type="text" id="search-input" placeholder="Search tasks..." aria-label="Search tasks">
            <select id="filter-status" aria-label="Filter by status">
                <option value="all">All Status</option>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
            </select>
            <select id="filter-category" aria-label="Filter by category">
                <option value="all">All Categories</option>
                <option value="personal">Personal</option>
                <option value="work">Work</option>
                <option value="shopping">Shopping</option>
                <option value="other">Other</option>
            </select>
            <input type="date" id="filter-date-start" aria-label="Filter start date">
            
            <button id="clear-filters-btn" aria-label="Clear Filters"><i class="fas fa-times"></i> Clear</button>
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <p>
                <a href="add_tasks.php" style="text-decoration: none; color: var(--primary-color); font-weight: bold;">
                    <i class="fas fa-plus-circle"></i> Add New Task
                </a>
            </p>
        </div>
   

    <section class="task-list-section">
        <h2>Tasks</h2>
        <ul id="task-list" aria-live="polite">
            </ul>
        <p id="no-tasks-message" class="hidden">No tasks found. Try adding some or adjusting filters!</p>
    </section>

    <div id="edit-modal" class="modal hidden" role="dialog" aria-modal="true" aria-labelledby="edit-modal-title">
        <div class="modal-content">
            <h2 id="edit-modal-title">Edit Task</h2>
            <form id="edit-task-form">
                <input type="hidden" id="edit-task-id">
                <label for="edit-task-input">Task:</label>
                <input type="text" id="edit-task-input" required>

                <label for="edit-task-category">Category:</label>
                <select id="edit-task-category">
                    <option value="personal">Personal</option>
                    <option value="work">Work</option>
                    <option value="shopping">Shopping</option>
                    <option value="other">Other</option>
                </select>

                <label for="edit-task-priority">Priority:</label>
                <select id="edit-task-priority">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>

                <label for="edit-task-due-date">Due Date:</label>
                <input type="date" id="edit-task-due-date">

                <div class="modal-actions">
                    <button type="submit" class="save-btn">Save Changes</button>
                    <button type="button" id="cancel-edit-btn">Cancel</button>
                </div>
            </form>
        </div>
    </div>


	</section>
	<script src="js/common.js"></script>
    <script src="js/viewTasks.js"></script>
	<script src="js/script.js"></script>
</body>
</html>