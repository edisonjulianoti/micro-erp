<?php

class Orcamento extends TRecord
{
    const TABLENAME  = 'orcamento';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $pessoa;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('pessoa_id');
        parent::addAttribute('data_orcamento');
        parent::addAttribute('valor');
            
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
     * Method getOrcamentoProdutoss
     */
    public function getOrcamentoProdutoss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('orcamento_id', '=', $this->id));
        return OrcamentoProdutos::getObjects( $criteria );
    }
    /**
     * Method getOrcamentoServicoss
     */
    public function getOrcamentoServicoss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('orcamento_id', '=', $this->id));
        return OrcamentoServicos::getObjects( $criteria );
    }

    public function set_orcamento_produtos_orcamento_to_string($orcamento_produtos_orcamento_to_string)
    {
        if(is_array($orcamento_produtos_orcamento_to_string))
        {
            $values = Orcamento::where('id', 'in', $orcamento_produtos_orcamento_to_string)->getIndexedArray('id', 'id');
            $this->orcamento_produtos_orcamento_to_string = implode(', ', $values);
        }
        else
        {
            $this->orcamento_produtos_orcamento_to_string = $orcamento_produtos_orcamento_to_string;
        }

        $this->vdata['orcamento_produtos_orcamento_to_string'] = $this->orcamento_produtos_orcamento_to_string;
    }

    public function get_orcamento_produtos_orcamento_to_string()
    {
        if(!empty($this->orcamento_produtos_orcamento_to_string))
        {
            return $this->orcamento_produtos_orcamento_to_string;
        }
    
        $values = OrcamentoProdutos::where('orcamento_id', '=', $this->id)->getIndexedArray('orcamento_id','{orcamento->id}');
        return implode(', ', $values);
    }

    public function set_orcamento_produtos_produto_to_string($orcamento_produtos_produto_to_string)
    {
        if(is_array($orcamento_produtos_produto_to_string))
        {
            $values = Produto::where('id', 'in', $orcamento_produtos_produto_to_string)->getIndexedArray('nome', 'nome');
            $this->orcamento_produtos_produto_to_string = implode(', ', $values);
        }
        else
        {
            $this->orcamento_produtos_produto_to_string = $orcamento_produtos_produto_to_string;
        }

        $this->vdata['orcamento_produtos_produto_to_string'] = $this->orcamento_produtos_produto_to_string;
    }

    public function get_orcamento_produtos_produto_to_string()
    {
        if(!empty($this->orcamento_produtos_produto_to_string))
        {
            return $this->orcamento_produtos_produto_to_string;
        }
    
        $values = OrcamentoProdutos::where('orcamento_id', '=', $this->id)->getIndexedArray('produto_id','{produto->nome}');
        return implode(', ', $values);
    }

    public function set_orcamento_servicos_orcamento_to_string($orcamento_servicos_orcamento_to_string)
    {
        if(is_array($orcamento_servicos_orcamento_to_string))
        {
            $values = Orcamento::where('id', 'in', $orcamento_servicos_orcamento_to_string)->getIndexedArray('id', 'id');
            $this->orcamento_servicos_orcamento_to_string = implode(', ', $values);
        }
        else
        {
            $this->orcamento_servicos_orcamento_to_string = $orcamento_servicos_orcamento_to_string;
        }

        $this->vdata['orcamento_servicos_orcamento_to_string'] = $this->orcamento_servicos_orcamento_to_string;
    }

    public function get_orcamento_servicos_orcamento_to_string()
    {
        if(!empty($this->orcamento_servicos_orcamento_to_string))
        {
            return $this->orcamento_servicos_orcamento_to_string;
        }
    
        $values = OrcamentoServicos::where('orcamento_id', '=', $this->id)->getIndexedArray('orcamento_id','{orcamento->id}');
        return implode(', ', $values);
    }

    public function set_orcamento_servicos_produto_to_string($orcamento_servicos_produto_to_string)
    {
        if(is_array($orcamento_servicos_produto_to_string))
        {
            $values = Produto::where('id', 'in', $orcamento_servicos_produto_to_string)->getIndexedArray('nome', 'nome');
            $this->orcamento_servicos_produto_to_string = implode(', ', $values);
        }
        else
        {
            $this->orcamento_servicos_produto_to_string = $orcamento_servicos_produto_to_string;
        }

        $this->vdata['orcamento_servicos_produto_to_string'] = $this->orcamento_servicos_produto_to_string;
    }

    public function get_orcamento_servicos_produto_to_string()
    {
        if(!empty($this->orcamento_servicos_produto_to_string))
        {
            return $this->orcamento_servicos_produto_to_string;
        }
    
        $values = OrcamentoServicos::where('orcamento_id', '=', $this->id)->getIndexedArray('produto_id','{produto->nome}');
        return implode(', ', $values);
    }

    
}

