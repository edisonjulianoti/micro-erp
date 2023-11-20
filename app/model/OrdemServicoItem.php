<?php

class OrdemServicoItem extends TRecord
{
    const TABLENAME  = 'ordem_servico_item';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $ordem_servico;
    private $produto;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('ordem_servico_id');
        parent::addAttribute('produto_id');
        parent::addAttribute('quantidade');
        parent::addAttribute('desconto');
        parent::addAttribute('valor');
        parent::addAttribute('valor_total');
            
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
    /**
     * Method set_produto
     * Sample of usage: $var->produto = $object;
     * @param $object Instance of Produto
     */
    public function set_produto(Produto $object)
    {
        $this->produto = $object;
        $this->produto_id = $object->id;
    }

    /**
     * Method get_produto
     * Sample of usage: $var->produto->attribute;
     * @returns Produto instance
     */
    public function get_produto()
    {
    
        // loads the associated object
        if (empty($this->produto))
            $this->produto = new Produto($this->produto_id);
    
        // returns the associated object
        return $this->produto;
    }

    
}

