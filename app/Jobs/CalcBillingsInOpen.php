<?php

namespace App\Jobs;

use App\Models\SystemOld\AuditorOfChipActiveSystemOld;
use App\Models\SystemOld\UserSystemOld;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class CalcBillingsInOpen implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


   protected $chip;

    public function __construct($chip)
    {
        $this->chip = $chip;
    }


    public function handle()
    {
        AuditorOfChipActiveSystemOld::create([
            "order_id"              =>$this->chip->pedidos->first()->pedido_id ?? null,
            "amount_billings"       => isset($this->chip->pedidos->first()->pedido_id_user) ?
                $this->calcBillingsInOpen($this->chip->pedidos->first()->user) : null,
            "user_name"             => $this->chip->pedidos->first()->user->user_nome ?? null,
            "chip_number"           => $this->chip->chip_iccid,
            "line_number"           => $this->chip->linha->num ?? null,
        ]);

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
