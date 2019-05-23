<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages.
    |
    */

    'accepted'             => ':Attribute musi zostać zaakceptowany.',
    'active_url'           => ':Attribute jest nieprawidłowym adresem URL.',
    'after'                => ':Attribute musi być datą późniejszą od :date.',
    'after_or_equal'       => ':Attribute musi być datą nie wcześniejszą niż :date.',
    'alpha'                => ':Attribute może zawierać jedynie litery.',
    'alpha_dash'           => ':Attribute może zawierać jedynie litery, cyfry i myślniki.',
    'alpha_num'            => ':Attribute może zawierać jedynie litery i cyfry.',
    'array'                => ':Attribute musi być tablicą.',
    'before'               => ':Attribute musi być datą wcześniejszą od :date.',
    'before_or_equal'      => ':Attribute musi być datą nie późniejszą niż :date.',
    'between'              => [
        'numeric' => ':Attribute musi zawierać się w granicach :min - :max.',
        'file'    => ':Attribute musi zawierać się w granicach :min - :max kilobajtów.',
        'string'  => ':Attribute musi zawierać się w granicach :min - :max znaków.',
        'array'   => ':Attribute musi składać się z :min - :max elementów.',
    ],
    'boolean'              => ':Attribute musi mieć wartość prawda albo fałsz',
    'confirmed'            => 'Potwierdzenie :attribute nie zgadza się.',
    'date'                 => ':Attribute nie jest prawidłową datą.',
    'date_equals'          => ':Attribute musi być datą równą :date.',
    'date_format'          => ':Attribute nie jest w formacie :format.',
    'different'            => ':Attribute oraz :other muszą się różnić.',
    'digits'               => ':Attribute musi składać się z :digits cyfr.',
    'digits_between'       => ':Attribute musi mieć od :min do :max cyfr.',
    'dimensions'           => ':Attribute ma niepoprawne wymiary.',
    'distinct'             => ':Attribute ma zduplikowane wartości.',
    'email'                => 'Format :attribute jest nieprawidłowy.',
    'exists'               => 'Zaznaczony :attribute jest nieprawidłowy.',
    'file'                 => ':Attribute musi być plikiem.',
    'filled'               => 'Pole :attribute jest wymagane.',
    'gt'                   => [
        'numeric' => ':Attribute musi być większy niż :value.',
        'file'    => ':Attribute musi być większy niż :value kilobajtów.',
        'string'  => ':Attribute musi być dłuższy niż :value znaków.',
        'array'   => ':Attribute musi mieć więcej niż :value elementów.',
    ],
    'gte'                  => [
        'numeric' => ':Attribute musi być większy lub równy :value.',
        'file'    => ':Attribute musi być większy lub równy :value kilobajtów.',
        'string'  => ':Attribute musi być dłuższy lub równy :value znaków.',
        'array'   => ':Attribute musi mieć :value lub więcej elementów.',
    ],
    'image'                => ':Attribute musi być obrazkiem.',
    'in'                   => 'Zaznaczony :attribute jest nieprawidłowy.',
    'in_array'             => ':Attribute nie znajduje się w :other.',
    'integer'              => ':Attribute musi być liczbą całkowitą.',
    'ip'                   => ':Attribute musi być prawidłowym adresem IP.',
    'ipv4'                 => ':Attribute musi być prawidłowym adresem IPv4.',
    'ipv6'                 => ':Attribute musi być prawidłowym adresem IPv6.',
    'json'                 => ':Attribute musi być poprawnym ciągiem znaków JSON.',
    'lt'                   => [
        'numeric' => ':Attribute musi być mniejszy niż :value.',
        'file'    => ':Attribute musi być mniejszy niż :value kilobajtów.',
        'string'  => ':Attribute musi być krótszy niż :value znaków.',
        'array'   => ':Attribute musi mieć mniej niż :value elementów.',
    ],
    'lte'                  => [
        'numeric' => ':Attribute musi być mniejszy lub równy :value.',
        'file'    => ':Attribute musi być mniejszy lub równy :value kilobajtów.',
        'string'  => ':Attribute musi być krótszy lub równy :value znaków.',
        'array'   => ':Attribute musi mieć :value lub mniej elementów.',
    ],
    'max'                  => [
        'numeric' => ':Attribute nie może być większy niż :max.',
        'file'    => ':Attribute nie może być większy niż :max kilobajtów.',
        'string'  => ':Attribute nie może być dłuższy niż :max znaków.',
        'array'   => ':Attribute nie może mieć więcej niż :max elementów.',
    ],
    'mimes'                => ':Attribute musi być plikiem typu :values.',
    'mimetypes'            => ':Attribute musi być plikiem typu :values.',
    'min'                  => [
        'numeric' => ':Attribute musi być nie mniejszy od :min.',
        'file'    => ':Attribute musi mieć przynajmniej :min kilobajtów.',
        'string'  => ':Attribute musi mieć przynajmniej :min znaków.',
        'array'   => ':Attribute musi mieć przynajmniej :min elementów.',
    ],
    'not_in'               => 'Zaznaczony :attribute jest nieprawidłowy.',
    'not_regex'            => 'Format :attribute jest nieprawidłowy.',
    'numeric'              => ':Attribute musi być liczbą.',
    'present'              => 'Pole :attribute musi być obecne.',
    'regex'                => 'Format :attribute jest nieprawidłowy.',
    'required'             => 'Pole :attribute jest wymagane.',
    'required_if'          => 'Pole :attribute jest wymagane gdy :other jest :value.',
    'required_unless'      => ':attribute jest wymagany jeżeli :other nie znajduje się w :values.',
    'required_with'        => 'Pole :attribute jest wymagane gdy :values jest obecny.',
    'required_with_all'    => 'Pole :attribute jest wymagane gdy :values jest obecny.',
    'required_without'     => 'Pole :attribute jest wymagane gdy :values nie jest obecny.',
    'required_without_all' => 'Pole :attribute jest wymagane gdy żadne z :values nie są obecne.',
    'same'                 => 'Pole :attribute i :other muszą się zgadzać.',
    'size'                 => [
        'numeric' => ':Attribute musi mieć :size.',
        'file'    => ':Attribute musi mieć :size kilobajtów.',
        'string'  => ':Attribute musi mieć :size znaków.',
        'array'   => ':Attribute musi zawierać :size elementów.',
    ],
    'starts_with'          => ':Attribute musi się zaczynać jednym z wymienionych: :values',
    'string'               => ':Attribute musi być ciągiem znaków.',
    'timezone'             => ':Attribute musi być prawidłową strefą czasową.',
    'unique'               => 'Taki :attribute już występuje.',
    'uploaded'             => 'Nie udało się wgrać pliku :attribute.',
    'url'                  => 'Format :attribute jest nieprawidłowy.',
    'uuid'                 => ':Attribute musi być poprawnym identyfikatorem UUID.',

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
        'code' => [
            'in' => 'Kod weryfikacyjny jest nieprawidłowy.',
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

    'attributes' => [
        'email' => 'adres emial',
        'password' => 'hasło',
        'name' => 'imię',
        'surname' => 'nazwisko',
        'password_confirmation' => 'potwierdzenie hasła',
        'matura_year' => 'rok matury',
        'description' => 'opis',
        'scans' => 'skany',
        'new-password' => 'nowe hasło'
    ],

];
