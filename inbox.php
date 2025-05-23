<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
  
	<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

	<!-- My CSS -->
	<link rel="stylesheet" href="css/style.css">

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
					<h1>Messages</h1>
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
				<div class="tabs-row">
  <div class="tabs">
    <button class="tab-button" onclick="showTab('All')">
      All <span id="All-count"></span>
    </button>
    <button class="tab-button active" onclick="showTab('inbox')">
      Inbox <span class="badge" id="inbox-count">1</span>
    </button>
    <button class="tab-button" onclick="showTab('archive')">
      Archive <span id="archive-count"></span>
    </button>
  </div>
  
  <div class="tabs-icons" style="position: relative;">
    <i class='bx bxs-filter-alt' id="filterIcon" title="Filter"></i>
    <div class="filter-dropdown" id="filterDropdown">
      <div class="filter-option" data-filter="system">System</div>
      <div class="filter-option" data-filter="team">Team</div>
      <div class="filter-option" data-filter="assigned">Assigned To</div>
    </div>
    <input type="checkbox" class="tabs-icons" />
    <span class="tabs-divider"></span>
    <i class='bx bxs-archive-in' title="Archive In"></i>
    <i class='bx bxs-trash' title="Delete"></i>
    <i class='bx bxs-error-alt' title="Report"></i>
  </div>
</div>

<!-----------    INBOX TABS   ---------------->

    <div class="message-list" id="inbox">
      <div class="message">
        <input type="checkbox" class="message-checkbox" />
        <div class="message-text">
          <p><strong>New Task:</strong> Meeting at 3 PM.</p>
          <span class="time">2 hours ago</span>
        </div>
        
        <div class="message-actions">
          <i class="bx bxs-share" title="Reply/Share"></i>
          <i class="bx bxs-archive-in" title="Archive"></i>
          <i class="bx bxs-trash" title="Delete"></i>
          <i class="bx bxs-error-alt" title="Report"></i>
        </div>
      </div>

      
      <div class="message">
        <input type="checkbox" class="message-checkbox" />
        <div class="message-text">
          <p><strong>System :</strong> Submit your project report.</p>
          <span class="time">10 minutes ago</span>
        </div>
        <div class="message-actions">
          <i class="bx bxs-share" title="Reply/Share"></i>
          <i class="bx bxs-archive-in" title="Archive"></i>
          <i class="bx bxs-trash" title="Delete"></i>
          <i class="bx bxs-error-alt" title="Report"></i>
        </div>
      </div>
    </div>

<!-----------    ARCHIVE TABS   ---------------->

    <div class="message-list" id="archive" style="display: none;">
      <div class="message">
        <input type="checkbox" class="message-checkbox" />
        <div class="message-text">
          <p><strong>System :</strong> Updated the report yesterday.</p>
          <span class="time">1 day ago</span>
        </div>
        <div class="message-actions">

          <i class="bx bxs-archive-in" title="Archive Up"></i>
          <i class="bx bxs-trash"></i>
          <i class='bx bxs-error-alt' title="Report"></i>
        </div>
      </div>
    </div>

<!-----------    ALL TABS   ---------------->

    <div class="message-list" id="All" style="display: none;">
      <div class="message">
        <input type="checkbox" class="message-checkbox" />
        <div class="message-text">
          <p><strong>System :</strong> Welcome to your dashboard!</p>
          <span class="time">Just now</span>
        </div>
        <div class="message-actions">
          <i class="bx bxs-share" title="Reply/Share"></i>
          <i class="bx bxs-archive-in" title="Archive"></i>
          <i class="bx bxs-trash" title="Delete"></i>
          <i class="bx bxs-error-alt" title="Report"></i>
        </div>
      </div>
      <div class="message">
        <input type="checkbox" class="message-checkbox" />
        <div class="message-text">
          <p><strong>System :</strong> Your profile was updated successfully.</p>
          <span class="time">5 minutes ago</span>
        </div>
        <div class="message-actions">
          <i class="bx bxs-share" title="Reply/Share"></i>
          <i class="bx bxs-archive-in" title="Archive"></i>
          <i class="bx bxs-trash" title="Delete"></i>
          <i class="bx bxs-error-alt" title="Report"></i>
        </div>
      </div>
      <div class="message">
        <input type="checkbox" class="message-checkbox" />
        <div class="message-text">
          <p><strong>System :</strong> Maintenance scheduled for tomorrow.</p>
          <span class="time">1 hour ago</span>
        </div>
        <div class="message-actions">
          <i class="bx bxs-share" title="Reply/Share"></i>
          <i class="bx bxs-archive-in" title="Archive"></i>
          <i class="bx bxs-trash" title="Delete"></i>
          <i class="bx bxs-error-alt" title="Report"></i>
        </div>
      </div>
    </div>

    <div class="add-button">
      <i class="bx bx-plus"></i>
    </div>
  </div>
	
	</section>
	
	

	<script src="js/script.js"></script>
</body>
</html>