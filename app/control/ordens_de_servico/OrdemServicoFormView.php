<?php

class OrdemServicoFormView extends TPage
{
    protected $form; // form
    private static $database = 'microerp';
    private static $activeRecord = 'OrdemServico';
    private static $primaryKey = 'id';
    private static $formName = 'formView_OrdemServico';

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();

        if(!empty($param['target_container']))
        {
            $this->adianti_target_container = $param['target_container'];
        }

        TTransaction::open(self::$database);
        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        $this->form->setTagName('div');

        $ordem_servico = new OrdemServico($param['key']);
        // define the form title
        $this->form->setFormTitle("Consulta da OS");

        $label2 = new TLabel("Código OS:", '', '14px', 'B', '100%');
        $text1 = new TTextDisplay($ordem_servico->id, '', '16px', '');
        $label6 = new TLabel("Data de início:", '', '14px', 'B', '100%');
        $text4 = new TTextDisplay(TDate::convertToMask($ordem_servico->data_inicio, 'yyyy-mm-dd', 'dd/mm/yyyy'), '', '16px', '');
        $label8 = new TLabel("Data de fim:", '', '14px', 'B', '100%');
        $text5 = new TTextDisplay(TDate::convertToMask($ordem_servico->data_fim, 'yyyy-mm-dd', 'dd/mm/yyyy'), '', '16px', '');
        $label10 = new TLabel("Data prevista:", '', '14px', 'B', '100%');
        $text6 = new TTextDisplay(TDate::convertToMask($ordem_servico->data_prevista, 'yyyy-mm-dd', 'dd/mm/yyyy'), '', '16px', '');
        $label12 = new TLabel("Cliente:", '', '14px', 'B', '100%');
        $text2 = new TTextDisplay($ordem_servico->cliente->nome, '', '16px', '');
        $label14 = new TLabel("Valor total:", '', '14px', 'B', '100%');
        $text7 = new TTextDisplay(number_format((double)$ordem_servico->valor_total, '2', ',', '.'), '', '16px', '');
        $label16 = new TLabel("Descrição:", '', '14px', 'B', '100%');
        $text3 = new TTextDisplay($ordem_servico->descricao, '', '16px', '');


        $row1 = $this->form->addFields([$label2,$text1],[$label6,$text4],[$label8,$text5],[$label10,$text6]);
        $row1->layout = ['col-sm-3','col-sm-3',' col-sm-3',' col-sm-3'];

        $row2 = $this->form->addFields([$label12,$text2],[$label14,$text7]);
        $row2->layout = [' col-sm-6','col-sm-6'];

        $row3 = $this->form->addFields([$label16,$text3]);
        $row3->layout = [' col-sm-12'];

        $this->ordem_servico_atendimento_ordem_servico_id_list = new TQuickGrid;
        $this->ordem_servico_atendimento_ordem_servico_id_list->disableHtmlConversion();
        $this->ordem_servico_atendimento_ordem_servico_id_list->style = 'width:100%';
        $this->ordem_servico_atendimento_ordem_servico_id_list->disableDefaultClick();

        $column_tecnico_nome = $this->ordem_servico_atendimento_ordem_servico_id_list->addQuickColumn("Técnico", 'tecnico->nome', 'left');
        $column_problema_nome = $this->ordem_servico_atendimento_ordem_servico_id_list->addQuickColumn("Problema", 'problema->nome', 'left');
        $column_causa_nome = $this->ordem_servico_atendimento_ordem_servico_id_list->addQuickColumn("Causa", 'causa->nome', 'left');
        $column_solucao_nome = $this->ordem_servico_atendimento_ordem_servico_id_list->addQuickColumn("Solução", 'solucao->nome', 'left');
        $column_data_atendimento_transformed = $this->ordem_servico_atendimento_ordem_servico_id_list->addQuickColumn("Data", 'data_atendimento', 'left');
        $column_horario_inicial = $this->ordem_servico_atendimento_ordem_servico_id_list->addQuickColumn("Horário inicial", 'horario_inicial', 'left');
        $column_horario_final = $this->ordem_servico_atendimento_ordem_servico_id_list->addQuickColumn("Horário final", 'horario_final', 'left');
        $column_obs = $this->ordem_servico_atendimento_ordem_servico_id_list->addQuickColumn("Observações", 'obs', 'left');

        $column_data_atendimento_transformed->setTransformer(function($value, $object, $row, $cell = null, $last_row = null)
        {
            if(!empty(trim($value)))
            {
                try
                {
                    $date = new DateTime($value);
                    return $date->format('d/m/Y');
                }
                catch (Exception $e)
                {
                    return $value;
                }
            }
        });

        $this->ordem_servico_atendimento_ordem_servico_id_list->createModel();

        $criteria_ordem_servico_atendimento_ordem_servico_id = new TCriteria();
        $criteria_ordem_servico_atendimento_ordem_servico_id->add(new TFilter('ordem_servico_id', '=', $ordem_servico->id));

        $criteria_ordem_servico_atendimento_ordem_servico_id->setProperty('order', 'id desc');

        $ordem_servico_atendimento_ordem_servico_id_items = OrdemServicoAtendimento::getObjects($criteria_ordem_servico_atendimento_ordem_servico_id);

        $this->ordem_servico_atendimento_ordem_servico_id_list->addItems($ordem_servico_atendimento_ordem_servico_id_items);

        $icon = new TImage('fas:wrench #000000');
        $title = new TTextDisplay("{$icon} ATENDIMENTOS", '#333', '14px', '{$fontStyle}');

        $panel = new TPanelGroup($title, '#f5f5f5');
        $panel->class = 'panel panel-default formView-detail';
        $panel->add(new BootstrapDatagridWrapper($this->ordem_servico_atendimento_ordem_servico_id_list));

        $this->form->addContent([$panel]);

        $this->ordem_servico_item_ordem_servico_id_list = new TQuickGrid;
        $this->ordem_servico_item_ordem_servico_id_list->disableHtmlConversion();
        $this->ordem_servico_item_ordem_servico_id_list->style = 'width:100%';
        $this->ordem_servico_item_ordem_servico_id_list->disableDefaultClick();

        $column_produto_tipo_produto_nome = $this->ordem_servico_item_ordem_servico_id_list->addQuickColumn("Tipo", 'produto->tipo_produto->nome', 'left');
        $column_produto_nome = $this->ordem_servico_item_ordem_servico_id_list->addQuickColumn("Produto", 'produto->nome', 'left');
        $column_quantidade = $this->ordem_servico_item_ordem_servico_id_list->addQuickColumn("Quantidade", 'quantidade', 'left');
        $column_valor_transformed = $this->ordem_servico_item_ordem_servico_id_list->addQuickColumn("Valor", 'valor', 'left');
        $column_desconto_transformed = $this->ordem_servico_item_ordem_servico_id_list->addQuickColumn("Desconto", 'desconto', 'left');
        $column_valor_total_transformed = $this->ordem_servico_item_ordem_servico_id_list->addQuickColumn("Valor total", 'valor_total', 'left');

        $column_valor_total_transformed->setTotalFunction( function($values) { 
            return array_sum((array) $values); 
        }); 

        $column_valor_transformed->setTransformer(function($value, $object, $row, $cell = null, $last_row = null)
        {
            if(!$value)
            {
                $value = 0;
            }

            if(is_numeric($value))
            {
                return "R$ " . number_format($value, 2, ",", ".");
            }
            else
            {
                return $value;
            }
        });

        $column_desconto_transformed->setTransformer(function($value, $object, $row, $cell = null, $last_row = null)
        {
            if(!$value)
            {
                $value = 0;
            }

            if(is_numeric($value))
            {
                return "R$ " . number_format($value, 2, ",", ".");
            }
            else
            {
                return $value;
            }
        });

        $column_valor_total_transformed->setTransformer(function($value, $object, $row, $cell = null, $last_row = null)
        {
            if(!$value)
            {
                $value = 0;
            }

            if(is_numeric($value))
            {
                return "R$ " . number_format($value, 2, ",", ".");
            }
            else
            {
                return $value;
            }
        });

        $this->ordem_servico_item_ordem_servico_id_list->createModel();

        $criteria_ordem_servico_item_ordem_servico_id = new TCriteria();
        $criteria_ordem_servico_item_ordem_servico_id->add(new TFilter('ordem_servico_id', '=', $ordem_servico->id));

        $criteria_ordem_servico_item_ordem_servico_id->setProperty('order', 'id desc');

        $ordem_servico_item_ordem_servico_id_items = OrdemServicoItem::getObjects($criteria_ordem_servico_item_ordem_servico_id);

        $this->ordem_servico_item_ordem_servico_id_list->addItems($ordem_servico_item_ordem_servico_id_items);

        $icon = new TImage('fas:boxes #000000');
        $title = new TTextDisplay("{$icon} MERCADORES/SERVIÇOS", '#333', '14px', '{$fontStyle}');

        $panel = new TPanelGroup($title, '#f5f5f5');
        $panel->class = 'panel panel-default formView-detail';
        $panel->add(new BootstrapDatagridWrapper($this->ordem_servico_item_ordem_servico_id_list));

        $this->form->addContent([$panel]);

        $this->conta_ordem_servico_id_list = new TQuickGrid;
        $this->conta_ordem_servico_id_list->disableHtmlConversion();
        $this->conta_ordem_servico_id_list->style = 'width:100%';
        $this->conta_ordem_servico_id_list->disableDefaultClick();

        $column_categoria_nome = $this->conta_ordem_servico_id_list->addQuickColumn("Categoria", 'categoria->nome', 'left');
        $column_forma_pagamento_nome = $this->conta_ordem_servico_id_list->addQuickColumn("Forma de pagamento", 'forma_pagamento->nome', 'left');
        $column_pessoa_nome = $this->conta_ordem_servico_id_list->addQuickColumn("Pessoa", 'pessoa->nome', 'left');
        $column_data_vencimento_transformed = $this->conta_ordem_servico_id_list->addQuickColumn("Vencimento", 'data_vencimento', 'center');
        $column_data_emissao_transformed = $this->conta_ordem_servico_id_list->addQuickColumn("Emissão", 'data_emissao', 'center');
        $column_data_pagamento_transformed = $this->conta_ordem_servico_id_list->addQuickColumn("Pagamento", 'data_pagamento', 'center');
        $column_parcela = $this->conta_ordem_servico_id_list->addQuickColumn("Parcela", 'parcela', 'left');
        $column_valor_transformed1 = $this->conta_ordem_servico_id_list->addQuickColumn("Valor", 'valor', 'left');
        $column_status = $this->conta_ordem_servico_id_list->addQuickColumn("Status", 'status', 'center');

        $column_valor_transformed1->setTotalFunction( function($values) { 
            return array_sum((array) $values); 
        }); 

        $column_data_vencimento_transformed->setTransformer(function($value, $object, $row, $cell = null, $last_row = null)
        {
            if(!empty(trim($value)))
            {
                try
                {
                    $date = new DateTime($value);
                    return $date->format('d/m/Y');
                }
                catch (Exception $e)
                {
                    return $value;
                }
            }
        });

        $column_data_emissao_transformed->setTransformer(function($value, $object, $row, $cell = null, $last_row = null)
        {
            if(!empty(trim($value)))
            {
                try
                {
                    $date = new DateTime($value);
                    return $date->format('d/m/Y');
                }
                catch (Exception $e)
                {
                    return $value;
                }
            }
        });

        $column_data_pagamento_transformed->setTransformer(function($value, $object, $row, $cell = null, $last_row = null)
        {
            if(!empty(trim($value)))
            {
                try
                {
                    $date = new DateTime($value);
                    return $date->format('d/m/Y');
                }
                catch (Exception $e)
                {
                    return $value;
                }
            }
        });

        $column_valor_transformed1->setTransformer(function($value, $object, $row, $cell = null, $last_row = null)
        {
            if(!$value)
            {
                $value = 0;
            }

            if(is_numeric($value))
            {
                return "R$ " . number_format($value, 2, ",", ".");
            }
            else
            {
                return $value;
            }
        });

        $this->conta_ordem_servico_id_list->createModel();

        $criteria_conta_ordem_servico_id = new TCriteria();
        $criteria_conta_ordem_servico_id->add(new TFilter('ordem_servico_id', '=', $ordem_servico->id));

        $criteria_conta_ordem_servico_id->setProperty('order', 'id desc');

        $conta_ordem_servico_id_items = Conta::getObjects($criteria_conta_ordem_servico_id);

        $this->conta_ordem_servico_id_list->addItems($conta_ordem_servico_id_items);

        $icon = new TImage('fas:money-bill-wave #000000');
        $title = new TTextDisplay("{$icon} CONTAS A RECEBER", '#333', '14px', '{$fontStyle}');

        $panel = new TPanelGroup($title, '#f5f5f5');
        $panel->class = 'panel panel-default formView-detail';
        $panel->add(new BootstrapDatagridWrapper($this->conta_ordem_servico_id_list));

        $this->form->addContent([$panel]);

        parent::setTargetContainer('adianti_right_panel');

        $btnClose = new TButton('closeCurtain');
        $btnClose->class = 'btn btn-sm btn-default';
        $btnClose->style = 'margin-right:10px;';
        $btnClose->onClick = "Template.closeRightPanel();";
        $btnClose->setLabel("Fechar");
        $btnClose->setImage('fas:times');

        $this->form->addHeaderWidget($btnClose);

        TTransaction::close();
        parent::add($this->form);

        $style = new TStyle('right-panel > .container-part[page-name=OrdemServicoFormView]');
        $style->width = '70% !important';   
        $style->show(true);

    }

    public function onShow($param = null)
    {     

    }

}

