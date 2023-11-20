<?php

class OrcamentoForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'microerp';
    private static $activeRecord = 'Orcamento';
    private static $primaryKey = 'id';
    private static $formName = 'form_OrcamentoForm';

    use BuilderMasterDetailTrait;

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
        $this->form->setFormTitle("Cadastro de orcamento");

        $criteria_orcamento_servicos_orcamento_produto_id = new TCriteria();
        $criteria_orcamento_produtos_orcamento_produto_id = new TCriteria();

        $filterVar = TipoProduto::SERVICO;
        $criteria_orcamento_servicos_orcamento_produto_id->add(new TFilter('tipo_produto_id', '=', $filterVar)); 
        $filterVar = TipoProduto::MERCADORIA;
        $criteria_orcamento_produtos_orcamento_produto_id->add(new TFilter('tipo_produto_id', '=', $filterVar)); 

        $id = new TEntry('id');
        $pessoa_id = new TDBCombo('pessoa_id', 'microerp', 'Pessoa', 'id', '{nome}','nome asc'  );
        $data_orcamento = new TDate('data_orcamento');
        $valor = new TNumeric('valor', '2', ',', '.' );
        $orcamento_servicos_orcamento_produto_id = new TDBCombo('orcamento_servicos_orcamento_produto_id', 'microerp', 'Produto', 'id', '{nome}','nome asc' , $criteria_orcamento_servicos_orcamento_produto_id );
        $orcamento_servicos_orcamento_id = new THidden('orcamento_servicos_orcamento_id');
        $orcamento_servicos_orcamento_valor = new TNumeric('orcamento_servicos_orcamento_valor', '2', ',', '.' );
        $button_adicionar_orcamento_servicos_orcamento = new TButton('button_adicionar_orcamento_servicos_orcamento');
        $orcamento_produtos_orcamento_produto_id = new TDBCombo('orcamento_produtos_orcamento_produto_id', 'microerp', 'Produto', 'id', '{nome}','nome asc' , $criteria_orcamento_produtos_orcamento_produto_id );
        $orcamento_produtos_orcamento_id = new THidden('orcamento_produtos_orcamento_id');
        $orcamento_produtos_orcamento_quantidade = new TNumeric('orcamento_produtos_orcamento_quantidade', '2', ',', '.' );
        $orcamento_produtos_orcamento_valor = new TNumeric('orcamento_produtos_orcamento_valor', '2', ',', '.' );
        $button_adicionar_orcamento_produtos_orcamento = new TButton('button_adicionar_orcamento_produtos_orcamento');

        $pessoa_id->addValidation("Cliente", new TRequiredValidator()); 

        $id->setEditable(false);
        $data_orcamento->setMask('dd/mm/yyyy');
        $data_orcamento->setDatabaseMask('yyyy-mm-dd');
        $button_adicionar_orcamento_servicos_orcamento->setAction(new TAction([$this, 'onAddDetailOrcamentoServicosOrcamento'],['static' => 1]), "Adicionar");
        $button_adicionar_orcamento_produtos_orcamento->setAction(new TAction([$this, 'onAddDetailOrcamentoProdutosOrcamento'],['static' => 1]), "Adicionar");

        $button_adicionar_orcamento_servicos_orcamento->addStyleClass('btn-default');
        $button_adicionar_orcamento_produtos_orcamento->addStyleClass('btn-default');

        $button_adicionar_orcamento_servicos_orcamento->setImage('fas:plus #2ecc71');
        $button_adicionar_orcamento_produtos_orcamento->setImage('fas:plus #2ecc71');

        $pessoa_id->enableSearch();
        $orcamento_servicos_orcamento_produto_id->enableSearch();
        $orcamento_produtos_orcamento_produto_id->enableSearch();

        $id->setSize(100);
        $valor->setSize('100%');
        $pessoa_id->setSize('100%');
        $data_orcamento->setSize(110);
        $orcamento_servicos_orcamento_id->setSize(200);
        $orcamento_produtos_orcamento_id->setSize(200);
        $orcamento_servicos_orcamento_valor->setSize('100%');
        $orcamento_produtos_orcamento_valor->setSize('100%');
        $orcamento_servicos_orcamento_produto_id->setSize('100%');
        $orcamento_produtos_orcamento_produto_id->setSize('100%');
        $orcamento_produtos_orcamento_quantidade->setSize('100%');

        $button_adicionar_orcamento_servicos_orcamento->id = '655b6d240ba48';
        $button_adicionar_orcamento_produtos_orcamento->id = '655b695b70c0d';

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("Cliente:", '#ff0000', '14px', null, '100%'),$pessoa_id]);
        $row1->layout = ['col-sm-6','col-sm-6'];

        $row2 = $this->form->addFields([new TLabel("Data orcamento:", null, '14px', null, '100%'),$data_orcamento],[new TLabel("Valor:", null, '14px', null, '100%'),$valor]);
        $row2->layout = ['col-sm-6','col-sm-6'];

        $this->detailFormOrcamentoServicosOrcamento = new BootstrapFormBuilder('detailFormOrcamentoServicosOrcamento');
        $this->detailFormOrcamentoServicosOrcamento->setProperty('style', 'border:none; box-shadow:none; width:100%;');

        $this->detailFormOrcamentoServicosOrcamento->setProperty('class', 'form-horizontal builder-detail-form');

        $row3 = $this->detailFormOrcamentoServicosOrcamento->addFields([new TFormSeparator("Serviços", '#333', '18', '#eee')]);
        $row3->layout = [' col-sm-12'];

        $row4 = $this->detailFormOrcamentoServicosOrcamento->addFields([new TLabel("Serviço:", '#ff0000', '14px', null, '100%'),$orcamento_servicos_orcamento_produto_id,$orcamento_servicos_orcamento_id],[new TLabel("Valor:", null, '14px', null, '100%'),$orcamento_servicos_orcamento_valor]);
        $row4->layout = ['col-sm-6','col-sm-6'];

        $row5 = $this->detailFormOrcamentoServicosOrcamento->addFields([$button_adicionar_orcamento_servicos_orcamento]);
        $row5->layout = [' col-sm-12'];

        $row6 = $this->detailFormOrcamentoServicosOrcamento->addFields([new THidden('orcamento_servicos_orcamento__row__id')]);
        $this->orcamento_servicos_orcamento_criteria = new TCriteria();

        $this->orcamento_servicos_orcamento_list = new BootstrapDatagridWrapper(new TDataGrid);
        $this->orcamento_servicos_orcamento_list->disableHtmlConversion();;
        $this->orcamento_servicos_orcamento_list->generateHiddenFields();
        $this->orcamento_servicos_orcamento_list->setId('orcamento_servicos_orcamento_list');

        $this->orcamento_servicos_orcamento_list->style = 'width:100%';
        $this->orcamento_servicos_orcamento_list->class .= ' table-bordered';

        $column_orcamento_servicos_orcamento_produto_nome = new TDataGridColumn('produto->nome', "Serviço", 'left');
        $column_orcamento_servicos_orcamento_valor = new TDataGridColumn('valor', "Valor", 'left');

        $column_orcamento_servicos_orcamento__row__data = new TDataGridColumn('__row__data', '', 'center');
        $column_orcamento_servicos_orcamento__row__data->setVisibility(false);

        $action_onEditDetailOrcamentoServicos = new TDataGridAction(array('OrcamentoForm', 'onEditDetailOrcamentoServicos'));
        $action_onEditDetailOrcamentoServicos->setUseButton(false);
        $action_onEditDetailOrcamentoServicos->setButtonClass('btn btn-default btn-sm');
        $action_onEditDetailOrcamentoServicos->setLabel("Editar");
        $action_onEditDetailOrcamentoServicos->setImage('far:edit #478fca');
        $action_onEditDetailOrcamentoServicos->setFields(['__row__id', '__row__data']);

        $this->orcamento_servicos_orcamento_list->addAction($action_onEditDetailOrcamentoServicos);
        $action_onDeleteDetailOrcamentoServicos = new TDataGridAction(array('OrcamentoForm', 'onDeleteDetailOrcamentoServicos'));
        $action_onDeleteDetailOrcamentoServicos->setUseButton(false);
        $action_onDeleteDetailOrcamentoServicos->setButtonClass('btn btn-default btn-sm');
        $action_onDeleteDetailOrcamentoServicos->setLabel("Excluir");
        $action_onDeleteDetailOrcamentoServicos->setImage('fas:trash-alt #dd5a43');
        $action_onDeleteDetailOrcamentoServicos->setFields(['__row__id', '__row__data']);

        $this->orcamento_servicos_orcamento_list->addAction($action_onDeleteDetailOrcamentoServicos);

        $this->orcamento_servicos_orcamento_list->addColumn($column_orcamento_servicos_orcamento_produto_nome);
        $this->orcamento_servicos_orcamento_list->addColumn($column_orcamento_servicos_orcamento_valor);

        $this->orcamento_servicos_orcamento_list->addColumn($column_orcamento_servicos_orcamento__row__data);

        $this->orcamento_servicos_orcamento_list->createModel();
        $tableResponsiveDiv = new TElement('div');
        $tableResponsiveDiv->class = 'table-responsive';
        $tableResponsiveDiv->add($this->orcamento_servicos_orcamento_list);
        $this->detailFormOrcamentoServicosOrcamento->addContent([$tableResponsiveDiv]);
        $row7 = $this->form->addFields([$this->detailFormOrcamentoServicosOrcamento]);
        $row7->layout = [' col-sm-12'];

        $this->detailFormOrcamentoProdutosOrcamento = new BootstrapFormBuilder('detailFormOrcamentoProdutosOrcamento');
        $this->detailFormOrcamentoProdutosOrcamento->setProperty('style', 'border:none; box-shadow:none; width:100%;');

        $this->detailFormOrcamentoProdutosOrcamento->setProperty('class', 'form-horizontal builder-detail-form');

        $row8 = $this->detailFormOrcamentoProdutosOrcamento->addFields([new TFormSeparator("Produtos", '#333', '18', '#eee')]);
        $row8->layout = [' col-sm-12'];

        $row9 = $this->detailFormOrcamentoProdutosOrcamento->addFields([new TLabel("Produto:", '#ff0000', '14px', null, '100%'),$orcamento_produtos_orcamento_produto_id,$orcamento_produtos_orcamento_id],[new TLabel("Quantidade:", null, '14px', null, '100%'),$orcamento_produtos_orcamento_quantidade],[new TLabel("Valor:", null, '14px', null, '100%'),$orcamento_produtos_orcamento_valor]);
        $row9->layout = ['col-sm-6',' col-sm-3',' col-sm-3'];

        $row10 = $this->detailFormOrcamentoProdutosOrcamento->addFields([$button_adicionar_orcamento_produtos_orcamento]);
        $row10->layout = [' col-sm-12'];

        $row11 = $this->detailFormOrcamentoProdutosOrcamento->addFields([new THidden('orcamento_produtos_orcamento__row__id')]);
        $this->orcamento_produtos_orcamento_criteria = new TCriteria();

        $this->orcamento_produtos_orcamento_list = new BootstrapDatagridWrapper(new TDataGrid);
        $this->orcamento_produtos_orcamento_list->disableHtmlConversion();;
        $this->orcamento_produtos_orcamento_list->generateHiddenFields();
        $this->orcamento_produtos_orcamento_list->setId('orcamento_produtos_orcamento_list');

        $this->orcamento_produtos_orcamento_list->style = 'width:100%';
        $this->orcamento_produtos_orcamento_list->class .= ' table-bordered';

        $column_orcamento_produtos_orcamento_produto_nome = new TDataGridColumn('produto->nome', "Produto", 'left');
        $column_orcamento_produtos_orcamento_id = new TDataGridColumn('id', "Quantidade", 'left');
        $column_orcamento_produtos_orcamento_id1 = new TDataGridColumn('id', "Valor", 'left');

        $column_orcamento_produtos_orcamento__row__data = new TDataGridColumn('__row__data', '', 'center');
        $column_orcamento_produtos_orcamento__row__data->setVisibility(false);

        $action_onEditDetailOrcamentoProdutos = new TDataGridAction(array('OrcamentoForm', 'onEditDetailOrcamentoProdutos'));
        $action_onEditDetailOrcamentoProdutos->setUseButton(false);
        $action_onEditDetailOrcamentoProdutos->setButtonClass('btn btn-default btn-sm');
        $action_onEditDetailOrcamentoProdutos->setLabel("Editar");
        $action_onEditDetailOrcamentoProdutos->setImage('far:edit #478fca');
        $action_onEditDetailOrcamentoProdutos->setFields(['__row__id', '__row__data']);

        $this->orcamento_produtos_orcamento_list->addAction($action_onEditDetailOrcamentoProdutos);
        $action_onDeleteDetailOrcamentoProdutos = new TDataGridAction(array('OrcamentoForm', 'onDeleteDetailOrcamentoProdutos'));
        $action_onDeleteDetailOrcamentoProdutos->setUseButton(false);
        $action_onDeleteDetailOrcamentoProdutos->setButtonClass('btn btn-default btn-sm');
        $action_onDeleteDetailOrcamentoProdutos->setLabel("Excluir");
        $action_onDeleteDetailOrcamentoProdutos->setImage('fas:trash-alt #dd5a43');
        $action_onDeleteDetailOrcamentoProdutos->setFields(['__row__id', '__row__data']);

        $this->orcamento_produtos_orcamento_list->addAction($action_onDeleteDetailOrcamentoProdutos);

        $this->orcamento_produtos_orcamento_list->addColumn($column_orcamento_produtos_orcamento_produto_nome);
        $this->orcamento_produtos_orcamento_list->addColumn($column_orcamento_produtos_orcamento_id);
        $this->orcamento_produtos_orcamento_list->addColumn($column_orcamento_produtos_orcamento_id1);

        $this->orcamento_produtos_orcamento_list->addColumn($column_orcamento_produtos_orcamento__row__data);

        $this->orcamento_produtos_orcamento_list->createModel();
        $tableResponsiveDiv = new TElement('div');
        $tableResponsiveDiv->class = 'table-responsive';
        $tableResponsiveDiv->add($this->orcamento_produtos_orcamento_list);
        $this->detailFormOrcamentoProdutosOrcamento->addContent([$tableResponsiveDiv]);
        $row12 = $this->form->addFields([$this->detailFormOrcamentoProdutosOrcamento]);
        $row12->layout = [' col-sm-12'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave'],['static' => 1]), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['OrcamentoList', 'onShow']), 'fas:arrow-left #000000');
        $this->btn_onshow = $btn_onshow;

        parent::setTargetContainer('adianti_right_panel');

        $btnClose = new TButton('closeCurtain');
        $btnClose->class = 'btn btn-sm btn-default';
        $btnClose->style = 'margin-right:10px;';
        $btnClose->onClick = "Template.closeRightPanel();";
        $btnClose->setLabel("Fechar");
        $btnClose->setImage('fas:times');

        $this->form->addHeaderWidget($btnClose);

        parent::add($this->form);

        $style = new TStyle('right-panel > .container-part[page-name=OrcamentoForm]');
        $style->width = '80% !important';   
        $style->show(true);

    }

    public  function onAddDetailOrcamentoServicosOrcamento($param = null) 
    {
        try
        {
            $data = $this->form->getData();

                $errors = [];
                $requiredFields = [];
                $requiredFields[] = ['label'=>"Produto id", 'name'=>"orcamento_servicos_orcamento_produto_id", 'class'=>'TRequiredValidator', 'value'=>[]];
                foreach($requiredFields as $requiredField)
                {
                    try
                    {
                        (new $requiredField['class'])->validate($requiredField['label'], $data->{$requiredField['name']}, $requiredField['value']);
                    }
                    catch(Exception $e)
                    {
                        $errors[] = $e->getMessage() . '.';
                    }
                 }
                 if(count($errors) > 0)
                 {
                     throw new Exception(implode('<br>', $errors));
                 }

                $__row__id = !empty($data->orcamento_servicos_orcamento__row__id) ? $data->orcamento_servicos_orcamento__row__id : 'b'.uniqid();

                TTransaction::open(self::$database);

                $grid_data = new OrcamentoServicos();
                $grid_data->__row__id = $__row__id;
                $grid_data->produto_id = $data->orcamento_servicos_orcamento_produto_id;
                $grid_data->id = $data->orcamento_servicos_orcamento_id;
                $grid_data->valor = $data->orcamento_servicos_orcamento_valor;

                $__row__data = array_merge($grid_data->toArray(), (array)$grid_data->getVirtualData());
                $__row__data['__row__id'] = $__row__id;
                $__row__data['__display__']['produto_id'] =  $param['orcamento_servicos_orcamento_produto_id'] ?? null;
                $__row__data['__display__']['id'] =  $param['orcamento_servicos_orcamento_id'] ?? null;
                $__row__data['__display__']['valor'] =  $param['orcamento_servicos_orcamento_valor'] ?? null;

                $grid_data->__row__data = base64_encode(serialize((object)$__row__data));
                $row = $this->orcamento_servicos_orcamento_list->addItem($grid_data);
                $row->id = $grid_data->__row__id;

                TDataGrid::replaceRowById('orcamento_servicos_orcamento_list', $grid_data->__row__id, $row);

                TTransaction::close();

                $data = new stdClass;
                $data->orcamento_servicos_orcamento_produto_id = '';
                $data->orcamento_servicos_orcamento_id = '';
                $data->orcamento_servicos_orcamento_valor = '';
                $data->orcamento_servicos_orcamento__row__id = '';

                TForm::sendData(self::$formName, $data);
                TScript::create("
                   var element = $('#655b6d240ba48');
                   if(typeof element.attr('add') != 'undefined')
                   {
                       element.html(base64_decode(element.attr('add')));
                   }
                ");

        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
        }
    }

    public  function onAddDetailOrcamentoProdutosOrcamento($param = null) 
    {
        try
        {
            $data = $this->form->getData();

                $errors = [];
                $requiredFields = [];
                $requiredFields[] = ['label'=>"Produto id", 'name'=>"orcamento_produtos_orcamento_produto_id", 'class'=>'TRequiredValidator', 'value'=>[]];
                foreach($requiredFields as $requiredField)
                {
                    try
                    {
                        (new $requiredField['class'])->validate($requiredField['label'], $data->{$requiredField['name']}, $requiredField['value']);
                    }
                    catch(Exception $e)
                    {
                        $errors[] = $e->getMessage() . '.';
                    }
                 }
                 if(count($errors) > 0)
                 {
                     throw new Exception(implode('<br>', $errors));
                 }

                $__row__id = !empty($data->orcamento_produtos_orcamento__row__id) ? $data->orcamento_produtos_orcamento__row__id : 'b'.uniqid();

                TTransaction::open(self::$database);

                $grid_data = new OrcamentoProdutos();
                $grid_data->__row__id = $__row__id;
                $grid_data->produto_id = $data->orcamento_produtos_orcamento_produto_id;
                $grid_data->id = $data->orcamento_produtos_orcamento_id;
                $grid_data->quantidade = $data->orcamento_produtos_orcamento_quantidade;
                $grid_data->valor = $data->orcamento_produtos_orcamento_valor;

                $__row__data = array_merge($grid_data->toArray(), (array)$grid_data->getVirtualData());
                $__row__data['__row__id'] = $__row__id;
                $__row__data['__display__']['produto_id'] =  $param['orcamento_produtos_orcamento_produto_id'] ?? null;
                $__row__data['__display__']['id'] =  $param['orcamento_produtos_orcamento_id'] ?? null;
                $__row__data['__display__']['quantidade'] =  $param['orcamento_produtos_orcamento_quantidade'] ?? null;
                $__row__data['__display__']['valor'] =  $param['orcamento_produtos_orcamento_valor'] ?? null;

                $grid_data->__row__data = base64_encode(serialize((object)$__row__data));
                $row = $this->orcamento_produtos_orcamento_list->addItem($grid_data);
                $row->id = $grid_data->__row__id;

                TDataGrid::replaceRowById('orcamento_produtos_orcamento_list', $grid_data->__row__id, $row);

                TTransaction::close();

                $data = new stdClass;
                $data->orcamento_produtos_orcamento_produto_id = '';
                $data->orcamento_produtos_orcamento_id = '';
                $data->orcamento_produtos_orcamento_quantidade = '';
                $data->orcamento_produtos_orcamento_valor = '';
                $data->orcamento_produtos_orcamento__row__id = '';

                TForm::sendData(self::$formName, $data);
                TScript::create("
                   var element = $('#655b695b70c0d');
                   if(typeof element.attr('add') != 'undefined')
                   {
                       element.html(base64_decode(element.attr('add')));
                   }
                ");

        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
        }
    }

    public static function onEditDetailOrcamentoServicos($param = null) 
    {
        try
        {

                $__row__data = unserialize(base64_decode($param['__row__data']));
                $__row__data->__display__ = is_array($__row__data->__display__) ? (object) $__row__data->__display__ : $__row__data->__display__;

                $data = new stdClass;
                $data->orcamento_servicos_orcamento_produto_id = $__row__data->__display__->produto_id ?? null;
                $data->orcamento_servicos_orcamento_id = $__row__data->__display__->id ?? null;
                $data->orcamento_servicos_orcamento_valor = $__row__data->__display__->valor ?? null;
                $data->orcamento_servicos_orcamento__row__id = $__row__data->__row__id;

                TForm::sendData(self::$formName, $data);
                TScript::create("
                   var element = $('#655b6d240ba48');
                   if(!element.attr('add')){
                       element.attr('add', base64_encode(element.html()));
                   }
                   element.html(\"<span><i class='far fa-edit' style='color:#478fca;padding-right:4px;'></i>Editar</span>\");
                   if(!element.attr('edit')){
                       element.attr('edit', base64_encode(element.html()));
                   }
                ");

        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
        }
    }

    public static function onDeleteDetailOrcamentoServicos($param = null) 
    {
        try
        {

                $__row__data = unserialize(base64_decode($param['__row__data']));

                $data = new stdClass;
                $data->orcamento_servicos_orcamento_produto_id = '';
                $data->orcamento_servicos_orcamento_id = '';
                $data->orcamento_servicos_orcamento_valor = '';
                $data->orcamento_servicos_orcamento__row__id = '';

                TForm::sendData(self::$formName, $data);

                TDataGrid::removeRowById('orcamento_servicos_orcamento_list', $__row__data->__row__id);

        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
        }
    }

    public static function onEditDetailOrcamentoProdutos($param = null) 
    {
        try
        {

                $__row__data = unserialize(base64_decode($param['__row__data']));
                $__row__data->__display__ = is_array($__row__data->__display__) ? (object) $__row__data->__display__ : $__row__data->__display__;

                $data = new stdClass;
                $data->orcamento_produtos_orcamento_produto_id = $__row__data->__display__->produto_id ?? null;
                $data->orcamento_produtos_orcamento_id = $__row__data->__display__->id ?? null;
                $data->orcamento_produtos_orcamento_quantidade = $__row__data->__display__->quantidade ?? null;
                $data->orcamento_produtos_orcamento_valor = $__row__data->__display__->valor ?? null;
                $data->orcamento_produtos_orcamento__row__id = $__row__data->__row__id;

                TForm::sendData(self::$formName, $data);
                TScript::create("
                   var element = $('#655b695b70c0d');
                   if(!element.attr('add')){
                       element.attr('add', base64_encode(element.html()));
                   }
                   element.html(\"<span><i class='far fa-edit' style='color:#478fca;padding-right:4px;'></i>Editar</span>\");
                   if(!element.attr('edit')){
                       element.attr('edit', base64_encode(element.html()));
                   }
                ");

        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
        }
    }

    public static function onDeleteDetailOrcamentoProdutos($param = null) 
    {
        try
        {

                $__row__data = unserialize(base64_decode($param['__row__data']));

                $data = new stdClass;
                $data->orcamento_produtos_orcamento_produto_id = '';
                $data->orcamento_produtos_orcamento_id = '';
                $data->orcamento_produtos_orcamento_quantidade = '';
                $data->orcamento_produtos_orcamento_valor = '';
                $data->orcamento_produtos_orcamento__row__id = '';

                TForm::sendData(self::$formName, $data);

                TDataGrid::removeRowById('orcamento_produtos_orcamento_list', $__row__data->__row__id);

        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
        }
    }

    public function onSave($param = null) 
    {
        try
        {
            TTransaction::open(self::$database); // open a transaction

            $messageAction = null;

            $this->form->validate(); // validate form data

            $object = new Orcamento(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->store(); // save the object 

            TForm::sendData(self::$formName, (object)['id' => $object->id]);

            $loadPageParam = [];

            if(!empty($param['target_container']))
            {
                $loadPageParam['target_container'] = $param['target_container'];
            }

            $orcamento_servicos_orcamento_items = $this->storeMasterDetailItems('OrcamentoServicos', 'orcamento_id', 'orcamento_servicos_orcamento', $object, $param['orcamento_servicos_orcamento_list___row__data'] ?? [], $this->form, $this->orcamento_servicos_orcamento_list, function($masterObject, $detailObject){ 

                //code here

            }, $this->orcamento_servicos_orcamento_criteria); 

            $orcamento_produtos_orcamento_items = $this->storeMasterDetailItems('OrcamentoProdutos', 'orcamento_id', 'orcamento_produtos_orcamento', $object, $param['orcamento_produtos_orcamento_list___row__data'] ?? [], $this->form, $this->orcamento_produtos_orcamento_list, function($masterObject, $detailObject){ 

                //code here

            }, $this->orcamento_produtos_orcamento_criteria); 

            // get the generated {PRIMARY_KEY}
            $data->id = $object->id; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            TToast::show('success', "Registro salvo", 'topRight', 'far:check-circle');
            TApplication::loadPage('OrcamentoList', 'onShow', $loadPageParam); 

                        TScript::create("Template.closeRightPanel();"); 
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

                $object = new Orcamento($key); // instantiates the Active Record 

                $orcamento_servicos_orcamento_items = $this->loadMasterDetailItems('OrcamentoServicos', 'orcamento_id', 'orcamento_servicos_orcamento', $object, $this->form, $this->orcamento_servicos_orcamento_list, $this->orcamento_servicos_orcamento_criteria, function($masterObject, $detailObject, $objectItems){ 

                    //code here

                }); 

                $orcamento_produtos_orcamento_items = $this->loadMasterDetailItems('OrcamentoProdutos', 'orcamento_id', 'orcamento_produtos_orcamento', $object, $this->form, $this->orcamento_produtos_orcamento_list, $this->orcamento_produtos_orcamento_criteria, function($masterObject, $detailObject, $objectItems){ 

                    //code here

                }); 

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

    }

    public function onShow($param = null)
    {

    } 

    public static function getFormName()
    {
        return self::$formName;
    }

}

