<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Room Reservation History</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
    font-family: Arial, sans-serif;
}

.container {
    width: 80%;
    margin: auto;
    padding: 20px;
}

h1 {
    text-align: left;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 10px;
    border: 1px solid #ccc;
    text-align: left;
}

th {
    background-color: #f0f0f0;
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Participation history total <span id="totalRecords">2</span> records</h1>
        <table>
            <thead>
                <tr>
                    <th>Room</th>
                    <th>Confirmation</th>
                    <th>Status</th>
                    <th>Reserve By</th>
                    <th>Reserve Date/Time</th>
                    <th>Create Date</th>
                </tr>
            </thead>
            <tbody id="recordsTable">
                <!-- Data from server will be inserted here dynamically -->
            </tbody>
        </table>
    </div>

    <script src="scripts.js">
        document.addEventListener('DOMContentLoaded', function() {
    // Fetch the data from the server
    fetch('getRecords.php')  // ใช้ backend PHP สำหรับดึงข้อมูล
        .then(response => response.json())
        .then(data => {
            const recordsTable = document.getElementById('recordsTable');
            const totalRecords = document.getElementById('totalRecords');

            totalRecords.textContent = data.length; // Update total records count

            // Create rows dynamically
            data.forEach(record => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${record.room}</td>
                    <td>${record.confirmation}</td>
                    <td>${record.status}</td>
                    <td>${record.reserve_by}</td>
                    <td>${record.reserve_date_time}</td>
                    <td>${record.create_date}</td>
                `;
                recordsTable.appendChild(row);
            });
        })
        .catch(error => console.error('Error fetching records:', error));
});

    </script>
</body>
</html>
