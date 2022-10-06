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
    'min_digits' => ':attribute 必須至少有 :min 位數',
    'multiple_of' => ':attribute 必須是 :value 的倍數',
    'not_in' => '所選擇的 :attribute 選項無效',
    'not_regex' => ':attribute 格式錯誤',
    'numeric' => ':attribute 必須是數字',
    'password' => [
        'letters' => 'The :attribute must contain at least one letter.',
        'mixed' => 'The :attribute must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'The :attribute must contain at least one number.',
        'symbols' => 'The :attribute must contain at least one symbol.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => ':attribute 必須存在於輸入數據中，但可以為空',
    'prohibited' => ':attribute 必須為空或不存在',
    'prohibited_if' => '當 :other 為 :value 時，:attribute 必須為空或不存在',
    'prohibited_unless' => '禁止使用 :attribute 字段，除非 :other 在 :values 中',
    'prohibits' => ':attribute 字段禁止 :other 出現',
    'regex' => ':attribute 格式錯誤',
    'required' => ':attribute 為必填',
    'required_array_keys' => ':attribute 必須包含: :values 陣列',
    'required_if' => '當 :other 是 :value 時， :attribute 為必填',
    'required_unless' => '當 :other 不是 :value 時， :attribute 為必填',
    'required_with' => '當 :values 出現時 :attribute 為必填',
    'required_with_all' => '當 :values 出現時 :attribute 為必填',
    'required_without' => '當 :values 為空時 :attribute 為必填',
    'required_without_all' => '當 :values 都沒出現時 :attribute 為必填',
    'same' => ':attribute 與 :other 必須相同',
    'size' => [
        'array' => ':attribute 必須有 :size 個元素',
        'file' => ':attribute 的大小必須是 :size KB',
        'numeric' => ':attribute 的大小必須是 :size',
        'string' => ':attribute 必須是 :size 個字元',
    ],
    'starts_with' => ':attribute 必須以 :values 其中之一開始',
    'string' => ':attribute 必須是一個字串',
    'timezone' => ':attribute 必須是一個正確的時區值',
    'unique' => ':attribute 已經存在',
    'uploaded' => ':attribute 上傳失敗',
    'url' => ':attribute 格式錯誤',
    'uuid' => ':attribute 必須是一個有效的UUID值',

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
