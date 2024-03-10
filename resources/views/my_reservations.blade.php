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
            Organizer
          </th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Date reservation
          </th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Ticket
          </th>

        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200 whitespace-nowrap">
        @foreach ($reservations as $reservation)
             <tr>
                <td class="px-6 py-4 text-sm text-[#333]">
                    {{$reservation->event->title}}
                </td>
                <td class="px-6 py-4 text-sm text-[#333]">
                    {{$reservation->event->date_event}}
                </td>
                <td class="px-6 py-4 text-sm text-[#333]">
                    {{$reservation->event->place}}
                </td>
                <td class="px-6 py-4 text-sm text-[#333]">
                    {{$reservation->event->place_dispo}}
                </td>
              
                @if ($reservation->status=="accepted")
                    <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                      <span class="bg-gradient-to-tl from-green-600 to-lime-400 px-2.5 text-xs rounded-1.8 py-2 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Accepted</span>
                    </td>
                @else @if ($reservation->status=="pending")
                    <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                       <span class="bg-gradient-to-tl from-slate-600 to-slate-300 px-2.5 text-xs rounded-1.8 py-2 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Pending</span>
                    </td>  
                @else
                    <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <span class="bg-gradient-to-tl from-red-600 to-slate-300 px-2.5 text-xs rounded-1.8 py-2 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Refuse</span>
                    </td>  
                @endif
                @endif

                <td class="px-6 py-4 text-sm text-[#333]">
                    {{$reservation->event->price}}
                </td>
                <td class="px-6 py-4 text-sm text-[#333]">
                    {{$reservation->event->duration}}
                </td>
                <td class="px-6 py-4 text-sm text-[#333]">
                    {{$reservation->event->acceptance}}
                </td>
                <td class="px-6 py-4 text-sm text-[#333]">
                    {{$reservation->event->category->name}}
                </td>
                <td class="px-6 py-4 text-sm text-[#333]">
                    {{$reservation->event->organizer->name}}
                </td>
                <td class="px-6 py-4 text-sm text-[#333]">
                    {{$reservation->date_reservation}}
                </td>
                <td class="px-6 py-4 text-sm text-[#333]">
                  @if ($reservation->ticket!=null)
                    <a href="{{asset($reservation->ticket)}}" target="_blank">
                      <img src="{{asset('images/pdf.svg')}}" width="22px" alt="">
                    </a>
                  @endif
                </td>
                
            </tr>
        @endforeach
           
      </tbody>
    </table>
  </div>


@endsection