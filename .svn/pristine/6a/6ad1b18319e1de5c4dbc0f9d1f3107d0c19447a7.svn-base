<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    //
//    public function getGenderAttribute() {
//        return 's';
//    }

    public function getAgeAttribute() {
        return date('Y') - substr($this->id_card, 6, 4);
    }

    public function scopeAgeBetween($query, $ageFrom, $ageTo) {
        $rawSql = '';
        $bind = array();
        $rawSql .= ' year(NOW()) - substr(id_card,7,4) >= ? ';
        $bind[] = $ageFrom ? $ageFrom : 0;


        $rawSql .= ' and year(NOW()) - substr(id_card,7,4) <= ? ';
        $bind[] = $ageTo ? $ageTo : 120;


        return $query->whereRaw($rawSql, $bind);
    }
}
