<?php

declare(strict_types=1);

namespace App\App\Reservation\Domain;

use App\App\Book\Domain\Book;
use DateTime;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Contracts\Service\Attribute\Required;

#[Entity]
class Reservation
{
    #[Id]
    #[Column(type: 'integer', nullable: false)]
    #[GeneratedValue(strategy: 'SEQUENCE')]
    private ?int $id;

    #[ManyToOne(targetEntity: Book::class)]
    #[JoinColumn(name: 'book_id', referencedColumnName: 'id')]
    private Book $book;

    #[Column(type: 'datetime', nullable: false)]
    private DateTime $lendingDate;

    #[Column(type: 'datetime', nullable: false)]
    private DateTime $returnDate;

    #[Column(type: 'datetime', nullable: true)]
    private ?DateTime $returnedAt;

    public function __construct(
        Book $book,
        DateTime $lendingDate,
        DateTime $returnDate,
        ?DateTime $returnedAt = null,
        ?int $id = null,
    ) {
        $this->id = $id;
        $this->book = $book;
        $this->lendingDate = $lendingDate;
        $this->returnDate = $returnDate;
        $this->returnedAt = $returnedAt;
    }
}
