<?php

class PessoaForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'microerp';
    private static $activeRecord = 'Pessoa';
    private static $primaryKey = 'id';
    private static $formName = 'form_PessoaForm';

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
        $this->form->setFormTitle("Cadastro de pessoa");


        $id = new TEntry('id');
        $system_users_id = new TDBCombo('system_users_id', 'microerp', 'SystemUsers', 'id', '{name}','name asc'  );
        $documento = new TEntry('documento');
        $button_buscar_cnpj = new TButton('button_buscar_cnpj');
        $nome = new TEntry('nome');
        $tipo_cliente_id = new TDBCombo('tipo_cliente_id', 'microerp', 'TipoPessoa', 'id', '{nome}','nome asc'  );
        $telefone = new TEntry('telefone');
        $email = new TEntry('email');
        $observacao = new TText('observacao');
        $grupos = new TDBCheckGroup('grupos', 'microerp', 'GrupoPessoa', 'id', '{nome}','nome asc'  );
        $pessoa_endereco_pessoa_nome = new TEntry('pessoa_endereco_pessoa_nome');
        $pessoa_endereco_pessoa_id = new THidden('pessoa_endereco_pessoa_id');
        $pessoa_endereco_pessoa_principal = new TCombo('pessoa_endereco_pessoa_principal');
        $pessoa_endereco_pessoa_cep = new TEntry('pessoa_endereco_pessoa_cep');
        $button_buscar_pessoa_endereco_pessoa = new TButton('button_buscar_pessoa_endereco_pessoa');
        $pessoa_endereco_pessoa_cidade_estado_id = new TDBCombo('pessoa_endereco_pessoa_cidade_estado_id', 'microerp', 'Estado', 'id', '{nome}','nome asc'  );
        $pessoa_endereco_pessoa_cidade_id = new TCombo('pessoa_endereco_pessoa_cidade_id');
        $pessoa_endereco_pessoa_bairro = new TEntry('pessoa_endereco_pessoa_bairro');
        $pessoa_endereco_pessoa_rua = new TEntry('pessoa_endereco_pessoa_rua');
        $pessoa_endereco_pessoa_numero = new TEntry('pessoa_endereco_pessoa_numero');
        $pessoa_endereco_pessoa_complemento = new TEntry('pessoa_endereco_pessoa_complemento');
        $button_adicionar_pessoa_endereco_pessoa = new TButton('button_adicionar_pessoa_endereco_pessoa');
        $pessoa_contato_pessoa_nome = new TEntry('pessoa_contato_pessoa_nome');
        $pessoa_contato_pessoa_id = new THidden('pessoa_contato_pessoa_id');
        $pessoa_contato_pessoa_email = new TEntry('pessoa_contato_pessoa_email');
        $pessoa_contato_pessoa_telefone = new TEntry('pessoa_contato_pessoa_telefone');
        $pessoa_contato_pessoa_ramal = new TEntry('pessoa_contato_pessoa_ramal');
        $pessoa_contato_pessoa_observacao = new TText('pessoa_contato_pessoa_observacao');
        $button_adicionar_pessoa_contato_pessoa = new TButton('button_adicionar_pessoa_contato_pessoa');

        $pessoa_endereco_pessoa_cidade_estado_id->setChangeAction(new TAction([$this,'onChangepessoa_endereco_pessoa_cidade_estado_id']));

        $nome->addValidation("Nome", new TRequiredValidator()); 
        $tipo_cliente_id->addValidation("Tipo do cliente", new TRequiredValidator()); 
        $email->addValidation("Email", new TEmailValidator(), []); 

        $id->setEditable(false);
        $grupos->setLayout('horizontal');
        $grupos->setBreakItems(3);
        $pessoa_endereco_pessoa_principal->addItems(["T"=>"Sim","F"=>"Não"]);
        $email->setInnerIcon(new TImage('far:envelope #F44336'), 'right');
        $telefone->setInnerIcon(new TImage('fas:phone-alt #03A9F4'), 'right');
        $documento->setInnerIcon(new TImage('fas:address-card #3F51B5'), 'right');

        $telefone->setMask('(99) 9 9999-9999');
        $pessoa_endereco_pessoa_cep->setMask('99999-999');
        $pessoa_contato_pessoa_telefone->setMask('(99) 9 9999-9999');

        $button_buscar_cnpj->setAction(new TAction([$this, 'onBuscarCNPJ']), "Buscar CNPJ");
        $button_buscar_pessoa_endereco_pessoa->setAction(new TAction([$this, 'onBuscarCEP']), "Buscar");
        $button_adicionar_pessoa_contato_pessoa->setAction(new TAction([$this, 'onAddDetailPessoaContatoPessoa'],['static' => 1]), "Adicionar");
        $button_adicionar_pessoa_endereco_pessoa->setAction(new TAction([$this, 'onAddDetailPessoaEnderecoPessoa'],['static' => 1]), "Adicionar");

        $button_buscar_cnpj->addStyleClass('btn-default');
        $button_buscar_pessoa_endereco_pessoa->addStyleClass('btn-default');
        $button_adicionar_pessoa_contato_pessoa->addStyleClass('btn-default');
        $button_adicionar_pessoa_endereco_pessoa->addStyleClass('btn-default');

        $button_buscar_cnpj->setImage('fas:address-card #000000');
        $button_buscar_pessoa_endereco_pessoa->setImage('fas:search #2196F3');
        $button_adicionar_pessoa_contato_pessoa->setImage('fas:plus #2ecc71');
        $button_adicionar_pessoa_endereco_pessoa->setImage('fas:plus #2ecc71');

        $system_users_id->enableSearch();
        $tipo_cliente_id->enableSearch();
        $pessoa_endereco_pessoa_principal->enableSearch();
        $pessoa_endereco_pessoa_cidade_id->enableSearch();
        $pessoa_endereco_pessoa_cidade_estado_id->enableSearch();

        $nome->setMaxLength(255);
        $email->setMaxLength(255);
        $telefone->setMaxLength(20);
        $documento->setMaxLength(20);
        $pessoa_endereco_pessoa_cep->setMaxLength(10);
        $pessoa_endereco_pessoa_rua->setMaxLength(255);
        $pessoa_contato_pessoa_nome->setMaxLength(255);
        $pessoa_endereco_pessoa_nome->setMaxLength(255);
        $pessoa_contato_pessoa_email->setMaxLength(255);
        $pessoa_contato_pessoa_ramal->setMaxLength(100);
        $pessoa_endereco_pessoa_bairro->setMaxLength(255);
        $pessoa_endereco_pessoa_numero->setMaxLength(100);
        $pessoa_contato_pessoa_telefone->setMaxLength(20);
        $pessoa_endereco_pessoa_complemento->setMaxLength(255);

        $id->setSize(100);
        $grupos->setSize(200);
        $nome->setSize('100%');
        $email->setSize('100%');
        $telefone->setSize('100%');
        $observacao->setSize('100%', 70);
        $system_users_id->setSize('100%');
        $tipo_cliente_id->setSize('100%');
        $pessoa_contato_pessoa_id->setSize(200);
        $pessoa_endereco_pessoa_id->setSize(200);
        $documento->setSize('calc(100% - 140px)');
        $pessoa_endereco_pessoa_rua->setSize('100%');
        $pessoa_contato_pessoa_nome->setSize('100%');
        $pessoa_endereco_pessoa_nome->setSize('100%');
        $pessoa_contato_pessoa_email->setSize('100%');
        $pessoa_contato_pessoa_ramal->setSize('100%');
        $pessoa_endereco_pessoa_bairro->setSize('100%');
        $pessoa_endereco_pessoa_numero->setSize('100%');
        $pessoa_contato_pessoa_telefone->setSize('100%');
        $pessoa_endereco_pessoa_principal->setSize('100%');
        $pessoa_endereco_pessoa_cidade_id->setSize('100%');
        $pessoa_endereco_pessoa_complemento->setSize('100%');
        $pessoa_contato_pessoa_observacao->setSize('100%', 70);
        $pessoa_endereco_pessoa_cidade_estado_id->setSize('100%');
        $pessoa_endereco_pessoa_cep->setSize('calc(100% - 120px)');

        $button_adicionar_pessoa_contato_pessoa->id = '62a5ec2b0b75d';
        $button_adicionar_pessoa_endereco_pessoa->id = '62a5eff10b765';

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("Usuário do sistema:", null, '14px', null, '100%'),$system_users_id]);
        $row1->layout = ['col-sm-6','col-sm-6'];

        $row2 = $this->form->addContent([new TFormSeparator("Dados Gerais", '#333', '18', '#eee')]);
        $row3 = $this->form->addFields([new TLabel("Documento:", '#ff0000', '14px', null, '100%'),$documento,$button_buscar_cnpj]);
        $row3->layout = ['col-sm-6'];

        $row4 = $this->form->addFields([new TLabel("Nome:", '#ff0000', '14px', null, '100%'),$nome],[new TLabel("Tipo do cliente:", '#ff0000', '14px', null, '100%'),$tipo_cliente_id]);
        $row4->layout = ['col-sm-6','col-sm-6'];

        $row5 = $this->form->addFields([new TLabel("Telefone:", null, '14px', null, '100%'),$telefone],[new TLabel("Email:", null, '14px', null, '100%'),$email]);
        $row5->layout = ['col-sm-6','col-sm-6'];

        $row6 = $this->form->addFields([new TLabel("Observações:", null, '14px', null, '100%'),$observacao]);
        $row6->layout = [' col-sm-12'];

        $row7 = $this->form->addFields([new TLabel("Grupos:", null, '14px', null, '100%'),$grupos]);
        $row7->layout = [' col-sm-12'];

        $tab_62a73192d0a5c = new BootstrapFormBuilder('tab_62a73192d0a5c');
        $this->tab_62a73192d0a5c = $tab_62a73192d0a5c;
        $tab_62a73192d0a5c->setProperty('style', 'border:none; box-shadow:none;');

        $tab_62a73192d0a5c->appendPage("Endereços");

        $tab_62a73192d0a5c->addFields([new THidden('current_tab_tab_62a73192d0a5c')]);
        $tab_62a73192d0a5c->setTabFunction("$('[name=current_tab_tab_62a73192d0a5c]').val($(this).attr('data-current_page'));");

        $this->detailFormPessoaEnderecoPessoa = new BootstrapFormBuilder('detailFormPessoaEnderecoPessoa');
        $this->detailFormPessoaEnderecoPessoa->setProperty('style', 'border:none; box-shadow:none; width:100%;');

        $this->detailFormPessoaEnderecoPessoa->setProperty('class', 'form-horizontal builder-detail-form');

        $row8 = $this->detailFormPessoaEnderecoPessoa->addFields([new TLabel("Nome:", '#ff0000', '14px', null, '100%'),$pessoa_endereco_pessoa_nome,$pessoa_endereco_pessoa_id],[new TLabel("Principal:", null, '14px', null, '100%'),$pessoa_endereco_pessoa_principal]);
        $row8->layout = [' col-sm-6','col-sm-6'];

        $row9 = $this->detailFormPessoaEnderecoPessoa->addFields([new TLabel("CEP:", '#ff0000', '14px', null, '100%'),$pessoa_endereco_pessoa_cep,$button_buscar_pessoa_endereco_pessoa],[]);
        $row9->layout = ['col-sm-6','col-sm-6'];

        $row10 = $this->detailFormPessoaEnderecoPessoa->addFields([new TLabel("Estado:", '#FF0000', '14px', null, '100%'),$pessoa_endereco_pessoa_cidade_estado_id],[new TLabel("Cidade:", '#ff0000', '14px', null, '100%'),$pessoa_endereco_pessoa_cidade_id]);
        $row10->layout = ['col-sm-6','col-sm-6'];

        $row11 = $this->detailFormPessoaEnderecoPessoa->addFields([new TLabel("Bairro:", '#ff0000', '14px', null, '100%'),$pessoa_endereco_pessoa_bairro],[new TLabel("Rua:", '#ff0000', '14px', null, '100%'),$pessoa_endereco_pessoa_rua]);
        $row11->layout = ['col-sm-6','col-sm-6'];

        $row12 = $this->detailFormPessoaEnderecoPessoa->addFields([new TLabel("Número:", '#ff0000', '14px', null, '100%'),$pessoa_endereco_pessoa_numero],[new TLabel("Complemento:", null, '14px', null, '100%'),$pessoa_endereco_pessoa_complemento]);
        $row12->layout = ['col-sm-6','col-sm-6'];

        $row13 = $this->detailFormPessoaEnderecoPessoa->addFields([$button_adicionar_pessoa_endereco_pessoa]);
        $row13->layout = [' col-sm-12'];

        $row14 = $this->detailFormPessoaEnderecoPessoa->addFields([new THidden('pessoa_endereco_pessoa__row__id')]);
        $this->pessoa_endereco_pessoa_criteria = new TCriteria();

        $this->pessoa_endereco_pessoa_list = new BootstrapDatagridWrapper(new TDataGrid);
        $this->pessoa_endereco_pessoa_list->disableHtmlConversion();;
        $this->pessoa_endereco_pessoa_list->generateHiddenFields();
        $this->pessoa_endereco_pessoa_list->setId('pessoa_endereco_pessoa_list');

        $this->pessoa_endereco_pessoa_list->style = 'width:100%';
        $this->pessoa_endereco_pessoa_list->class .= ' table-bordered';

        $column_pessoa_endereco_pessoa_nome = new TDataGridColumn('nome', "Nome", 'left');
        $column_pessoa_endereco_pessoa_cidade_nome = new TDataGridColumn('cidade->nome', "Cidade", 'left');
        $column_pessoa_endereco_pessoa_bairro = new TDataGridColumn('bairro', "Bairro", 'left');
        $column_pessoa_endereco_pessoa_cep = new TDataGridColumn('cep', "CEP", 'left');
        $column_pessoa_endereco_pessoa_rua = new TDataGridColumn('rua', "Rua", 'left');
        $column_pessoa_endereco_pessoa_numero = new TDataGridColumn('numero', "Número", 'left');
        $column_pessoa_endereco_pessoa_complemento = new TDataGridColumn('complemento', "Complemento", 'left');
        $column_pessoa_endereco_pessoa_principal_transformed = new TDataGridColumn('principal', "Principal", 'left');

        $column_pessoa_endereco_pessoa__row__data = new TDataGridColumn('__row__data', '', 'center');
        $column_pessoa_endereco_pessoa__row__data->setVisibility(false);

        $action_onEditDetailPessoaEndereco = new TDataGridAction(array('PessoaForm', 'onEditDetailPessoaEndereco'));
        $action_onEditDetailPessoaEndereco->setUseButton(false);
        $action_onEditDetailPessoaEndereco->setButtonClass('btn btn-default btn-sm');
        $action_onEditDetailPessoaEndereco->setLabel("Editar");
        $action_onEditDetailPessoaEndereco->setImage('far:edit #478fca');
        $action_onEditDetailPessoaEndereco->setFields(['__row__id', '__row__data']);

        $this->pessoa_endereco_pessoa_list->addAction($action_onEditDetailPessoaEndereco);
        $action_onDeleteDetailPessoaEndereco = new TDataGridAction(array('PessoaForm', 'onDeleteDetailPessoaEndereco'));
        $action_onDeleteDetailPessoaEndereco->setUseButton(false);
        $action_onDeleteDetailPessoaEndereco->setButtonClass('btn btn-default btn-sm');
        $action_onDeleteDetailPessoaEndereco->setLabel("Excluir");
        $action_onDeleteDetailPessoaEndereco->setImage('fas:trash-alt #dd5a43');
        $action_onDeleteDetailPessoaEndereco->setFields(['__row__id', '__row__data']);

        $this->pessoa_endereco_pessoa_list->addAction($action_onDeleteDetailPessoaEndereco);

        $this->pessoa_endereco_pessoa_list->addColumn($column_pessoa_endereco_pessoa_nome);
        $this->pessoa_endereco_pessoa_list->addColumn($column_pessoa_endereco_pessoa_cidade_nome);
        $this->pessoa_endereco_pessoa_list->addColumn($column_pessoa_endereco_pessoa_bairro);
        $this->pessoa_endereco_pessoa_list->addColumn($column_pessoa_endereco_pessoa_cep);
        $this->pessoa_endereco_pessoa_list->addColumn($column_pessoa_endereco_pessoa_rua);
        $this->pessoa_endereco_pessoa_list->addColumn($column_pessoa_endereco_pessoa_numero);
        $this->pessoa_endereco_pessoa_list->addColumn($column_pessoa_endereco_pessoa_complemento);
        $this->pessoa_endereco_pessoa_list->addColumn($column_pessoa_endereco_pessoa_principal_transformed);

        $this->pessoa_endereco_pessoa_list->addColumn($column_pessoa_endereco_pessoa__row__data);

        $this->pessoa_endereco_pessoa_list->createModel();
        $tableResponsiveDiv = new TElement('div');
        $tableResponsiveDiv->class = 'table-responsive';
        $tableResponsiveDiv->add($this->pessoa_endereco_pessoa_list);
        $this->detailFormPessoaEnderecoPessoa->addContent([$tableResponsiveDiv]);

        $column_pessoa_endereco_pessoa_principal_transformed->setTransformer(function($value, $object, $row, $cell = null, $last_row = null)
        {
            if($value === true || $value == 't' || $value === 1 || $value == '1' || $value == 's' || $value == 'S' || $value == 'T')
            {
                return 'Sim';
            }
            elseif($value === false || $value == 'f' || $value === 0 || $value == '0' || $value == 'n' || $value == 'N' || $value == 'F')   
            {
                return 'Não';
            }

            return $value;

        });        $row15 = $tab_62a73192d0a5c->addFields([$this->detailFormPessoaEnderecoPessoa]);
        $row15->layout = [' col-sm-12'];

        $tab_62a73192d0a5c->appendPage("Contatos");

        $this->detailFormPessoaContatoPessoa = new BootstrapFormBuilder('detailFormPessoaContatoPessoa');
        $this->detailFormPessoaContatoPessoa->setProperty('style', 'border:none; box-shadow:none; width:100%;');

        $this->detailFormPessoaContatoPessoa->setProperty('class', 'form-horizontal builder-detail-form');

        $row16 = $this->detailFormPessoaContatoPessoa->addFields([new TLabel("Nome:", null, '14px', null, '100%'),$pessoa_contato_pessoa_nome,$pessoa_contato_pessoa_id],[new TLabel("Email:", null, '14px', null, '100%'),$pessoa_contato_pessoa_email]);
        $row16->layout = ['col-sm-6','col-sm-6'];

        $row17 = $this->detailFormPessoaContatoPessoa->addFields([new TLabel("Telefone:", null, '14px', null, '100%'),$pessoa_contato_pessoa_telefone],[new TLabel("Ramal:", null, '14px', null, '100%'),$pessoa_contato_pessoa_ramal]);
        $row17->layout = ['col-sm-6','col-sm-6'];

        $row18 = $this->detailFormPessoaContatoPessoa->addFields([new TLabel("Observacao:", null, '14px', null, '100%'),$pessoa_contato_pessoa_observacao]);
        $row18->layout = [' col-sm-12'];

        $row19 = $this->detailFormPessoaContatoPessoa->addFields([$button_adicionar_pessoa_contato_pessoa]);
        $row19->layout = [' col-sm-12'];

        $row20 = $this->detailFormPessoaContatoPessoa->addFields([new THidden('pessoa_contato_pessoa__row__id')]);
        $this->pessoa_contato_pessoa_criteria = new TCriteria();

        $this->pessoa_contato_pessoa_list = new BootstrapDatagridWrapper(new TDataGrid);
        $this->pessoa_contato_pessoa_list->disableHtmlConversion();;
        $this->pessoa_contato_pessoa_list->generateHiddenFields();
        $this->pessoa_contato_pessoa_list->setId('pessoa_contato_pessoa_list');

        $this->pessoa_contato_pessoa_list->style = 'width:100%';
        $this->pessoa_contato_pessoa_list->class .= ' table-bordered';

        $column_pessoa_contato_pessoa_nome = new TDataGridColumn('nome', "Nome", 'left');
        $column_pessoa_contato_pessoa_email = new TDataGridColumn('email', "Email", 'left');
        $column_pessoa_contato_pessoa_telefone = new TDataGridColumn('telefone', "Telefone", 'left');
        $column_pessoa_contato_pessoa_ramal = new TDataGridColumn('ramal', "Ramal", 'left');

        $column_pessoa_contato_pessoa__row__data = new TDataGridColumn('__row__data', '', 'center');
        $column_pessoa_contato_pessoa__row__data->setVisibility(false);

        $action_onEditDetailPessoaContato = new TDataGridAction(array('PessoaForm', 'onEditDetailPessoaContato'));
        $action_onEditDetailPessoaContato->setUseButton(false);
        $action_onEditDetailPessoaContato->setButtonClass('btn btn-default btn-sm');
        $action_onEditDetailPessoaContato->setLabel("Editar");
        $action_onEditDetailPessoaContato->setImage('far:edit #478fca');
        $action_onEditDetailPessoaContato->setFields(['__row__id', '__row__data']);

        $this->pessoa_contato_pessoa_list->addAction($action_onEditDetailPessoaContato);
        $action_onDeleteDetailPessoaContato = new TDataGridAction(array('PessoaForm', 'onDeleteDetailPessoaContato'));
        $action_onDeleteDetailPessoaContato->setUseButton(false);
        $action_onDeleteDetailPessoaContato->setButtonClass('btn btn-default btn-sm');
        $action_onDeleteDetailPessoaContato->setLabel("Excluir");
        $action_onDeleteDetailPessoaContato->setImage('fas:trash-alt #dd5a43');
        $action_onDeleteDetailPessoaContato->setFields(['__row__id', '__row__data']);

        $this->pessoa_contato_pessoa_list->addAction($action_onDeleteDetailPessoaContato);

        $this->pessoa_contato_pessoa_list->addColumn($column_pessoa_contato_pessoa_nome);
        $this->pessoa_contato_pessoa_list->addColumn($column_pessoa_contato_pessoa_email);
        $this->pessoa_contato_pessoa_list->addColumn($column_pessoa_contato_pessoa_telefone);
        $this->pessoa_contato_pessoa_list->addColumn($column_pessoa_contato_pessoa_ramal);

        $this->pessoa_contato_pessoa_list->addColumn($column_pessoa_contato_pessoa__row__data);

        $this->pessoa_contato_pessoa_list->createModel();
        $tableResponsiveDiv = new TElement('div');
        $tableResponsiveDiv->class = 'table-responsive';
        $tableResponsiveDiv->add($this->pessoa_contato_pessoa_list);
        $this->detailFormPessoaContatoPessoa->addContent([$tableResponsiveDiv]);
        $row21 = $tab_62a73192d0a5c->addFields([$this->detailFormPessoaContatoPessoa]);
        $row21->layout = [' col-sm-12'];

        $row22 = $this->form->addFields([$tab_62a73192d0a5c]);
        $row22->layout = [' col-sm-12'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave'],['static' => 1]), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['PessoaList', 'onShow']), 'fas:arrow-left #000000');
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

        $style = new TStyle('right-panel > .container-part[page-name=PessoaForm]');
        $style->width = '70% !important';   
        $style->show(true);

    }

    public static function onChangepessoa_endereco_pessoa_cidade_estado_id($param)
    {
        try
        {

            if (isset($param['pessoa_endereco_pessoa_cidade_estado_id']) && $param['pessoa_endereco_pessoa_cidade_estado_id'])
            { 
                $criteria = TCriteria::create(['estado_id' => $param['pessoa_endereco_pessoa_cidade_estado_id']]);
                TDBCombo::reloadFromModel(self::$formName, 'pessoa_endereco_pessoa_cidade_id', 'microerp', 'Cidade', 'id', '{nome}', 'nome asc', $criteria, TRUE); 
            } 
            else 
            { 
                TCombo::clearField(self::$formName, 'pessoa_endereco_pessoa_cidade_id'); 
            }  

        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    } 

    public static function onBuscarCNPJ($param = null) 
    {
        try 
        {

            if($param['tipo_cliente_id'] != TipoCliente::JURIDICA)
            {
                throw new Exception('A busca de CNPJ é apenas para pessoa júridica ');
            }

            TTransaction::open(self::$database);
            $dados = CNPJService::get($param['documento']);

            if(!$dados)
            {
                throw new Exception('CNPJ não encontrado');
            }
            // iremos recarregar a combo de estado, pois pode ser que o estado encontrado para aquele CNPJ
            // ainda não foi cadastrado no sistema
            TCombo::reload(self::$formName, 'pessoa_endereco_pessoa_cidade_estado_id', Estado::getIndexedArray('id', 'nome'), true);

            TTransaction::close();

            $object = new stdClass();

            // dados principais
            $object->nome = $dados->razao_social;
            $object->telefone = $dados->ddd_telefone_1;

            // dados relacionados ao endereço
            $object->pessoa_endereco_pessoa_cep = $dados->cep;
            $object->pessoa_endereco_pessoa_rua = $dados->logradouro;
            $object->pessoa_endereco_pessoa_bairro = $dados->bairro;
            $object->pessoa_endereco_pessoa_numero = $dados->numero;
            $object->pessoa_endereco_pessoa_complemento = $dados->complemento;
            $object->pessoa_endereco_pessoa_cidade_estado_id = $dados->estado_id;
            $object->pessoa_endereco_pessoa_cidade_id = $dados->cidade_id;

            TForm::sendData(self::$formName, $object);

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public static function onBuscarCEP($param = null) 
    {
        try 
        {
            if(!empty($param['pessoa_endereco_pessoa_cep']))
            {
                TTransaction::open(self::$database);
                $dadosCep = CEPService::get($param['pessoa_endereco_pessoa_cep']);
                TTransaction::close();

                if($dadosCep)
                {
                    $object = new stdClass();
                    $object->pessoa_endereco_pessoa_cidade_estado_id = $dadosCep->estado_id;
                    $object->pessoa_endereco_pessoa_cidade_id = $dadosCep->cidade_id;
                    $object->pessoa_endereco_pessoa_rua = $dadosCep->rua;
                    $object->pessoa_endereco_pessoa_bairro = $dadosCep->bairro;

                    TDBCombo::reloadFromModel(self::$formName, 'pessoa_endereco_pessoa_cidade_estado_id', self::$database, 'Estado', 'id', '{nome}', 'nome', null, true);

                    TForm::sendData(self::$formName, $object);    
                }
                else
                {
                    $object = new stdClass();
                    $object->pessoa_endereco_pessoa_cidade_estado_id = '';
                    $object->pessoa_endereco_pessoa_cidade_id = '';
                    $object->pessoa_endereco_pessoa_rua = '';
                    $object->pessoa_endereco_pessoa_bairro = '';

                    TForm::sendData(self::$formName, $object);    
                }
            }

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onAddDetailPessoaEnderecoPessoa($param = null) 
    {
        try
        {
            $data = $this->form->getData();

            $errors = [];
            $requiredFields = [];
            $requiredFields[] = ['label'=>"Nome", 'name'=>"pessoa_endereco_pessoa_nome", 'class'=>'TRequiredValidator', 'value'=>[]];
            $requiredFields[] = ['label'=>"CEP", 'name'=>"pessoa_endereco_pessoa_cep", 'class'=>'TRequiredValidator', 'value'=>[]];
            $requiredFields[] = ['label'=>"Cidade id", 'name'=>"pessoa_endereco_pessoa_cidade_id", 'class'=>'TRequiredValidator', 'value'=>[]];
            $requiredFields[] = ['label'=>"Bairro", 'name'=>"pessoa_endereco_pessoa_bairro", 'class'=>'TRequiredValidator', 'value'=>[]];
            $requiredFields[] = ['label'=>"Rua", 'name'=>"pessoa_endereco_pessoa_rua", 'class'=>'TRequiredValidator', 'value'=>[]];
            $requiredFields[] = ['label'=>"Número", 'name'=>"pessoa_endereco_pessoa_numero", 'class'=>'TRequiredValidator', 'value'=>[]];
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

            $__row__id = !empty($data->pessoa_endereco_pessoa__row__id) ? $data->pessoa_endereco_pessoa__row__id : 'b'.uniqid();

            TTransaction::open(self::$database);

            $grid_data = new PessoaEndereco();
            $grid_data->__row__id = $__row__id;
            $grid_data->nome = $data->pessoa_endereco_pessoa_nome;
            $grid_data->id = $data->pessoa_endereco_pessoa_id;
            $grid_data->principal = $data->pessoa_endereco_pessoa_principal;
            $grid_data->cep = $data->pessoa_endereco_pessoa_cep;
            $grid_data->cidade_estado_id = $data->pessoa_endereco_pessoa_cidade_estado_id;
            $grid_data->cidade_id = $data->pessoa_endereco_pessoa_cidade_id;
            $grid_data->bairro = $data->pessoa_endereco_pessoa_bairro;
            $grid_data->rua = $data->pessoa_endereco_pessoa_rua;
            $grid_data->numero = $data->pessoa_endereco_pessoa_numero;
            $grid_data->complemento = $data->pessoa_endereco_pessoa_complemento;

            $__row__data = array_merge($grid_data->toArray(), (array)$grid_data->getVirtualData());
            $__row__data['__row__id'] = $__row__id;
            $__row__data['__display__']['nome'] =  $param['pessoa_endereco_pessoa_nome'] ?? null;
            $__row__data['__display__']['id'] =  $param['pessoa_endereco_pessoa_id'] ?? null;
            $__row__data['__display__']['principal'] =  $param['pessoa_endereco_pessoa_principal'] ?? null;
            $__row__data['__display__']['cep'] =  $param['pessoa_endereco_pessoa_cep'] ?? null;
            $__row__data['__display__']['cidade_estado_id'] =  $param['pessoa_endereco_pessoa_cidade_estado_id'] ?? null;
            $__row__data['__display__']['cidade_id'] =  $param['pessoa_endereco_pessoa_cidade_id'] ?? null;
            $__row__data['__display__']['bairro'] =  $param['pessoa_endereco_pessoa_bairro'] ?? null;
            $__row__data['__display__']['rua'] =  $param['pessoa_endereco_pessoa_rua'] ?? null;
            $__row__data['__display__']['numero'] =  $param['pessoa_endereco_pessoa_numero'] ?? null;
            $__row__data['__display__']['complemento'] =  $param['pessoa_endereco_pessoa_complemento'] ?? null;

            $grid_data->__row__data = base64_encode(serialize((object)$__row__data));
            $row = $this->pessoa_endereco_pessoa_list->addItem($grid_data);
            $row->id = $grid_data->__row__id;

            TDataGrid::replaceRowById('pessoa_endereco_pessoa_list', $grid_data->__row__id, $row);

            TTransaction::close();

            $data = new stdClass;
            $data->pessoa_endereco_pessoa_nome = '';
            $data->pessoa_endereco_pessoa_id = '';
            $data->pessoa_endereco_pessoa_principal = '';
            $data->pessoa_endereco_pessoa_cep = '';
            $data->pessoa_endereco_pessoa_cidade_estado_id = '';
            $data->pessoa_endereco_pessoa_cidade_id = '';
            $data->pessoa_endereco_pessoa_bairro = '';
            $data->pessoa_endereco_pessoa_rua = '';
            $data->pessoa_endereco_pessoa_numero = '';
            $data->pessoa_endereco_pessoa_complemento = '';
            $data->pessoa_endereco_pessoa__row__id = '';

            TForm::sendData(self::$formName, $data);
            TScript::create("
               var element = $('#62a5eff10b765');
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

    public  function onAddDetailPessoaContatoPessoa($param = null) 
    {
        try
        {
            $data = $this->form->getData();

            $__row__id = !empty($data->pessoa_contato_pessoa__row__id) ? $data->pessoa_contato_pessoa__row__id : 'b'.uniqid();

            TTransaction::open(self::$database);

            $grid_data = new PessoaContato();
            $grid_data->__row__id = $__row__id;
            $grid_data->nome = $data->pessoa_contato_pessoa_nome;
            $grid_data->id = $data->pessoa_contato_pessoa_id;
            $grid_data->email = $data->pessoa_contato_pessoa_email;
            $grid_data->telefone = $data->pessoa_contato_pessoa_telefone;
            $grid_data->ramal = $data->pessoa_contato_pessoa_ramal;
            $grid_data->observacao = $data->pessoa_contato_pessoa_observacao;

            $__row__data = array_merge($grid_data->toArray(), (array)$grid_data->getVirtualData());
            $__row__data['__row__id'] = $__row__id;
            $__row__data['__display__']['nome'] =  $param['pessoa_contato_pessoa_nome'] ?? null;
            $__row__data['__display__']['id'] =  $param['pessoa_contato_pessoa_id'] ?? null;
            $__row__data['__display__']['email'] =  $param['pessoa_contato_pessoa_email'] ?? null;
            $__row__data['__display__']['telefone'] =  $param['pessoa_contato_pessoa_telefone'] ?? null;
            $__row__data['__display__']['ramal'] =  $param['pessoa_contato_pessoa_ramal'] ?? null;
            $__row__data['__display__']['observacao'] =  $param['pessoa_contato_pessoa_observacao'] ?? null;

            $grid_data->__row__data = base64_encode(serialize((object)$__row__data));
            $row = $this->pessoa_contato_pessoa_list->addItem($grid_data);
            $row->id = $grid_data->__row__id;

            TDataGrid::replaceRowById('pessoa_contato_pessoa_list', $grid_data->__row__id, $row);

            TTransaction::close();

            $data = new stdClass;
            $data->pessoa_contato_pessoa_nome = '';
            $data->pessoa_contato_pessoa_id = '';
            $data->pessoa_contato_pessoa_email = '';
            $data->pessoa_contato_pessoa_telefone = '';
            $data->pessoa_contato_pessoa_ramal = '';
            $data->pessoa_contato_pessoa_observacao = '';
            $data->pessoa_contato_pessoa__row__id = '';

            TForm::sendData(self::$formName, $data);
            TScript::create("
               var element = $('#62a5ec2b0b75d');
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

    public static function onEditDetailPessoaEndereco($param = null) 
    {
        try
        {

            $__row__data = unserialize(base64_decode($param['__row__data']));
            $__row__data->__display__ = is_array($__row__data->__display__) ? (object) $__row__data->__display__ : $__row__data->__display__;

            $data = new stdClass;
            $data->pessoa_endereco_pessoa_nome = $__row__data->__display__->nome ?? null;
            $data->pessoa_endereco_pessoa_id = $__row__data->__display__->id ?? null;
            $data->pessoa_endereco_pessoa_principal = $__row__data->__display__->principal ?? null;
            $data->pessoa_endereco_pessoa_cep = $__row__data->__display__->cep ?? null;
            $data->pessoa_endereco_pessoa_cidade_estado_id = $__row__data->__display__->cidade_estado_id ?? null;
            $data->pessoa_endereco_pessoa_cidade_id = $__row__data->__display__->cidade_id ?? null;
            $data->pessoa_endereco_pessoa_bairro = $__row__data->__display__->bairro ?? null;
            $data->pessoa_endereco_pessoa_rua = $__row__data->__display__->rua ?? null;
            $data->pessoa_endereco_pessoa_numero = $__row__data->__display__->numero ?? null;
            $data->pessoa_endereco_pessoa_complemento = $__row__data->__display__->complemento ?? null;
            $data->pessoa_endereco_pessoa__row__id = $__row__data->__row__id;

            TForm::sendData(self::$formName, $data);
            TScript::create("
               var element = $('#62a5eff10b765');
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
    public static function onDeleteDetailPessoaEndereco($param = null) 
    {
        try
        {

            $__row__data = unserialize(base64_decode($param['__row__data']));

            $data = new stdClass;
            $data->pessoa_endereco_pessoa_nome = '';
            $data->pessoa_endereco_pessoa_id = '';
            $data->pessoa_endereco_pessoa_principal = '';
            $data->pessoa_endereco_pessoa_cep = '';
            $data->pessoa_endereco_pessoa_cidade_estado_id = '';
            $data->pessoa_endereco_pessoa_cidade_id = '';
            $data->pessoa_endereco_pessoa_bairro = '';
            $data->pessoa_endereco_pessoa_rua = '';
            $data->pessoa_endereco_pessoa_numero = '';
            $data->pessoa_endereco_pessoa_complemento = '';
            $data->pessoa_endereco_pessoa__row__id = '';

            TForm::sendData(self::$formName, $data);

            TDataGrid::removeRowById('pessoa_endereco_pessoa_list', $__row__data->__row__id);

        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
        }
    }
    public static function onEditDetailPessoaContato($param = null) 
    {
        try
        {

            $__row__data = unserialize(base64_decode($param['__row__data']));
            $__row__data->__display__ = is_array($__row__data->__display__) ? (object) $__row__data->__display__ : $__row__data->__display__;

            $data = new stdClass;
            $data->pessoa_contato_pessoa_nome = $__row__data->__display__->nome ?? null;
            $data->pessoa_contato_pessoa_id = $__row__data->__display__->id ?? null;
            $data->pessoa_contato_pessoa_email = $__row__data->__display__->email ?? null;
            $data->pessoa_contato_pessoa_telefone = $__row__data->__display__->telefone ?? null;
            $data->pessoa_contato_pessoa_ramal = $__row__data->__display__->ramal ?? null;
            $data->pessoa_contato_pessoa_observacao = $__row__data->__display__->observacao ?? null;
            $data->pessoa_contato_pessoa__row__id = $__row__data->__row__id;

            TForm::sendData(self::$formName, $data);
            TScript::create("
               var element = $('#62a5ec2b0b75d');
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
    public static function onDeleteDetailPessoaContato($param = null) 
    {
        try
        {

            $__row__data = unserialize(base64_decode($param['__row__data']));

            $data = new stdClass;
            $data->pessoa_contato_pessoa_nome = '';
            $data->pessoa_contato_pessoa_id = '';
            $data->pessoa_contato_pessoa_email = '';
            $data->pessoa_contato_pessoa_telefone = '';
            $data->pessoa_contato_pessoa_ramal = '';
            $data->pessoa_contato_pessoa_observacao = '';
            $data->pessoa_contato_pessoa__row__id = '';

            TForm::sendData(self::$formName, $data);

            TDataGrid::removeRowById('pessoa_contato_pessoa_list', $__row__data->__row__id);

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

            $object = new Pessoa(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->store(); // save the object 

            $this->fireEvents($object);

            $repository = PessoaGrupo::where('pessoa_id', '=', $object->id);
            $repository->delete(); 

            if ($data->grupos) 
            {
                foreach ($data->grupos as $grupos_value) 
                {
                    $pessoa_grupo = new PessoaGrupo;

                    $pessoa_grupo->grupo_pessoa_id = $grupos_value;
                    $pessoa_grupo->pessoa_id = $object->id;
                    $pessoa_grupo->store();
                }
            }

            TForm::sendData(self::$formName, (object)['id' => $object->id]);

            $loadPageParam = [];

            if(!empty($param['target_container']))
            {
                $loadPageParam['target_container'] = $param['target_container'];
            }

            $pessoa_endereco_pessoa_items = $this->storeMasterDetailItems('PessoaEndereco', 'pessoa_id', 'pessoa_endereco_pessoa', $object, $param['pessoa_endereco_pessoa_list___row__data'] ?? [], $this->form, $this->pessoa_endereco_pessoa_list, function($masterObject, $detailObject){ 

                //code here

            }, $this->pessoa_endereco_pessoa_criteria); 

            $pessoa_contato_pessoa_items = $this->storeMasterDetailItems('PessoaContato', 'pessoa_id', 'pessoa_contato_pessoa', $object, $param['pessoa_contato_pessoa_list___row__data'] ?? [], $this->form, $this->pessoa_contato_pessoa_list, function($masterObject, $detailObject){ 

                //code here

            }, $this->pessoa_contato_pessoa_criteria); 

            // get the generated {PRIMARY_KEY}
            $data->id = $object->id; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            TToast::show('success', "Registro salvo", 'topRight', 'far:check-circle');
            TApplication::loadPage('PessoaList', 'onShow', $loadPageParam); 

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

                $object = new Pessoa($key); // instantiates the Active Record 

                $object->grupos = PessoaGrupo::where('pessoa_id', '=', $object->id)->getIndexedArray('grupo_pessoa_id', 'grupo_pessoa_id');

                $pessoa_endereco_pessoa_items = $this->loadMasterDetailItems('PessoaEndereco', 'pessoa_id', 'pessoa_endereco_pessoa', $object, $this->form, $this->pessoa_endereco_pessoa_list, $this->pessoa_endereco_pessoa_criteria, function($masterObject, $detailObject, $objectItems){ 

                    //code here

                    $objectItems->pessoa_endereco_pessoa_cidade_estado_id = null;
                    if(isset($detailObject->cidade->estado_id) && $detailObject->cidade->estado_id)
                    {
                        $objectItems->__display__->cidade_estado_id = $detailObject->cidade->estado_id;
                    }

                    $objectItems->pessoa_endereco_pessoa_cidade_id = null;
                    if(isset($detailObject->cidade_id) && $detailObject->cidade_id)
                    {
                        $objectItems->__display__->cidade_id = $detailObject->cidade_id;
                    }

                }); 

                $pessoa_contato_pessoa_items = $this->loadMasterDetailItems('PessoaContato', 'pessoa_id', 'pessoa_contato_pessoa', $object, $this->form, $this->pessoa_contato_pessoa_list, $this->pessoa_contato_pessoa_criteria, function($masterObject, $detailObject, $objectItems){ 

                    //code here

                }); 

                $this->form->setData($object); // fill the form 

                $this->fireEvents($object);

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

    public function fireEvents( $object )
    {
        $obj = new stdClass;
        if(is_object($object) && get_class($object) == 'stdClass')
        {
            if(isset($object->pessoa_endereco_pessoa_cidade_estado_id))
            {
                $value = $object->pessoa_endereco_pessoa_cidade_estado_id;

                $obj->pessoa_endereco_pessoa_cidade_estado_id = $value;
            }
            if(isset($object->pessoa_endereco_pessoa_cidade_id))
            {
                $value = $object->pessoa_endereco_pessoa_cidade_id;

                $obj->pessoa_endereco_pessoa_cidade_id = $value;
            }
        }
        elseif(is_object($object))
        {
            if(isset($object->pessoa_endereco->pessoa->cidade->estado_id))
            {
                $value = $object->pessoa_endereco->pessoa->cidade->estado_id;

                $obj->pessoa_endereco_pessoa_cidade_estado_id = $value;
            }
            if(isset($object->pessoa_endereco->pessoa->cidade_id))
            {
                $value = $object->pessoa_endereco->pessoa->cidade_id;

                $obj->pessoa_endereco_pessoa_cidade_id = $value;
            }
        }
        TForm::sendData(self::$formName, $obj);
    }  

    public static function getFormName()
    {
        return self::$formName;
    }

}

