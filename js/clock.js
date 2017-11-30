$(function(){
	setInterval(updateTime, 500);
	function updateTime() {
		var date = new Date();
		var hours = date.getHours() > 12 ? date.getHours() - 12 : date.getHours();
		var am_pm = date.getHours() >= 12 ? "PM" : "AM";
		hours = hours < 10 ? "0" + hours : hours;
		var minutes = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
		var seconds = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();
		time = hours + ":" + minutes + ":" + seconds + " " + am_pm;
		$("#clock").text(formatDate(date) + " " + time);
	}

	function formatDate(date) {
		var monthNames = [
		"January", "February", "March",
		"April", "May", "June", "July",
		"August", "September", "October",
		"November", "December"
		];

		var day = date.getDate();
		var monthIndex = date.getMonth();
		var year = date.getFullYear();

		return monthNames[monthIndex] + ' ' + day + ', ' + year;
	}
})