<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => ':attribute 은 유효하지 않은 URL입니다.',
    'after'                => ':attribute 는 반드시 :date 이후여야 합니다.',
    'alpha'                => ':attribute 는 문자만 포함해야합니다.',
    'alpha_dash'           => ':attribute 는 문자, 숫자, 대시를 포함해야 합니다.',
    'alpha_num'            => ':attribute 는 문자와 숫자를 포함해야 합니다.',
    'array'                => ':attribute must be an array.',
    'before'               => ':attribute 는 반드시 :date 이전이어야 합니다.',
    'between'              => [
        'numeric' => ':attribute 는 반드시 최소 :min 최대 :max여야 합니다.',
        'file'    => ':attribute 는 반드시 최소 :min 최대 :maxKB이어야 합니다.',
        'string'  => ':attribute 는 반드시 최소 :min 최대 :max자이어야 합니다.',
        'array'   => ':attribute 는 반드시 최소 :min 최대 :max개이어야 합니다.',
    ],
    'boolean'              => ':attribute값은 반드시 참 혹은 거짓이어야 합니다.',
    'confirmed'            => ':attribute 확인이 일치하지 않습니다.',
    'date'                 => ':attribute는 유효한 날짜가 아닙니다.',
    'date_format'          => ':attribute값이 요구되는 형식과 맞지 않습니다 :format.',
    'different'            => ':attribute와 :other는 반드시 달라야합니다.',
    'digits'               => ':attribute는 반드시 :digits 숫자이어야 합니다.',
    'digits_between'       => ':attribute는 반드시 최소 :min 최대 :max 숫자이어야 합니다.',
    'email'                => ':attribute는 반드시 유효한 이메일이어야 합니다.',
    'exists'               => '선택된 :attribute는 유효하지 않습니다.',
    'filled'               => ':attribute값은 반드시 입력되어야 합니다.',
    'image'                => ':attribute 는 반드시 이미지여야 합니다.',
    'in'                   => '선택된 :attribute는 유효하지 않습니다.',
    'integer'              => ':attribute는 반드시 정수여야 합니다.',
    'ip'                   => ':attribute는 반드시 유효한 IP 주소여야 합니다.',
    'json'                 => ':attribute는 반드시 유효한 JSON 문자열이어야 합니다.',
    'max'                  => [
        'numeric' => ':attribute는 :max 를 초과할 수 없습니다.',
        'file'    => ':attribute는 :max kilobytes를 초과할 수 없습니다.',
        'string'  => ':attribute는 :max 자를 초과할 수 없습니다.',
        'array'   => ':attribute는 :max 개 이상을 초과할 수 없습니다.',
    ],
    'mimes'                => ':attribute는 반드시 다음과 같은 파일 형식이어야 합니다 :values.',
    'min'                  => [
        'numeric' => ':attribute는 반드시 최소 :min 이상 이어야 합니다.',
        'file'    => ':attribute는 최소 :min KB 이상 이어야 합니다.',
        'string'  => ':attribute는 최소한 :min 자 이상 이어야 합니다.',
        'array'   => ':attribute는 반드시 최소 :min개의 아이템을 가지고 있어야 합니다.',
    ],
    'not_in'               => '선택된 :attribute는 유효하지 않습니다.',
    'numeric'              => ':attribute는 반드시 숫자이어야 합니다.',
    'regex'                => ':attribute 형식은 유효하지 않습니다.',
    'required'             => ':attribute칸은 필수기입사항입니다.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => ':attribute와 :other는 반드시 일치해야 합니다.',
    'size'                 => [
        'numeric' => ':attribute는 반드시 :size이어야 합니다.',
        'file'    => ':attribute는 반드시 :sizeKB이어야 합니다.',
        'string'  => ':attribute는 반드시 :size자이어야 합니다.',
        'array'   => ':attribute는 반드시 :size개를 포함해야합니다.',
    ],
    'string'               => ':attribute는 반드시 문자열이어야 합니다.',
    'timezone'             => ':attribute 는 반드시 유효한 시간대이어야 합니다.',
    'unique'               => ':attribute 는 이미 사용중입니다.',
    'url'                  => ':attribute 형식은 유효하지 않습니다.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
