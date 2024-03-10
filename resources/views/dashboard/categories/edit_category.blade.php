@extends('layouts.dashboard')
@section('content')
    <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <h6>Categories</h6>
                    </div>
                    
                    <div class="flex-auto px-0 pt-0 pb-2">
                        <form action="{{route('dashboard.categories.update',$category->id)}}" method="POST" class="w-full max-w-lg">
                            @csrf
                            @method('PUT')
                            <div class="flex flex-wrap -mx-3 mb-6">
                              <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                    Name 
                                </label>
                                <input value="{{$category->name}}" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" name="name" type="text" placeholder="Name of category">
                              </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-6">
                              <div class="w-full px-3">
                                <button type="submit" class="px-6 py-2.5 rounded-full text-white text-sm tracking-wider font-semibold border-none outline-none bg-green-600 hover:bg-green-700 active:bg-green-600">Update</button>
                              </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection