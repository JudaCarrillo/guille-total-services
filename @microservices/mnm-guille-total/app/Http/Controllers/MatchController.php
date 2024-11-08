<?php

namespace App\Http\Controllers;

use App\Imports\MatchesImport;
use App\Models\Matches;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;


class MatchController extends Controller
{
    public function importMatches(Request $request)
    {
        try {
            $request->validate([
                'matchExcel' => 'required|file|mimes:xlsx,xls'
            ]);
            $archivo = $request->file('matchExcel');
            $nombreArchivo = $archivo->getClientOriginalName();
            if (Storage::exists('public/matches/' . $nombreArchivo)) {
                Storage::delete('public/matches/' . $nombreArchivo);
            }
            $archivo->storeAs('matches', $nombreArchivo, 'public');
            Excel::import(new MatchesImport, storage_path('app/public/matches/' . $nombreArchivo));
            return response()->json(["resp" => "Programación importada correctamente"], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'data' => ['item' => null],
                'token' => null,
                'error' => 'Algo salió mal',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function getMatchesLast()
    {
        try {
            $matches = Matches::where('evento', 'T')
                ->orderBy('id', 'desc')
                ->skip(8)
                ->take(5)
                ->get();

            if ($matches->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'data' => ['items' => null],
                    'token' => null,
                    'error' => 'No se encontraron partidos pasados',
                    'message' => 'No se encontraron partidos pasados'
                ], 404);
            }
            return response()->json([
                'success' => true,
                'data' => ['items' => $matches],
                'token' => null,
                'error' => null,
                'message' => 'Lista de partidos Pasados'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'data' => ['item' => null],
                'token' => null,
                'error' => 'Algo salió mal',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function getMatchesFuture()
    {
        try {
            $matches = Matches::orderBy('id', 'desc')->take(8)->get();
            if ($matches->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'data' => ['items' => null],
                    'token' => null,
                    'error' => 'No se encontraron partidos futuros',
                    'message' => 'No se encontraron partidos futuros'
                ], 404);
            }
            return response()->json([
                'success' => true,
                'data' => ['items' => $matches],
                'token' => null,
                'error' => null,
                'message' => 'Lista de partidos Futuros'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'data' => ['item' => null],
                'token' => null,
                'error' => 'Algo salió mal',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
