<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Фильтрация
        $query = Product::query();

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('in_stock')) {
            $query->whereHas('stock', function ($q) use ($request) {
                $q->where('id', $request->in_stock)->where('count', '>', 0);
            });
        }

        if ($request->has('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->has('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        if ($request->has('characteristic_key') && $request->has('characteristic_value')) {
            $query->whereHas('characteristick', function ($q) use ($request) {
                $q->where('name', $request->characteristic_key)->where('value', $request->characteristic_value);
            });
        }

        // Сортировка
        if ($request->has('sort_by')) {
            $query->orderBy($request->sort_by, $request->get('sort_order', 'asc'));
        }

        // Пагинация
        $perPage = $request->get('per_page', 14);
        $products = $query->paginate($perPage);

        // Получение только конкретных полей
        $fields = $request->get('fields', null);

        // Трансформация ресурсов
        return ProductResource::collection($products)->additional(['fields' => $fields]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'category_id'=>'required|int'
        ]);
        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/product/images');
            $image->move($destinationPath, $name);
        }
        $yes = Product::where('name', $validate['name'])->first();
        if ($yes) {
            return response()->json(['message' => 'product already exist']);
        }
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->image = $name;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->save();
        return response()->json([
            'status' => true,
            'message' => 'Product created successfully',
            'Product' => $product,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return new productResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
