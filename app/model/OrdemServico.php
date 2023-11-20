<?php

class OrdemServico extends TRecord
{
    const TABLENAME  = 'ordem_servico';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const DELETEDAT  = 'deleted_at';
    const CREATEDAT  = 'inserted_at';
    const UPDATEDAT  = 'updated_at';

    private $cliente;

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('cliente_id');
        parent::addAttribute('descricao');
        parent::addAttribute('data_inicio');
        parent::addAttribute('data_fim');
        parent::addAttribute('data_prevista');
        parent::addAttribute('valor_total');
        parent::addAttribute('mes');
        parent::addAttribute('ano');
        parent::addAttribute('mes_ano');
        parent::addAttribute('inserted_at');
        parent::addAttribute('updated_at');
        parent::addAttribute('deleted_at');
    
    }

    /**
     * Method set_pessoa
     * Sample of usage: $var->pessoa = $object;
     * @param $object Instance of Pessoa
     */
    public function set_cliente(Pessoa $object)
    {
        $this->cliente = $object;
        $this->cliente_id = $object->id;
    }

    /**
     * Method get_cliente
     * Sample of usage: $var->cliente->attribute;
     * @returns Pessoa instance
     */
    public function get_cliente()
    {
    
        // loads the associated object
        if (empty($this->cliente))
            $this->cliente = new Pessoa($this->cliente_id);
    
        // returns the associated object
        return $this->cliente;
    }

    /**
     * Method getContas
     */
    public function getContas()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('ordem_servico_id', '=', $this->id));
        return Conta::getObjects( $criteria );
    }
    /**
     * Method getOrdemServicoAtendimentos
     */
    public function getOrdemServicoAtendimentos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('ordem_servico_id', '=', $this->id));
        return OrdemServicoAtendimento::getObjects( $criteria );
    }
    /**
     * Method getOrdemServicoItems
     */
    public function getOrdemServicoItems()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('ordem_servico_id', '=', $this->id));
        return OrdemServicoItem::getObjects( $criteria );
    }

    public function set_conta_tipo_conta_to_string($conta_tipo_conta_to_string)
    {
        if(is_array($conta_tipo_conta_to_string))
        {
            $values = TipoConta::where('id', 'in', $conta_tipo_conta_to_string)->getIndexedArray('nome', 'nome');
            $this->conta_tipo_conta_to_string = implode(', ', $values);
        }
        else
        {
            $this->conta_tipo_conta_to_string = $conta_tipo_conta_to_string;
        }

        $this->vdata['conta_tipo_conta_to_string'] = $this->conta_tipo_conta_to_string;
    }

    public function get_conta_tipo_conta_to_string()
    {
        if(!empty($this->conta_tipo_conta_to_string))
        {
            return $this->conta_tipo_conta_to_string;
        }
    
        $values = Conta::where('ordem_servico_id', '=', $this->id)->getIndexedArray('tipo_conta_id','{tipo_conta->nome}');
        return implode(', ', $values);
    }

    public function set_conta_categoria_to_string($conta_categoria_to_string)
    {
        if(is_array($conta_categoria_to_string))
        {
            $values = Categoria::where('id', 'in', $conta_categoria_to_string)->getIndexedArray('nome', 'nome');
            $this->conta_categoria_to_string = implode(', ', $values);
        }
        else
        {
            $this->conta_categoria_to_string = $conta_categoria_to_string;
        }

        $this->vdata['conta_categoria_to_string'] = $this->conta_categoria_to_string;
    }

    public function get_conta_categoria_to_string()
    {
        if(!empty($this->conta_categoria_to_string))
        {
            return $this->conta_categoria_to_string;
        }
    
        $values = Conta::where('ordem_servico_id', '=', $this->id)->getIndexedArray('categoria_id','{categoria->nome}');
        return implode(', ', $values);
    }

    public function set_conta_forma_pagamento_to_string($conta_forma_pagamento_to_string)
    {
        if(is_array($conta_forma_pagamento_to_string))
        {
            $values = FormaPagamento::where('id', 'in', $conta_forma_pagamento_to_string)->getIndexedArray('nome', 'nome');
            $this->conta_forma_pagamento_to_string = implode(', ', $values);
        }
        else
        {
            $this->conta_forma_pagamento_to_string = $conta_forma_pagamento_to_string;
        }

        $this->vdata['conta_forma_pagamento_to_string'] = $this->conta_forma_pagamento_to_string;
    }

    public function get_conta_forma_pagamento_to_string()
    {
        if(!empty($this->conta_forma_pagamento_to_string))
        {
            return $this->conta_forma_pagamento_to_string;
        }
    
        $values = Conta::where('ordem_servico_id', '=', $this->id)->getIndexedArray('forma_pagamento_id','{forma_pagamento->nome}');
        return implode(', ', $values);
    }

    public function set_conta_pessoa_to_string($conta_pessoa_to_string)
    {
        if(is_array($conta_pessoa_to_string))
        {
            $values = Pessoa::where('id', 'in', $conta_pessoa_to_string)->getIndexedArray('nome', 'nome');
            $this->conta_pessoa_to_string = implode(', ', $values);
        }
        else
        {
            $this->conta_pessoa_to_string = $conta_pessoa_to_string;
        }

        $this->vdata['conta_pessoa_to_string'] = $this->conta_pessoa_to_string;
    }

    public function get_conta_pessoa_to_string()
    {
        if(!empty($this->conta_pessoa_to_string))
        {
            return $this->conta_pessoa_to_string;
        }
    
        $values = Conta::where('ordem_servico_id', '=', $this->id)->getIndexedArray('pessoa_id','{pessoa->nome}');
        return implode(', ', $values);
    }

    public function set_conta_ordem_servico_to_string($conta_ordem_servico_to_string)
    {
        if(is_array($conta_ordem_servico_to_string))
        {
            $values = OrdemServico::where('id', 'in', $conta_ordem_servico_to_string)->getIndexedArray('id', 'id');
            $this->conta_ordem_servico_to_string = implode(', ', $values);
        }
        else
        {
            $this->conta_ordem_servico_to_string = $conta_ordem_servico_to_string;
        }

        $this->vdata['conta_ordem_servico_to_string'] = $this->conta_ordem_servico_to_string;
    }

    public function get_conta_ordem_servico_to_string()
    {
        if(!empty($this->conta_ordem_servico_to_string))
        {
            return $this->conta_ordem_servico_to_string;
        }
    
        $values = Conta::where('ordem_servico_id', '=', $this->id)->getIndexedArray('ordem_servico_id','{ordem_servico->id}');
        return implode(', ', $values);
    }

    public function set_ordem_servico_atendimento_tecnico_to_string($ordem_servico_atendimento_tecnico_to_string)
    {
        if(is_array($ordem_servico_atendimento_tecnico_to_string))
        {
            $values = Pessoa::where('id', 'in', $ordem_servico_atendimento_tecnico_to_string)->getIndexedArray('nome', 'nome');
            $this->ordem_servico_atendimento_tecnico_to_string = implode(', ', $values);
        }
        else
        {
            $this->ordem_servico_atendimento_tecnico_to_string = $ordem_servico_atendimento_tecnico_to_string;
        }

        $this->vdata['ordem_servico_atendimento_tecnico_to_string'] = $this->ordem_servico_atendimento_tecnico_to_string;
    }

    public function get_ordem_servico_atendimento_tecnico_to_string()
    {
        if(!empty($this->ordem_servico_atendimento_tecnico_to_string))
        {
            return $this->ordem_servico_atendimento_tecnico_to_string;
        }
    
        $values = OrdemServicoAtendimento::where('ordem_servico_id', '=', $this->id)->getIndexedArray('tecnico_id','{tecnico->nome}');
        return implode(', ', $values);
    }

    public function set_ordem_servico_atendimento_ordem_servico_to_string($ordem_servico_atendimento_ordem_servico_to_string)
    {
        if(is_array($ordem_servico_atendimento_ordem_servico_to_string))
        {
            $values = OrdemServico::where('id', 'in', $ordem_servico_atendimento_ordem_servico_to_string)->getIndexedArray('id', 'id');
            $this->ordem_servico_atendimento_ordem_servico_to_string = implode(', ', $values);
        }
        else
        {
            $this->ordem_servico_atendimento_ordem_servico_to_string = $ordem_servico_atendimento_ordem_servico_to_string;
        }

        $this->vdata['ordem_servico_atendimento_ordem_servico_to_string'] = $this->ordem_servico_atendimento_ordem_servico_to_string;
    }

    public function get_ordem_servico_atendimento_ordem_servico_to_string()
    {
        if(!empty($this->ordem_servico_atendimento_ordem_servico_to_string))
        {
            return $this->ordem_servico_atendimento_ordem_servico_to_string;
        }
    
        $values = OrdemServicoAtendimento::where('ordem_servico_id', '=', $this->id)->getIndexedArray('ordem_servico_id','{ordem_servico->id}');
        return implode(', ', $values);
    }

    public function set_ordem_servico_atendimento_solucao_to_string($ordem_servico_atendimento_solucao_to_string)
    {
        if(is_array($ordem_servico_atendimento_solucao_to_string))
        {
            $values = Solucao::where('id', 'in', $ordem_servico_atendimento_solucao_to_string)->getIndexedArray('nome', 'nome');
            $this->ordem_servico_atendimento_solucao_to_string = implode(', ', $values);
        }
        else
        {
            $this->ordem_servico_atendimento_solucao_to_string = $ordem_servico_atendimento_solucao_to_string;
        }

        $this->vdata['ordem_servico_atendimento_solucao_to_string'] = $this->ordem_servico_atendimento_solucao_to_string;
    }

    public function get_ordem_servico_atendimento_solucao_to_string()
    {
        if(!empty($this->ordem_servico_atendimento_solucao_to_string))
        {
            return $this->ordem_servico_atendimento_solucao_to_string;
        }
    
        $values = OrdemServicoAtendimento::where('ordem_servico_id', '=', $this->id)->getIndexedArray('solucao_id','{solucao->nome}');
        return implode(', ', $values);
    }

    public function set_ordem_servico_atendimento_causa_to_string($ordem_servico_atendimento_causa_to_string)
    {
        if(is_array($ordem_servico_atendimento_causa_to_string))
        {
            $values = Causa::where('id', 'in', $ordem_servico_atendimento_causa_to_string)->getIndexedArray('nome', 'nome');
            $this->ordem_servico_atendimento_causa_to_string = implode(', ', $values);
        }
        else
        {
            $this->ordem_servico_atendimento_causa_to_string = $ordem_servico_atendimento_causa_to_string;
        }

        $this->vdata['ordem_servico_atendimento_causa_to_string'] = $this->ordem_servico_atendimento_causa_to_string;
    }

    public function get_ordem_servico_atendimento_causa_to_string()
    {
        if(!empty($this->ordem_servico_atendimento_causa_to_string))
        {
            return $this->ordem_servico_atendimento_causa_to_string;
        }
    
        $values = OrdemServicoAtendimento::where('ordem_servico_id', '=', $this->id)->getIndexedArray('causa_id','{causa->nome}');
        return implode(', ', $values);
    }

    public function set_ordem_servico_atendimento_problema_to_string($ordem_servico_atendimento_problema_to_string)
    {
        if(is_array($ordem_servico_atendimento_problema_to_string))
        {
            $values = Problema::where('id', 'in', $ordem_servico_atendimento_problema_to_string)->getIndexedArray('nome', 'nome');
            $this->ordem_servico_atendimento_problema_to_string = implode(', ', $values);
        }
        else
        {
            $this->ordem_servico_atendimento_problema_to_string = $ordem_servico_atendimento_problema_to_string;
        }

        $this->vdata['ordem_servico_atendimento_problema_to_string'] = $this->ordem_servico_atendimento_problema_to_string;
    }

    public function get_ordem_servico_atendimento_problema_to_string()
    {
        if(!empty($this->ordem_servico_atendimento_problema_to_string))
        {
            return $this->ordem_servico_atendimento_problema_to_string;
        }
    
        $values = OrdemServicoAtendimento::where('ordem_servico_id', '=', $this->id)->getIndexedArray('problema_id','{problema->nome}');
        return implode(', ', $values);
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
    
        $values = OrdemServicoItem::where('ordem_servico_id', '=', $this->id)->getIndexedArray('ordem_servico_id','{ordem_servico->id}');
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
    
        $values = OrdemServicoItem::where('ordem_servico_id', '=', $this->id)->getIndexedArray('produto_id','{produto->nome}');
        return implode(', ', $values);
    }

}

