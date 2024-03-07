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
<div class="w-full min-h-screen flex justify-center items-center">
    <form method="POST" enctype="multipart/form-data" action="{{ route('event.update',$event->id) }}"
        class="w-96 p-6 shadow-lg max-w-96 rounded-md border border-gray-100 mx-auto">
        @csrf
        @method('PUT')

        <div class="mb-5">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                title</label>
            <input type="title" value="{{$event->title}}" id="title" name="title"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required />


            @error('title')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Description</label>
            <input type="text" value="{{$event->description}}" id="description" name="description"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required />
            @error('description')
                <p>{{ $message }}</p>
            @enderror
        </div>


        <div class="mb-5">
            <label for="place" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                place</label>
            <input type="text" value="{{$event->place}}" id="place" name="place"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required />
            @error('place')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                price</label>
            <input type="number" value="{{$event->price}}" id="price" name="price"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required />
            @error('price')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label for="duration" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                duration</label>
            <input type="number" value="{{$event->duration}}" id="duration" name="duration"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required />
            @error('duration')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label for="acceptance" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                acceptance</label>
            <select id="acceptance" name="acceptance"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option @if($event->acceptance=='auto') selected @endif  value="auto">Automatic</option>
                <option @if($event->acceptance=='manual') selected @endif value="manual">Manual</option>
            </select>

            @error('acceptance')
                <p>{{ $message }}</p>
            @enderror

        </div>

        <div class="mb-5">
            <label for="nbr_place" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Nombre place</label>
            <input type="number" value="{{$event->nbr_place}}" id="nbr_place" name="nbr_place"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required />

            @error('nbr_place')
                <p>{{ $message }}</p>
            @enderror
        </div>


        <div class="mb-5">
            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Event Header Image</label>
            <input type="file" id="image" name="image" value="{{ old('image') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>

            @error('image')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label for="date_event" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Date event</label>
            <input type="date" value="{{$event->date_event}}" min="@php echo date('Y-m-d');@endphp" id="date_event" name="date_event"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required />

            @error('date_event')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Category</label>
            <select id="category" name="category_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                @foreach ($categories as $item)
                    <option  @if($event->category_id==$item->id) selected @endif value={{ $item->id }}>{{ $item->name }}</option>
                @endforeach

            </select>

            @error('category_id')
                <p>{{ $message }}</p>
            @enderror
        </div>


        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>
</div>

@endsection