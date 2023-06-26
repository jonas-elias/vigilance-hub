<?php

declare(strict_types=1);
/**
 * Este arquivo faz parte do Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Linhas de Idioma para Validação
    |--------------------------------------------------------------------------
    |
    | As seguintes linhas de idioma contêm as mensagens de erro padrão usadas pelo
    | classe validadora. Algumas dessas regras têm várias versões, como
    | as regras de tamanho. Sinta-se à vontade para ajustar cada uma dessas mensagens aqui.
    |
    */

    'accepted' => 'O campo :attribute deve ser aceito.',
    'active_url' => 'O campo :attribute não é uma URL válida.',
    'after' => 'O campo :attribute deve ser uma data posterior a :date.',
    'after_or_equal' => 'O campo :attribute deve ser uma data posterior ou igual a :date.',
    'alpha' => 'O campo :attribute pode conter apenas letras.',
    'alpha_dash' => 'O campo :attribute pode conter apenas letras, números e traços.',
    'alpha_num' => 'O campo :attribute pode conter apenas letras e números.',
    'array' => 'O campo :attribute deve ser uma matriz.',
    'before' => 'O campo :attribute deve ser uma data anterior a :date.',
    'before_or_equal' => 'O campo :attribute deve ser uma data anterior ou igual a :date.',
    'between' => [
        'numeric' => 'O campo :attribute deve estar entre :min e :max.',
        'file' => 'O campo :attribute deve ter entre :min e :max kilobytes.',
        'string' => 'O campo :attribute deve ter entre :min e :max caracteres.',
        'array' => 'O campo :attribute deve ter entre :min e :max itens.',
    ],
    'boolean' => 'O campo :attribute deve ser verdadeiro ou falso.',
    'confirmed' => 'A confirmação do campo :attribute não corresponde.',
    'date' => 'O campo :attribute não é uma data válida.',
    'date_format' => 'O campo :attribute não corresponde ao formato :format.',
    'different' => 'Os campos :attribute e :other devem ser diferentes.',
    'digits' => 'O campo :attribute deve ter :digits dígitos.',
    'digits_between' => 'O campo :attribute deve ter entre :min e :max dígitos.',
    'dimensions' => 'O campo :attribute possui dimensões de imagem inválidas.',
    'distinct' => 'O campo :attribute possui um valor duplicado.',
    'email' => 'O campo :attribute deve ser um endereço de e-mail válido.',
    'exists' => 'O :attribute selecionado é inválido.',
    'file' => 'O campo :attribute deve ser um arquivo.',
    'filled' => 'O campo :attribute é obrigatório.',
    'gt' => [
        'numeric' => 'O campo :attribute deve ser maior que :value',
        'file' => 'O campo :attribute deve ser maior que :value kb',
        'string' => 'O campo :attribute deve ser maior que :value caracteres',
        'array' => 'O campo :attribute deve ser maior que :value itens',
    ],
    'gte' => [
        'numeric' => 'O campo :attribute deve ser maior ou igual a :value',
        'file' => 'O campo :attribute deve ser maior ou igual a :value kb',
        'string' => 'O campo :attribute deve ser maior ou igual a :value caracteres',
        'array' => 'O campo :attribute deve ser maior ou igual a :value itens',
    ],
    'image' => 'O campo :attribute deve ser uma imagem.',
    'in' => 'O :attribute selecionado é inválido.',
    'in_array' => 'O campo :attribute não existe em :other.',
    'integer' => 'O campo :attribute deve ser um número inteiro.',
    'ip' => 'O campo :attribute deve ser um endereço IP válido.',
    'ipv4' => 'O campo :attribute deve ser um endereço IPv4 válido.',
    'ipv6' => 'O campo :attribute deve ser um endereço IPv6 válido.',
    'json' => 'O campo :attribute deve ser uma string JSON válida.',
    'lt' => [
        'numeric' => 'O campo :attribute deve ser menor que :value',
        'file' => 'O campo :attribute deve ser menor que :value kb',
        'string' => 'O campo :attribute deve ser menor que :value caracteres',
        'array' => 'O campo :attribute deve ser menor que :value itens',
    ],
    'lte' => [
        'numeric' => 'O campo :attribute deve ser menor ou igual a :value',
        'file' => 'O campo :attribute deve ser menor ou igual a :value kb',
        'string' => 'O campo :attribute deve ser menor ou igual a :value caracteres',
        'array' => 'O campo :attribute deve ser menor ou igual a :value itens',
    ],
    'max' => [
        'numeric' => 'O campo :attribute não pode ser maior que :max.',
        'file' => 'O campo :attribute não pode ser maior que :max kilobytes.',
        'string' => 'O campo :attribute não pode ser maior que :max caracteres.',
        'array' => 'O campo :attribute não pode ter mais que :max itens.',
    ],
    'mimes' => 'O campo :attribute deve ser um arquivo do tipo: :values.',
    'mimetypes' => 'O campo :attribute deve ser um arquivo do tipo: :values.',
    'min' => [
        'numeric' => 'O campo :attribute deve ser pelo menos :min.',
        'file' => 'O campo :attribute deve ter pelo menos :min kilobytes.',
        'string' => 'O campo :attribute deve ter pelo menos :min caracteres.',
        'array' => 'O campo :attribute deve ter pelo menos :min itens.',
    ],
    'not_in' => 'O :attribute selecionado é inválido.',
    'not_regex' => 'O campo :attribute não pode corresponder a uma regra regular dada.',
    'numeric' => 'O campo :attribute deve ser um número.',
    'present' => 'O campo :attribute deve estar presente.',
    'regex' => 'O formato do campo :attribute é inválido.',
    'required' => 'O campo :attribute é obrigatório.',
    'required_if' => 'O campo :attribute é obrigatório quando :other é :value.',
    'required_unless' => 'O campo :attribute é obrigatório, a menos que :other esteja em :values.',
    'required_with' => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_with_all' => 'O campo :attribute é obrigatório quando :values estão presentes.',
    'required_without' => 'O campo :attribute é obrigatório quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum dos valores :values está presente.',
    'same' => 'O campo :attribute e :other devem ser iguais.',
    'size' => [
        'numeric' => 'O campo :attribute deve ser :size.',
        'file' => 'O campo :attribute deve ser :size kilobytes.',
        'string' => 'O campo :attribute deve ser :size caracteres.',
        'array' => 'O campo :attribute deve conter :size itens.',
    ],
    'starts_with' => 'O campo :attribute deve começar com um dos seguintes valores: :values ',
    'string' => 'O campo :attribute deve ser uma string.',
    'timezone' => 'O campo :attribute deve ser uma zona válida.',
    'unique' => 'O campo :attribute já foi utilizado.',
    'uploaded' => 'O campo :attribute falhou ao ser carregado.',
    'url' => 'O formato do campo :attribute é inválido.',
    'uuid' => 'O campo :attribute é um UUID inválido.',
    'max_if' => [
        'numeric' => 'O campo :attribute não pode ser maior que :max quando :other é :value.',
        'file' => 'O campo :attribute não pode ser maior que :max kilobytes quando :other é :value.',
        'string' => 'O campo :attribute não pode ser maior que :max caracteres quando :other é :value.',
        'array' => 'O campo :attribute não pode ter mais que :max itens quando :other é :value.',
    ],
    'min_if' => [
        'numeric' => 'O campo :attribute deve ser pelo menos :min quando :other é :value.',
        'file' => 'O campo :attribute deve ter pelo menos :min kilobytes quando :other é :value.',
        'string' => 'O campo :attribute deve ter pelo menos :min caracteres quando :other é :value.',
        'array' => 'O campo :attribute deve ter pelo menos :min itens quando :other é :value.',
    ],
    'between_if' => [
        'numeric' => 'O campo :attribute deve estar entre :min e :max quando :other é :value.',
        'file' => 'O campo :attribute deve estar entre :min e :max kilobytes quando :other é :value.',
        'string' => 'O campo :attribute deve estar entre :min e :max caracteres quando :other é :value.',
        'array' => 'O campo :attribute deve ter entre :min e :max itens quando :other é :value.',
    ],
    /*
    |--------------------------------------------------------------------------
    | Linhas de Linguagem Personalizadas de Validação
    |--------------------------------------------------------------------------
    |
    | Aqui você pode especificar mensagens de validação personalizadas para atributos usando a
    | convenção "attribute.rule" para nomear as linhas. Isso nos ajuda a
    | especificar rapidamente uma linha de idioma personalizada específica para uma determinada regra de atributo.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Atributos Personalizados de Validação
    |--------------------------------------------------------------------------
    |
    | As seguintes linhas de linguagem são usadas para substituir os place-holders de atributos
    | com algo mais amigável para o leitor, como "Endereço de E-mail" em vez de
    | "email". Isso simplesmente nos ajuda a tornar as mensagens um pouco mais limpas.
    |
    */

    'attributes' => [],

];
