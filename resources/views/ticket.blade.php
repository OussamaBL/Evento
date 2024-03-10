<div style="width: 50%;margin:0 auto;">
    <div style="text-align: center;border: 1px solid blue;background-color: #f4dcdc">
        <strong style="color: blue">Reservation sur Evento</strong>
        <div>
            <h4 style="text-decoration: underline">Event</h4>
            <strong style="color: red">{{$reservation->event->title}}</strong>
            <p><strong>Date reservation : </strong>{{$reservation->date_reservation}}</p>
            <p><strong>Date event : </strong>{{$reservation->event->date_event}}</p>
            <p><strong>Price : </strong>{{$reservation->event->price}}</p>
            <p><strong>Location : </strong>{{$reservation->event->place}}</p>
            <p><strong>Duration : </strong>{{$reservation->event->duration}}</p>
        </div>
    </div>
</div>
