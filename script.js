document.getElementById('taskForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    // Get form data
    const formData = new FormData(event.target);
    const taskName = formData.get('taskName');
    const startDate = formData.get('startDate');
    const endDate = formData.get('endDate');
    const dependency = formData.get('dependency');

    // Send form data to server for processing
    fetch('generate_gantt.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(svgData => {
        // Update Gantt chart with new data
        document.getElementById('ganttChart').innerHTML = svgData;
    })
    .catch(error => console.error('Error:', error));
});
