document.addEventListener('DOMContentLoaded', () => {
    // --- Removed: Theme Toggle related DOM Elements ---
    // const themeToggle = document.getElementById('theme-toggle');
    // const body = document.body; // No longer needs to be explicitly managed for theme
    // const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)'); // Removed

    // --- State ---
    let tasks = []; // This will be populated by loadTasks in each relevant script

    // --- Utility Functions ---
    const generateId = () => `task-${Date.now()}-${Math.random().toString(36).substring(2, 7)}`;

    const formatDate = (dateString) => {
        if (!dateString) return 'No due date';
        try {
            const date = new Date(dateString + 'T00:00:00'); // Ensure correct parsing as local date
            if (isNaN(date)) return 'Invalid Date';
            return date.toLocaleDateString(undefined, { year: 'numeric', month: 'short', day: 'numeric' });
        } catch (e) {
            console.error("Error formatting date:", dateString, e);
            return 'Invalid Date';
        }
    };

    const getDueDateStatus = (dueDate) => {
        if (!dueDate) return { class: '', text: '' };
        const today = new Date();
        today.setHours(0, 0, 0, 0); // Compare dates only
        const taskDueDate = new Date(dueDate + 'T00:00:00');
        if (isNaN(taskDueDate)) return { class: '', text: '' };

        const oneDay = 24 * 60 * 60 * 1000;
        const diffDays = Math.round((taskDueDate - today) / oneDay);

        if (diffDays < 0) {
            return { class: 'overdue', text: 'Overdue' };
        } else if (diffDays === 0) {
            return { class: 'upcoming', text: 'Due Today' };
        } else if (diffDays <= 3) { // Example: Upcoming within 3 days
            return { class: 'upcoming', text: `Due in ${diffDays} day${diffDays > 1 ? 's' : ''}` };
        }
        return { class: '', text: '' }; // Not overdue or upcoming soon
    };

    // --- LocalStorage Functions (Shared) ---
    const saveTasks = (currentTasks) => {
        try {
            localStorage.setItem('tasks', JSON.stringify(currentTasks));
        } catch (e) {
            console.error("Error saving tasks to localStorage:", e);
            alert("Could not save tasks. Local storage might be full or disabled.");
        }
    };

    const loadTasks = () => {
        try {
            const storedTasks = localStorage.getItem('tasks');
            if (storedTasks) {
                let loaded = JSON.parse(storedTasks);
                // Basic validation/migration if structure changes over time
                loaded = loaded.map(task => ({
                    id: task.id || generateId(), // Ensure ID exists
                    text: task.text || '',
                    category: task.category || 'other',
                    priority: task.priority || 'medium',
                    dueDate: task.dueDate || null,
                    completed: typeof task.completed === 'boolean' ? task.completed : false,
                    createdAt: task.createdAt || new Date().toISOString() // Add createdAt if missing
                }));
                return loaded;
            } else {
                return [];
            }
        } catch (e) {
            console.error("Error loading tasks from localStorage:", e);
            alert("Could not load tasks. Previous data might be corrupted.");
            return []; // Reset to empty array on error
        }
    }

    // --- Removed: Theme Handling (Shared) ---
    // All theme related functions and listeners are removed from here.

    // Expose common functions to the global scope or a shared object if needed by other scripts
    window.AppCommon = {
        generateId,
        formatDate,
        getDueDateStatus,
        saveTasks,
        loadTasks
        // Removed: applyTheme
    };

}); // End DOMContentLoaded