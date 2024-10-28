function showTime() {
    var now = new Date();
    var hours = now.getHours(); // 0 - 23
    var minutes = now.getMinutes(); // 0 - 59
    var seconds = now.getSeconds(); // 0 - 59
    var day = now.getDay();
    var date = now.getDate();
    var month = now.getMonth();
    var year = now.getFullYear();

    var session = hours < 12 ? "AM" : "PM";
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

    if (hours == 0) {
        hours = 12;
    }

    // format date and time
    hours = hours < 10 ? "0" + hours : hours;
    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;
    date = date < 10 ? "0" + date : date;

    // display date and time
    var currentTime =
        monthNames[month] +
        " " +
        date +
        ", " +
        year +
        " " +
        dayNames[day] +
        " " +
        hours +
        ":" +
        minutes +
        ":" +
        seconds +
        " " +
        session;

    document.getElementById("current-date").innerText = currentTime;

    setTimeout(showTime, 1000);
}

showTime();
