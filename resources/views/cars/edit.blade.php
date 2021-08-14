@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/6 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase bold">
                Update Cars
            </h1>
        </div>

        <div class="flex justify-center pt-20">
            <form action="{{ route('cars.update',$car->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="block">
                    <input type="text" class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400" name="name" value="{{ $car->name }}">

                    <input type="text" class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400" name="founded" value="{{ $car->founded }}">

                    <input type="text" class="block shadow-5xl mb-10 p-2 w-80 italic placeholder-gray-400" name="description" value="{{ $car->description }}">

                    <div class="form-group">
                        <input type="file" class="block text-black shadow-5xl mb-10 p-2 w-80 italic"  name="image">
                        <img src="{{ asset('images/'. $car->image_path) }}" alt="" class="w-2/12 mb-8 shadow-xl">
                        {{-- <input type="file" class="block text-black shadow-5xl mb-10 p-2 w-80 italic" value="{{ $car->image_path }}"  name="image"> --}}
                    </div>



                    <button type="submit" class="bg-green-500 block shadow-5xl mb-10 p-2 w-80 uppercase font-bold">Update Car</button>
                </div>
            </form>

        </div>
    </div>
@endsection
