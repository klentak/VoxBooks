<?php

declare(strict_types=1);

namespace App\App\Book\Enum;

enum BookResponseMessageEnum
{
    const CREATED_MESSAGE = "Book successfully created";
    const UPDATED_MESSAGE = "Book successfully updated";
    const REMOVED_MESSAGE = "Book successfully removed";
}
