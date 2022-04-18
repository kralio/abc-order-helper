<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Contracts\Services\OrderOrganizer;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class StockController extends Controller
{
    protected const MARGIN_RATIO = 1.3;

    protected const DEFAULT_PRODUCT = 'Левый носок';

    public function getProductInfo(Request $request, OrderOrganizer $orderOrganizer)
    {
        $errors = $this->getValidationErrors($request);
        if (! empty($errors)) {
            return $this->showPage(null, ['errors' => $errors]);
        }

        $currentDate = new Carbon($request->input('date'));

        try {
            $productToOrder = $orderOrganizer->getQuantityForOrderOnDate($currentDate);
        } catch (\Throwable $e) {
            return $this->showPage($currentDate, ['errors' => [
                'Не удалось просчитать количество товара для заказа. Попробуйте более ранние даты',
            ]]);
        }

        $stock = $this->getStockForDate($currentDate);

        return $this->showPage($currentDate, [
            'productPrice' => round(self::MARGIN_RATIO * ($stock->avg_price ?? 0), 2),
            'productTotal' => $stock->total ?? 0,
            'productToOrder' => $productToOrder
        ]);
    }

    protected function showPage(?Carbon $date, array $params)
    {
        if ($date) {
            $params['date'] = $date->format('Y-m-d');
        }

        return view('stock', $params);
    }

    protected function getValidationErrors(Request $request): array
    {
        $startDate = app(OrderOrganizer::class)->getOrderStartDate()->format('Y-m-d');

        $validator = $this->getValidationFactory()->make(
            $request->all(),
            [
                'date' => ['date', "after_or_equal:$startDate"],
            ]
        );

        return $validator->fails()
            ? $validator->errors()->getMessages()['date'] ?? []
            : [];
    }

    protected function getStockForDate(Carbon $date): ?Stock
    {
        return Stock::where('date', $date->format('Y-m-d'))
            ->where('name', self::DEFAULT_PRODUCT)
            ->first();
    }
}
