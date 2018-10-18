<?php

namespace App\Repository;

use Doctrine\DBAL\Driver\Connection;

class SearchRepository
{
    protected $connection;

    public function __construct(Connection $conn)
    {
        $this->connection = $conn;
    }

    /**
     * Perform a search of the specified term into the database among
     * ISBNs/ISANs, titles, book authors and movie directors and actors.
     */
    public function search($term)
    {
        $sql = '
            SELECT \'Livre\' AS type, book.isbn AS number, book.title, author.name AS creator
            FROM book
            LEFT JOIN author
                ON book.author_id = author.id
            WHERE MATCH(book.isbn, book.title) AGAINST(:term)
                OR MATCH(author.name) AGAINST(:term)

            UNION

            SELECT \'DVD\' AS type, dvd.isan AS number, dvd.title, director.name AS creator
            FROM dvd
            LEFT JOIN director
                ON dvd.director_id = director.id
            LEFT JOIN dvd_actor
                ON dvd.id = dvd_actor.dvd_id
            LEFT JOIN actor
                ON dvd_actor.actor_id = actor.id
            WHERE MATCH(dvd.isan, dvd.title) AGAINST(:term)
                OR MATCH(director.name) AGAINST(:term)
                OR MATCH(actor.name) AGAINST(:term)

            UNION

            SELECT \'Blu-ray\' AS type, bluray.isan AS number, bluray.title, director.name AS creator
            FROM bluray
            LEFT JOIN director
                ON bluray.director_id = director.id
            LEFT JOIN bluray_actor
                ON bluray.id = bluray_actor.bluray_id
            LEFT JOIN actor
                ON bluray_actor.actor_id = actor.id
            WHERE MATCH(bluray.isan, bluray.title) AGAINST(:term)
                OR MATCH(director.name) AGAINST(:term)
                OR MATCH(actor.name) AGAINST(:term)
            ';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            'term' => $term,
        ]);

        return $stmt->fetchAll();
    }
}
