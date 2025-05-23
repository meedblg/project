document.addEventListener('DOMContentLoaded', () => {
    // --- DOM Elements specific to viewing/managing tasks ---
    const taskList = document.getElementById('task-list');
    const noTasksMessage = document.getElementById('no-tasks-message');

    // Filters
    const searchInput = document.getElementById('search-input');
    const filterStatus = document.getElementById('filter-status');
    const filterCategory = document.getElementById('filter-category');
    const filterDateStart = document.getElementById('filter-date-start');
    // Removed: const filterDateEnd = document.getElementById('filter-date-end'); // هذا كان تعريفًا تم إزالته سابقًا
    const clearFiltersBtn = document.getElementById('clear-filters-btn');

    // Edit Modal
    const editModal = document.getElementById('edit-modal');
    const editTaskForm = document.getElementById('edit-task-form');
    const editTaskIdInput = document.getElementById('edit-task-id');
    const editTaskInput = document.getElementById('edit-task-input');
    const editTaskCategoryInput = document.getElementById('edit-task-category');
    const editTaskPriorityInput = document.getElementById('edit-task-priority');
    const editTaskDueDateInput = document.getElementById('edit-task-due-date');
    const cancelEditBtn = document.getElementById('cancel-edit-btn');

    // --- State ---
    let tasks = [];
    let draggedItem = null; // For drag and drop

    // --- Task Rendering ---
    const renderTasks = (tasksToRender = tasks) => {
        taskList.innerHTML = ''; // Clear existing list
        noTasksMessage.classList.toggle('hidden', tasksToRender.length > 0);

        if (tasksToRender.length === 0 && tasks.length > 0) {
            noTasksMessage.textContent = "No tasks match the current filters.";
        } else if (tasksToRender.length === 0) {
            noTasksMessage.textContent = "No tasks found. Try adding some!";
        }

        tasksToRender.forEach((task, index) => {
            const li = document.createElement('li');
            li.className = `task-item ${task.completed ? 'completed' : ''}`;
            li.setAttribute('data-id', task.id);
            li.setAttribute('data-priority', task.priority);
            li.setAttribute('draggable', true); // Make item draggable

            const dueDateStatus = window.AppCommon.getDueDateStatus(task.dueDate); // Use common utility

            li.innerHTML = `
                <div class="task-details">
                    <span class="task-text">${task.text}</span>
                    <div class="task-meta">
                        <span class="category">
                            <i class="fas fa-tag"></i>
                            <span class="category-badge category-${task.category}">${task.category}</span>
                        </span>
                        <span class="priority">
                            <i class="fas fa-flag"></i> Priority: ${task.priority.charAt(0).toUpperCase() + task.priority.slice(1)}
                        </span>
                        <span class="due-date ${dueDateStatus.class}">
                            <i class="fas fa-calendar-alt"></i> ${window.AppCommon.formatDate(task.dueDate)} ${dueDateStatus.text ? `(${dueDateStatus.text})` : ''}
                        </span>
                    </div>
                </div>
                <div class="task-actions">
                    <button class="complete-btn" aria-label="${task.completed ? 'Mark as Pending' : 'Mark as Complete'}">
                        <i class="fas ${task.completed ? 'fa-undo' : 'fa-check'}"></i>
                    </button>
                    <button class="edit-btn" aria-label="Edit Task">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button class="delete-btn" aria-label="Delete Task">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `;

            li.classList.add('adding');
            li.addEventListener('animationend', () => li.classList.remove('adding'), { once: true });

            li.querySelector('.complete-btn').addEventListener('click', () => toggleCompleteTask(task.id));
            li.querySelector('.edit-btn').addEventListener('click', () => openEditModal(task.id));
            li.querySelector('.delete-btn').addEventListener('click', () => deleteTaskWithAnimation(task.id, li));

            li.addEventListener('dragstart', handleDragStart);
            li.addEventListener('dragover', handleDragOver);
            li.addEventListener('dragleave', handleDragLeave);
            li.addEventListener('drop', handleDrop);
            li.addEventListener('dragend', handleDragEnd);

            taskList.appendChild(li);
        });
    };

    // --- CRUD Operations (Delete, Toggle Complete) ---
    const deleteTask = (id) => {
        tasks = tasks.filter(task => task.id !== id);
        window.AppCommon.saveTasks(tasks); // Use common utility
        applyFiltersAndRender();
    };

    const deleteTaskWithAnimation = (id, listItem) => {
        listItem.classList.add('deleting');
        listItem.addEventListener('animationend', () => {
            deleteTask(id);
        }, { once: true });
        setTimeout(() => {
            if (document.body.contains(listItem)) {
                deleteTask(id);
            }
        }, 500);
    };

    const toggleCompleteTask = (id) => {
        tasks = tasks.map(task =>
            task.id === id ? { ...task, completed: !task.completed } : task
        );
        window.AppCommon.saveTasks(tasks); // Use common utility
        applyFiltersAndRender();
    };

    // --- Edit Modal Logic ---
    const openEditModal = (id) => {
        const task = tasks.find(task => task.id === id);
        if (!task) return;

        editTaskIdInput.value = task.id;
        editTaskInput.value = task.text;
        editTaskCategoryInput.value = task.category;
        editTaskPriorityInput.value = task.priority;
        editTaskDueDateInput.value = task.dueDate || '';

        editModal.classList.remove('hidden');
        editTaskInput.focus();
        editModal.addEventListener('keydown', trapFocus);
    };

    const closeEditModal = () => {
        editModal.classList.add('hidden');
        editTaskForm.reset();
        editModal.removeEventListener('keydown', trapFocus);
    };

    const saveEditedTask = (e) => {
        e.preventDefault();
        const id = editTaskIdInput.value;
        const newText = editTaskInput.value.trim();
        if (!newText) return;

        tasks = tasks.map(task =>
            task.id === id ? {
                ...task,
                text: newText,
                category: editTaskCategoryInput.value,
                priority: editTaskPriorityInput.value,
                dueDate: editTaskDueDateInput.value || null
            } : task
        );

        window.AppCommon.saveTasks(tasks); // Use common utility
        closeEditModal();
        applyFiltersAndRender();
    };

    const trapFocus = (e) => {
        if (e.key !== 'Tab') return;
        const focusableElements = editModal.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
        const firstElement = focusableElements[0];
        const lastElement = focusableElements[focusableElements.length - 1];

        if (e.shiftKey) {
            if (document.activeElement === firstElement) {
                lastElement.focus();
                e.preventDefault();
            }
        } else {
            if (document.activeElement === lastElement) {
                firstElement.focus();
                e.preventDefault();
            }
        }
    };

    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !editModal.classList.contains('hidden')) {
            closeEditModal();
        }
    });

    editModal.addEventListener('click', (e) => {
        if (e.target === editModal) {
            closeEditModal();
        }
    });

    // --- Filtering and Searching ---
    const applyFiltersAndRender = () => {
        const searchTerm = searchInput.value.toLowerCase();
        const statusFilter = filterStatus.value;
        const categoryFilter = filterCategory.value;
        const dateStart = filterDateStart.value;
        // const dateEnd = filterDateEnd.value; // هذا السطر صحيح لأنه تعليق

        let filteredTasks = tasks.filter(task => {
            const matchesSearch = task.text.toLowerCase().includes(searchTerm);
            const matchesStatus = statusFilter === 'all' ||
                                    (statusFilter === 'completed' && task.completed) ||
                                    (statusFilter === 'pending' && !task.completed);
            const matchesCategory = categoryFilter === 'all' || task.category === categoryFilter;

            let matchesDate = true;
            if (task.dueDate) {
                const taskDate = new Date(task.dueDate + 'T00:00:00');
                if (!isNaN(taskDate)) {
                    if (dateStart) {
                        const startDate = new Date(dateStart + 'T00:00:00');
                        if (!isNaN(startDate) && taskDate < startDate) {
                            matchesDate = false;
                        }
                    }
                    // if (dateEnd && matchesDate) { // هذا الجزء تم التعليق عليه سابقًا بشكل صحيح
                    //    const endDate = new Date(dateEnd + 'T00:00:00');
                    //    if (!isNaN(endDate) && taskDate > endDate) {
                    //       matchesDate = false;
                    //    }
                    // }
                }
            } else if (dateStart ) { // تم تعديل هذا الشرط سابقا
                matchesDate = false;
            }
            return matchesSearch && matchesStatus && matchesCategory && matchesDate;
        });

        renderTasks(filteredTasks);
    };

    const clearFilters = () => {
        searchInput.value = '';
        filterStatus.value = 'all';
        filterCategory.value = 'all';
        filterDateStart.value = '';
        // REMOVE THIS LINE: filterDateEnd.value = ''; // <--- هذا هو السطر الذي يسبب المشكلة!
        applyFiltersAndRender();
    };

    // --- Drag and Drop Handlers ---
    function handleDragStart(e) {
        draggedItem = this;
        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/plain', this.dataset.id);
        setTimeout(() => {
            this.classList.add('dragging');
        }, 0);
    }

    function handleDragOver(e) {
        e.preventDefault();
        e.dataTransfer.dropEffect = 'move';
        const targetItem = e.target.closest('.task-item');
        if (targetItem && targetItem !== draggedItem) {
            taskList.querySelectorAll('.task-item').forEach(item => item.classList.remove('drag-over'));
            targetItem.classList.add('drag-over');
        }
    }

    function handleDragLeave(e) {
        const targetItem = e.target.closest('.task-item');
        if (targetItem) {
            targetItem.classList.remove('drag-over');
        }
        if (!taskList.contains(e.relatedTarget)) {
            taskList.querySelectorAll('.task-item').forEach(item => item.classList.remove('drag-over'));
        }
    }

    function handleDrop(e) {
        e.preventDefault();
        e.stopPropagation();

        const targetItem = e.target.closest('.task-item');
        if (!targetItem || targetItem === draggedItem) {
            return;
        }

        const draggedId = e.dataTransfer.getData('text/plain');
        const targetId = targetItem.dataset.id;

        const draggedIndex = tasks.findIndex(task => task.id === draggedId);
        const targetIndex = tasks.findIndex(task => task.id === targetId);

        if (draggedIndex === -1 || targetIndex === -1) {
            console.error("Could not find dragged or target task in array.");
            return;
        }

        const [movedTask] = tasks.splice(draggedIndex, 1);
        const adjustedTargetIndex = draggedIndex < targetIndex ? targetIndex - 1 : targetIndex;
        tasks.splice(adjustedTargetIndex, 0, movedTask);

        targetItem.classList.remove('drag-over');

        window.AppCommon.saveTasks(tasks); // Use common utility
        applyFiltersAndRender();
    }

    function handleDragEnd(e) {
        this.classList.remove('dragging');
        taskList.querySelectorAll('.task-item').forEach(item => item.classList.remove('drag-over'));
        draggedItem = null;
    }

    // --- Reminder Notifications (Simple Visual Cue) ---
    const checkUpcomingTasks = () => {
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        const upcoming = tasks.filter(task => {
            if (!task.completed && task.dueDate) {
                const taskDueDate = new Date(task.dueDate + 'T00:00:00');
                if (!isNaN(taskDueDate)) {
                    const diffTime = taskDueDate - today;
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    return diffDays === 0; // Due today
                }
            }
            return false;
        });

        if (upcoming.length > 0 && Notification.permission === "granted") {
            new Notification("Todo App Reminder", {
                body: `You have ${upcoming.length} task(s) due today!`,
                icon: './favicon.ico'
            });
        } else if (Notification.permission !== "denied") {
            console.log("Notifications permission not granted. Visual cues will be used instead.");
        }
    };

    // --- Initial Load & Event Listeners ---
    if (window.AppCommon && typeof window.AppCommon.loadTasks === 'function') {
        tasks = window.AppCommon.loadTasks(); // Load tasks on page load
    } else {
        console.error("AppCommon.loadTasks is not available. Ensure common.js is loaded first.");
    }
    
    applyFiltersAndRender(); // Initial render based on loaded tasks and default filters

    // Filter event listeners
    if (searchInput) searchInput.addEventListener('input', applyFiltersAndRender);
    if (filterStatus) filterStatus.addEventListener('change', applyFiltersAndRender);
    if (filterCategory) filterCategory.addEventListener('change', applyFiltersAndRender);
    if (filterDateStart) filterDateStart.addEventListener('change', applyFiltersAndRender);
    // REMOVED THIS LINE: if (filterDateEnd) filterDateEnd.addEventListener('change', applyFiltersAndRender); // <--- هذا السطر أيضا يسبب مشكلة لأن filterDateEnd غير موجود

    if (clearFiltersBtn) clearFiltersBtn.addEventListener('click', clearFilters);

    // Edit modal listeners
    if (editTaskForm) editTaskForm.addEventListener('submit', saveEditedTask);
    if (cancelEditBtn) cancelEditBtn.addEventListener('click', closeEditModal);

    // Check reminders shortly after load (allow time for permission prompt if needed)
    setTimeout(checkUpcomingTasks, 3000);

}); // End DOMContentLoaded