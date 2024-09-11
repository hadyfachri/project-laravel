<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class PaymentRepository.
 */
class PaymentRepository
{
    protected $model;
    protected $order;

    public function __construct(Payment $payment, Order $order)
    {
        $this->model = $payment;
        $this->order = $order;
    }

    public function getAll()
    {
        return $this->model->get();
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create($request)
    {

        return $this->model->create([
            'order_id' => $request->order_id,
            'amount' => $this->model->order->total_price,
            'payment_method' => $request->payment_method ?: 'pending',
            'status' => $request->status,
            'transaction_date' => Carbon::now(),
        ]);

        if($this->model->status != 'pending')
        {
            $this->order->update([
                'status' => 'shipping'
            ]);
        }
    }

    public function update($request, $id)
    {
        $payment = $this->model;
        return $payment->findOrfail($id)->update([
            'order_id' => $request->order_id ?? $payment->order_id,
            'amount' => $request->amount ?? $payment->amount,
            'payment_method' => $request->payment_method ?? $payment->payment_method,
            'status' => $request->status ?? $payment->status,
        ]);
        
    }

    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }
}
