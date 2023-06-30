const inputBox = document.getElementById("inputbox");
const listContainer = document.getElementById("list-container");

// Add a task for the logged-in user
function addTask() {
    if (inputBox.value === '') {
        alert("Please add a note!");
    } else {
        let li = document.createElement("li");
        li.innerHTML = inputBox.value;
        listContainer.appendChild(li);

        let span = document.createElement("span");
        span.innerHTML = "\u00d7";
        li.appendChild(span);

        saveTask(inputBox.value, false); // Save the task to the database
    }

    inputBox.value = "";
}

// Save a task for the logged-in user
function saveTask(taskName, isCompleted) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "save_tasks.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            console.log("Task saved to the database.");
        }
    };
    xhr.send(`task_name=${taskName}&is_completed=${isCompleted}`);
}

// Delete a task for the logged-in user
function deleteTask(taskElement) {
    const taskName = taskElement.innerText;
    taskElement.remove();

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "delete_task.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            console.log("Task deleted from the database.");
        }
    };
    xhr.send(`task_name=${taskName}`);
}

// Mark a task as completed for the logged-in user
function markTaskAsCompleted(taskElement) {
    const taskName = taskElement.innerText;
    taskElement.classList.toggle("checked");

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "mark_task_completed.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            console.log("Task marked as completed in the database.");
        }
    };
    xhr.send(`task_name=${taskName}`);
}

// Load tasks for the logged-in user
function loadTasks() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "load_tasks.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            const tasksData = JSON.parse(xhr.responseText);
            displayTasks(tasksData);
        }
    };
    xhr.send();
}

// Display tasks on the frontend
function displayTasks(tasksData) {
    tasksData.forEach(taskData => {
        let li = document.createElement("li");
        li.innerHTML = taskData.task_name;
        if (taskData.is_completed) {
            li.classList.add("checked");
        }
        listContainer.appendChild(li);

        let span = document.createElement("span");
        span.innerHTML = "\u00d7";
        li.appendChild(span);
    });
}

// Event listeners
listContainer.addEventListener("click", function(e) {
    if (e.target.tagName === "LI") {
        markTaskAsCompleted(e.target);
    } else if (e.target.tagName === "SPAN") {
        deleteTask(e.target.parentElement);
    }
}, false);

// Load tasks on page load
loadTasks();
