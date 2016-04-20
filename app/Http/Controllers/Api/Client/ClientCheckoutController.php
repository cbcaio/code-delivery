<?php

namespace CodeDelivery\Http\Controllers\Api\Client;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\Contracts\OrderRepository;
use CodeDelivery\Repositories\Contracts\UserRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ClientCheckoutController extends Controller
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
     * @var OrderService
     */
    private $orderService;

    public function __construct(
        OrderRepository $orderRepository,
        OrderService $orderService,
        UserRepository $userRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->orderService    = $orderService;
        $this->userRepository  = $userRepository;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $authenticated_id = Authorizer::getResourceOwnerId();
        $clientId         = $this->userRepository->find($authenticated_id)->client->id;
        $orders           = $this->orderRepository->with(['items'])->scopeQuery(function ($query) use ($clientId) {
            return $query->where('client_id', '=', $clientId);
        })->paginate();

        return $orders;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $authenticated_id             = Authorizer::getResourceOwnerId();
        $data                         = $request->all();
        $clientId                     = $this->userRepository->find($authenticated_id)->client->id;
        $data['client_id']            = $clientId;
        $created_order                = $this->orderService->create($data);
        $creater_order_with_relations = $this->orderRepository->with(['items'])->find($created_order->id);

        return $creater_order_with_relations;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $order = $this->orderRepository->with(['client', 'items.product', 'cupom'])->find($id);

        return $order;
    }

}
