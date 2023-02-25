<?php

namespace App\Jobs;

use App\Models\SystemOld\AuditorOfChipActiveSystemOld;
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
                $dados = [
                    "order_id"              => isset($this->chip->pedidos) && !empty($this->chip->pedidos[0]->pedido_id) ? $this->chip->pedidos[0]->pedido_id : null,
                    "amount_billings"       => isset($this->chip->pedidos) && !empty($this->chip->pedidos[0]->user->user_id) ? self::calcBillingsInOpen($this->chip->pedidos[0]->user->user_id) : null,
                    "user_name"             => isset($this->chip->pedidos) && !empty($this->chip->pedidos[0]->user->user_nome) ? $this->chip->pedidos[0]->user->user_nome : null,
                    "chip_number"           => $this->chip->chip_iccid,
                    "line_number"           =>  isset($this->chip->linha) && !empty($this->chip->linha) ? $this->chip->linha->num : null,
                ];

        AuditorOfChipActiveSystemOld::create($dados);

    }


    private function calcBillingsInOpen($user)
    {
        $now = now()->format("Y-m-d");
        $queryString = "SELECT COUNT(*) AS contador FROM pedido INNER JOIN user ";
        $queryString .= "ON user_id = pedido_id_user WHERE pedido_tipo IN(1,2) AND pedido_status = '0' ";
        $queryString .= "AND user.user_id = '" . $user . "' ";
        $queryString .= "AND pedido_data_vencimento BETWEEN '2010-01-01' AND '" . $now . "' ";
        $queryString .= "GROUP BY pedido_id_user";
        $query = DB::connection("system_old")->select($queryString);
        return isset($query) && !empty($query[0]->contador)  ? $query[0]->contador : null;
    }
}
