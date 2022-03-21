<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Query Builder
        // $result = DB::table("categories")->get();

        // Eloquent
        $result = Category::all();
        
        return view('category.index', ["data"=>$result]);
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
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    public function showList($id_category){
        $data = Category::find($id_category);
        $name_cat = $data->name;
        $result = $data->medicines;
        if ($result) $getTotalData = $result->count();
        else $getTotalData = 0;

        // dd($result);
        return view('report.list_medicines_by_category', compact('id_category', 'name_cat', 'result', 'getTotalData'));
    }

    public function showHighestPriceMedList(){
        // Raw Query in MySQL for showing medicine with highest price for each category
        // select c.*, m.* from categories c inner join medicines m on c.id=m.category_id where m.price = (select m1.price from medicines m1 where m1.category_id = c.id order by m1.price desc limit 1)

        $categories = DB::table("categories")->get();

        // Show only one medicine with highest price for each categories
        // $result = [];
        // foreach ($categories as $cat) {
        //     $arrmed = DB::table("medicines")->where("medicines.category_id", "=", $cat->id)
        //         ->orderBy("price", "desc")
        //         ->limit(1)
        //         ->get();
        //     array_push($result, ["category"=>$cat, "medicines"=>$arrmed]);
        // }

        // Show all medicine with highest price for each categories
        $result = []; 
        foreach ($categories as $cat) {
            $arrmed = DB::table("medicines")->where("category_id", "=", $cat->id)
                ->where("price", "=", DB::table('medicines')->select(DB::raw('max(price) as price'))
                                        ->where("category_id", "=", $cat->id)->get()[0]->price
                )->get();
            array_push($result, ["category"=>$cat, "medicines"=>$arrmed]);
        }

        return view('report.list_highest_price_medicine_by_category', ["data"=>$result]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }

    public function coba2(){
        // ========================================================================
        // QUERY TABLE 1
        // ========================================================================

        // 1. Show all drug category data
        // Eloquent
        $result = Category::all();

        // Query Builder
        $result = DB::table('categories')->get();

        // Raw Query
        $result = DB::select("select * from categories");

        // 2. Show all medicines name, formulas, and prices
        // ------------------ Di Medicine ------------------

        // ========================================================================
        // QUERY INNER JOIN 2 TABLES
        // ========================================================================

        // 1. Show all medicines name, formula, and category name
        // ------------------ Di Medicine ------------------

        // ========================================================================
        // THERE IS AN AGGREGATION OF SUM, COUNT WITH 2 TABLES
        // ========================================================================

        // 1. Display of the number of categories that have data on medicines
        // Eloquent Method 2
        $result = Category::whereHas('medicines')->count();
        // ------------------ Di Medicine ------------------

        // 2. Show the name of the category that does not have any medicines data
        // Eloquent
        $result = Category::doesnthave('medicines')
            ->get();

        // Query Builder
        $result = DB::table('categories')
            ->whereNotIn('id', function($query){
                $query->select('category_id')->from('medicines')->distinct('category_id');
            })->get();

        $result = DB::table('categories')
            ->whereNotIn('id', 
                DB::table('medicines')
                    ->select('category_id')
                    ->distinct('category_id')
            )->get();

        // Raw Query
        $result = DB::select('select * from categories where id not in (select DISTINCT category_id from medicines)');

        // 3. Show the average price of each drug category. If there is no medicine then give 0
        // Eloquent
        $result = Category::select('categories.id', DB::raw('coalesce(avg(medicines.price), 0) as avgPrice'))
            ->leftJoin('medicines', function ($join){
                $join->on('categories.id', '=', 'medicines.category_id');
            })->groupBy('categories.id')->get();

        // 'strict' -> "false"
        $result = Category::select('categories.name', DB::raw('coalesce(avg(medicines.price), 0) as avgPrice'))
            ->leftJoin('medicines', function ($join){
                $join->on('categories.id', '=', 'medicines.category_id');
            })->groupBy('categories.id')->get();

        // Query Builder
        $result = DB::table('categories')
            ->select('categories.id', DB::raw('coalesce(avg(medicines.price),0) as avgPrice'))
            ->leftJoin('medicines', 'categories.id', '=', 'medicines.category_id')
            ->groupBy('categories.id')
            ->get();
        
        // 'strict' -> "false"
        // $result = DB::table('categories')
        //     ->select('categories.name', DB::raw('coalesce(avg(medicines.price),0) as avgPrice'))
        //     ->leftJoin('medicines', 'categories.id', '=', 'medicines.category_id')
        //     ->groupBy('categories.id')
        //     ->get();

        // Raw Query
        $result = DB::select('select c.id, coalesce(avg(m.price), 0) as avgPrice from categories c left join medicines m on m.category_id = c.id group by c.id');

        // 'strict' -> false
        // $result = DB::select('select c.name, coalesce(avg(m.price), 0) as avgPrice from categories c left join medicines m on m.category_id = c.id group by c.id');

        // 4. Show drug categories that have only 1 medicine product
        // Eloquent
        $result = Category::select('categories.id')
            ->join('medicines', function($join){
                $join->on('categories.id', '=', 'medicines.category_id');
            })->groupBy('categories.id')
            ->havingRaw('count(medicines.id) = 1')
            ->get();
        
        // 'strict' -> false
        // $result = Category::select('categories.id', 'categories.name', 'categories.description')
        //     ->join('medicines', function($join){
        //         $join->on('categories.id', '=', 'medicines.category_id');
        //     })->groupBy('categories.id')
        //     ->havingRaw('count(medicines.id) = 1')
        //     ->get();
        
        // Query Builder
        $result = DB::table('categories')
            ->select('categories.id')
            ->join('medicines', 'categories.id', '=', 'medicines.category_id')
            ->groupBy('categories.id')
            ->havingRaw('COUNT(medicines.id) = 1')
            ->get();
        
        // 'strict' -> false
        // $result = DB::table('categories')
        //     ->select('categories.id', 'categories.name', 'categories.description')
        //     ->join('medicines', 'categories.id', '=', 'medicines.category_id')
        //     ->groupBy('categories.id')
        //     ->havingRaw('COUNT(medicines.id) = 1')
        //     ->get();
        
        // Raw Query
        $result = DB::select('select c.id from categories c inner join medicines m on c.id = m.category_id group by c.id having count(m.id) = 1');

        // 'strict' -> false
        // $result = DB::select('select c.id, c.name, c.description from categories c inner join medicines m on c.id = m.category_id group by c.id having count(m.id) = 1');

        // 5. Show drugs that have one form
        // ------------------ Di Medicine ------------------

        // 6. Display the category and name of the drug that has the highest price
        // ------------------ Di Medicine ------------------
        
        dd($result);
    }
}
