@extends('layouts.app')
@section("content")

<div class="relative font-[sans-serif] before:absolute before:w-full before:h-full before:inset-0 before:bg-black before:opacity-50 before:z-10">
    <img src="https://readymadeui.com/cardImg.webp" alt="Banner Image" class="absolute inset-0 w-full h-full object-cover" />
    <div class="min-h-[380px] relative z-50 h-full max-w-6xl mx-auto flex flex-col justify-center items-center text-center text-white p-6">
      <h2 class="sm:text-4xl text-2xl font-bold mb-6">Une plateforme de gestion et réservation des places d'événements</h2>
      <p class="text-base text-center text-gray-200">La société "Evento" ambitionne de développer une plateforme novatrice dédiée à la gestion et à la réservation des places d'événements. L'objectif est de fournir une expérience utilisateur optimale aux participants, organisateurs et administrateurs. </p>
      <button type="button"
        class="px-6 py-3 mt-10 rounded-full text-white text-base tracking-wider font-semibold outline-none bg-transparent hover:bg-gray-50 hover:text-[#333] border-2 border-gray-300 transition-all duration-300">Getting started now</button>
    </div>  
</div>

<div class="mt-4 mb-4 flex flex-col justify-center max-w-lg mx-auto px-4 space-y-6 font-[sans-serif] text-[#333]">
    <div>
        <input type='text' id="search" placeholder='Search by title'
            class="px-4 py-2 text-base rounded-md bg-white border border-gray-400 w-full outline-blue-500" />
    </div>
    <div class="mb-4">
        <select id="categories" class="border p-2 rounded w-full">
            @foreach ($categories as $item)
                <option value={{ $item->id }}>{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
  </div>

<div class="font-[sans-serif] bg-gray-100">
    <div class="p-4 mx-auto lg:max-w-7xl sm:max-w-full">
        <h2 class="text-4xl font-extrabold text-gray-800 mb-12">Events</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" id="events-container">

            @foreach ($events as $event)
                <div class="bg-white rounded-2xl p-6 cursor-pointer hover:-translate-y-2 transition-all relative">
                
                    <div class="w-11/12 h-[220px] overflow-hidden mx-auto aspect-w-16 aspect-h-8 md:mb-2 mb-4">
                        <img src="{{ $event->getFirstMediaUrl('images') }}" alt="" class="h-full w-full object-contain" />
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">{{$event->title}}</h3>
                        <p class="text-gray-500 text-sm mt-2">{{ Str::substr($event->description, 0, 40) }}</p>
                        <h4 class="text-lg text-gray-700 font-bold mt-4">{{$event->price}}$</h4>
                        <a href="{{route('event.details',$event->id)}}" class="px-6 py-2 w-full mt-4 rounded-lg text-white text-sm tracking-wider font-semibold border-none outline-none bg-blue-600 hover:bg-blue-700 active:bg-blue-600">View</a>

                    </div>
                </div>
            @endforeach
            {{$events->links()}}
        </div>
    </div>
  </div>

@endsection

@section("scripts")
<script>
    
    const searchInput = document.getElementById('search');
    const categoriesSelect = document.getElementById('categories');

    const eventsContainer = document.getElementById('events-container');

    function fetchEventsByCategory(categoryId) {
            fetch('/event/filter/'+categoryId)
                .then(response => {
                    if (!response.ok) {
                        console.error('Error during fetch:', response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    // console.log(data.events);
                    renderCard(data.events)
                })
                .catch(error => {
                    console.error('Error during fetch:', error);
                });
    }

    categoriesSelect.addEventListener('change', function() {
            const selectedCategoryId = categoriesSelect.value;
            fetchEventsByCategory(selectedCategoryId);
    });
    searchInput.addEventListener('keyup', function() {
        const inputValue = searchInput.value;
        searchEventsByTitle(inputValue);
    });

    function searchEventsByTitle(title) {
        if(title=="") title="all";
        fetch('/event/search/'+title)
            .then(response => {
                if (!response.ok) {
                    console.error('Error during fetch:', response.statusText);
                }
                return response.json();
            })
            .then(data => {
                console.log(data.events);
                renderCard(data.events)
            })
            .catch(error => {
                console.error('Error during fetch:', error);
            });
    }

    function renderCard(events) {
        let temp = "";
            events.forEach(event => {
                console.log(event);
                temp +=  `<div class="bg-white shadow-[0_8px_12px_-6px_rgba(0,0,0,0.2)] border p-2 max-w-sm rounded-lg font-[sans-serif] overflow-hidden mx-auto mt-4">
                <img src="${event.media}" class="w-full rounded-lg" />
                <div class="px-4 my-6 text-center">
                    <h3 class="text-lg font-semibold">${event.event.title}</h3>
                    <p class="mt-2 text-sm text-gray-400">${event.event.description.substring(0, 40)}</p>
                    <a href="{{route('event.details',$event->id)}}" class="px-6 py-2 w-full mt-4 rounded-lg text-white text-sm tracking-wider font-semibold border-none outline-none bg-blue-600 hover:bg-blue-700 active:bg-blue-600">View</a>
                </div>
                </div>`;
            });
        eventsContainer.innerHTML = temp;
    }

</script>
@endsection