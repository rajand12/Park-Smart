  function validation() {
    var arrivalTime = document.getElementById("arrival_time").value;
    var departureTime = document.getElementById("departure_time").value;
    isValidate = true;
    // alert(arrivalTime);
    // alert(departureTime);
    const today = new Date();
    var time = today.toLocaleTimeString();
    time = convertTo24HrsFormat(time);
    // alert (time);
    // alert (arrivalTime);
    // alert (departureTime);
    // let h = today.getHours();
    // let m = today.getMinutes();
    // alert (h);
    // alert (m);
    // h = checkTime(h);
    // m = checkTime(m);
    // let s = h + ":" + m;
    // alert("Current time" + s);

    if (arrivalTime > time && departureTime > arrivalTime) {
        diff();
        
    }
    else{
        alert("Invalid Time-- Arrival Time should be greater than current time and booking time should be 30 minutes or more.");
        isValidate = false;
           
    }
  }
function convertTo24HrsFormat(time) {
   const slicedTime = time.split(/(PM|AM)/gm)[0];

   let [hours, minutes] = slicedTime.split(':');

   if (hours === '12') {
      hours = '00';
   }

   let updateHourAndMin;

   function addition(hoursOrMin) {
      updateHourAndMin =
         hoursOrMin.length < 2
            ? (hoursOrMin = `${0}${hoursOrMin}`)
            : hoursOrMin;

      return updateHourAndMin;
   }

   if (time.endsWith('PM')) {
      hours = parseInt(hours, 10) + 12;
   }

   return `${addition(hours)}:${addition(minutes)}`;
}
//   function checkTime(i) {
//     if (i < 10) {
//       i = "0" + i;
//     }; // add zero in front of numbers < 10
//     return i;
//   }

  function diff() {
    var start = document.getElementById("arrival_time").value;
    var end = document.getElementById("departure_time").value;
    start = start.split(":");
    end = end.split(":");
    var startDate = new Date(0, 0, 0, start[0], start[1], 0);
    var endDate = new Date(0, 0, 0, end[0], end[1], 0);
    var diff = endDate.getTime() - startDate.getTime();
    //difference in arrival and departure time
    var minutes = Math.floor(diff / 1000 / 60);

    // alert("difference in arrival and departure" + minutes);
    // document.getElementById("diff").innerHTML = minutes;

    if (minutes < 30) {
      alert("Time too short");
      isValidate = false;
    }
    else{
       isValidate=true;
    }
    //units=how many 30 minutes diff
    if(isValidate==true){
      m=parseInt(minutes);
  
      var unit=m/30;
      var unit=Math.round(unit);
      // alert("integer banako minutes lai"+ m);
      var price = document.getElementById('rate').value;
      var cost= price*unit;
      // alert("total cost" + cost);
      document.getElementById('price').value = cost;
    }
    
  }