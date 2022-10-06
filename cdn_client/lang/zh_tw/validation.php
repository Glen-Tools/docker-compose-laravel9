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

    'accepted' => '必須接受 :attribute',
    'accepted_if' => '當 :other 是 :value 時必須接受 :attribute',
    'active_url' => ':attribute 並非一個有效的網址',
    'after' => ':attribute 必須要在 :date 之後的日期',
    'after_or_equal' => ':attribute 必須要在 :date 之後或一樣的日期',
    'alpha' => ':attribute 只能以英文組成',
    'alpha_dash' => ':attribute 只能以英文、數字及斜線組成',
    'alpha_num' => ':attribute 只能以英文及數字組成',
    'array' => ':attribute 必須為陣列',
    'before' => ':attribute 必須要在 :date 之前的日期',
    'before_or_equal' => ':attribute 必須要在 :date 之前或或一樣的日期',
    'between' => [
        'array' => ':attribute 必須介於 :min 和 :max 個元素 之間',
        'file' => ':attribute 必須介於 :min 和 :max KB 之間',
        'numeric' => ':attribute 必須介於 :min 和 :max 之間',
        'string' => ':attribute 必須介於 :min 和 :max 個字元 之間',
    ],
    'boolean' => ':attribute 必須為布林值',
    'confirmed' => ':attribute 確認欄位的輸入並不相符',
    'current_password' => '密碼不正確',
    'date' => ':attribute 並非一個有效的日期',
    'date_equals' => ':attribute 必須和 :date 相等',
    'date_format' => ':attribute 與 :format 格式不相符',
    'declined' => '屬性必須被拒絕',
    'declined_if' => '當 :other 為 :value 時，必須拒絕 :attribute',
    'different' => ':attribute 與 :other 必須不同',
    'digits' => ':attribute 必須是 :digits 位數字',
    'digits_between' => ':attribute 必須介於 :min 至 :max 位數字',
    'dimensions' => ':attribute 不符合圖片尺寸',
    'distinct' => ':attribute 已經存在',
    'doesnt_end_with' => ':attribute 不能以下列之一結尾: :values',
    'doesnt_start_with' => ':attribute 不能以下列之一開頭: :values',
    'email' => ':attribute 不是有效的E-mail格式',
    'ends_with' => ':attribute 必須以 :values 作為結束',
    'enum' => '選擇的 :attribute 不符合',
    'exists' => '所選擇的 :attribute 選項無效',
    'file' => ':attribute 必須是一個檔案',
    'filled' => ':attribute 不能為空',
    'gt' => [
        'array' => ':attribute 必須大於 :value 個元素',
        'file' => ':attribute 必須大於 :value KB',
        'numeric' => ':attribute 必須大於 :value',
        'string' => ':attribute 必須大於 :value 個字元',
    ],
    'gte' => [
        'array' => ':attribute 必須大於等於 :value 個元素',
        'file' => ':attribute 必須大於等於 :value KB',
        'numeric' => ':attribute 必須大於等於 :value',
        'string' => ':attribute 必須大於等於 :value 個字元',
    ],
    'image' => ':attribute 必須是一張圖片',
    'in' => '所選擇的 :attribute 不符合',
    'in_array' => ':attribute 沒有在 :other 中',
    'integer' => ':attribute 必須是一個整數',
    'ip' => ':attribute 不是一個有效的IP網址',
    'ipv4' => ':attribute 不是一個有效的IPv4網址',
    'ipv6' => ':attribute 不是一個有效的IPv6網址',
    'json' => ':attribute 不是一個有效的JSON字串',
    'lt' => [
        'array' => ':attribute 必須小於 :value 個元素',
        'file' => ':attribute 必須小於 :value KB',
        'numeric' => ':attribute 必須小於 :value',
        'string' => ':attribute 必須小於 :value 個字元',
    ],
    'lte' => [
        'array' => ':attribute 必須小於等於 :value 個元素',
        'file' => ':attribute 必須小於等於 :value KB',
        'numeric' => ':attribute 必須小於等於 :value',
        'string' => ':attribute 必須小於等於 :value 個字元',
    ],
    'mac_address' => ':attribute 必須是有效的 MAC 地址',
    'max' => [
        'array' => ':attribute 不能超過 :max 個元素',
        'file' => ':attribute 不能超過 :max KB',
        'numeric' => ':attribute 不能超過 :max',
        'string' => ':attribute 不能超過 :max 個字元',
    ],
    'max_digits' => ':attribute 不能超過 :max 位數',
    'mimes' => ':attribute 必須為 :values 的檔案',
    'mimetypes' => ':attribute 必須為 :values 的檔案',
    'min' => [
        'array' => ':attribute 不能小於 :min 個元素',
        'file' => ':attribute 不能小於 :min KB',
        'numeric' => ':attribute 不能小於 :min',
        'string' => ':attribute 不能小於 :min 個字元',
    ],
    'min_digits' => 'The :attribute must have at least :min digits.',
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => [
        'letters' => 'The :attribute must contain at least one letter.',
        'mixed' => 'The :attribute must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'The :attribute must contain at least one number.',
        'symbols' => 'The :attribute must contain at least one symbol.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => 'The :attribute field must be present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'array' => 'The :attribute must contain :size items.',
        'file' => 'The :attribute must be :size kilobytes.',
        'numeric' => 'The :attribute must be :size.',
        'string' => 'The :attribute must be :size characters.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid timezone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute must be a valid URL.',
    'uuid' => 'The :attribute must be a valid UUID.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
