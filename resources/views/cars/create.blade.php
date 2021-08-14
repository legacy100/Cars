@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/6 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase bold text-black">
                Create Cars
            </h1>
        </div>

        <div class="flex justify-center pt-20">
            <form action="/cars" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="block">
                    <input type="text" class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400" name="name" placeholder="Brand name...">

                    <input type="text" class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400" name="founded" placeholder="Founded...">

                    {{-- <input type="text" class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400" name="model_name" placeholder="Model...">

                    <input type="text" class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400" name="engine_name" placeholder="Engine Number..."> --}}

                    <input type="text" class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400" name="description" placeholder="Description...">

                    <input type="file" class="block text-gray-500 shadow-5xl mb-10 p-2 w-80 italic" name="image">

                    <button type="submit" class="bg-green-500 block shadow-5xl mb-10 p-2 w-80 uppercase font-bold">Add a Car</button>
                </div>
           
            </form>
       
        </div> 
              @if ($errors->any())
            <div class="w-4/8 m-auto text-center">
                @foreach ($errors->all() as $error)
                    <li class="text-red-600 list-none">
                        {{ $error }}
                    </li>
                @endforeach
            </div>
        @endif   
    </div>
@endsection
