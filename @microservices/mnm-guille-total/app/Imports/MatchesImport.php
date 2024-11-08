<?php

namespace App\Imports;

use App\Models\Matches;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Carbon\Carbon;

class MatchesImport implements ToCollection
{
    /**
     * Maneja la importación de datos desde una colección de Excel.
     *
     * @param Collection $collection La colección de datos de la hoja de Excel.
     */
    public function collection(Collection $columnas)
    {
        DB::transaction(function () use ($columnas) {
            $contador = 0;
            foreach ($columnas as $columna) {
                $contador++;
                if ($contador === 1) {
                    continue;
                }
                $match_id = $columna[0] ?? null;
                $rival = $columna[1] ?? null;
                $rival_confederation = $columna[2] ?? null;
                $peru_score = $columna[3] ?? null;
                $rival_score = $columna[4] ?? null;
                $peru_awarded_score = $columna[5] ?? null;
                $rival_awarded_score = $columna[6] ?? null;
                $result = $columna[7] ?? null;
                $shootout_result = $columna[8] ?? null;
                $awarded_result = $columna[9] ?? null;
                $tournament_name = $columna[10] ?? null;
                $tournament_type = $columna[11] ?? null;
                $official = $columna[12] ?? null;
                $stadium = $columna[13] ?? null;
                $city = $columna[14] ?? null;
                $country = $columna[15] ?? null;
                $elevation = $columna[16] ?? null;
                $peru_condition = $columna[17] ?? null;
                $coach = $columna[18] ?? null;
                $coach_nationality = $columna[19] ?? null;
                $date = $columna[20] ?? null;
                if ($date !== null) {
                    $date = \DateTime::createFromFormat('U', ($date - 25569) * 86400);
                    $date = $date->format('Y/m/d'); 
                }
                
                $porcentaje_gana = $columna[21] ?? null;
                $porcentaje_empate = $columna[22] ?? null;
                $porcentaje_pierde = $columna[23] ?? null;
                Matches::create([
                    'match_id' => $match_id,
                    'rival' => $rival,
                    'rival_confederation' => $rival_confederation,
                    'peru_score' => $peru_score,
                    'rival_score' => $rival_score,
                    'peru_awarded_score' => $peru_awarded_score,
                    'rival_awarded_score' => $rival_awarded_score,
                    'result' => $result,
                    'shootout_result' => $shootout_result,
                    'awarded_result' => $awarded_result,
                    'tournament_name' => $tournament_name,
                    'tournament_type' => $tournament_type,
                    'official' => $official,
                    'stadium' => $stadium,
                    'city' => $city,
                    'country' => $country,
                    'elevation' => $elevation,
                    'peru_condition' => $peru_condition,
                    'coach' => $coach,
                    'coach_nationality' => $coach_nationality,
                    'date' => $date,
                    'porcentaje_gana' => $porcentaje_gana,
                    'porcentaje_empate' => $porcentaje_empate,
                    'porcentaje_pierde' => $porcentaje_pierde,
                    'evento' => 'T'
                ]);
            }
        });
    }
}
