<?php

class Produto extends TRecord
{
    const TABLENAME  = 'produto';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const DELETEDAT  = 'deleted_at';
    const CREATEDAT  = 'inserted_at';
    const UPDATEDAT  = 'updated_at';

    private $tipo_produto;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('tipo_produto_id');
        parent::addAttribute('nome');
        parent::addAttribute('preco');
        parent::addAttribute('obs');
        parent::addAttribute('foto');
        parent::addAttribute('inserted_at');
        parent::addAttribute('deleted_at');
        parent::addAttribute('updated_at');
            
    }

    /**
     * Method set_tipo_produto
     * Sample of usage: $var->tipo_produto = $object;
     * @param $object Instance of TipoProduto
     */
    public function set_tipo_produto(TipoProduto $object)
    {
        $this->tipo_produto = $object;
        $this->tipo_produto_id = $object->id;
    }

    /**
     * Method get_tipo_produto
     * Sample of usage: $var->tipo_produto->attribute;
     * @returns TipoProduto instance
     */
    public function get_tipo_produto()
    {
    
        // loads the associated object
        if (empty($this->tipo_produto))
            $this->tipo_produto = new TipoProduto($this->tipo_produto_id);
    
        // returns the associated object
        return $this->tipo_produto;
    }

    /**
     * Method getOrdemServicoItems
     */
    public function getOrdemServicoItems()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('produto_id', '=', $this->id));
        return OrdemServicoItem::getObjects( $criteria );
    }

    public function set_ordem_servico_item_ordem_servico_to_string($ordem_servico_item_ordem_servico_to_string)
    {
        if(is_array($ordem_servico_item_ordem_servico_to_string))
        {
            $values = OrdemServico::where('id', 'in', $ordem_servico_item_ordem_servico_to_string)->getIndexedArray('id', 'id');
            $this->ordem_servico_item_ordem_servico_to_string = implode(', ', $values);
        }
        else
        {
            $this->ordem_servico_item_ordem_servico_to_string = $ordem_servico_item_ordem_servico_to_string;
        }

        $this->vdata['ordem_servico_item_ordem_servico_to_string'] = $this->ordem_servico_item_ordem_servico_to_string;
    }

    public function get_ordem_servico_item_ordem_servico_to_string()
    {
        if(!empty($this->ordem_servico_item_ordem_servico_to_string))
        {
            return $this->ordem_servico_item_ordem_servico_to_string;
        }
    
        $values = OrdemServicoItem::where('produto_id', '=', $this->id)->getIndexedArray('ordem_servico_id','{ordem_servico->id}');
        return implode(', ', $values);
    }

    public function set_ordem_servico_item_produto_to_string($ordem_servico_item_produto_to_string)
    {
        if(is_array($ordem_servico_item_produto_to_string))
        {
            $values = Produto::where('id', 'in', $ordem_servico_item_produto_to_string)->getIndexedArray('nome', 'nome');
            $this->ordem_servico_item_produto_to_string = implode(', ', $values);
        }
        else
        {
            $this->ordem_servico_item_produto_to_string = $ordem_servico_item_produto_to_string;
        }

        $this->vdata['ordem_servico_item_produto_to_string'] = $this->ordem_servico_item_produto_to_string;
    }

    public function get_ordem_servico_item_produto_to_string()
    {
        if(!empty($this->ordem_servico_item_produto_to_string))
        {
            return $this->ordem_servico_item_produto_to_string;
        }
    
        $values = OrdemServicoItem::where('produto_id', '=', $this->id)->getIndexedArray('produto_id','{produto->nome}');
        return implode(', ', $values);
    }

    
}

