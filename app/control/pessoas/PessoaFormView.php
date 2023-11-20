<?php

class PessoaFormView extends TPage
{
    protected $form; // form
    private static $database = 'microerp';
    private static $activeRecord = 'Pessoa';
    private static $primaryKey = 'id';
    private static $formName = 'formView_Pessoa';

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

        $pessoa = new Pessoa($param['key']);
        // define the form title
        $this->form->setFormTitle("Consulta de Pessoa");

        $label2 = new TLabel("Id:", '', '14px', 'B', '100%');
        $text1 = new TTextDisplay($pessoa->id, '', '16px', '');
        $label4 = new TLabel("Criado em:", '', '14px', 'B', '100%');
        $text9 = new TTextDisplay(TDateTime::convertToMask($pessoa->created_at, 'yyyy-mm-dd hh:ii', 'dd/mm/yyyy hh:ii'), '', '14px', '');
        $label6 = new TLabel("Atualizado em:", '', '14px', 'B', '100%');
        $text10 = new TTextDisplay(TDateTime::convertToMask($pessoa->updated_at, 'yyyy-mm-dd hh:ii', 'dd/mm/yyyy hh:ii'), '', '14px', '');
        $label8 = new TLabel("Nome:", '', '14px', 'B', '100%');
        $text4 = new TTextDisplay($pessoa->nome, '', '16px', '');
        $label10 = new TLabel("Tipo do cliente:", '', '14px', 'B', '100%');
        $text2 = new TTextDisplay($pessoa->tipo_cliente->nome, '', '16px', '');
        $label12 = new TLabel("Usuário do sistema:", '', '14px', 'B', '100%');
        $text3 = new TTextDisplay($pessoa->system_users->name, '', '16px', '');
        $label14 = new TLabel(new TImage('fas:address-card #673AB7')."Documento:", '', '14px', 'B', '100%');
        $text5 = new TTextDisplay($pessoa->documento, '', '16px', '');
        $label16 = new TLabel("Email:", '', '14px', 'B', '100%');
        $text8 = new TTextDisplay(new TImage('far:envelope #F44336').$pessoa->email, '', '14px', '');
        $label18 = new TLabel("Telefone:", '', '14px', 'B', '100%');
        $text7 = new TTextDisplay(new TImage('fas:phone-alt #2196F3').$pessoa->telefone, '', '16px', '');
        $label20 = new TLabel(new TImage('fas:comment-alt #FF9800')."Observações:", '', '14px', 'B', '100%');
        $text6 = new TTextDisplay($pessoa->observacao, '', '16px', '');
        $label22 = new TLabel("Grupos:", '', '14px', 'B', '100%');
        $grupos = new TTextDisplay($pessoa->pessoa_grupo_grupo_pessoa_to_string, '', '16px', '');

        $row1 = $this->form->addFields([$label2,$text1],[$label4,$text9],[$label6,$text10]);
        $row1->layout = [' col-sm-4',' col-sm-4',' col-sm-4'];

        $row2 = $this->form->addContent([new TFormSeparator("", '#333', '18', '#eee')]);
        $row3 = $this->form->addFields([$label8,$text4],[$label10,$text2],[$label12,$text3]);
        $row3->layout = [' col-sm-4',' col-sm-4',' col-sm-4'];

        $row4 = $this->form->addFields([$label14,$text5],[$label16,$text8],[$label18,$text7]);
        $row4->layout = [' col-sm-4',' col-sm-4',' col-sm-4'];

        $row5 = $this->form->addFields([$label20,$text6],[$label22,$grupos]);
        $row5->layout = [' col-sm-6','col-sm-6'];

        $tab_62a78e4b01882 = new BootstrapFormBuilder('tab_62a78e4b01882');
        $this->tab_62a78e4b01882 = $tab_62a78e4b01882;
        $tab_62a78e4b01882->setProperty('style', 'border:none; box-shadow:none;');

        $tab_62a78e4b01882->appendPage("Endereços");

        $tab_62a78e4b01882->addFields([new THidden('current_tab_tab_62a78e4b01882')]);
        $tab_62a78e4b01882->setTabFunction("$('[name=current_tab_tab_62a78e4b01882]').val($(this).attr('data-current_page'));");

        $this->pessoa_endereco_pessoa_id_list = new TQuickGrid;
        $this->pessoa_endereco_pessoa_id_list->disableHtmlConversion();
        $this->pessoa_endereco_pessoa_id_list->style = 'width:100%';
        $this->pessoa_endereco_pessoa_id_list->disableDefaultClick();

        $column_nome = $this->pessoa_endereco_pessoa_id_list->addQuickColumn("Nome", 'nome', 'left');
        $column_cidade_estado_nome = $this->pessoa_endereco_pessoa_id_list->addQuickColumn("Estado", 'cidade->estado->nome', 'left');
        $column_cidade_nome = $this->pessoa_endereco_pessoa_id_list->addQuickColumn("Cidade", 'cidade->nome', 'left');
        $column_cep = $this->pessoa_endereco_pessoa_id_list->addQuickColumn("CEP", 'cep', 'left');
        $column_bairro = $this->pessoa_endereco_pessoa_id_list->addQuickColumn("Bairro", 'bairro', 'left');
        $column_rua = $this->pessoa_endereco_pessoa_id_list->addQuickColumn("Rua", 'rua', 'left');
        $column_numero = $this->pessoa_endereco_pessoa_id_list->addQuickColumn("Número", 'numero', 'left');
        $column_complemento = $this->pessoa_endereco_pessoa_id_list->addQuickColumn("Complemento", 'complemento', 'left');
        $column_principal_transformed = $this->pessoa_endereco_pessoa_id_list->addQuickColumn("Principal", 'principal', 'left');

        $column_principal_transformed->setTransformer(function($value, $object, $row, $cell = null, $last_row = null)
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

        });

        $this->pessoa_endereco_pessoa_id_list->createModel();

        $criteria_pessoa_endereco_pessoa_id = new TCriteria();
        $criteria_pessoa_endereco_pessoa_id->add(new TFilter('pessoa_id', '=', $pessoa->id));

        $criteria_pessoa_endereco_pessoa_id->setProperty('order', 'id desc');

        $pessoa_endereco_pessoa_id_items = PessoaEndereco::getObjects($criteria_pessoa_endereco_pessoa_id);

        $this->pessoa_endereco_pessoa_id_list->addItems($pessoa_endereco_pessoa_id_items);

        $panel = new TElement('div');
        $panel->class = 'formView-detail';
        $panel->add(new BootstrapDatagridWrapper($this->pessoa_endereco_pessoa_id_list));

        $tab_62a78e4b01882->addContent([$panel]);

        $tab_62a78e4b01882->appendPage("Contatos");

        $this->pessoa_contato_pessoa_id_list = new TQuickGrid;
        $this->pessoa_contato_pessoa_id_list->disableHtmlConversion();
        $this->pessoa_contato_pessoa_id_list->style = 'width:100%';
        $this->pessoa_contato_pessoa_id_list->disableDefaultClick();

        $column_nome1 = $this->pessoa_contato_pessoa_id_list->addQuickColumn("Nome", 'nome', 'left');
        $column_email = $this->pessoa_contato_pessoa_id_list->addQuickColumn("Email", 'email', 'left');
        $column_telefone = $this->pessoa_contato_pessoa_id_list->addQuickColumn("Telefone", 'telefone', 'left');
        $column_ramal = $this->pessoa_contato_pessoa_id_list->addQuickColumn("Ramal", 'ramal', 'left');
        $column_observacao = $this->pessoa_contato_pessoa_id_list->addQuickColumn("Observacao", 'observacao', 'left');

        $this->pessoa_contato_pessoa_id_list->createModel();

        $criteria_pessoa_contato_pessoa_id = new TCriteria();
        $criteria_pessoa_contato_pessoa_id->add(new TFilter('pessoa_id', '=', $pessoa->id));

        $criteria_pessoa_contato_pessoa_id->setProperty('order', 'id desc');

        $pessoa_contato_pessoa_id_items = PessoaContato::getObjects($criteria_pessoa_contato_pessoa_id);

        $this->pessoa_contato_pessoa_id_list->addItems($pessoa_contato_pessoa_id_items);

        $panel = new TElement('div');
        $panel->class = 'formView-detail';
        $panel->add(new BootstrapDatagridWrapper($this->pessoa_contato_pessoa_id_list));

        $tab_62a78e4b01882->addContent([$panel]);
        $row6 = $this->form->addFields([$tab_62a78e4b01882]);
        $row6->layout = [' col-sm-12'];

        if(!empty($param['current_tab']))
        {
            $this->form->setCurrentPage($param['current_tab']);
        }

        if(!empty($param['current_tab_tab_62a78e4b01882']))
        {
            $this->tab_62a78e4b01882->setCurrentPage($param['current_tab_tab_62a78e4b01882']);
        }

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

        $style = new TStyle('right-panel > .container-part[page-name=PessoaFormView]');
        $style->width = '70% !important';   
        $style->show(true);

    }

    public function onShow($param = null)
    {     

    }

}

