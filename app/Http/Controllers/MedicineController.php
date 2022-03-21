<?php

namespace App\Http\Controllers;

use App\Medicine;
use Illuminate\Http\Request;
use DB;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // echo "ni hao!";
        // Raw Query
        // $result = DB::select(DB::raw("select * from medicines"));

        // Query Builder
        // $result = DB::table("medicines")->get();

        // Eloquent Model (karna pake eloquent di model bisa auto ke detect anak tablenya maka harus pake eloquent biar bisa tau anaknya)
        $result = Medicine::all();

        # Untuk testing hasil datanya
        // dd($result);

        // Cara View 1
        // return view('medicine.index', compact('result'));

        // Cara View 2
        return view('medicine.index', ["data"=>$result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function show(Medicine $medicine)
    {
        // dd($medicine);
        $data = $medicine;
        return view("medicine.show", compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicine $medicine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicine $medicine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicine $medicine)
    {
        //
    }

    public function coba1(){
        //Filter 
        $result = DB::table('medicines')
            ->where("price",">",20000)
            ->get();

        $result = DB::table('medicines')
            ->where("generic_name","like","%fen")
            ->get();
        
        // Group By
        $result = DB::table('medicines')
            ->select("generic_name")
            ->groupBy("generic_name")
            ->get();

        // Aggregate
        $result = DB::table('medicines')->count();

        $result = DB::table('medicines')->max('price');

        // Filter + Aggregate
        $result = DB::table('medicines')
            ->where("generic_name","like","%fen")
            ->avg('price');

        // Join + sort
        $result=DB::table('medicines')
            ->join('categories', 'medicines.category_id', '=', 'categories.id')
            ->orderBy('price','desc')
            ->get();

        //Eloquent
        $result=Medicine::where("price", ">=", 20000);

        $result=Medicine::find(3);

        dd($result);
    }

    public function coba2(){
        // ========================================================================
        // QUERY TABLE 1
        // ========================================================================

        // 1. Show all drug category data
        // ------------------ Di Category ------------------

        // 2. Show all medicines name, formulas, and prices
        # Eloquent
        $result = Medicine::select('generic_name', 'form', 'price')
            ->get();
        
        # Query Builder
        $result = DB::table('medicines')
            ->select('generic_name', 'form', 'price')
            ->get();

        # Raw Query
        $result = DB::select('select generic_name, form, price from medicines');
        
        // ========================================================================
        // QUERY INNER JOIN 2 TABLES
        // ========================================================================

        // 1. Show all medicines name, formula, and category name
        // Eloquent
        $result = Medicine::select('generic_name','form','price', 'category_id')
            ->with(['category' => function ($query){
                $query->select('id', 'name');
            }])->get();

        // Query Builder
        $result = DB::table('medicines')
            ->join('categories', 'categories.id', '=', 'medicines.category_id')
            ->select('generic_name', 'form', 'price', 'categories.name')
            ->get();

        // Raw Query
        $result = DB::select("select m.generic_name, m.form, m.price, c.name from medicines m inner join categories c on m.category_id = c.id");

        // ========================================================================
        // THERE IS AN AGGREGATION OF SUM, COUNT WITH 2 TABLES
        // ========================================================================

        // 1. Display of the number of categories that have data on medicines
        // Eloquent
        $result = Medicine::distinct('category_id')
            ->count();

        // Query Builder
        $result = DB::table('medicines')
            ->distinct('category_id')
            ->count();

        // Raw Query
        $result = DB::select("select count(distinct category_id) from medicines");

        // 2. Show the name of the category that does not have any medicines data
        // ------------------ Di Category ------------------

        // 3. Show the average price of each drug category. If there is no medicine then give 0
        // ------------------ Di Category ------------------

        // 4. Show drug categories that have only 1 medicine product
        // ------------------ Di Category ------------------

        // 5. Show drugs that have one form
        // Eloquent
        $result = Medicine::select('generic_name')
            ->groupBy('generic_name')
            ->havingRaw('count(medicines.id) = 1')
            ->get();
        
        // Query Builder
        $result = DB::table('medicines')
            ->select('generic_name')
            ->groupBy('generic_name')
            ->havingRaw('COUNT(medicines.id) = 1')
            ->get();
        
        // Raw Query
        $result = DB::select('select generic_name from medicines group by generic_name having count(id) = 1');

        // 6. Display the category and name of the drug that has the highest price
        // Eloquent
        $result = Medicine::select('generic_name', 'form', 'price', 'category_id')
            ->with(['category' => function ($query){
                $query->select('id', 'name');
            }])->where('price', Medicine::max('price'))
            ->get();

        // Query Builder
        $result = DB::table('medicines')
            ->select('categories.name', 'medicines.generic_name', 'medicines.form')
            ->join('categories', 'medicines.category_id', '=', 'categories.id')
            ->where('price', DB::table('medicines')->max('price'))
            ->get();
                
        // Raw Query
        $result = DB::select('select * from medicines m inner join categories c on m.category_id = c.id where m.price = (select max(price) from medicines)');

        dd($result);
    }
}
