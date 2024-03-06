@extends('layouts.app')
@section('content')
    
<div class="relative font-[sans-serif] before:absolute before:w-full before:h-full before:inset-0 before:bg-black before:opacity-50 before:z-10">
    <img src="https://readymadeui.com/cardImg.webp" alt="Banner Image" class="absolute inset-0 w-full h-full object-cover" />
    <div class="min-h-[380px] relative z-50 h-full max-w-6xl mx-auto flex flex-col justify-center items-center text-center text-white p-6">
      <h2 class="sm:text-4xl text-2xl font-bold mb-6">Showcase Your Product or Service in Style</h2>
      <p class="text-base text-center text-gray-200">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis accumsan, nunc et tempus blandit, metus mi consectetur nibh, a pharetra felis turpis vitae ligula. Etiam laoreet velit nec neque ultrices, non consequat mauris tincidunt.</p>
      <button type="button"
        class="px-6 py-3 mt-10 rounded-full text-white text-base tracking-wider font-semibold outline-none bg-transparent hover:bg-gray-50 hover:text-[#333] border-2 border-gray-300 transition-all duration-300">Getting started now</button>
    </div>  
  </div>


    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">

        <div class="bg-white shadow-[0_8px_12px_-6px_rgba(0,0,0,0.2)] border p-2 max-w-sm rounded-lg font-[sans-serif] overflow-hidden mx-auto mt-4">
        <img src="https://readymadeui.com/cardImg.webp" class="w-full rounded-lg" />
        <div class="px-4 my-6 text-center">
            <h3 class="text-lg font-semibold">Heading</h3>
            <p class="mt-2 text-sm text-gray-400">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed auctor auctor arcu, at fermentum dui. Maecenas</p>
            <button type="button" class="px-6 py-2 w-full mt-4 rounded-lg text-white text-sm tracking-wider font-semibold border-none outline-none bg-blue-600 hover:bg-blue-700 active:bg-blue-600">View</button>
        </div>
        </div>
        
        <div class="bg-white shadow-[0_8px_12px_-6px_rgba(0,0,0,0.2)] border p-2 max-w-sm rounded-lg font-[sans-serif] overflow-hidden mx-auto mt-4">
            <img src="https://readymadeui.com/cardImg.webp" class="w-full rounded-lg" />
            <div class="px-4 my-6 text-center">
            <h3 class="text-lg font-semibold">Heading</h3>
            <p class="mt-2 text-sm text-gray-400">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed auctor auctor arcu, at fermentum dui. Maecenas</p>
            <button type="button" class="px-6 py-2 w-full mt-4 rounded-lg text-white text-sm tracking-wider font-semibold border-none outline-none bg-blue-600 hover:bg-blue-700 active:bg-blue-600">View</button>
            </div>
        </div>

    </div>

@endsection