<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;
use App\Rules\Uppercase;
use App\Models\Product;
use App\Http\Requests\CreatValidationRequest;
use Illuminate\Support\Facades\File;


class CarsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$cars = Car::all();
        //$cars = json_decode($cars);
            //var_dump($cars);

        // return view('cars.index', [
        //     'cars' => $cars
        // ]);
        $cars = Car::simplePaginate(4);
        return view('cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //public function store(CreatValidationRequest $request)
    public function store(Request $request)
    {


        $request->validate([
            'name'=>'required|unique:cars',
            'founded'=>'required|integer|min:0|max:2022',
            'description'=>'required',
            'image' => 'required|mimes:png,jpg,jpeg,svg|max:5048'
        ]);


        $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $newImageName);

        $request->image_path = $newImageName;


        $car = Car::create([
            'name' => $request->input('name'),
                'founded' => $request->input('founded'),
                'description' => $request->input('description'),
                'image_path' => $newImageName,
                'user_id'=>auth()->user()->id
                // 'model_name' => $request->input('model_name'),
                // 'engine_name' => $request->input('engine_name')
        ]);


        $car->save();
        return redirect('/cars');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Car::find($id);

        return view('cars.show')->with('car', $car);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Car::find($id);
        return view('cars.edit')->with('car', $car);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

       // $request->validated();

        // $car = Car::where('id', $id)->update([

        //     'name' => $request->input('name'),
        //     'founded' => $request->input('founded'),
        //     'description' => $request->input('description'),
        //     'user_id'=>auth()->user()->id
        // ]);

        // if($request->hasFile('image_path')){

        //     $destination = public_path('images').$car->image_path;
        //     if(FILE::exists($destination)){
        //         FILE::delete();
        //     }
        //     $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();
        //     $request->image->move(public_path('images'), $newImageName);

        // }

            $car= Car::find($id);
            $car->name = $request->input('name');
            $car->founded = $request->input('founded');
            $car->description = $request->input('description');
            $car->user_id = auth()->user()->id;


            if($request->hasFile('image')){
                $destination = public_path('images').$car->image_path;
                if(File::exists($destination)){
                    File::delete($destination);
                }

                $file = $request->file('image');
                $extension =$file->extension();
                $newImageName = time().'-'.$extension;
                $file->move(public_path('images'), $newImageName);
                $car->image_path = $newImageName;

        } else{
            unset($car->image_path);
        }

        $car->update();
        return redirect('/cars')->with('success','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();

        return redirect('/cars');
    }
}
