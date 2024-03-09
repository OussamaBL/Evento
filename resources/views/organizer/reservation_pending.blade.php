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
            Name
          </th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Email
          </th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Date Reservation
          </th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Actions
          </th>
        </tr>
      </thead>
      
      <tbody class="bg-white divide-y divide-gray-200 whitespace-nowrap">
        @foreach ($reservations as $reservation)
             <tr>
                <td class="px-6 py-4 text-sm text-[#333]">
                    {{$reservation->user->name}}
                </td>
                <td class="px-6 py-4 text-sm text-[#333]">
                    {{$reservation->user->email}}
                </td>
                <td class="px-6 py-4 text-sm text-[#333]">
                    {{$reservation->date_reservation}}
                </td>
                <td class="px-6 py-4 text-sm text-[#333]">
                    <a href="{{route('reservation.refuse',$reservation->id)}}" class="px-6 py-2.5 rounded-full text-white text-sm tracking-wider font-semibold border-none outline-none bg-red-600 hover:bg-red-700 active:bg-red-600">Refuse</a>
                    <a href="{{route('reservation.accept',$reservation->id)}}" class="px-6 py-2.5 rounded-full text-white text-sm tracking-wider font-semibold border-none outline-none bg-green-600 hover:bg-green-700 active:bg-green-600">Accept</a>
                </td>
            </tr>
        @endforeach
           
      </tbody>
    </table>
  </div>


@endsection