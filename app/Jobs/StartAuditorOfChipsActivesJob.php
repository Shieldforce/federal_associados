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
                $pedidos->with("user");
            }])
            ->get();

        $batches = [];

        foreach ($chips as $chip) {
            $batches[] = new AuditorOfChipsActivesJob([
                "order_id"              => $chip->pedidos->first()->pedido_id ?? null,
                "amount_billings"       => isset($chip->pedidos->first()->pedido_id_user) ?
                    $this->calcBillingsInOpen($chip->pedidos->first()->user) : null,
                "user_name"             => $chip->pedidos->first()->user->user_nome ?? null,
                "chip_number"           => $chip->chip_iccid,
                "line_number"           => $chip->linha->num ?? null,
            ]);
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

    private function calcBillingsInOpen(UserSystemOld $user)
    {
        $now = now()->format("Y-m-d");
        $queryString = "SELECT COUNT(*) AS contador FROM pedido INNER JOIN user ";
        $queryString .= "ON user_id = pedido_id_user WHERE pedido_tipo IN(1,2) AND pedido_status = '0' ";
        $queryString .= "AND user.user_id = '{$user->user_id}' ";
        $queryString .= "AND pedido_data_vencimento BETWEEN '2010-01-01' AND '" . $now . "' ";
        $queryString .= "GROUP BY pedido_id_user;";
        $query = DB::connection("system_old")->select($queryString);
        return isset($query[0]) && isset($query[0]->contador) ? $query[0]->contador : null;
    }
}
