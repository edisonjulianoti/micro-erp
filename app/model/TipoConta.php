<?php

class TipoConta extends TRecord
{
    const TABLENAME  = 'tipo_conta';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const PAGAR = '1';
    const RECEBER = '2';

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
            
    }

    /**
     * Method getCategorias
     */
    public function getCategorias()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('tipo_conta_id', '=', $this->id));
        return Categoria::getObjects( $criteria );
    }
    /**
     * Method getContas
     */
    public function getContas()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('tipo_conta_id', '=', $this->id));
        return Conta::getObjects( $criteria );
    }

    public function set_categoria_tipo_conta_to_string($categoria_tipo_conta_to_string)
    {
        if(is_array($categoria_tipo_conta_to_string))
        {
            $values = TipoConta::where('id', 'in', $categoria_tipo_conta_to_string)->getIndexedArray('nome', 'nome');
            $this->categoria_tipo_conta_to_string = implode(', ', $values);
        }
        else
        {
            $this->categoria_tipo_conta_to_string = $categoria_tipo_conta_to_string;
        }

        $this->vdata['categoria_tipo_conta_to_string'] = $this->categoria_tipo_conta_to_string;
    }

    public function get_categoria_tipo_conta_to_string()
    {
        if(!empty($this->categoria_tipo_conta_to_string))
        {
            return $this->categoria_tipo_conta_to_string;
        }
    
        $values = Categoria::where('tipo_conta_id', '=', $this->id)->getIndexedArray('tipo_conta_id','{tipo_conta->nome}');
        return implode(', ', $values);
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
    
        $values = Conta::where('tipo_conta_id', '=', $this->id)->getIndexedArray('tipo_conta_id','{tipo_conta->nome}');
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
    
        $values = Conta::where('tipo_conta_id', '=', $this->id)->getIndexedArray('categoria_id','{categoria->nome}');
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
    
        $values = Conta::where('tipo_conta_id', '=', $this->id)->getIndexedArray('forma_pagamento_id','{forma_pagamento->nome}');
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
    
        $values = Conta::where('tipo_conta_id', '=', $this->id)->getIndexedArray('pessoa_id','{pessoa->nome}');
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
    
        $values = Conta::where('tipo_conta_id', '=', $this->id)->getIndexedArray('ordem_servico_id','{ordem_servico->id}');
        return implode(', ', $values);
    }

    
}

