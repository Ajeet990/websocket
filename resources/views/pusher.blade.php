<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  
</head>
<body>
  <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>

  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    // Pusher.logToConsole = true;

    var pusher = new Pusher('cd1b8c568f5834aba032', {
      cluster: 'ap2'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        alert(`Hi ${data.message.name}, your role is ${data.message.role}`)
    //   alert(JSON.stringify(data));
    });
  </script>
</body>