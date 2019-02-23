<?php

namespace App\Repositories\API\Contracts;

interface SetlistRepository {

    public function getBand($bandId);

    public function getShows($bandId);

    public function getAllShows($bandId);

    public function getShowsByYear($bandId, $year);

}
