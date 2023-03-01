<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class StartExcelInadiplentesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'GerarExcelINadiplentes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $inicio= 0;
        dd(DB::select(DB::connection('mysql1')->raw("SELECT COUNT(*) AS contador, pedido_id_user FROM pedido INNER JOIN user ON user_id = pedido_id_user WHERE pedido_tipo IN(1,2) AND pedido_status = '0' AND pedido_data_vencimento BETWEEN '2010-01-01' AND '2023-01-01' GROUP BY pedido_id_user HAVING COUNT() > 0 ")));
    }
}

