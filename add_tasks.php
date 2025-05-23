<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
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
					<h1>Add Tasks</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Messages</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
            </div>

        <form id="add-task-form">
            <input type="text" id="task-input" placeholder="Name of task..." required aria-label="New task description">
            
            <!-- حقل الوصف الجديد -->
            <input type="text" id="task-description" placeholder="Description..." aria-label="Task description" style="margin-top:10px;">
            
            <div class="task-options">
                <select id="task-category" aria-label="Task category">
                    <option value="personal">Personal</option>
                    <option value="work">Work</option>
                    <option value="shopping">Shopping</option>
                    <option value="other">Other</option>
                </select>
                <select id="task-priority" aria-label="Task priority">
                    <option value="low">Low</option>
                    <option value="medium" selected>Medium</option>
                    <option value="high">High</option>
                </select>
                <input type="date" id="task-due-date" aria-label="Task due date">
            </div>
        </form>

        <div style="text-align:center; margin: 20px 0;">
            <button type="submit" form="add-task-form" class="add-btn center-btn" aria-label="Add Task">
                <i class="fas fa-plus"></i> Added Task
            </button>
        </div>
        <div style="text-align: center; margin-top: 20px;">
            <p>
                <a href="my_tasks.php" style="text-decoration: none; color: var(--primary-color); font-weight: bold;">
                    <i class="fas fa-list"></i> View All My Tasks
                </a>
            </p>
        </div>
    </main>    
  </section>


	<!-- CONTENT -->
	<script src="js/common.js"></script>
  <script src="js/addTask.js"></script>

	<script src="js/script.js"></script>
</body>
</html>