<?php

namespace CodeDelivery\Http\Controllers\Api\Deliveryman;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\Contracts\OrderRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class DeliverymanCheckoutController extends Controller
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var OrderService
     */
    private $orderService;

    private $withIncludes = [
        'client',
        'cupom',
        'items'
    ];

    /**
     * @param OrderRepository $orderRepository
     * @param OrderService    $orderService
     */
    public function __construct(OrderRepository $orderRepository, OrderService $orderService)
    {
        $this->orderRepository = $orderRepository;
        $this->orderService    = $orderService;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $authenticated_id = Authorizer::getResourceOwnerId();

        $orders = $this->orderRepository
            ->skipPresenter(false)
            ->with($this->withIncludes)
            ->scopeQuery(function ($query) use ($authenticated_id) {
                return $query->where('user_deliveryman_id', '=', $authenticated_id);
            })
            ->paginate();

        return $orders;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $authenticated_id = Authorizer::getResourceOwnerId();

        return $this->orderRepository
            ->skipPresenter(false)
            ->getByIdAndDeliveryman($id, $authenticated_id);
    }

    /**
     * @param Request $request
     * @param         $orderId
     * @return bool|\CodeDelivery\Models\Order
     */
    public function updateStatus(Request $request, $orderId)
    {
        $idDeliveyman = Authorizer::getResourceOwnerId();
        $order        = $this->orderService->updateStatus($orderId, $idDeliveyman, $request->get('status'));

        if ($order) {
            return $this->orderRepository->find($order->id);
        }

        abort(400, "Order não encontrada");
    }

}
