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
<div class="overflow-x-auto mt-4 mb-4">
    <table class="min-w-full divide-y divide-gray-200 font-[sans-serif]">
      <thead class="bg-gray-100 whitespace-nowrap">
        <tr>
          <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            
          </th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Title
          </th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Date event
          </th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Place
          </th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Place dispo
          </th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Status
          </th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Price
          </th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Duration
          </th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Acceptance
          </th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Category
          </th>

          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Actions
          </th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200 whitespace-nowrap">
        @foreach ($events as $event)
             <tr>
                <td class="px-6 py-4 text-sm text-[#333]">
                  <img src="{{ $event->getFirstMediaUrl('images') }}" class="w-full rounded-lg" />
                </td>
                <td class="px-6 py-4 text-sm text-[#333]">
                    {{$event->title}}
                </td>
                <td class="px-6 py-4 text-sm text-[#333]">
                    {{$event->date_event}}
                </td>
                <td class="px-6 py-4 text-sm text-[#333]">
                    {{$event->place}}
                </td>
                <td class="px-6 py-4 text-sm text-[#333]">
                    {{$event->place_dispo}}
                </td>
                <td class="px-6 py-4 text-sm text-[#333]">
                    {{$event->status}}
                </td>

                @if ($event->status=="accepted")
                    <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                      <span class="bg-gradient-to-tl from-green-600 to-lime-400 px-2.5 text-xs rounded-1.8 py-2 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Accepted</span>
                    </td>
                @else
                    <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                       <span class="bg-gradient-to-tl from-slate-600 to-slate-300 px-2.5 text-xs rounded-1.8 py-2 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Pending</span>
                    </td>   
                @endif

                <td class="px-6 py-4 text-sm text-[#333]">
                    {{$event->price}}
                </td>
                <td class="px-6 py-4 text-sm text-[#333]">
                    {{$event->duration}}
                </td>
                <td class="px-6 py-4 text-sm text-[#333]">
                    {{$event->acceptance}}
                </td>
                <td class="px-6 py-4 text-sm text-[#333]">
                    {{$event->category->name}}
                </td>
                <td class="px-6 py-4 text-sm text-[#333]">
                    <a href="{{ route('event.edit',$event->id) }}" class="px-6 py-2.5 rounded-full text-white text-sm tracking-wider font-semibold border-none outline-none bg-blue-600 hover:bg-blue-700 active:bg-blue-600">Edit</a>
                      <form action="{{ route('event.destroy',$event->id) }}" style="display: inline-block" method="post">
                          @csrf
                          @method('delete')
                          <button type="submit" onclick="return confirm('Are you sure you want to delete this user?');" class="px-6 py-2.5 rounded-full text-white text-sm tracking-wider font-semibold border-none outline-none bg-red-600 hover:bg-red-700 active:bg-red-600">Delete</button>
                      </form>
                        <a href="{{route('event.approve',$event->id)}}" class="px-6 py-2 rounded-full text-black text-sm tracking-wider font-medium outline-none border-2 border-purple-600 hover:bg-purple-600 hover:text-white transition-all duration-300">Reservations pending</a>
                        <a href="{{route('event.reservations',$event->id)}}" class="px-6 py-2 rounded-full text-black text-sm tracking-wider font-medium outline-none border-2 border-green-600 hover:bg-green-600 hover:text-white transition-all duration-300">Reservations</a>
                </td>
            </tr>
        @endforeach
           
      </tbody>
    </table>
  </div>


@endsection