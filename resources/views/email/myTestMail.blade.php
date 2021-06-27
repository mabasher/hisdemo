
<!DOCTYPE html>

<html>

<head>

    <title>Healthcare</title>

</head>

<body>

    <h1>{{ $details['title'] }}</h1>

    <p>Dear {{$details['name']->ful_name}},</p>
    <p>Assalamu Alaikum</p>
    <p>Your Appointment is Successfully Completed.</p>
    <p>Appoint Date: {{\Carbon\Carbon::parse($details['name']->app_date)->format('d-m-Y')}}</p>
    <p>Appoint Time: {{\Carbon\Carbon::parse($details['name']->start_time)->format('h:i A')}}</p>
    <p>Care Giver: {{$details['name']->appdoctor->doctor_name.', '.$details['name']->appdoctor->designation}}</p>
    <p>Chember: {{$details['name']->appdoctor->doc_chember.' '.'2nd Flood, Main Building'}}</p>
   <a href="{{url('appointmentCard').'/'.$details['name']->appoint_no}}">Appointment Card</a>

    <p>Thank you</p>

</body>

</html>