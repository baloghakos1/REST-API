<?php
namespace App\Repositories;

class CityRepository extends BaseRepository
{
    function __construct(
        $host = self::HOST, 
        $user = self::USER,
        $password = self::PASSWORD,
        $database = self::DATABASE)
    {
        parent::__construct($host, $user, $password, $database);
        $this->tableName = 'cities';
    }

    public function getAllByCounty($id): array
    {
        $query = $this->select() . "WHERE id_county = $id";

        return $this->mysqli
            ->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function getABC($id) {
        $query = "SELECT DISTINCT LEFT(city, 1) as abc FROM cities
            WHERE id_county = $id";

        return $this->mysqli
            ->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function getCitiesByABC($id, $betu) {
        $jobetu = urldecode($betu);
        $query = $this->select() . "WHERE id_county = $id AND city LIKE '$jobetu%'";

        return $this->mysqli
            ->query($query)->fetch_all(MYSQLI_ASSOC);
    }
}