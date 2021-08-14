@extends('layouts.app')

{{-- @foreach ($cars as $car)
    {{ $car->name }}
@endforeach --}}

@section('content')
    <div class="m-auto w-4/5 py-24">

        <div class="text-center">
            <h1 class="text-5xl text-black uppercase bold">
                Cars
            </h1>
        </div>

        @if (Auth::user())
            <div class="pt-10">
                <a href="cars/create" class="border-b-2 border-dotted italic text-black">
                    Add a new Car &rArr;
                </a>
            </div>
            {{-- @else
            <p class="py-12 italic">
                Please login to add a new Car!
            </p> --}}
        @endif



        <div class="w-5/6 py-10">
            @foreach ($cars as $car)
                <div class="m-auto">

                    {{-- @if (isset(Auth::user()->id) && Auth::user()->id == $car->user_id) --}}
                    @if(Auth::user())
                        <div class="float-right">
                            <a class="border-b-2 border-dotted italic text-green-500" href="cars/{{ $car->id }}/edit">Edit &rarr;</a>

                            <form action="cars/{{ $car->id }}" method="post" class="pt-6">
                                @csrf
                                @method('delete')
                                <button type="submit" class="border-b-2 border-dotted italic text-red-500">Delete &larr;</button>
                            </form>
                        </div>
                    @endif



                <span class="uppercase text-green-500 font-bold text-xs italic">
                    Founded: {{ $car->founded }}
                </span>

                <h2 class="text-black text-5xl py-4">
                    <a href="cars/{{ $car->id }}">
                        {{ $car->name }}
                    </a>
                </h2>

                {{-- <div>
                    <span class=" text-black-500 font-bold text-l italic">
                        @forelse ($car->carModels as $model)
                             Model: {{ $model->model_name }} |
                        @empty
                        No Car Model
                        @endforelse

                </span>


                    <span class="uppercase text-black-500 font-bold text-l italic pl-10">
                        @foreach ($car->engines as $engine)
                                    @if ($model->id == $engine->model_id)
                                    Engine: {{ $engine->engine_name }} |
                                    @endif
                        @endforeach
                </span>
                </div> --}}
                <div>
                    <img src="{{ asset('images/'. $car->image_path) }}" alt="" class="w-6/12 mb-8 shadow-xl">
                    <p class="text-lg text-green-700 py-4">
                        {{ \Illuminate\Support\Str::limit($car->description, 300, '...') }}
                            @if (strlen(strip_tags($car->description )) > 300)<br>
                               <a href="/cars/{{ $car->id }}" class="italic bold text-black">Read More</a>
                            @endif
                                        {{-- {{ $car->description }}                 --}}
                    </p>
                </div>


                <hr class="mt-4 mb-8 py-4">
            </div>

            @endforeach
        </div>
           {{ $cars->links() }}
    </div>

@endsection

