<?php

class OrdemServicoGerarFinanceiroForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'microerp';
    private static $activeRecord = 'OrdemServico';
    private static $primaryKey = 'id';
    private static $formName = 'form_OrdemServicoGerarFinanceiroForm';

    use BuilderMasterDetailFieldListTrait;

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

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle("Gerar financeiro da OS");

        $criteria_categoria_id = new TCriteria();

        $filterVar = TipoConta::RECEBER;
        $criteria_categoria_id->add(new TFilter('tipo_conta_id', '=', $filterVar)); 

        $id = new TEntry('id');
        $cliente_id = new TDBCombo('cliente_id', 'microerp', 'Pessoa', 'id', '{nome}','nome asc'  );
        $valor_total = new TNumeric('valor_total', '2', ',', '.' );
        $categoria_id = new TDBCombo('categoria_id', 'microerp', 'Categoria', 'id', '{nome}','nome asc' , $criteria_categoria_id );
        $forma_pagamento_id = new TDBCombo('forma_pagamento_id', 'microerp', 'FormaPagamento', 'id', '{nome}','nome asc'  );
        $primeiro_vencimento = new TDate('primeiro_vencimento');
        $parcelas = new TSpinner('parcelas');
        $button_gerar_parcelas = new TButton('button_gerar_parcelas');
        $conta_ordem_servico_id = new THidden('conta_ordem_servico_id[]');
        $conta_ordem_servico___row__id = new THidden('conta_ordem_servico___row__id[]');
        $conta_ordem_servico___row__data = new THidden('conta_ordem_servico___row__data[]');
        $conta_ordem_servico_parcela = new TEntry('conta_ordem_servico_parcela[]');
        $conta_ordem_servico_categoria_id = new TDBCombo('conta_ordem_servico_categoria_id[]', 'microerp', 'Categoria', 'id', '{nome}','nome asc'  );
        $conta_ordem_servico_forma_pagamento_id = new TDBCombo('conta_ordem_servico_forma_pagamento_id[]', 'microerp', 'FormaPagamento', 'id', '{nome}','nome asc'  );
        $conta_ordem_servico_data_vencimento = new TDate('conta_ordem_servico_data_vencimento[]');
        $conta_ordem_servico_valor = new TNumeric('conta_ordem_servico_valor[]', '2', ',', '.' );
        $this->fieldlist_contas = new TFieldList();

        $this->fieldlist_contas->addField(null, $conta_ordem_servico_id, []);
        $this->fieldlist_contas->addField(null, $conta_ordem_servico___row__id, ['uniqid' => true]);
        $this->fieldlist_contas->addField(null, $conta_ordem_servico___row__data, []);
        $this->fieldlist_contas->addField(new TLabel("Parcela", null, '14px', null), $conta_ordem_servico_parcela, ['width' => '20%']);
        $this->fieldlist_contas->addField(new TLabel("Categoria", null, '14px', null), $conta_ordem_servico_categoria_id, ['width' => '20%']);
        $this->fieldlist_contas->addField(new TLabel("Forma de pagamento", null, '14px', null), $conta_ordem_servico_forma_pagamento_id, ['width' => '20%']);
        $this->fieldlist_contas->addField(new TLabel("Data de vencimento", null, '14px', null), $conta_ordem_servico_data_vencimento, ['width' => '20%']);
        $this->fieldlist_contas->addField(new TLabel("Valor", null, '14px', null), $conta_ordem_servico_valor, ['width' => '20%']);

        $this->fieldlist_contas->width = '100%';
        $this->fieldlist_contas->setFieldPrefix('conta_ordem_servico');
        $this->fieldlist_contas->name = 'fieldlist_contas';

        $this->criteria_fieldlist_contas = new TCriteria();
        $this->default_item_fieldlist_contas = new stdClass();

        $this->form->addField($conta_ordem_servico_id);
        $this->form->addField($conta_ordem_servico___row__id);
        $this->form->addField($conta_ordem_servico___row__data);
        $this->form->addField($conta_ordem_servico_parcela);
        $this->form->addField($conta_ordem_servico_categoria_id);
        $this->form->addField($conta_ordem_servico_forma_pagamento_id);
        $this->form->addField($conta_ordem_servico_data_vencimento);
        $this->form->addField($conta_ordem_servico_valor);

        $this->fieldlist_contas->setRemoveAction(null, 'fas:times #dd5a43', "Excluír");

        $cliente_id->addValidation("Cliente", new TRequiredValidator()); 
        $conta_ordem_servico_categoria_id->addValidation("Categoria", new TRequiredListValidator()); 
        $conta_ordem_servico_forma_pagamento_id->addValidation("Forma de pagamento", new TRequiredListValidator()); 

        $parcelas->setRange(1, 2000, 1);
        $button_gerar_parcelas->setAction(new TAction([$this, 'onGerarParcelas']), "Gerar Parcelas");
        $button_gerar_parcelas->addStyleClass('btn-default');
        $button_gerar_parcelas->setImage('fas:cogs #4CAF50');
        $primeiro_vencimento->setMask('dd/mm/yyyy');
        $conta_ordem_servico_data_vencimento->setMask('dd/mm/yyyy');

        $primeiro_vencimento->setDatabaseMask('yyyy-mm-dd');
        $conta_ordem_servico_data_vencimento->setDatabaseMask('yyyy-mm-dd');

        $categoria_id->enableSearch();
        $forma_pagamento_id->enableSearch();
        $conta_ordem_servico_forma_pagamento_id->enableSearch();

        $id->setEditable(false);
        $cliente_id->setEditable(false);
        $valor_total->setEditable(false);
        $conta_ordem_servico_categoria_id->setEditable(false);

        $id->setSize('100%');
        $parcelas->setSize(110);
        $cliente_id->setSize('100%');
        $valor_total->setSize('100%');
        $categoria_id->setSize('100%');
        $forma_pagamento_id->setSize('100%');
        $primeiro_vencimento->setSize('100%');
        $conta_ordem_servico_valor->setSize('100%');
        $conta_ordem_servico_parcela->setSize('100%');
        $conta_ordem_servico_categoria_id->setSize('100%');
        $conta_ordem_servico_data_vencimento->setSize('100%');
        $conta_ordem_servico_forma_pagamento_id->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("Código da OS:", null, '14px', null, '100%'),$id],[new TLabel("Cliente:", '#ff0000', '14px', null, '100%'),$cliente_id]);
        $row1->layout = [' col-sm-3',' col-sm-3'];

        $row2 = $this->form->addFields([new TLabel("Valor total:", null, '14px', null, '100%'),$valor_total],[new TLabel("Categoria da conta:", null, '14px', null, '100%'),$categoria_id],[new TLabel("Forma de pagamento:", null, '14px', null, '100%'),$forma_pagamento_id]);
        $row2->layout = [' col-sm-3',' col-sm-3',' col-sm-3'];

        $row3 = $this->form->addFields([new TLabel("Primeiro vencimento:", null, '14px', null, '100%'),$primeiro_vencimento],[new TLabel("Parcelas:", null, '14px', null, '100%'),$parcelas,$button_gerar_parcelas]);
        $row3->layout = [' col-sm-3',' col-sm-6',' col-sm-3'];

        $row4 = $this->form->addFields([$this->fieldlist_contas]);
        $row4->layout = [' col-sm-12'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave'],['static' => 1]), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        parent::setTargetContainer('adianti_right_panel');

        $btnClose = new TButton('closeCurtain');
        $btnClose->class = 'btn btn-sm btn-default';
        $btnClose->style = 'margin-right:10px;';
        $btnClose->onClick = "Template.closeRightPanel();";
        $btnClose->setLabel("Fechar");
        $btnClose->setImage('fas:times');

        $this->form->addHeaderWidget($btnClose);

        parent::add($this->form);

        $style = new TStyle('right-panel > .container-part[page-name=OrdemServicoGerarFinanceiroForm]');
        $style->width = '70% !important';   
        $style->show(true);

    }

    public static function onGerarParcelas($param = null) 
    {
        try 
        {

            (new TRequiredValidator)->validate('Valor total', $param['valor_total'] );
            (new TRequiredValidator)->validate('Parcelas', $param['parcelas']);
            (new TRequiredValidator)->validate('Primeiro vencimento', $param['primeiro_vencimento']);
            (new TRequiredValidator)->validate('Categoria', $param['categoria_id']);
            (new TRequiredValidator)->validate('Forma de pagamento', $param['forma_pagamento_id']);

            //popula as variáveis com os valores que vem por parâmetro 
            $valor_total = (double) str_replace(',', '.', str_replace('.', '', $param['valor_total']));
            $parcelas = $param['parcelas'];
            $categoria_id = $param['categoria_id'];
            $forma_pagamento_id = $param['forma_pagamento_id'];
            $primeiro_vencimento = TDate::date2us($param['primeiro_vencimento']);

            // calcula o valor da parcela
            $valorParcela = $valor_total / $parcelas;

            // transforma a data de vencimento em um objeto da classe DateTime
            $data_vencimento = new DateTime($primeiro_vencimento);

            $data = new stdClass();
            $data->conta_ordem_servico_valor = [];
            $data->conta_ordem_servico_parcela = [];
            $data->conta_ordem_servico_data_vencimento = [];
            $data->conta_ordem_servico_categoria_id = [];
            $data->conta_ordem_servico_forma_pagamento_id = [];

            for($i = 0 ; $i < $parcelas; $i++)
            {
                // populando o array das propriedades do fieldlist
                $data->conta_ordem_servico_valor[] = number_format($valorParcela, 2, ',','.');
                $data->conta_ordem_servico_parcela[] = $i+1;
                $data->conta_ordem_servico_data_vencimento[] = $data_vencimento->format('d/m/Y');
                $data->conta_ordem_servico_categoria_id[] = $categoria_id;
                $data->conta_ordem_servico_forma_pagamento_id[] = $forma_pagamento_id;

                // acrescenta um mês a data de vencimento
                $data_vencimento->modify( 'next month' );
            }

            // limpa o TFieldList
            // o primeiro parâmetro é o nome da variável definida para o TFieldList
            TFieldList::clearRows('fieldlist_contas');
            // adicionamos as linhas novas
            // primeiro parâmetro é o nome da variável definida para o TFieldList
            TFieldList::addRows('fieldlist_contas', $parcelas - 1, 1);
            // enviando os dados para o field list
            TForm::sendData(self::$formName, $data, false, true, 500);

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public function onSave($param = null) 
    {
        try
        {
            TTransaction::open(self::$database); // open a transaction

            $messageAction = null;

            $this->form->validate(); // validate form data

            $object = new OrdemServico(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->store(); // save the object 

            $messageAction = new TAction(['OrdemServicoList', 'onShow']);   

            if(!empty($param['target_container']))
            {
                $messageAction->setParameter('target_container', $param['target_container']);
            }

            $conta_ordem_servico_items = $this->storeItems('Conta', 'ordem_servico_id', $object, $this->fieldlist_contas, function($masterObject, $detailObject){ 

                $detailObject->tipo_conta_id = TipoConta::RECEBER;
                $detailObject->pessoa_id = $masterObject->cliente_id;

            }, $this->criteria_fieldlist_contas); 

            // get the generated {PRIMARY_KEY}
            $data->id = $object->id; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            new TMessage('info', "Registro salvo", $messageAction); 

                        TScript::create("Template.closeRightPanel();");
            TForm::sendData(self::$formName, (object)['id' => $object->id]);

        }
        catch (Exception $e) // in case of exception
        {
            //</catchAutoCode> 

            new TMessage('error', $e->getMessage()); // shows the exception error message
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback(); // undo all pending operations
        }
    }

    public function onEdit( $param )
    {
        try
        {
            if (isset($param['key']))
            {
                $key = $param['key'];  // get the parameter $key
                TTransaction::open(self::$database); // open a transaction

                $object = new OrdemServico($key); // instantiates the Active Record 

                $this->fieldlist_contas_items = $this->loadItems('Conta', 'ordem_servico_id', $object, $this->fieldlist_contas, function($masterObject, $detailObject, $objectItems){ 

                    //code here

                }, $this->criteria_fieldlist_contas); 

                $this->form->setData($object); // fill the form 

                TTransaction::close(); // close the transaction 
            }
            else
            {
                $this->form->clear();
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }

    /**
     * Clear form data
     * @param $param Request
     */
    public function onClear( $param )
    {
        $this->form->clear(true);

        $this->fieldlist_contas->addHeader();
        $this->fieldlist_contas->addDetail($this->default_item_fieldlist_contas);

        $this->fieldlist_contas->addCloneAction(null, 'fas:plus #69aa46', "Clonar");

    }

    public function onShow($param = null)
    {
        $this->fieldlist_contas->addHeader();
        $this->fieldlist_contas->addDetail($this->default_item_fieldlist_contas);

        $this->fieldlist_contas->addCloneAction(null, 'fas:plus #69aa46', "Clonar");

    } 

    public static function getFormName()
    {
        return self::$formName;
    }

}

