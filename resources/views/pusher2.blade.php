<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
</head>
<body>
  <h1>Pusher Test</h1>
  <div>
    <button id="start_meeting">Start meeting</button>
    <button id="end_meeting" style="display: none">End meeting</button>
  </div>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>

  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('cd1b8c568f5834aba032', {
      cluster: 'ap2'
    });

    var channel = pusher.subscribe('my-channel2');
    channel.bind('my-event2', function(data) {
      if (data.message.status == 'start') {
        localStorage.setItem("meeting_duration", 1);
        $('#start_meeting').hide();
        $('#end_meeting').show();
        checkMeetingTime();
      } else if (data.message.status == 'end') {
        localStorage.removeItem('meeting_duration');
        $('#end_meeting').hide();
        $('#start_meeting').show();
        clearInterval(intervalId); // Stop the timer
      }
    });

    $(document).on('click', '#start_meeting', function() {
      $.ajax({
        url : "http://127.0.0.1:8000/sendPusher",
        method : 'get',
        data : {},
        success : function(response) {
          if (response.success) {
            // Action after starting meeting
          }
        }
      });
    });

    $(document).on('click', '#end_meeting', function() {
      $.ajax({
        url : "http://127.0.0.1:8000/endSendPusher",
        method : 'get',
        data : {},
        success : function(response) {
          if (response.success) {
            clearInterval(intervalId); // Stop the timer
            localStorage.setItem('meeting_duration', null);
          }
        }
      });
    });

    var intervalId; // Declare intervalId globally

    function checkMeetingTime() {
      var isMeetingOn = Number(localStorage.getItem('meeting_duration')) || null;
      if (isMeetingOn != null) {
        intervalId = setInterval(() => { // Assign to global intervalId
          // console.log(isMeetingOn);
          if (isMeetingOn != 0) {
            var newVal = Number(localStorage.getItem('meeting_duration'));
            localStorage.setItem('meeting_duration', newVal + 1);
          } else {
            localStorage.removeItem('meeting_duration');
            clearInterval(intervalId); // Stop the timer when meeting ends
          }
        }, 1000);
      }
    }

    var checkMeetingStatus = Number(localStorage.getItem('meeting_duration')) || null;
    if (checkMeetingStatus != null)  {
      checkMeetingTime()
    }


  </script>
</body>
