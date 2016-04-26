<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\CheckoutRequest;
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

    /**
     * @param OrderRepository   $orderRepository
     * @param UserRepository    $userRepository
     * @param ProductRepository $productRepository
     * @param OrderService      $service
     */
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $clientId = $this->userRepository->find(Auth::user()->id)->client->id;
        $orders   = $this->orderRepository->scopeQuery(function ($query) use ($clientId)
        {
            return $query->where('client_id', '=', $clientId);
        })->paginate();

        return view('customer.order.index', compact('orders'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $products = $this->productRepository->all([
            'id',
            'name',
            'price'
        ]);

        return view('customer.order.create', compact('products'));
    }

    /**
     * @param CheckoutRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(CheckoutRequest $request)
    {
        $data              = $request->all();
        $clientId          = $this->userRepository->find(Auth::user()->id)->client->id;
        $data['client_id'] = $clientId;
        $this->service->create($data);

        return redirect()->route('customer.order.index');
    }

}
