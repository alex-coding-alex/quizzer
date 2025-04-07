<?php

namespace App\Enums;

enum Role: string
{
    case ADMIN = 'admin';
    case TEACHER = 'teacher';
    case STUDENT = 'student';

    public function label(): string
    {
        return $this->internalLabel();
    }

    private function internalLabel(): string
    {
        return match ($this) {
            self::ADMIN => 'Admin',
            self::TEACHER => 'Teacher',
            self::STUDENT => 'Student',
        };
    }
}
