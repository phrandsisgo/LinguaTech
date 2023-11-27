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

    'accepted' => 'Das :attribute muss akzeptiert werden.',
    'accepted_if' => 'Das :attribute muss akzeptiert werden, wenn :other :value ist.',
    'active_url' => 'Das :attribute muss eine gültige URL sein.',
    'after' => 'Das :attribute muss ein Datum nach dem :date sein.',
    'after_or_equal' => 'Das :attribute muss ein Datum nach oder gleich dem :date sein.',
    'alpha' => 'Das :attribute darf nur Buchstaben enthalten.',
    'alpha_dash' => 'Das :attribute darf nur Buchstaben, Zahlen, Bindestriche und Unterstriche enthalten.',
    'alpha_num' => 'Das :attribute darf nur Buchstaben und Zahlen enthalten.',
    'array' => 'Das :attribute muss ein Array sein.',
    'ascii' => 'Das :attribute darf nur einbyteige alphanumerische Zeichen und Symbole enthalten.',
    'before' => 'Das :attribute muss ein Datum vor dem :date sein.',
    'before_or_equal' => 'Das :attribute muss ein Datum vor oder gleich dem :date sein.',
    'between' => [
        'array' => 'Das :attribute muss zwischen :min und :max Elemente haben.',
        'file' => 'Das :attribute muss zwischen :min und :max Kilobytes groß sein.',
        'numeric' => 'Das :attribute muss zwischen :min und :max liegen.',
        'string' => 'Das :attribute muss zwischen :min und :max Zeichen lang sein.',
    ],
    'boolean' => 'Das :attribute Feld muss wahr oder falsch sein.',
    'can' => 'Das :attribute enthält einen unautorisierten Wert.',
    'confirmed' => 'Die Bestätigung des :attribute stimmt nicht überein.',
    'current_password' => 'Das Passwort ist falsch.',
    'date' => 'Das :attribute muss ein gültiges Datum sein.',
    'date_equals' => 'Das :attribute muss ein Datum gleich dem :date sein.',
    'date_format' => 'Das :attribute muss das Format :format entsprechen.',
    'decimal' => 'Das :attribute muss :decimal Dezimalstellen haben.',
    'declined' => 'Das :attribute muss abgelehnt werden.',
    'declined_if' => 'Das :attribute muss abgelehnt werden, wenn :other :value ist.',
    'different' => 'Das :attribute und :other müssen unterschiedlich sein.',
    'digits' => 'Das :attribute muss :digits Ziffern lang sein.',
    'digits_between' => 'Das :attribute muss zwischen :min und :max Ziffern lang sein.',
    'dimensions' => 'Das :attribute hat ungültige Bildabmessungen.',
    'distinct' => 'Das :attribute Feld hat einen doppelten Wert.',
    'doesnt_end_with' => 'Das :attribute darf nicht mit einem der folgenden enden: :values.',
    'doesnt_start_with' => 'Das :attribute darf nicht mit einem der folgenden beginnen: :values.',
    'email' => 'Das :attribute muss eine gültige E-Mail-Adresse sein.',
    'ends_with' => 'Das :attribute muss mit einem der folgenden enden: :values.',
    'enum' => 'Das ausgewählte :attribute ist ungültig.',
    'exists' => 'Das ausgewählte :attribute ist ungültig.',
    'file' => 'Das :attribute muss eine Datei sein.',
    'filled' => 'Das :attribute Feld muss einen Wert haben.',
    'gt' => [
        'array' => 'Das :attribute Feld muss mehr als :value Elemente haben.',
        'file' => 'Das :attribute muss größer als :value Kilobytes sein.',
        'numeric' => 'Das :attribute muss größer als :value sein.',
        'string' => 'Das :attribute muss mehr als :value Zeichen lang sein.',
    ],
    'gte' => [
        'array' => 'Das :attribute Feld muss :value Elemente oder mehr haben.',
        'file' => 'Das :attribute muss größer oder gleich :value Kilobytes sein.',
        'numeric' => 'Das :attribute muss größer oder gleich :value sein.',
        'string' => 'Das :attribute muss gleich oder mehr als :value Zeichen lang sein.',
    ],
    'image' => 'Das :attribute muss ein Bild sein.',
    'in' => 'Das ausgewählte :attribute ist ungültig.',
    'in_array' => 'Das :attribute Feld muss in :other vorhanden sein.',
    'integer' => 'Das :attribute muss eine ganze Zahl sein.',
    'ip' => 'Das :attribute muss eine gültige IP-Adresse sein.',
    'ipv4' => 'Das :attribute muss eine gültige IPv4-Adresse sein.',
    'ipv6' => 'Das :attribute muss eine gültige IPv6-Adresse sein.',
    'json' => 'Das :attribute muss ein gültiger JSON-String sein.',
    'lowercase' => 'Das :attribute muss in Kleinbuchstaben sein.',
    'lt' => [
        'array' => 'Das :attribute muss weniger als :value Elemente haben.',
        'file' => 'Das :attribute muss kleiner als :value Kilobytes sein.',
        'numeric' => 'Das :attribute muss kleiner als :value sein.',
        'string' => 'Das :attribute muss weniger als :value Zeichen lang sein.',
    ],
    'lte' => [
        'array' => 'Das :attribute darf nicht mehr als :value Elemente haben.',
        'file' => 'Das :attribute muss kleiner oder gleich :value Kilobytes sein.',
        'numeric' => 'Das :attribute muss kleiner oder gleich :value sein.',
        'string' => 'Das :attribute darf nicht mehr als :value Zeichen lang sein.',
    ],
    'mac_address' => 'Das :attribute muss eine gültige MAC-Adresse sein.',
    'max' => [
        'array' => 'Das :attribute darf nicht mehr als :max Elemente haben.',
        'file' => 'Das :attribute darf nicht größer als :max Kilobytes sein.',
        'numeric' => 'Das :attribute darf nicht größer als :max sein.',
        'string' => 'Das :attribute darf nicht mehr als :max Zeichen lang sein.',
    ],
    'max_digits' => 'Das :attribute darf nicht mehr als :max Ziffern haben.',
    'mimes' => 'Das :attribute muss eine Datei des Typs: :values sein.',
    'mimetypes' => 'Das :attribute muss eine Datei des Typs: :values sein.',
    'min' => [
        'array' => 'Das :attribute muss mindestens :min Elemente haben.',
        'file' => 'Das :attribute muss mindestens :min Kilobytes groß sein.',
        'numeric' => 'Das :attribute muss mindestens :min sein.',
        'string' => 'Das :attribute muss mindestens :min Zeichen lang sein.',
    ],
    'min_digits' => 'Das :attribute muss mindestens :min Ziffern haben.',
    'missing' => 'Das :attribute Feld muss fehlen.',
    'missing_if' => 'Das :attribute Feld muss fehlen, wenn :other :value ist.',
    'missing_unless' => 'Das :attribute Feld muss fehlen, es sei denn, :other ist :value.',
    'missing_with' => 'Das :attribute Feld muss fehlen, wenn :values vorhanden ist.',
    'missing_with_all' => 'Das :attribute Feld muss fehlen, wenn :values vorhanden sind.',
    'multiple_of' => 'Das :attribute muss ein Vielfaches von :value sein.',
    'not_in' => 'Das ausgewählte :attribute ist ungültig.',
    'not_regex' => 'Das Format des :attribute ist ungültig.',
    'numeric' => 'Das :attribute muss eine Zahl sein.',
    'password' => [
        'letters' => 'Das :attribute muss mindestens einen Buchstaben enthalten.',
        'mixed' => 'Das :attribute muss mindestens einen Groß- und einen Kleinbuchstaben enthalten.',
        'numbers' => 'Das :attribute muss mindestens eine Zahl enthalten.',
        'symbols' => 'Das :attribute muss mindestens ein Symbol enthalten.',
        'uncompromised' => 'Das angegebene :attribute wurde in einem Datenleck gefunden. Bitte wählen Sie ein anderes :attribute.',
    ],
    'present' => 'Das :attribute Feld muss vorhanden sein.',
    'prohibited' => 'Das :attribute Feld ist verboten.',
    'prohibited_if' => 'Das :attribute Feld ist verboten, wenn :other :value ist.',
    'prohibited_unless' => 'Das :attribute Feld ist verboten, es sei denn :other ist in :values.',
    'prohibits' => 'Das :attribute Feld verbietet :other vorhanden zu sein.',
    'regex' => 'Das Format des :attribute ist ungültig.',
    'required' => 'Das :attribute Feld ist erforderlich.',
    'required_array_keys' => 'Das :attribute Feld muss Einträge für :values enthalten.',
    
    'required_array_keys' => 'Das :attribute Feld muss Einträge für :values enthalten.',
    'required_if' => 'Das :attribute Feld ist erforderlich, wenn :other :value ist.',
    'required_if_accepted' => 'Das :attribute Feld ist erforderlich, wenn :other akzeptiert wird.',
    'required_unless' => 'Das :attribute Feld ist erforderlich, es sei denn, :other befindet sich in :values.',
    'required_with' => 'Das :attribute Feld ist erforderlich, wenn :values vorhanden ist.',
    'required_with_all' => 'Das :attribute Feld ist erforderlich, wenn :values vorhanden sind.',
    'required_without' => 'Das :attribute Feld ist erforderlich, wenn :values nicht vorhanden ist.',
    'required_without_all' => 'Das :attribute Feld ist erforderlich, wenn keines von :values vorhanden ist.',
    'same' => 'Das :attribute Feld und :other müssen übereinstimmen.',
    'size' => [
        'array' => 'Das :attribute Feld muss :size Elemente enthalten.',
        'file' => 'Das :attribute Feld muss :size Kilobyte groß sein.',
        'numeric' => 'Das :attribute Feld muss :size sein.',
        'string' => 'Das :attribute Feld muss :size Zeichen lang sein.',
    ],
    'starts_with' => 'Das :attribute Feld muss mit einem der folgenden beginnen: :values.',
    'string' => 'Das :attribute Feld muss ein String sein.',
    'timezone' => 'Das :attribute Feld muss eine gültige Zeitzone sein.',
    'unique' => 'Der Wert des :attribute Feldes wurde bereits vergeben.',
    'uploaded' => 'Das :attribute Feld konnte nicht hochgeladen werden.',
    'uppercase' => 'Das :attribute Feld muss in Großbuchstaben sein.',
    'url' => 'Das :attribute Feld muss eine gültige URL sein.',
    'ulid' => 'Das :attribute Feld muss eine gültige ULID sein.',
    'uuid' => 'Das :attribute Feld muss eine gültige UUID sein.',

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
