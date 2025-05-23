document.addEventListener('DOMContentLoaded', () => {
    // --- DOM Elements specific to adding tasks ---
    const taskInput = document.getElementById('task-input');
    const taskCategoryInput = document.getElementById('task-category');
    const taskPriorityInput = document.getElementById('task-priority');
    const taskDueDateInput = document.getElementById('task-due-date');
    const addTaskForm = document.getElementById('add-task-form');
    const confirmationMessage = document.getElementById('confirmation-message'); // New element for confirmation

    // --- State ---
    let tasks = [];

    // --- Initialize (Load existing tasks) ---
    if (window.AppCommon && typeof window.AppCommon.loadTasks === 'function') {
        tasks = window.AppCommon.loadTasks();
    } else {
        console.error("AppCommon.loadTasks is not available. Ensure common.js is loaded first.");
    }

    // --- Function to display confirmation message ---
    const showConfirmation = (message) => {
        if (confirmationMessage) {
            confirmationMessage.textContent = message;
            confirmationMessage.classList.remove('hidden'); // Show the message
            setTimeout(() => {
                confirmationMessage.classList.add('hidden'); // Hide after 3 seconds
            }, 3000);
        }
    };

    // --- CRUD Operations (Add Task) ---
    const addTask = (e) => {
        e.preventDefault();
        const text = taskInput.value.trim();
        if (!text) return; // Don't add empty tasks

        const newTask = {
            id: window.AppCommon.generateId(),
            text: text,
            category: taskCategoryInput.value,
            priority: taskPriorityInput.value,
            dueDate: taskDueDateInput.value || null,
            completed: false,
            createdAt: new Date().toISOString()
        };

        tasks.unshift(newTask); // Add to the beginning of the array
        window.AppCommon.saveTasks(tasks); // Save updated tasks using common utility

        // Clear the form
        addTaskForm.reset();
        taskPriorityInput.value = 'medium'; // Reset priority to default

        // Show confirmation message
        showConfirmation('Task added successfully!');

        // NO REDIRECTION HERE - User stays on addTask.html
        // window.location.href = 'viewTasks.html'; // This line is removed
    };

    // --- Event Listeners ---
    if (addTaskForm) {
        addTaskForm.addEventListener('submit', addTask);
    }
}); // End DOMContentLoaded