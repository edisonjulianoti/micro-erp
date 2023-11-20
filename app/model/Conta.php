<?php

class Conta extends TRecord
{
    const TABLENAME  = 'conta';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const DELETEDAT  = 'deleted_at';
    const CREATEDAT  = 'created_at';
    const UPDATEDAT  = 'updated_at';

    private $tipo_conta;
    private $categoria;
    private $forma_pagamento;
    private $pessoa;
    private $ordem_servico;

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('tipo_conta_id');
        parent::addAttribute('categoria_id');
        parent::addAttribute('forma_pagamento_id');
        parent::addAttribute('pessoa_id');
        parent::addAttribute('ordem_servico_id');
        parent::addAttribute('data_vencimento');
        parent::addAttribute('data_emissao');
        parent::addAttribute('data_pagamento');
        parent::addAttribute('valor');
        parent::addAttribute('parcela');
        parent::addAttribute('obs');
        parent::addAttribute('created_at');
        parent::addAttribute('updated_at');
        parent::addAttribute('deleted_at');
    
    }

    /**
     * Method set_tipo_conta
     * Sample of usage: $var->tipo_conta = $object;
     * @param $object Instance of TipoConta
     */
    public function set_tipo_conta(TipoConta $object)
    {
        $this->tipo_conta = $object;
        $this->tipo_conta_id = $object->id;
    }

    /**
     * Method get_tipo_conta
     * Sample of usage: $var->tipo_conta->attribute;
     * @returns TipoConta instance
     */
    public function get_tipo_conta()
    {
    
        // loads the associated object
        if (empty($this->tipo_conta))
            $this->tipo_conta = new TipoConta($this->tipo_conta_id);
    
        // returns the associated object
        return $this->tipo_conta;
    }
    /**
     * Method set_categoria
     * Sample of usage: $var->categoria = $object;
     * @param $object Instance of Categoria
     */
    public function set_categoria(Categoria $object)
    {
        $this->categoria = $object;
        $this->categoria_id = $object->id;
    }

    /**
     * Method get_categoria
     * Sample of usage: $var->categoria->attribute;
     * @returns Categoria instance
     */
    public function get_categoria()
    {
    
        // loads the associated object
        if (empty($this->categoria))
            $this->categoria = new Categoria($this->categoria_id);
    
        // returns the associated object
        return $this->categoria;
    }
    /**
     * Method set_forma_pagamento
     * Sample of usage: $var->forma_pagamento = $object;
     * @param $object Instance of FormaPagamento
     */
    public function set_forma_pagamento(FormaPagamento $object)
    {
        $this->forma_pagamento = $object;
        $this->forma_pagamento_id = $object->id;
    }

    /**
     * Method get_forma_pagamento
     * Sample of usage: $var->forma_pagamento->attribute;
     * @returns FormaPagamento instance
     */
    public function get_forma_pagamento()
    {
    
        // loads the associated object
        if (empty($this->forma_pagamento))
            $this->forma_pagamento = new FormaPagamento($this->forma_pagamento_id);
    
        // returns the associated object
        return $this->forma_pagamento;
    }
    /**
     * Method set_pessoa
     * Sample of usage: $var->pessoa = $object;
     * @param $object Instance of Pessoa
     */
    public function set_pessoa(Pessoa $object)
    {
        $this->pessoa = $object;
        $this->pessoa_id = $object->id;
    }

    /**
     * Method get_pessoa
     * Sample of usage: $var->pessoa->attribute;
     * @returns Pessoa instance
     */
    public function get_pessoa()
    {
    
        // loads the associated object
        if (empty($this->pessoa))
            $this->pessoa = new Pessoa($this->pessoa_id);
    
        // returns the associated object
        return $this->pessoa;
    }
    /**
     * Method set_ordem_servico
     * Sample of usage: $var->ordem_servico = $object;
     * @param $object Instance of OrdemServico
     */
    public function set_ordem_servico(OrdemServico $object)
    {
        $this->ordem_servico = $object;
        $this->ordem_servico_id = $object->id;
    }

    /**
     * Method get_ordem_servico
     * Sample of usage: $var->ordem_servico->attribute;
     * @returns OrdemServico instance
     */
    public function get_ordem_servico()
    {
    
        // loads the associated object
        if (empty($this->ordem_servico))
            $this->ordem_servico = new OrdemServico($this->ordem_servico_id);
    
        // returns the associated object
        return $this->ordem_servico;
    }

    public function get_status()
    {
        if(date('Y-m-d') > $this->data_vencimento && !$this->data_pagamento)
        {
            return "<label style='width:120px;' class='label label-danger'> ATRASADA </label>";
        }
        elseif(!$this->data_pagamento )
        {
            return "<label style='width:120px;' class='label label-warning'> EM ABERTA </label>";
        }
        elseif($this->data_pagamento )
        {
            return "<label style='width:120px;' class='label label-success'> QUITADA </label>";
        }
    }

}

