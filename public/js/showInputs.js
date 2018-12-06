function showInputs($id) {
    var title = document.getElementById('title_'+$id);
    var titleInput = document.getElementById('titleInput_'+$id);
    var task = document.getElementById('task_'+$id);
    var taskInput = document.getElementById('taskInput_'+$id);
    var timeInput = document.getElementById('timeInput_'+$id);
    var time = document.getElementById('time_'+$id); 
    title.classList.add('d-none');
    task.classList.add('d-none');
    time.classList.add('d-none');
    titleInput.classList.remove('d-none');
    taskInput.classList.remove('d-none');
    timeInput.classList.remove('d-none');
}
