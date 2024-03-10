<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <header class='shadow-md py-4 px-4 sm:px-10 bg-white font-[sans-serif] min-h-[70px]'>
        <div class='flex flex-wrap items-center justify-between gap-5 relative'>
          <a href="javascript:void(0)"><strong style="color: blue;font-size: 25px">Ev<span style="color: black">ento</span></strong>
          </a>
          @auth
            <div class='flex lg:order-1 max-sm:ml-auto'>
              <a href="{{route('profile.edit')}}" class='px-4 py-2 text-sm rounded-full font-bold text-white border-2 border-[#007bff] bg-[#007bff] transition-all ease-in-out duration-300 hover:bg-transparent hover:text-[#007bff]'>Profile</a>
              <form action="{{route('logout')}}" method="POST">
                @csrf
                  <button type="submit" class='px-4 py-2 text-sm rounded-full font-bold text-white border-2 border-[#007bff] bg-[#007bff] transition-all ease-in-out duration-300 hover:bg-transparent hover:text-[#007bff] ml-3'>Logout
                  </button>
              </form>
            </div>
          @else
            <div class='flex lg:order-1 max-sm:ml-auto'>
                <a href="{{route('login')}}" class='px-4 py-2 text-sm rounded-full font-bold text-white border-2 border-[#007bff] bg-[#007bff] transition-all ease-in-out duration-300 hover:bg-transparent hover:text-[#007bff]'>Login</a>
                <a href="{{route('register')}}" class='px-4 py-2 text-sm rounded-full font-bold text-white border-2 border-[#007bff] bg-[#007bff] transition-all ease-in-out duration-300 hover:bg-transparent hover:text-[#007bff] ml-3'>Sign
                  up
                </a>
            </div>
          @endauth
          
          <ul id="collapseMenu" class='lg:!flex lg:space-x-5 max-lg:space-y-2 max-lg:hidden max-lg:py-4 max-lg:w-full'>
            <li class='max-lg:border-b max-lg:bg-[#007bff] max-lg:py-2 px-3 max-lg:rounded'>
              <a href='{{route('index')}}'
                class='lg:hover:text-[#007bff] text-[#007bff] max-lg:text-white block font-semibold text-[15px]'>Home</a>
            </li>
            @if (Auth::check() && Auth::user()->hasRole('organizer'))
                <li class='max-lg:border-b max-lg:py-2 px-3 max-lg:rounded'>
                    <a href='{{ route('event.index') }}' class='lg:hover:text-[#007bff] text-gray-500 block font-semibold text-[15px]'>My events</a>
                </li>
                <li class='max-lg:border-b max-lg:py-2 px-3 max-lg:rounded'>
                  <a href='{{ route('event.create') }}' class='lg:hover:text-[#007bff] text-gray-500 block font-semibold text-[15px]'>Add event</a>
              </li>
            @endif
            @if (Auth::check() && (Auth::user()->hasRole('organizer') || Auth::user()->hasRole('spectator')))
                <li class='max-lg:border-b max-lg:py-2 px-3 max-lg:rounded'>
                    <a href='{{ route('my_reservation') }}' class='lg:hover:text-[#007bff] text-gray-500 block font-semibold text-[15px]'>My Reservations</a>
                </li>
            @endif
           
          </ul>
        </div>
    </header>

    @yield("content")
      
    <footer class="bg-gray-900 py-8 px-10 font-[sans-serif]">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
          <div class="lg:flex lg:items-center">
            <a href="javascript:void(0)">
              <strong style="color: blue;font-size: 25px">Ev<span style="color: white">ento</span></strong>
            </a>
          </div>
          <div class="lg:flex lg:items-center">
            <ul class="flex space-x-6">
              <li>
                <a href="javascript:void(0)">
                  <svg xmlns="http://www.w3.org/2000/svg" class="fill-gray-300 hover:fill-white w-7 h-7" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                      d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h7v-7h-2v-3h2V8.5A3.5 3.5 0 0 1 15.5 5H18v3h-2a1 1 0 0 0-1 1v2h3v3h-3v7h4a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2z"
                      clip-rule="evenodd" />
                  </svg>
                </a>
              </li>
              <li>
                <a href="javascript:void(0)">
                  <svg xmlns="http://www.w3.org/2000/svg" class="fill-gray-300 hover:fill-white w-7 h-7" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                      d="M21 5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5zm-2.5 8.2v5.3h-2.79v-4.93a1.4 1.4 0 0 0-1.4-1.4c-.77 0-1.39.63-1.39 1.4v4.93h-2.79v-8.37h2.79v1.11c.48-.78 1.47-1.3 2.32-1.3 1.8 0 3.26 1.46 3.26 3.26zM6.88 8.56a1.686 1.686 0 0 0 0-3.37 1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68zm1.39 1.57v8.37H5.5v-8.37h2.77z"
                      clip-rule="evenodd" />
                  </svg>
                </a>
              </li>
              <li>
                <a href="javascript:void(0)">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="fill-gray-300 hover:fill-white w-7 h-7"
                    viewBox="0 0 24 24">
                    <path
                      d="M22.92 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.83 4.5 17.72 4 16.46 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98-3.56-.18-6.73-1.89-8.84-4.48-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.9 20.29 6.16 21 8.58 21c7.88 0 12.21-6.54 12.21-12.21 0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z" />
                  </svg>
                </a>
              </li>
            </ul>
          </div>
          <div>
            <h4 class="text-lg font-semibold mb-6 text-white">Contact Us</h4>
            <ul class="space-y-4">
              <li>
                <a href="javascript:void(0)" class="text-gray-300 hover:text-white text-sm">Email</a>
              </li>
              <li>
                <a href="javascript:void(0)" class="text-gray-300 hover:text-white text-sm">Phone</a>
              </li>
              <li>
                <a href="javascript:void(0)" class="text-gray-300 hover:text-white text-sm">Address</a>
              </li>
            </ul>
          </div>
          <div>
            <h4 class="text-lg font-semibold mb-6 text-white">Information</h4>
            <ul class="space-y-4">
              <li>
                <a href="javascript:void(0)" class="text-gray-300 hover:text-white text-sm">About Us</a>
              </li>
              <li>
                <a href="javascript:void(0)" class="text-gray-300 hover:text-white text-sm">Terms &amp; Conditions</a>
              </li>
              <li>
                <a href="javascript:void(0)" class="text-gray-300 hover:text-white text-sm">Privacy Policy</a>
              </li>
            </ul>
          </div>
        </div>
        <p class='text-gray-300 text-sm mt-8'>© 2024<a href='https://readymadeui.com/' target='_blank'
          class="hover:underline mx-1">Youcode</a>All Rights Reserved.
        </p>
    </footer>

    @yield("scripts")
</body>
</html>