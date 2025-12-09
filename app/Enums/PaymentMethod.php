<?php

namespace App\Enums;

enum PaymentMethod: string {
    case CARD = 'CARD';
    case CHECK = 'CHECK';
    case CASH = 'CASH';
}