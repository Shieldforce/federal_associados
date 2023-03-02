<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class Plans extends Seeder
{
    public function run()
    {
        Plan::updateOrCreate([
            "name"        => "Plano Esmeralda",
            "description" => "Neste Plano Esmeralda tera toda uma estrutura de rastreamento e acompanhamento do seu próprio veículo, com uma plataforma rápida e fácil de utilizar.Alem de Rastreamento o associado poderá usar os benefícios de Auxílio Funeral, Proteção por morte Acidental, Indique e ganhe (PBI), Clube de Benefícios e Muito Mais.",
            "file_link"   => "files/plans/esmeralda.png",
            "min_price"   => 0.00
        ]);

        Plan::updateOrCreate([
            "name"        => "Plano Perola",
            "description" => "Neste Plano pérola contemplamos os melhores Benefícios do Brasil, Internet de 1GB até 500GB. Alem de internet o associado poderá usar os benefícios de ligações (De acordo com o plano escolhido), Auxílio Funeral, Proteção por morte Acidental, Indique e ganhe (PBI), Clube de Benefícios e Muito Mais.",
            "file_link"   => "files/plans/perola.png",
            "min_price"   => 0.00
        ]);

        Plan::updateOrCreate([
            "name"        => "Plano Prata",
            "description" => "Neste Plano Prata e contemplado os melhores Benefícios do Brasil, O associado alem de ter a proteção do seu veiculo poderá usufruir de benefícios tais como descontos em parceiros, rastreador, Auxílio Funeral, Proteção por morte Acidental, Indique e ganhe (PBI), Clube de Benefícios e Muito Mais.",
            "file_link"   => "files/plans/prata.png",
            "min_price"   => 0.00
        ]);

        Plan::updateOrCreate([
            "name"        => "Plano Rubi",
            "description" => "Neste Plano Prata e contemplado os melhores Benefícios do Brasil, O associado alem de ter a proteção do seu veiculo poderá usufruir de benefícios tais como descontos em parceiros, rastreador, Auxílio Funeral, Proteção por morte Acidental, Indique e ganhe (PBI), Clube de Benefícios e Muito Mais.",
            "file_link"   => "files/plans/rubi.png",
            "min_price"   => 0.00
        ]);
    }
}
