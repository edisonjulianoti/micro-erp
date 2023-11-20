<?php

class DashboardOS extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = '';
    private static $activeRecord = '';
    private static $primaryKey = '';
    private static $formName = 'form_DashboardOS';

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param = null)
    {
        parent::__construct();

        if(!empty($param['target_container']))
        {
            $this->adianti_target_container = $param['target_container'];
        }

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle("Dashboard");

        $criteria_total_vendas_mes = new TCriteria();
        $criteria_total_vendas_por_mes = new TCriteria();
        $criteria_total_por_mercadoria = new TCriteria();
        $criteria_total_por_servico = new TCriteria();

        $filterVar = TipoProduto::MERCADORIA;
        $criteria_total_por_mercadoria->add(new TFilter('ordem_servico_item.produto_id', 'in', "(SELECT id FROM produto WHERE tipo_produto_id = '{$filterVar}')")); 
        $filterVar = TipoProduto::SERVICO;
        $criteria_total_por_servico->add(new TFilter('ordem_servico_item.produto_id', 'in', "(SELECT id FROM produto WHERE tipo_produto_id = '{$filterVar}')")); 

        $mes = new TCombo('mes');
        $ano = new TCombo('ano');
        $button_filtrar = new TButton('button_filtrar');
        $total_vendas_mes = new BIndicator('total_vendas_mes');
        $total_vendas_ano = new BIndicator('total_vendas_ano');
        $total_vendas_por_mes = new BBarChart('total_vendas_por_mes');
        $total_por_mercadoria = new BPieChart('total_por_mercadoria');
        $total_por_servico = new BPieChart('total_por_servico');


        $button_filtrar->setAction(new TAction(['DashboardOS', 'onShow']), "Filtrar");
        $button_filtrar->addStyleClass('btn-primary');
        $button_filtrar->setImage('fas:filter #FFFFFF');
        $mes->setSize('100%');
        $ano->setSize('100%');

        $ano->addItems(TempoService::getAnos());
        $mes->addItems(TempoService::getMeses());

        $mes->setValue(date('m'));
        $ano->setValue(date('Y'));

        $mes->enableSearch();
        $ano->enableSearch();

        $total_vendas_mes->setDatabase('microerp');
        $total_vendas_mes->setFieldValue("ordem_servico.valor_total");
        $total_vendas_mes->setModel('OrdemServico');
        $total_vendas_mes->setTransformerValue(function($value)
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
        $total_vendas_mes->setTotal('sum');
        $total_vendas_mes->setColors('#27ae60', '#ffffff', '#2ecc71', '#ffffff');
        $total_vendas_mes->setTitle("TOTAL VENDIDO NO MÊS", '#ffffff', '20', '');
        $total_vendas_mes->setCriteria($criteria_total_vendas_mes);
        $total_vendas_mes->setIcon(new TImage('fas:shopping-basket #ffffff'));
        $total_vendas_mes->setValueSize("20");
        $total_vendas_mes->setValueColor("#ffffff", 'B');
        $total_vendas_mes->setSize('100%', 95);
        $total_vendas_mes->setLayout('horizontal', 'left');

        $total_vendas_ano->setDatabase('microerp');
        $total_vendas_ano->setFieldValue("ordem_servico.valor_total");
        $total_vendas_ano->setModel('OrdemServico');
        $total_vendas_ano->setTransformerValue(function($value)
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
        $total_vendas_ano->setTotal('sum');
        $total_vendas_ano->setColors('#3498DB', '#FFFFFF', '#2980B9', '#FFFFFF');
        $total_vendas_ano->setTitle("TOTAL VENDIDO NO ANO", '#FFFFFF', '20', '');
        $total_vendas_ano->setIcon(new TImage('fas:shopping-basket #FFFFFF'));
        $total_vendas_ano->setValueSize("20");
        $total_vendas_ano->setValueColor("#FFFFFF", 'B');
        $total_vendas_ano->setSize('100%', 95);
        $total_vendas_ano->setLayout('horizontal', 'left');

        $total_vendas_por_mes->setDatabase('microerp');
        $total_vendas_por_mes->setFieldValue("ordem_servico.valor_total");
        $total_vendas_por_mes->setFieldGroup(["ordem_servico.mes_ano"]);
        $total_vendas_por_mes->setModel('OrdemServico');
        $total_vendas_por_mes->setTitle("TOTAL VENDIDO POR MÊS");
        $total_vendas_por_mes->setTransformerValue(function($value, $row, $data)
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
        $total_vendas_por_mes->setLayout('vertical');
        $total_vendas_por_mes->setTotal('sum');
        $total_vendas_por_mes->showLegend(false);
        $total_vendas_por_mes->setCriteria($criteria_total_vendas_por_mes);
        $total_vendas_por_mes->setLabelValue("Valor total");
        $total_vendas_por_mes->setSize('100%', 280);
        $total_vendas_por_mes->disableZoom();

        $total_por_mercadoria->setDatabase('microerp');
        $total_por_mercadoria->setFieldValue("ordem_servico_item.valor_total");
        $total_por_mercadoria->setFieldGroup("produto.nome");
        $total_por_mercadoria->setModel('OrdemServicoItem');
        $total_por_mercadoria->setTitle("TOTAL POR MERCADORIA");
        $total_por_mercadoria->setTransformerValue(function($value, $row, $data)
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
        $total_por_mercadoria->setJoins([
             'produto' => ['ordem_servico_item.produto_id', 'produto.id']
        ]);
        $total_por_mercadoria->setTotal('sum');
        $total_por_mercadoria->showLegend(true);
        $total_por_mercadoria->enableOrderByValue('asc');
        $total_por_mercadoria->setCriteria($criteria_total_por_mercadoria);
        $total_por_mercadoria->setSize('100%', 280);
        $total_por_mercadoria->disableZoom();

        $total_por_servico->setDatabase('microerp');
        $total_por_servico->setFieldValue("ordem_servico_item.valor_total");
        $total_por_servico->setFieldGroup("produto.nome");
        $total_por_servico->setModel('OrdemServicoItem');
        $total_por_servico->setTitle("TOTAL POR SERVIÇO");
        $total_por_servico->setTransformerValue(function($value, $row, $data)
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
        $total_por_servico->setJoins([
             'produto' => ['ordem_servico_item.produto_id', 'produto.id']
        ]);
        $total_por_servico->setTotal('sum');
        $total_por_servico->showLegend(true);
        $total_por_servico->enableOrderByValue('asc');
        $total_por_servico->setCriteria($criteria_total_por_servico);
        $total_por_servico->setSize('100%', 280);
        $total_por_servico->disableZoom();

        $row1 = $this->form->addFields([new TLabel("Mês:", null, '14px', null, '100%'),$mes],[new TLabel("Ano:", null, '14px', null, '100%'),$ano],[$button_filtrar]);
        $row1->layout = [' col-sm-3',' col-sm-3',' col-sm-6'];

        $row2 = $this->form->addFields([$total_vendas_mes],[$total_vendas_ano]);
        $row2->layout = [' col-sm-6','col-sm-6'];

        $row3 = $this->form->addFields([$total_vendas_por_mes]);
        $row3->layout = [' col-sm-12'];

        $row4 = $this->form->addFields([$total_por_mercadoria],[$total_por_servico]);
        $row4->layout = [' col-sm-6',' col-sm-6'];

        if(!isset($param['mes']) && $mes->getValue())
        {
            $_POST['mes'] = $mes->getValue();
        }
        if(!isset($param['ano']) && $ano->getValue())
        {
            $_POST['ano'] = $ano->getValue();
        }

        $searchData = $this->form->getData();
        $this->form->setData($searchData);

        $filterVar = $searchData->mes;
        if($filterVar)
        {
            $criteria_total_vendas_mes->add(new TFilter('ordem_servico.mes', '=', $filterVar)); 
        }
        $filterVar = $searchData->ano;
        if($filterVar)
        {
            $criteria_total_vendas_mes->add(new TFilter('ordem_servico.ano', '=', $filterVar)); 
        }
        $filterVar = $searchData->ano;
        if($filterVar)
        {
            $criteria_total_vendas_por_mes->add(new TFilter('ordem_servico.ano', '=', $filterVar)); 
        }
        $filterVar = $searchData->mes;
        if($filterVar)
        {
            $criteria_total_por_mercadoria->add(new TFilter('ordem_servico_item.ordem_servico_id', 'in', "(SELECT id FROM ordem_servico WHERE mes = '$filterVar')")); 
        }
        $filterVar = $searchData->ano;
        if($filterVar)
        {
            $criteria_total_por_mercadoria->add(new TFilter('ordem_servico_item.ordem_servico_id', 'in', "(SELECT id FROM ordem_servico WHERE ano = '$filterVar')")); 
        }
        $filterVar = $searchData->mes;
        if($filterVar)
        {
            $criteria_total_por_servico->add(new TFilter('ordem_servico_item.ordem_servico_id', 'in', "(SELECT id FROM ordem_servico WHERE mes = '$filterVar')")); 
        }
        $filterVar = $searchData->ano;
        if($filterVar)
        {
            $criteria_total_por_servico->add(new TFilter('ordem_servico_item.ordem_servico_id', 'in', "(SELECT id FROM ordem_servico WHERE ano = '$filterVar')")); 
        }

        BChart::generate($total_vendas_mes, $total_vendas_ano, $total_vendas_por_mes, $total_por_mercadoria, $total_por_servico);

        // create the form actions

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["Ordens de Serviço","Dashboard"]));
        }
        $container->add($this->form);

        parent::add($container);

    }

    public function onShow($param = null)
    {               

    } 

}

