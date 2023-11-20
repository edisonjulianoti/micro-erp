<?php

class ContaPagarForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'microerp';
    private static $activeRecord = 'Conta';
    private static $primaryKey = 'id';
    private static $formName = 'form_ContaPagarForm';

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
        $this->form->setFormTitle("Cadastro de conta a pagar");

        $criteria_pessoa_id = new TCriteria();
        $criteria_categoria_id = new TCriteria();

        $filterVar = GrupoPessoa::FORNECEDOR;
        $criteria_pessoa_id->add(new TFilter('id', 'in', "(SELECT pessoa_id FROM pessoa_grupo WHERE grupo_pessoa_id = '{$filterVar}')")); 
        $filterVar = TipoConta::PAGAR;
        $criteria_categoria_id->add(new TFilter('tipo_conta_id', '=', $filterVar)); 

        $id = new TEntry('id');
        $pessoa_id = new TDBCombo('pessoa_id', 'microerp', 'Pessoa', 'id', '{nome}','nome asc' , $criteria_pessoa_id );
        $categoria_id = new TDBCombo('categoria_id', 'microerp', 'Categoria', 'id', '{nome}','nome asc' , $criteria_categoria_id );
        $forma_pagamento_id = new TDBCombo('forma_pagamento_id', 'microerp', 'FormaPagamento', 'id', '{nome}','nome asc'  );
        $data_emissao = new TDate('data_emissao');
        $data_pagamento = new TDate('data_pagamento');
        $data_vencimento = new TDate('data_vencimento');
        $valor = new TNumeric('valor', '2', ',', '.' );
        $parcela = new TSpinner('parcela');
        $obs = new TText('obs');

        $pessoa_id->addValidation("Pessoa", new TRequiredValidator()); 
        $categoria_id->addValidation("Categoria", new TRequiredValidator()); 
        $forma_pagamento_id->addValidation("Forma de pagamento", new TRequiredValidator()); 

        $id->setEditable(false);
        $parcela->setRange(1, 2000, 1);
        $pessoa_id->enableSearch();
        $categoria_id->enableSearch();
        $forma_pagamento_id->enableSearch();

        $data_emissao->setMask('dd/mm/yyyy');
        $data_pagamento->setMask('dd/mm/yyyy');
        $data_vencimento->setMask('dd/mm/yyyy');

        $data_emissao->setDatabaseMask('yyyy-mm-dd');
        $data_pagamento->setDatabaseMask('yyyy-mm-dd');
        $data_vencimento->setDatabaseMask('yyyy-mm-dd');

        $id->setSize(100);
        $valor->setSize('100%');
        $parcela->setSize('100%');
        $obs->setSize('100%', 100);
        $pessoa_id->setSize('100%');
        $data_emissao->setSize(110);
        $data_pagamento->setSize(110);
        $categoria_id->setSize('100%');
        $data_vencimento->setSize(110);
        $forma_pagamento_id->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id]);
        $row1->layout = ['col-sm-6'];

        $row2 = $this->form->addFields([new TLabel("Fornecedor:", '#ff0000', '14px', null, '100%'),$pessoa_id],[]);
        $row2->layout = ['col-sm-6','col-sm-6'];

        $row3 = $this->form->addFields([new TLabel("Categoria:", '#ff0000', '14px', null, '100%'),$categoria_id],[new TLabel("Forma de pagamento:", '#ff0000', '14px', null, '100%'),$forma_pagamento_id]);
        $row3->layout = ['col-sm-6','col-sm-6'];

        $row4 = $this->form->addFields([new TLabel("Data de emissão:", null, '14px', null, '100%'),$data_emissao],[new TLabel("Data de pagamento:", null, '14px', null, '100%'),$data_pagamento],[new TLabel("Data de vencimento:", null, '14px', null, '100%'),$data_vencimento]);
        $row4->layout = [' col-sm-4',' col-sm-4',' col-sm-4'];

        $row5 = $this->form->addFields([new TLabel("Valor:", null, '14px', null, '100%'),$valor],[new TLabel("Parcela:", null, '14px', null, '100%'),$parcela]);
        $row5->layout = ['col-sm-6','col-sm-6'];

        $row6 = $this->form->addFields([new TLabel("Obs:", null, '14px', null, '100%'),$obs]);
        $row6->layout = [' col-sm-12'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['ContaReceberList', 'onShow']), 'fas:arrow-left #000000');
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

    }

    public function onSave($param = null) 
    {
        try
        {
            TTransaction::open(self::$database); // open a transaction

            $messageAction = null;

            $this->form->validate(); // validate form data

            $object = new Conta(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->tipo_conta_id = TipoConta::PAGAR;

            $object->store(); // save the object 

            $loadPageParam = [];

            if(!empty($param['target_container']))
            {
                $loadPageParam['target_container'] = $param['target_container'];
            }

            // get the generated {PRIMARY_KEY}
            $data->id = $object->id; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            TToast::show('success', "Registro salvo", 'topRight', 'far:check-circle');
            TApplication::loadPage('ContaPagarList', 'onShow', $loadPageParam); 

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

                $object = new Conta($key); // instantiates the Active Record 

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

    public  function onQuitar($param = null) 
    {
        try 
        {
            $this->onEdit($param);

            $this->form->getField('pessoa_id')->setEditable(false);
            $this->form->getField('categoria_id')->setEditable(false);
            $this->form->getField('valor')->setEditable(false);
            $this->form->getField('data_vencimento')->setEditable(false);
            $this->form->getField('data_emissao')->setEditable(false);
            $this->form->getField('parcela')->setEditable(false);

            $this->form->getField('data_pagamento')->setValue(date('d/m/Y'));

            $this->form->setFormTitle("Quitar conta a pagar");

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

}

