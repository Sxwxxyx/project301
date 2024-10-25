<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple Calendar</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      background-color: #f0f0f0;
    }

    .calendar {
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }

    .days {
      display: flex;
      justify-content: space-between;
      background-color: #5a4b8a;
      color: white;
      padding: 10px;
      border-radius: 5px;
    }

    .day {
      width: 40px;
      text-align: center;
    }

    .dates {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 10px;
      margin-top: 10px;
    }

    .date {
      width: 40px;
      height: 40px;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #e0e0e0;
      border-radius: 5px;
      cursor: pointer;
    }

    .date:hover {
      background-color: #d4d4d4;
    }

    .date.today {
      background-color: #5a4b8a;
      color: white;
    }
  </style>
</head>
<body>
  <div class="calendar">
    <div class="header">
      <button id="prevMonth">Previous</button>
      <h2 id="monthYear"></h2>
      <button id="nextMonth">Next</button>
    </div>
    <div class="days">
      <div class="day">Sun</div>
      <div class="day">Mon</div>
      <div class="day">Tue</div>
      <div class="day">Wed</div>
      <div class="day">Thu</div>
      <div class="day">Fri</div>
      <div class="day">Sat</div>
    </div>
    <div class="dates" id="dates"></div>
  </div>

  <script>
    const monthYear = document.getElementById('monthYear');
    const datesContainer = document.getElementById('dates');
    const prevMonthBtn = document.getElementById('prevMonth');
    const nextMonthBtn = document.getElementById('nextMonth');

    let currentDate = new Date();

    function renderCalendar() {
      datesContainer.innerHTML = '';
      const month = currentDate.getMonth();
      const year = currentDate.getFullYear();
      monthYear.textContent = `${currentDate.toLocaleString('default', { month: 'long' })} ${year}`;

      const firstDayOfMonth = new Date(year, month, 1).getDay();
      const daysInMonth = new Date(year, month + 1, 0).getDate();

      // Padding for days before the 1st
      for (let i = 0; i < firstDayOfMonth; i++) {
        const emptyDiv = document.createElement('div');
        datesContainer.appendChild(emptyDiv);
      }

      // Render each day of the month
      for (let day = 1; day <= daysInMonth; day++) {
        const dateDiv = document.createElement('div');
        dateDiv.textContent = day;
        dateDiv.classList.add('date');

        if (day === currentDate.getDate() && currentDate.getMonth() === new Date().getMonth() && currentDate.getFullYear() === new Date().getFullYear()) {
          dateDiv.classList.add('today');
        }

        datesContainer.appendChild(dateDiv);
      }
    }

    prevMonthBtn.addEventListener('click', () => {
      currentDate.setMonth(currentDate.getMonth() - 1);
      renderCalendar();
    });

    nextMonthBtn.addEventListener('click', () => {
      currentDate.setMonth(currentDate.getMonth() + 1);
      renderCalendar();
    });

    renderCalendar();
  </script>
</body>
</html>
