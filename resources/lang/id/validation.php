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

    'accepted' => 'The :attribute harus diterima.',
    'active_url' => 'The :attribute bukan URL yang valid.',
    'after' => 'The :attribute harus berisi tanggal setelah :date.',
    'after_or_equal' => 'The :harus berisi tanggal setelah atau sama dengan :date.',
    'alpha' => 'The :attribute hanya boleh berisi huruf.',
    'alpha_dash' => 'The :attribute hanya boleh berisi huruf, angka, strip dan garis bawah.',
    'alpha_num' => 'The :attribute hanya boleh berisi huruf dan angka.',
    'array' => 'The :attribute harus berisi sebuah array.',
    'before' => 'The :attribute harus berisi tanggal sebelum :date.',
    'before_or_equal' => 'The :attribute harus berisi tanggal sebelum atau sama dengan :date.',
    'between' => [
        'numeric' => 'The :attribute harus benilai antara :min sampai :max.',
        'file' => 'The :attribute harus berukuran antara :min sampai :max kilobita.',
        'string' => 'The :attribute harus berisi antara :min sampai :max karakter.',
        'array' => 'The :attribute harus memiliki :min sampai :max anggota.',
    ],
    'boolean' => 'The :attribute harus bernilai true atau false.',
    'confirmed' => 'The :attribute tidak cocok.',
    'date' => 'The :attribute bukan tanggal yang valid.',
    'date_equals' => 'The :attribute harus berisi tanggal yang sama dengan :date.',
    'date_format' => 'The :attribute tidak cocok dengan format :format.',
    'different' => 'The :attribute dan :other harus berbeda.',
    'digits' => 'The :attribute harus terdiri dari :digits angka.',
    'digits_between' => 'The :attribute harus terdiri dari :min sampai :max angka.',
    'dimensions' => 'The :attribute tidak memiliki dimensi gambar yang valid.',
    'distinct' => 'The :attribute memiliki nilai yang duplikat',
    'email' => 'The :attribute harus berupa alamat surel yang valid.',
    'ends_with' => 'The :attribute harus diakhiri salah satu dari berikut: :values.',
    'exists' => 'The selected :attribute yang dipilih tidak valid.',
    'file' => 'The :attribute harus berupa sebuah berkas.',
    'filled' => 'The :attribute harus memiliki nilai.',
    'gt' => [
        'numeric' => 'The :attribute harus bernilai lebih besar dari :value.',
        'file' => 'The :attribute harus berukuran lebih besar dari :value kilobita.',
        'string' => 'The :attribute harus berisi lebih besar dari :value karakter.',
        'array' => 'The :attribute harus memiliki lebih dari :value anggota.',
    ],
    'gte' => [
        'numeric' => 'The :attribute  harus bernilai lebih besar dari atau sama dengan :value.',
        'file' => 'The :attribute harus berukuran lebih besar dari atau sama dengan :value kilobita.',
        'string' => 'The :attribute harus berisi lebih besar dari atau sama dengan :value karakter.',
        'array' => 'The :attribute harus terdiri dari :value anggota atau lebih.',
    ],
    'image' => 'The :attribute harus berupa gambar.',
    'in' => 'The selected :attribute yang dipilih tidak valid.',
    'in_array' => 'The :attribute tidak ada dalam :other.',
    'integer' => 'The :attribute harus berupa bilangan bulat.',
    'ip' => 'The :attribute harus berupa alamat IP yang valid.',
    'ipv4' => 'The :attribute harus berupa alamat IPv4 yang valid.',
    'ipv6' => 'The :attribute harus berupa alamat IPv6 yang valid.',
    'json' => 'The :attribute harus berupa JSON string yang valid.',
    'lt' => [
        'numeric' => 'The :attribute harus bernilai kurang dari atau sama dengan :value.',
        'file' => 'The :attribute harus berukuran dari atau sama dengan :value kilobita.',
        'string' => 'The :attribute harus berisi kurang dari atau sama dengan :value karakter.',
        'array' => 'The :attribute harus tidak lebih dari :value anggota.',
    ],
    'lte' => [
        'numeric' => 'The :attribute harus bernilai kurang dari atau sama dengan :value.',
        'file' => 'The :attribute harus berukuran kurang dari atau sama dengan :value kilobita.',
        'string' => 'The :attribute harus berisi kurang dari :value karakter.',
        'array' => 'The :attribute harus tidak lebih dari :value anggota.',
    ],
    'max' => [
        'numeric' => 'The :attribute maksimal bernilai :max.',
        'file' => 'The :attribute maksimal berukuran :max kilobita.',
        'string' => 'The :attribute maksimal berisi  :max karakter.',
        'array' => 'The :attribute maksimal terdiri dari :max anggota.',
    ],
    'mimes' => 'The :attribute harus berupa berkas berjenis: :values.',
    'mimetypes' => 'The :attribute harus berupa berkas berjenis: :values.',
    'min' => [
        'numeric' => 'The :attribute minimal bernilai :min.',
        'file' => 'The :attribute minimal berukuran :min kilobytes.',
        'string' => 'The :attribute minimal berisi :min characters.',
        'array' => 'The :attribute minimal terdiri dari :min items.',
    ],
    'not_in' => 'The selected :attribute yang dipilihtidak valid.',
    'not_regex' => 'The :attribute tidak valid.',
    'numeric' => 'The :attribute harus berupa angka.',
    'password' => 'Kata sandi salah.',
    'present' => 'The :attribute wajib ada.',
    'regex' => 'The :attribute tidak valid.',
    'required' => 'The :attribute wajib diisi.',
    'required_if' => 'The :attribute wajib diisi bila :other adalah :value.',
    'required_unless' => 'The :attribute wajib diisi kecuali :other memiliki nilai :values.',
    'required_with' => 'The :attribute wajib diisi bila terdapat :values.',
    'required_with_all' => 'The :attribute wajib diisi bila terdapat :values.',
    'required_without' => 'The :attribute wajib diisi bila tidak terdapat :values.',
    'required_without_all' => 'The :attribute wajib diisi bila sama sekali tidak terdapat :values.',
    'same' => 'The :attribute dan :other harus sama.',
    'size' => [
        'numeric' => 'The :attribute:size.',
        'file' => 'The :attribute harus berukuran:size kilobyte.',
        'string' => 'The :attribute harus berukuran:size karakter.',
        'array' => 'The :attribute harus mengandung :size anggota.',
    ],
    'starts_with' => 'The :attribute harus diawali salah satu dari berikut: :values.',
    'string' => 'The :attribute harus berupa string.',
    'timezone' => 'The :attribute harus berisi zona waktu yang valid.',
    'unique' => 'The :attribute sudah ada sebelumnya.',
    'uploaded' => 'The :attribute gagal diunggah.',
    'url' => 'The :attribute tidak valid.',
    'uuid' => 'The :attribute harus merupakan UUID yang valid.',

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
