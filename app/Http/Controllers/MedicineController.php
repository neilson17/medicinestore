<?php

namespace App\Http\Controllers;

use App\Medicine;
use App\Category;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\File; 

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
        $datacategory = Category::all();
        $data = Medicine::all();

        # Untuk testing hasil datanya
        // dd($result);

        // Cara View 1
        // return view('medicine.index', compact('result'));

        // Cara View 2
        return view('medicine.index', compact('data', 'datacategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('medicine.create', ["datacategory"=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Medicine();
        $data->generic_name = $request->get('generic_name');
        $data->form = $request->get('form');
        $data->restriction_formula = $request->get('restriction_formula');
        $data->price = $request->get('price');
        $data->description = $request->get('description');
        $data->category_id = $request->get('category');
        $data->faskes1 = ($request->get('faskes1') == "on") ? 1 : 0;
        $data->faskes2 = ($request->get('faskes2') == "on") ? 1 : 0;
        $data->faskes3 = ($request->get('faskes3') == "on") ? 1 : 0;

        // Save Image
        $file=$request->file('image');
        $imgFolder='images';
        $imgFile= strtolower(str_replace(' ', '', ($data->generic_name.$data->form))).'.'.$file->getClientOriginalExtension();
        $file->move($imgFolder, $imgFile);
        $data->image=$imgFile;

        $data->save();
        return redirect()->route('medicines.index')->with('status', 'Data baru berhasil tersimpan');
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
        // dd($medicine);
        $data = $medicine;
        $categories = Category::all();
        return view("medicine.edit", compact('data', 'categories'));
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
        $medicine->generic_name = $request->get('generic_name');
        $medicine->form = $request->get('form');
        $medicine->restriction_formula = $request->get('restriction_formula');
        $medicine->price = $request->get('price');
        $medicine->description = $request->get('description');
        $medicine->category_id = $request->get('category');
        $medicine->faskes1 = ($request->get('faskes1') == "on") ? 1 : 0;
        $medicine->faskes2 = ($request->get('faskes2') == "on") ? 1 : 0;
        $medicine->faskes3 = ($request->get('faskes3') == "on") ? 1 : 0;
        if ($request->hasFile('image')) {
            File::delete($medicine->image);
            $file = $request->file('image');
            $imgFolder = "images";
            $imgFile = strtolower(str_replace(' ', '', ($medicine->generic_name.$medicine->form))).'.'.$file->getClientOriginalExtension();
            $file->move($imgFolder, $imgFile);
            $medicine->image = $imgFile;
        }
        $medicine->save();

        return redirect()->route('medicines.index')->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicine $medicine)
    {
        try{
            // Untuk proses langsung delete tanpa menghapus data medicine di many to many
            // $medicine->delete();

            // Untuk proses delete many to many dari medicines dan transactions harus di detach terlebih dahulu agar tidak error. Karena medicine bisa saja ada di tabel many to many antara medicine dan transactions sehingga tidak bisa langsung dihapus.
            // Detach akan menghapus data di tabel many to many.
            $medicine->transactions()->detach();
            $medicine->delete();

            return redirect()->route('medicines.index')->with('status', 'Data berhasil dihapus');
        }
        catch(\PDOException $e)
        {
            $msg = 'Data gagal dihapus'. $e;
            return redirect()->route('medicines.index')->with('status', $msg);
        }
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
 
    public function showInfo(){
        $result = Medicine::orderBy('price', 'desc')->first();

        return response()->json(array(
        'status'=>'oke',
        'msg'=>"<div class='alert alert-info'>
                Did you know? <br>Harga obat termahal adalah ".$result->generic_name." ".$result->form." dengan harga ".$result->price."</div>"
        ),200);
    }

    public function getEditForm(Request $request){
        $id = $request->get('id');
        $data = Medicine::find($id);
        $categories = Category::all();
        return response()->json(array(
            'status'=> 'ok',
            'msg' =>view('medicine.getEditForm', compact('data', 'categories'))->render()
        ), 200);
    }

    public function getEditForm2(Request $request){
        $id = $request->get('id');
        $data = Medicine::find($id);
        $categories = Category::all();
        return response()->json(array(
            'status'=> 'ok',
            'msg' =>view('medicine.getEditForm2', compact('data', 'categories'))->render()
        ), 200);
    }

    public function deleteData(Request $request){
        $id = $request->get('id');
        $medicine = Medicine::find($id);
        $medicine->transactions()->detach();
        $medicine->delete();
        return response()->json(array(
            'status'=> 'ok',
            'msg' => 'berhasil menghapus data'
        ), 200);
    }

    public function saveData(Request $request) {
        $id = $request->get('id');
        $medicine = Medicine::find($id);
        $medicine->generic_name = $request->get('generic_name');
        $medicine->form = $request->get('form');
        $medicine->restriction_formula = $request->get('restriction_formula');
        $medicine->price = $request->get('price');
        $medicine->description = $request->get('description');
        $medicine->category_id = $request->get('category_id');
        $medicine->faskes1 = $request->get('faskes1');
        $medicine->faskes2 = $request->get('faskes2');
        $medicine->faskes3 = $request->get('faskes3');
        $medicine->save();

        return response()->json(array(
            'status' => 'ok',
            'msg' => 'Berhasil mengubah data',
        ), 200);
    }
}
