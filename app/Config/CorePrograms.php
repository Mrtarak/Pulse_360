<?php

namespace Config;

class CorePrograms
{
    public const DIGITAL_SHAKTI = 'PRG_DS';

    public const DOOSRA_MAUKA = 'PRG_DM';

    public const LEARNING_ADDA = 'PRG_LA';

    public const VIJEETAS = 'PRG_VJ';

    public const SCHOOL_SAHYOG = 'PRG_SS';

    public static function all()
    {
        return [
            self::DIGITAL_SHAKTI,
            self::DOOSRA_MAUKA,
            self::LEARNING_ADDA,
            self::VIJEETAS,
            self::SCHOOL_SAHYOG
        ];
    }
}
