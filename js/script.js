
const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

// Highlight active link on page load
allSideMenu.forEach(item => {
  if (item.href === window.location.href) {
    item.parentElement.classList.add('active');
  }
});

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});




// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})







const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
	if(window.innerWidth < 576) {
		e.preventDefault();
		searchForm.classList.toggle('show');
		if(searchForm.classList.contains('show')) {
			searchButtonIcon.classList.replace('bx-search', 'bx-x');
		} else {
			searchButtonIcon.classList.replace('bx-x', 'bx-search');
		}
	}
})





if(window.innerWidth < 768) {
	sidebar.classList.add('hide');
} else if(window.innerWidth > 576) {
	searchButtonIcon.classList.replace('bx-x', 'bx-search');
	searchForm.classList.remove('show');
}


window.addEventListener('resize', function () {
	if(this.innerWidth > 576) {
		searchButtonIcon.classList.replace('bx-x', 'bx-search');
		searchForm.classList.remove('show');
	}
})



const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
	if(this.checked) {
		document.body.classList.add('dark');
	} else {
		document.body.classList.remove('dark');
	}
})













document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("taskForm");
  const taskList = document.getElementById("taskList");

  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();

      const title = document.getElementById("title").value.trim();
      const description = document.getElementById("description").value.trim();
      const dueDate = document.getElementById("dueDate").value;
      const priority = document.getElementById("priority").value;
      const type = document.getElementById("type").value;

      if (title && description && dueDate && priority && type) {
        const task = {
          title,
          description,
          dueDate,
          priority,
          type,
          createdAt: new Date().toISOString()
        };

        const existingTasks = JSON.parse(localStorage.getItem("tasks") || "[]");
        existingTasks.push(task);
        localStorage.setItem("tasks", JSON.stringify(existingTasks));

        document.getElementById("message").innerText = "✅ Task Added!";
        form.reset();
      }
    });
  }

  if (taskList) {
    const tasks = JSON.parse(localStorage.getItem("tasks") || "[]");

    if (tasks.length === 0) {
      taskList.innerHTML = "<p>No tasks yet.</p>";
    } else {
      taskList.innerHTML = ""; // تفريغ القائمة
      tasks.forEach((task, index) => {
        const div = document.createElement("div");
        div.className = "task";
        div.innerHTML = `
          <div class="task-row" style="display:flex;align-items:center;justify-content:space-between;">
            <div class="task-info" style="flex:1;min-width:0;">
              <h3 style="margin:0 0 4px 0;">${task.title}</h3>
              <p style="margin:0 0 4px 0;">${task.description}</p>
              <small style="color:#888;display:flex;gap:12px;">
                <span class="icon-label" style="display:inline-flex;align-items:center;gap:3px;">
                  <i class="fas fa-tag"></i> ${task.type}
                </span>
                <span class="icon-label" style="display:inline-flex;align-items:center;gap:3px;">
                  <i class="fas fa-flag"></i> ${task.priority}
                </span>
                <span class="icon-label" style="display:inline-flex;align-items:center;gap:3px;">
                  <i class="fas fa-calendar-alt"></i> ${task.dueDate}
                </span>
              </small>
            </div>
            <div class="task-actions" style="display:flex;gap:8px;align-items:center;justify-content:flex-end;margin-left:16px;">
              <i class='bx bx-edit' title="تعديل" data-index="${index}"></i>
              <i class='bx bx-trash' title="حذف" data-index="${index}"></i>
            </div>
          </div>
        `;
        taskList.appendChild(div);
      });

      // حذف المهمة
      document.querySelectorAll('.bx-trash').forEach(btn => {
        btn.onclick = function() {
          const idx = this.getAttribute('data-index');
          tasks.splice(idx, 1);
          localStorage.setItem("tasks", JSON.stringify(tasks));
          location.reload();
        };
      });

      // تعديل المهمة
      document.querySelectorAll(".bx-edit").forEach(btn => {
        btn.onclick = function() {
          const idx = this.getAttribute('data-index');
          const task = tasks[idx];
          document.getElementById("title").value = task.title;
          document.getElementById("description").value = task.description;
          document.getElementById("dueDate").value = task.dueDate;
          document.getElementById("priority").value = task.priority;
          document.getElementById("type").value = task.type;
          tasks.splice(idx, 1); // <--- THIS IS DELETING!
          localStorage.setItem("tasks", JSON.stringify(tasks));
        // You'll likely need to re-render tasks here if not already done
        }
      });
    }
  }
});




document.addEventListener('DOMContentLoaded', function() {
  const filterIcon = document.getElementById('filterIcon');
  const filterDropdown = document.getElementById('filterDropdown');

  filterIcon.addEventListener('click', function(e) {
    filterDropdown.style.display = filterDropdown.style.display === 'block' ? 'none' : 'block';
    e.stopPropagation();
  });

  document.addEventListener('click', function() {
    filterDropdown.style.display = 'none';
  });

  filterDropdown.addEventListener('click', function(e) {
    e.stopPropagation();
    // هنا يمكنك إضافة كود الفلترة حسب الحاجة
    // مثال: alert(e.target.dataset.filter);
  });
});

    function showTab(tab) {
      document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
      document.querySelectorAll('.message-list').forEach(list => list.style.display = 'none');

      document.querySelector(`.tab-button[onclick*="${tab}"]`).classList.add('active');
      document.getElementById(tab).style.display = 'flex';
    }

const loadTasks = () => {
    try {
        const storedTasks = localStorage.getItem('tasks');
        if (storedTasks) {
            tasks = JSON.parse(storedTasks);
            // تأكد أن كل مهمة تحتوي على الحقول الصحيحة
            tasks = tasks.map(task => ({
                title: task.title || '',
                description: task.description || '',
                dueDate: task.dueDate || '',
                priority: task.priority || '',
                type: task.type || '',
                createdAt: task.createdAt || new Date().toISOString()
            }));
        } else {
            tasks = [];
        }
    } catch (e) {
        console.error("Error loading tasks from localStorage:", e);
        tasks = [];
        alert("Could not load tasks. Previous data might be corrupted.");
    }
};















