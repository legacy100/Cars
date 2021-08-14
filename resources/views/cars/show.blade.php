@extends('layouts.app')

@section('content')
<div class="float-left m-auto w-4/5 py-5 pl-10">
            <a class="border-b-2 border-dotted italic text-black" href="/cars">Go Back to Cars &larr;</a>


        </div>
    <div class="m-auto w-4/5 py-24">

        <div class="text-center">

            <h1 class="text-5xl uppercase text-black bold">
                {{ $car->name }}
            </h1>
        </div>


        <a class="border-b-2 border-dotted italic text-green-500 float-right" href="{{ $car->id }}/edit">Edit &rarr;</a>

         <div class="text-center py-10">
            <div class="m-auto">
                <img src="{{ asset('images/'. $car->image_path) }}" alt="" class="w-6/12 mb-8 mt-9 shadow-xl float-right">
                <span class="uppercase text-green-500 font-bold text-xs italic">
                    Founded: {{ $car->founded }}
                </span>

                <p class="text-lg text-black py-4 pt-6 pb-10">
                    {{ $car->description }}
                </p>

                {{-- <ul>
                    <p class="text-lg text-gray-700 py-3">
                        Models:
                    </p> --}}

                    {{-- @forelse ($car->carModels as $model)
                        <li class="inline italic text-gray-600 px-1 py-6">
                            {{ $model['model_name'] }}
                        </li>
                    @empty
                        <p>
                            No Models Found
                        </p>
                    @endforelse
                </ul> --}}
                <table class="table-auto pt-10 mt-10">
                    <tr>
                         <th class="w-1/4 border-4 border-green-200 text-black">
                        Model
                    </th>
                    <th class="w-1/4 border-4 border-green-200 text-black">
                        Engines
                    </th>
                    <th class="w-1/4 border-4 border-green-200 text-black">
                        Production Date
                    </th>
                    </tr>

                    @forelse ($car->carModels as $model)
                        <tr>
                            <td class="border-4 border-gray-500">
                                {{ $model->model_name }}
                            </td>

                            <td class="border-4 border-gray-500">
                                @foreach ($car->engines as $engine)
                                    @if ($model->id == $engine->model_id)
                                        {{ $engine->engine_name }}
                                    @endif
                                @endforeach
                            </td>

                            <td class="border-4 border-gray-500">
                                {{ date('d-m-Y', strtotime($car->productionDate->created_at)) }}
                            </td>
                        </tr>
                    @empty
                    <p class="italic text-black">
                        No Model and Engine Available
                    </p>

                    @endforelse

                </table>


                {{-- <p class="text-left">
                    Products Types:
                    @forelse ($car->products as $product)
                        {{ $product->name }}
                    @empty
                        <p>
                            No Product Type
                        </p>
                    @endforelse

                </p> --}}
                <hr class="mt-4 mb-8 py-4 pt-10">
            </=>
         </div>
    </div>
@endsection
