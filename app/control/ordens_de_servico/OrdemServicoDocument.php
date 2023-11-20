<?php

class OrdemServicoDocument extends TPage
{
    private static $database = 'microerp';
    private static $activeRecord = 'OrdemServico';
    private static $primaryKey = 'id';
    private static $htmlFile = 'app/documents/OrdemServicoDocumentTemplate.html';

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {

    }

    public static function onGenerate($param)
    {
        try 
        {
            TTransaction::open(self::$database);

            $class = self::$activeRecord;
            $object = new $class($param['key']);

            $html = new AdiantiHTMLDocumentParser(self::$htmlFile);
            $html->setMaster($object);

            $criteria_OrdemServicoAtendimento_ordem_servico_id = new TCriteria();
            $criteria_OrdemServicoAtendimento_ordem_servico_id->add(new TFilter('ordem_servico_id', '=', $param['key']));
            $criteria_OrdemServicoItem_ordem_servico_id = new TCriteria();
            $criteria_OrdemServicoItem_ordem_servico_id->add(new TFilter('ordem_servico_id', '=', $param['key']));

            $object->data_inicio = TDate::date2br($object->data_inicio);
            $object->data_fim = TDate::date2br($object->data_fim);
            $object->valor_total_geral = 0;

            $objectsOrdemServicoAtendimento_ordem_servico_id = OrdemServicoAtendimento::getObjects($criteria_OrdemServicoAtendimento_ordem_servico_id);
            $html->setDetail('OrdemServicoAtendimento.ordem_servico_id', $objectsOrdemServicoAtendimento_ordem_servico_id);
            $objectsOrdemServicoItem_ordem_servico_id = OrdemServicoItem::getObjects($criteria_OrdemServicoItem_ordem_servico_id);
            $html->setDetail('OrdemServicoItem.ordem_servico_id', $objectsOrdemServicoItem_ordem_servico_id);

            $pageSize = 'A4';
            $document = 'tmp/'.uniqid().'.pdf'; 

            if($objectsOrdemServicoItem_ordem_servico_id)
            {
                foreach($objectsOrdemServicoItem_ordem_servico_id as $item)
                {
                    if(!$item->desconto)
                    {
                        $item->desconto = 0;
                    }

                    $object->valor_total_geral += $item->valor_total;
                    $item->valor_total = number_format($item->valor_total, 2, ',', '.'); 
                    $item->valor = number_format($item->valor, 2, ',', '.');
                    $item->desconto = number_format($item->desconto, 2, ',', '.');
                    $item->quantidade = number_format($item->quantidade, 2, ',', '.');
                }
            }

            if($objectsOrdemServicoAtendimento_ordem_servico_id)
            {
                foreach($objectsOrdemServicoAtendimento_ordem_servico_id as $atendimento)
                {
                    $atendimento->data_atendimento = TDate::date2br($atendimento->data_atendimento);
                }
            }

            $object->valor_total_geral = number_format($object->valor_total_geral, 2, ',', '.');

            $html->process();

            $html->saveAsPDF($document, $pageSize, 'portrait');

            TTransaction::close();

            if(empty($param['returnFile']))
            {
                parent::openFile($document);

                new TMessage('info', _t('Document successfully generated'));    
            }
            else
            {
                return $document;
            }
        } 
        catch (Exception $e) 
        {
            // shows the exception error message
            new TMessage('error', $e->getMessage());

            // undo all pending operations
            TTransaction::rollback();
        }
    }

}

