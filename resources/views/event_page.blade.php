@extends('layouts.app')
@section('content')
    
<div>
  @if (session()->has('success'))
      <div id="successAlert"
          class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
          role="alert">
          <span class="font-medium"> {{ session('success') }}</span>
      </div>
  @endif
</div>

<div class="bg-gray-100 dark:bg-gray-800 py-8">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col md:flex-row -mx-4">
          <div class="md:flex-1 px-4">
              <div class="h-[460px] rounded-lg bg-gray-300 dark:bg-gray-700 mb-4">
                  <img class="w-full h-full object-cover" src="{{$event->getFirstMediaUrl('images')}}" alt="Product Image">
              </div>
              <div class="flex -mx-2 mb-4">
                  @if ($access_reservation)
                    <div class="w-1/2 px-2">
                        <a href="{{ route('reserver',$event->id) }}" class="w-full bg-gray-900 dark:bg-gray-600 text-white py-2 px-4 rounded-full font-bold hover:bg-gray-800 dark:hover:bg-gray-700">Reserver</a>
                    </div>
                  @endif
              </div>
          </div>
          <div class="md:flex-1 px-4">
              <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">{{$event->title}}</h2>
              <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">
                {{$event->place}}
              </p>
              <div class="flex mb-4">
                  <div class="mr-4">
                      <span class="font-bold text-gray-700 dark:text-gray-300">Price:</span>
                      <span class="text-gray-600 dark:text-gray-300">${{$event->price}}</span>
                  </div>
                  <div>
                      <span class="font-bold text-gray-700 dark:text-gray-300">Availability:</span>
                      <span class="text-gray-600 dark:text-gray-300">{{$event->nbr_place}} In Stock</span>
                  </div>
              </div>
              <div class="flex mb-4">
                  <div class="mr-4">
                    <span class="font-bold text-gray-700 dark:text-gray-300">Availability:</span>
                    <span class="text-gray-600 dark:text-gray-300">{{$event->place_dispo}} In Stock</span>
                  </div>
                  <div>
                    <span class="font-bold text-gray-700 dark:text-gray-300">Duration:</span>
                    <span class="text-gray-600 dark:text-gray-300">{{$event->duration}}</span>
                  </div>
              </div>
              <div class="flex mb-4">
                <div class="mr-4">
                  <span class="font-bold text-gray-700 dark:text-gray-300">Organizer:</span>
                  <span class="text-gray-600 dark:text-gray-300">{{$event->organizer->name}} In Stock</span>
                </div>
                <div>
                  <span class="font-bold text-gray-700 dark:text-gray-300">Category:</span>
                  <span class="text-gray-600 dark:text-gray-300">{{$event->category->name}}</span>
                </div>
            </div>
              <div>
                  <span class="font-bold text-gray-700 dark:text-gray-300">Product Description:</span>
                  <p class="text-gray-600 dark:text-gray-300 text-sm mt-2">
                    {{$event->description}}
                  </p>
              </div>
          </div>
      </div>
  </div>
</div>

  
@endsection