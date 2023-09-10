function showTime() {
  var now = new Date();
  var h = now.getHours(); // 0 - 23
  var m = now.getMinutes(); // 0 - 59
  var s = now.getSeconds(); // 0 - 59
  var day = now.getDay();
  var date = now.getDate();
  var month = now.getMonth();
  var year = now.getFullYear();
  var session = "AM";

  if (h == 0) {
    h = 12;
  }

  if (h > 12) {
    h = h - 12;
    session = "PM";
  }
  // store day and month name in an array
  var dayNames = [
    "Sunday",
    "Monday",
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday",
  ];
  var monthNames = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];
  // format date and time
  h = h < 10 ? "0" + h : h;
  m = m < 10 ? "0" + m : m;
  s = s < 10 ? "0" + s : s;
  date = date < 10 ? "0" + date : date;

  // display date and time
  var time =
    dayNames[day] +
    ", " +
    monthNames[month] +
    " " +
    date +
    ", " +
    year +
    " " +
    h +
    ":" +
    m +
    ":" +
    s +
    " " +
    session;
  document.getElementById("time").innerText = time;
  document.getElementById("time").textContent = time;

  setTimeout(showTime, 1000);
}

showTime();