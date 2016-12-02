<?php

namespace App\Http\Controllers;

use App\Managers\ProductManager;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductController extends Controller
{
    /**
     * @var ProductRepository
     */
    private $products;
    /**
     * @var ProductManager
     */
    private $manager;

    /**
     * ProductController constructor.
     * @param ProductRepository $products
     * @param ProductManager $manager
     */
    public function __construct(
        ProductRepository $products,
        ProductManager $manager
    )
    {
        $this->products = $products;
        $this->manager = $manager;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = $this->products->all();

        return view('product.index', [
            'products' => $products
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function table()
    {
        $products = $this->products->all();

        return view('product.content', [
            'products' => $products
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $product = new Product($request->all());

        $this->manager->save($product);

        return new JsonResponse([
            "status" => 1,
            "route" => route('products.content'),
        ]);
    }


    public function edit($product_id, Request $request)
    {
        $product = $this->products->find($product_id);

        return view('product.edit', [
            "product"  => $product,
        ]);
    }

    /**
     * @param Product $product
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $product = $this->products->find($request->get("id"));
        $product->name = $request->get("name");
        $product->quantity = $request->get("quantity");
        $product->price = $request->get("price");

        $this->manager->save($product);

        return new JsonResponse([
            "status" => 1,
            "route" => route('products.content'),
        ]);
    }
}
