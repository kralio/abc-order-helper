<?php

namespace App\Console\Commands;

use App\Models\{Stock, Supply};
use App\Contracts\Services\OrderOrganizer;

use Illuminate\Console\Command;
use Illuminate\Support\{Carbon, Facades\DB};

class FillStockHistory extends Command
{
    protected $signature = 'service:fill-stock-history';

    protected $description = 'Fill stock history for "Левый носок" supplies (only for empty table)';

    public function handle(OrderOrganizer $orderOrganizer)
    {
        // Если предполагаем, что у нас поставок тысячи - то все не достаем, обрабатываем чанками
        $supplies = Supply::where('name', 'Левый носок')->get()->keyBy('date');
        if ($supplies->isEmpty()) {
            $this->info('There are no supplies');
            return self::SUCCESS;
        }
        $lastSupplyDate = (new Carbon($supplies->max('date')))->format('Y-m-d');

        try {
            DB::beginTransaction();

            // предположим, что и поставки, и заказы для левого носка
            // начинаются с 13 января (ведь так оно и есть в задаче)
            $date = $orderOrganizer->getOrderStartDate()->format('Y-m-d');

            $lastStock = null;
            while ($date <= $lastSupplyDate) {
                $currentDate = new Carbon($date);

                $supply = $supplies->get($date);
                $supplyCost = $supply->cost ?? 0;
                $supplyQuantity = $supply->quantity ?? 0;

                $name = $lastStock->name ?? $supply->name ?? null;
                if ($name) {
                    $lastAvgPrice = $lastStock->avg_price ?? 0;
                    $lastOrdered = $lastStock->ordered ?? 0;
                    $lastTotal = $lastStock->total ?? 0;
                    $availableTotal = max(0, $lastTotal - $lastOrdered);

                    $productsInOrder = $orderOrganizer->getQuantityForOrderOnDate($currentDate);

                    $totalQuantity = $availableTotal + $supplyQuantity;
                    $lastStock = Stock::create([
                        'date' => $date,
                        'name' => $name,
                        'total' => $totalQuantity,
                        'ordered' => $productsInOrder,
                        'avg_price' => $totalQuantity > 0
                            ? ($availableTotal * $lastAvgPrice + $supplyCost) / $totalQuantity
                            : 0,
                    ]);
                    if (! $lastStock->exists) {
                        throw new \Exception("Failed to add stock info on $date");
                    }
                }

                $date = $currentDate->addDay()->format('Y-m-d');
            }

            DB::commit();
            return self::SUCCESS;
        } catch (\Throwable $e) {
            $this->error($e);
            DB::rollBack();
            return self::FAILURE;
        }
    }
}
