<?php

namespace App\Enum;

enum MachineStatus: string
{
    case ACTIVE = 'Disponible';
    case ON_MAINTAIN = 'En mantenimiento';
    case INACTIVE = 'Fuera de servicio';
}