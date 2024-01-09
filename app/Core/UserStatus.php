<?php

namespace App\Core;

enum UserStatus: int
{
    case Admin = 1;
    case User = 0;
}
