<?php

namespace App\Jobs;

use App\Models\SystemOld\ChipSystemOld;
use App\Models\SystemOld\UserSystemOld;
use Illuminate\Bus\Batch;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class StartAuditorOfChipsActivesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 6000;

    public $failOnTimeout = false;

    private array $iccids;

    public function __construct(array $iccids)
    {
        $this->iccids = $iccids;
    }
    public function handle()
    {
        $chips = ChipSystemOld::whereIn("chip_iccid", $this->iccids)
            ->with("linha")
            ->with(["pedidos" => function($pedidos) {
                $pedidos->where("pedido_tipo", 0)->with("user");
            }])
            ->get();

        $batches = [];

        foreach ($chips as $chip) {
//            $now = now()->format("Y-m-d");
//            $queryString = "SELECT COUNT(*) AS contador FROM pedido INNER JOIN user ";
//            $queryString .= "ON user_id = pedido_id_user WHERE pedido_tipo IN(1,2) AND pedido_status = '0' ";
//            $queryString .= "AND user.user_id = '" . $user . "' ";
//            $queryString .= "AND pedido_data_vencimento BETWEEN '2010-01-01' AND '" . $now . "' ";
//            $queryString .= "GROUP BY pedido_id_user";
//            $query = DB::connection("system_old")->select($queryString);
//            return isset($query) && !empty($query)  ? $query[0]->contador : null;
//            dd($query);
            $batches[] = new CalcBillingsInOpen($chip);
        }

        $batch = Bus::batch($batches)->then(function (Batch $batch) {
            Log::info("Job finalizado... Batch id: {$batch->id}");
        })->catch(function (Batch $batch, Throwable $e) {
            Log::error("Erro ao executar batch... Erro: {$e->getMessage()}");
        })->finally(function (Batch $batch) {
            Log::info("Batch finalizado... Batch id: {$batch->id}");
        })->dispatch();

        return $batch->id;
    }


}
