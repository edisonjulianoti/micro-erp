<?php

class FakeDataService
{
    public static function generateOS()
    {
        // Código gerado pelo snippet: "Conexão com banco de dados"
        TTransaction::open('microerp');

        $produtos = Produto::getObjects();
        $pessoas = Pessoa::getObjects();
        
        
        for($i = 0; $i <= 40; $i++)
        {
            $mes = str_pad(rand(1,12), 2, "0", STR_PAD_LEFT);
            $dia = str_pad(rand(1,28), 2, "0", STR_PAD_LEFT);
            
            $os = new OrdemServico();
            $os->cliente_id = rand(1, count($pessoas));
            $os->data_inicio = '2022-'.$mes.'-'.$dia;
            
            $dataFim = new DateTime($os->data_inicio);
            $dataFim->add(new DateInterval('P4D'));
            
            $os->data_fim = $dataFim->format('Y-m-d');
            
            $dataPrevista = new DateTime($os->data_inicio);
            $dataPrevista->add(new DateInterval('P7D'));
            
            $os->data_prevista = $dataPrevista->format('Y-m-d');
            
            $os->mes = $mes;
            $os->ano = '2022';
            $os->mes_ano = $mes.'/2022';
            $os->valor_total = 0;
            $os->descricao = 'Ordem Servço Padrão';
            $os->store();
            
            for($x = 0; $x <= rand(1,5); $x++)
            {
                $produto = $produtos[rand(0, count($produtos)-1)] ?? $produtos[0];
                
                $ordemServicoItem = new OrdemServicoItem();
                $ordemServicoItem->ordem_servico_id = $os->id;
                $ordemServicoItem->produto_id = $produto->id;
                $ordemServicoItem->quantidade = rand(1,10);
                $ordemServicoItem->valor = $produto->preco;
                $ordemServicoItem->valor_total = $ordemServicoItem->quantidade * $ordemServicoItem->valor;
                $ordemServicoItem->store();
                
                $os->valor_total += $ordemServicoItem->valor_total;
            }
            $os->store();
        }
        
        
        TTransaction::close();
        // -----
    }
}
