<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\Contracts\OrderRepository;
use CodeDelivery\Repositories\Contracts\ProductRepository;
use CodeDelivery\Repositories\Contracts\UserRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var OrderService
     */
    private $service;

    public function __construct(
        OrderRepository $orderRepository,
        UserRepository $userRepository,
        ProductRepository $productRepository,
        OrderService $service
    )
    {
        $this->orderRepository   = $orderRepository;
        $this->userRepository    = $userRepository;
        $this->productRepository = $productRepository;
        $this->service           = $service;
    }

    public function index()
    {
        $clientId = $this->userRepository->find(Auth::user()->id)->client->id;
        $orders   = $this->orderRepository->scopeQuery(function ($query) use ($clientId)
        {
            return $query->where('client_id', '=', $clientId);
        })->paginate();

        return view('customer.order.index', compact('orders'));
    }


    public function create()
    {
        dd('checkout ctrl create');
        $products = $this->productRepository->lists();
        return view('customer.order.create', compact('products'));
    }

    public function store(Request $request)
    {
        $data              = $request->all();
        $clientId          = $this->userRepository->find(Auth::user()->id)->client->id;
        $data['client_id'] = $clientId;
        $this->service->create($data);

        return redirect()->route('customer.order.index');
    }

}
