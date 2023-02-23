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

        $query = DB::connection("system_old")->select("SELECT * FROM pedido INNER JOIN itens_pedido_chip ON pedido_id = itens_pedido_chip_id_pedido
INNER JOIN chip ON itens_pedido_chip_id_chip = chip_id INNER JOIN `user` ON pedido_id_user = user_id WHERE chip_iccid = '{$this->chip}'AND pedido_tipo = 0");
        $dados = [];
        if (!empty($query)){
            foreach ($query as $quer){
                $dados = [
                    "order_id"              =>$quer["pedido_id"] ?? null,
                    "amount_billings"       => isset($quer["pedido_id_user"]) ?
                        $this->calcBillingsInOpen($quer["pedido_id_user"]) : null,
                    "user_name"             => $quer["user_nome"] ?? null,
                    "chip_number"           => $quer["chip_iccid"],
                    "line_number"           => $quer["num"] ?? null,
                ];
        }
        }

        AuditorOfChipActiveSystemOld::create($dados);

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
