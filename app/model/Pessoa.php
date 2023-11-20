<?php

class Pessoa extends TRecord
{
    const TABLENAME  = 'pessoa';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    const DELETEDAT  = 'deleted_at';
    const CREATEDAT  = 'created_at';
    const UPDATEDAT  = 'updated_at';

    private $tipo_cliente;
    private $system_users;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('tipo_cliente_id');
        parent::addAttribute('system_users_id');
        parent::addAttribute('nome');
        parent::addAttribute('documento');
        parent::addAttribute('observacao');
        parent::addAttribute('telefone');
        parent::addAttribute('email');
        parent::addAttribute('created_at');
        parent::addAttribute('updated_at');
        parent::addAttribute('deleted_at');
            
    }

    /**
     * Method set_tipo_pessoa
     * Sample of usage: $var->tipo_pessoa = $object;
     * @param $object Instance of TipoPessoa
     */
    public function set_tipo_cliente(TipoPessoa $object)
    {
        $this->tipo_cliente = $object;
        $this->tipo_cliente_id = $object->id;
    }

    /**
     * Method get_tipo_cliente
     * Sample of usage: $var->tipo_cliente->attribute;
     * @returns TipoPessoa instance
     */
    public function get_tipo_cliente()
    {
    
        // loads the associated object
        if (empty($this->tipo_cliente))
            $this->tipo_cliente = new TipoPessoa($this->tipo_cliente_id);
    
        // returns the associated object
        return $this->tipo_cliente;
    }
    /**
     * Method set_system_users
     * Sample of usage: $var->system_users = $object;
     * @param $object Instance of SystemUsers
     */
    public function set_system_users(SystemUsers $object)
    {
        $this->system_users = $object;
        $this->system_users_id = $object->id;
    }

    /**
     * Method get_system_users
     * Sample of usage: $var->system_users->attribute;
     * @returns SystemUsers instance
     */
    public function get_system_users()
    {
    
        // loads the associated object
        if (empty($this->system_users))
            $this->system_users = new SystemUsers($this->system_users_id);
    
        // returns the associated object
        return $this->system_users;
    }

    /**
     * Method getContas
     */
    public function getContas()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('pessoa_id', '=', $this->id));
        return Conta::getObjects( $criteria );
    }
    /**
     * Method getOrdemServicos
     */
    public function getOrdemServicos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('cliente_id', '=', $this->id));
        return OrdemServico::getObjects( $criteria );
    }
    /**
     * Method getOrdemServicoAtendimentos
     */
    public function getOrdemServicoAtendimentos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('tecnico_id', '=', $this->id));
        return OrdemServicoAtendimento::getObjects( $criteria );
    }
    /**
     * Method getPessoaContatos
     */
    public function getPessoaContatos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('pessoa_id', '=', $this->id));
        return PessoaContato::getObjects( $criteria );
    }
    /**
     * Method getPessoaEnderecos
     */
    public function getPessoaEnderecos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('pessoa_id', '=', $this->id));
        return PessoaEndereco::getObjects( $criteria );
    }
    /**
     * Method getPessoaGrupos
     */
    public function getPessoaGrupos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('pessoa_id', '=', $this->id));
        return PessoaGrupo::getObjects( $criteria );
    }
    /**
     * Method getOrcamentos
     */
    public function getOrcamentos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('pessoa_id', '=', $this->id));
        return Orcamento::getObjects( $criteria );
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
    
        $values = Conta::where('pessoa_id', '=', $this->id)->getIndexedArray('tipo_conta_id','{tipo_conta->nome}');
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
    
        $values = Conta::where('pessoa_id', '=', $this->id)->getIndexedArray('categoria_id','{categoria->nome}');
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
    
        $values = Conta::where('pessoa_id', '=', $this->id)->getIndexedArray('forma_pagamento_id','{forma_pagamento->nome}');
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
    
        $values = Conta::where('pessoa_id', '=', $this->id)->getIndexedArray('pessoa_id','{pessoa->nome}');
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
    
        $values = Conta::where('pessoa_id', '=', $this->id)->getIndexedArray('ordem_servico_id','{ordem_servico->id}');
        return implode(', ', $values);
    }

    public function set_ordem_servico_cliente_to_string($ordem_servico_cliente_to_string)
    {
        if(is_array($ordem_servico_cliente_to_string))
        {
            $values = Pessoa::where('id', 'in', $ordem_servico_cliente_to_string)->getIndexedArray('nome', 'nome');
            $this->ordem_servico_cliente_to_string = implode(', ', $values);
        }
        else
        {
            $this->ordem_servico_cliente_to_string = $ordem_servico_cliente_to_string;
        }

        $this->vdata['ordem_servico_cliente_to_string'] = $this->ordem_servico_cliente_to_string;
    }

    public function get_ordem_servico_cliente_to_string()
    {
        if(!empty($this->ordem_servico_cliente_to_string))
        {
            return $this->ordem_servico_cliente_to_string;
        }
    
        $values = OrdemServico::where('cliente_id', '=', $this->id)->getIndexedArray('cliente_id','{cliente->nome}');
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
    
        $values = OrdemServicoAtendimento::where('tecnico_id', '=', $this->id)->getIndexedArray('tecnico_id','{tecnico->nome}');
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
    
        $values = OrdemServicoAtendimento::where('tecnico_id', '=', $this->id)->getIndexedArray('ordem_servico_id','{ordem_servico->id}');
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
    
        $values = OrdemServicoAtendimento::where('tecnico_id', '=', $this->id)->getIndexedArray('solucao_id','{solucao->nome}');
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
    
        $values = OrdemServicoAtendimento::where('tecnico_id', '=', $this->id)->getIndexedArray('causa_id','{causa->nome}');
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
    
        $values = OrdemServicoAtendimento::where('tecnico_id', '=', $this->id)->getIndexedArray('problema_id','{problema->nome}');
        return implode(', ', $values);
    }

    public function set_pessoa_contato_pessoa_to_string($pessoa_contato_pessoa_to_string)
    {
        if(is_array($pessoa_contato_pessoa_to_string))
        {
            $values = Pessoa::where('id', 'in', $pessoa_contato_pessoa_to_string)->getIndexedArray('nome', 'nome');
            $this->pessoa_contato_pessoa_to_string = implode(', ', $values);
        }
        else
        {
            $this->pessoa_contato_pessoa_to_string = $pessoa_contato_pessoa_to_string;
        }

        $this->vdata['pessoa_contato_pessoa_to_string'] = $this->pessoa_contato_pessoa_to_string;
    }

    public function get_pessoa_contato_pessoa_to_string()
    {
        if(!empty($this->pessoa_contato_pessoa_to_string))
        {
            return $this->pessoa_contato_pessoa_to_string;
        }
    
        $values = PessoaContato::where('pessoa_id', '=', $this->id)->getIndexedArray('pessoa_id','{pessoa->nome}');
        return implode(', ', $values);
    }

    public function set_pessoa_endereco_cidade_to_string($pessoa_endereco_cidade_to_string)
    {
        if(is_array($pessoa_endereco_cidade_to_string))
        {
            $values = Cidade::where('id', 'in', $pessoa_endereco_cidade_to_string)->getIndexedArray('nome', 'nome');
            $this->pessoa_endereco_cidade_to_string = implode(', ', $values);
        }
        else
        {
            $this->pessoa_endereco_cidade_to_string = $pessoa_endereco_cidade_to_string;
        }

        $this->vdata['pessoa_endereco_cidade_to_string'] = $this->pessoa_endereco_cidade_to_string;
    }

    public function get_pessoa_endereco_cidade_to_string()
    {
        if(!empty($this->pessoa_endereco_cidade_to_string))
        {
            return $this->pessoa_endereco_cidade_to_string;
        }
    
        $values = PessoaEndereco::where('pessoa_id', '=', $this->id)->getIndexedArray('cidade_id','{cidade->nome}');
        return implode(', ', $values);
    }

    public function set_pessoa_endereco_pessoa_to_string($pessoa_endereco_pessoa_to_string)
    {
        if(is_array($pessoa_endereco_pessoa_to_string))
        {
            $values = Pessoa::where('id', 'in', $pessoa_endereco_pessoa_to_string)->getIndexedArray('nome', 'nome');
            $this->pessoa_endereco_pessoa_to_string = implode(', ', $values);
        }
        else
        {
            $this->pessoa_endereco_pessoa_to_string = $pessoa_endereco_pessoa_to_string;
        }

        $this->vdata['pessoa_endereco_pessoa_to_string'] = $this->pessoa_endereco_pessoa_to_string;
    }

    public function get_pessoa_endereco_pessoa_to_string()
    {
        if(!empty($this->pessoa_endereco_pessoa_to_string))
        {
            return $this->pessoa_endereco_pessoa_to_string;
        }
    
        $values = PessoaEndereco::where('pessoa_id', '=', $this->id)->getIndexedArray('pessoa_id','{pessoa->nome}');
        return implode(', ', $values);
    }

    public function set_pessoa_grupo_pessoa_to_string($pessoa_grupo_pessoa_to_string)
    {
        if(is_array($pessoa_grupo_pessoa_to_string))
        {
            $values = Pessoa::where('id', 'in', $pessoa_grupo_pessoa_to_string)->getIndexedArray('nome', 'nome');
            $this->pessoa_grupo_pessoa_to_string = implode(', ', $values);
        }
        else
        {
            $this->pessoa_grupo_pessoa_to_string = $pessoa_grupo_pessoa_to_string;
        }

        $this->vdata['pessoa_grupo_pessoa_to_string'] = $this->pessoa_grupo_pessoa_to_string;
    }

    public function get_pessoa_grupo_pessoa_to_string()
    {
        if(!empty($this->pessoa_grupo_pessoa_to_string))
        {
            return $this->pessoa_grupo_pessoa_to_string;
        }
    
        $values = PessoaGrupo::where('pessoa_id', '=', $this->id)->getIndexedArray('pessoa_id','{pessoa->nome}');
        return implode(', ', $values);
    }

    public function set_pessoa_grupo_grupo_pessoa_to_string($pessoa_grupo_grupo_pessoa_to_string)
    {
        if(is_array($pessoa_grupo_grupo_pessoa_to_string))
        {
            $values = GrupoPessoa::where('id', 'in', $pessoa_grupo_grupo_pessoa_to_string)->getIndexedArray('nome', 'nome');
            $this->pessoa_grupo_grupo_pessoa_to_string = implode(', ', $values);
        }
        else
        {
            $this->pessoa_grupo_grupo_pessoa_to_string = $pessoa_grupo_grupo_pessoa_to_string;
        }

        $this->vdata['pessoa_grupo_grupo_pessoa_to_string'] = $this->pessoa_grupo_grupo_pessoa_to_string;
    }

    public function get_pessoa_grupo_grupo_pessoa_to_string()
    {
        if(!empty($this->pessoa_grupo_grupo_pessoa_to_string))
        {
            return $this->pessoa_grupo_grupo_pessoa_to_string;
        }
    
        $values = PessoaGrupo::where('pessoa_id', '=', $this->id)->getIndexedArray('grupo_pessoa_id','{grupo_pessoa->nome}');
        return implode(', ', $values);
    }

    public function set_orcamento_pessoa_to_string($orcamento_pessoa_to_string)
    {
        if(is_array($orcamento_pessoa_to_string))
        {
            $values = Pessoa::where('id', 'in', $orcamento_pessoa_to_string)->getIndexedArray('nome', 'nome');
            $this->orcamento_pessoa_to_string = implode(', ', $values);
        }
        else
        {
            $this->orcamento_pessoa_to_string = $orcamento_pessoa_to_string;
        }

        $this->vdata['orcamento_pessoa_to_string'] = $this->orcamento_pessoa_to_string;
    }

    public function get_orcamento_pessoa_to_string()
    {
        if(!empty($this->orcamento_pessoa_to_string))
        {
            return $this->orcamento_pessoa_to_string;
        }
    
        $values = Orcamento::where('pessoa_id', '=', $this->id)->getIndexedArray('pessoa_id','{pessoa->nome}');
        return implode(', ', $values);
    }

    
}

