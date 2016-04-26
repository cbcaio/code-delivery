<?php

namespace CodeDelivery\Http\Controllers\Api\Client;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Http\Requests\CheckoutRequest;
use CodeDelivery\Repositories\Contracts\OrderRepository;
use CodeDelivery\Repositories\Contracts\UserRepository;
use CodeDelivery\Services\OrderService;
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

    private $withIncludes = [
        'client',
        'cupom',
        'items'
    ];

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
        $orders           = $this->orderRepository
            ->skipPresenter(false)
            ->with($this->withIncludes)
            ->scopeQuery(function ($query) use ($clientId) {
                return $query->where('client_id', '=', $clientId);
            })
            ->paginate();

        return $orders;
    }

    /**
     * @param CheckoutRequest $request
     * @return mixed
     * @throws \Exception
     */
    public function store(CheckoutRequest $request)
    {
        $authenticated_id  = Authorizer::getResourceOwnerId();
        $data              = $request->all();
        $clientId          = $this->userRepository->find($authenticated_id)->client->id;
        $data['client_id'] = $clientId;
        $created_order     = $this->orderService->create($data);

        return $this->orderRepository
            ->skipPresenter(false)
            ->with($this->withIncludes)
            ->find($created_order->id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->orderRepository
            ->skipPresenter(false)
            ->with($this->withIncludes)
            ->find($id);
    }
}
