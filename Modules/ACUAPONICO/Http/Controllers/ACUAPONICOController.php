<?php

namespace Modules\ACUAPONICO\Http\Controllers;


namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ACUAPONICO\Entities\AquaponicSystem;
use Modules\ACUAPONICO\Entities\Lot;
use Modules\AGROCEFA\Entities\Crop;
use Modules\ACUAPONICO\Entities\HarvestAquaponic;
use Modules\ACUAPONICO\Entities\Resowing;
use Illuminate\Support\Facades\DB;
use Modules\ACUAPONICO\Entities\Tracking;

class ACUAPONICOController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('acuaponico::index');
    }
    public function welcome()
    {
        return view('acuaponico::welcome');
    }


    public function pasante()
    {
        try {
            $systems = AquaponicSystem::get(); // Todos los sistemas acuapónicos
            $availableLotsCount = Lot::where('state', 'disponible')->count(); // Lotes disponibles
            $cropsCount = Crop::where('status', 'Seguimiento')->count(); // Cultivos activos (en seguimiento)
            $resowingsCount = Resowing::whereIn('status', ['Registrada', 'Seguimiento'])->count(); // Resiembras activas

            // Datos para gráficas del año actual - Producción vs Mortalidad de Plantas por sistema
            $currentYear = date('Y');
            $productionVsMortalityData = [];
            
            foreach ($systems as $system) {
                // Obtener datos de cultivos del año actual para este sistema
                $cropsData = Crop::select(
                    DB::raw('MONTH(created_at) as month'),
                    DB::raw('COUNT(*) as total_crops'),
                    DB::raw('SUM(CASE WHEN status = "Cosechado" THEN 1 ELSE 0 END) as harvested_crops')
                )
                ->where('aquaponic_system_id', $system->id)
                ->whereYear('created_at', $currentYear)
                ->groupBy('month')
                ->orderBy('month')
                ->get();

                // Obtener datos de mortalidad de plantas del año actual para este sistema
                $plantMortalityData = Tracking::select(
                    DB::raw('MONTH(trackings.date) as month'),
                    DB::raw('COALESCE(SUM(trackingplant.mortality), 0) as plant_mortality')
                )
                ->leftJoin('trackingplant', 'trackings.id', '=', 'trackingplant.tracking_id')
                ->where('trackings.aquaponic_system_id', $system->id)
                ->whereYear('trackings.date', $currentYear)
                ->groupBy('month')
                ->orderBy('month')
                ->get();

                // Combinar datos de producción y mortalidad por mes
                $monthlyData = [];
                for ($month = 1; $month <= 12; $month++) {
                    $cropData = $cropsData->where('month', $month)->first();
                    $mortalityDataMonth = $plantMortalityData->where('month', $month)->first();
                    
                    $monthlyData[] = [
                        'month' => $month,
                        'month_name' => date('M', mktime(0, 0, 0, $month, 1)),
                        'total_crops' => $cropData ? $cropData->total_crops : 0,
                        'harvested_crops' => $cropData ? $cropData->harvested_crops : 0,
                        'plant_mortality' => $mortalityDataMonth ? $mortalityDataMonth->plant_mortality : 0
                    ];
                }

                $productionVsMortalityData[$system->id] = [
                    'system_name' => $system->name,
                    'monthly_data' => $monthlyData
                ];
            }

            // Datos para gráfica de eficiencia por sistema (producción vs mortalidad de plantas)
            $systemEfficiency = [];
            foreach ($systems as $system) {
                $totalCrops = Crop::where('aquaponic_system_id', $system->id)
                                 ->whereYear('created_at', $currentYear)
                                 ->count();
                
                $harvestedCrops = Crop::where('aquaponic_system_id', $system->id)
                                     ->where('status', 'Cosechado')
                                     ->whereYear('created_at', $currentYear)
                                     ->count();
                
                $totalPlantMortality = Tracking::join('trackingplant', 'trackings.id', '=', 'trackingplant.tracking_id')
                                              ->where('trackings.aquaponic_system_id', $system->id)
                                              ->whereYear('trackings.date', $currentYear)
                                              ->sum('trackingplant.mortality');
                
                // Calcular eficiencia basada en producción vs mortalidad de plantas
                $efficiency = 0;
                if ($totalCrops > 0) {
                    // Fórmula: (Cultivos cosechados / (Total cultivos + Mortalidad plantas)) * 100
                    $efficiency = ($harvestedCrops / ($totalCrops + $totalPlantMortality)) * 100;
                }
                
                $systemEfficiency[] = [
                    'system_name' => $system->name,
                    'total_crops' => $totalCrops,
                    'harvested_crops' => $harvestedCrops,
                    'plant_mortality' => $totalPlantMortality,
                    'efficiency_percentage' => round($efficiency, 2)
                ];
            }

            // Ordenar sistemas por eficiencia (mejor a peor)
            $systemEfficiency = collect($systemEfficiency)->sortByDesc('efficiency_percentage')->values()->all();

            // Datos básicos para otras funcionalidades
            $cropsBySystem = Crop::select('aquaponic_system_id', DB::raw('COUNT(id) as count'))
                ->groupBy('aquaponic_system_id')
                ->get();

            // Nuevos datos para gráfica de cultivos por especie (usando species_id de crops)
            $cropsBySpecies = Crop::select('species_id', DB::raw('COUNT(id) as count'))
                ->where('status', 'Seguimiento') // Solo activos
                ->groupBy('species_id')
                ->with('species') // Asumiendo relación con Species para obtener nombres
                ->get();

            // Opcional: Datos para gráfica de resiembras por estado
            $resowingsByStatus = Resowing::select('status', DB::raw('COUNT(id) as count'))
                ->groupBy('status')
                ->get();

            return view('acuaponico::welcomepas', compact(
                'systems',
                'availableLotsCount',
                'cropsCount',
                'resowingsCount',
                'cropsBySystem',
                'cropsBySpecies',
                'resowingsByStatus',
                'productionVsMortalityData',
                'systemEfficiency',
                'currentYear'
            ));

        } catch (\Exception $e) {
            // Log del error para debugging
            \Log::error('Error en método pasante: ' . $e->getMessage());
            
            // Retornar vista con datos básicos en caso de error
            $systems = AquaponicSystem::get();
            $availableLotsCount = Lot::where('state', 'disponible')->count();
            $cropsCount = Crop::where('status', 'Seguimiento')->count();
            $resowingsCount = Resowing::whereIn('status', ['Registrada', 'Seguimiento'])->count();
            $currentYear = date('Y');
            
            return view('acuaponico::welcomepas', compact(
                'systems',
                'availableLotsCount',
                'cropsCount',
                'resowingsCount',
                'currentYear'
            ))->with('error', 'Error al cargar datos de gráficas: ' . $e->getMessage());
        }
    }



    public function admin()
    {
        $systems = AquaponicSystem::get();
        $availableLotsCount = Lot::where('state', 'disponible')->count();
        $cropsCount = Crop::where('status', 'Seguimiento')->count();
        $resowingsCount = Resowing::whereIn('status', ['Registrada', 'Seguimiento'])->count();

        // Datos de mortalidad usando la tabla correcta
        $mortalityData = HarvestAquaponic::select(
            'aquaponic_system_id',
            'aquaponic_systems.name',
            DB::raw('SUM(mortality) as total_mortality'),
            DB::raw('AVG(mortality) as avg_mortality')
        )
            ->leftJoin('aquaponic_systems', 'harvestsaquaponics.aquaponic_system_id', '=', 'aquaponic_systems.id')
            ->where('harvestable_type', 'crop')
            ->groupBy('aquaponic_system_id', 'aquaponic_systems.name')
            ->orderBy('avg_mortality', 'asc') 
            ->get();

        $cropsBySystem = Crop::select('aquaponic_system_id', DB::raw('COUNT(id) as count'))
            ->groupBy('aquaponic_system_id')
            ->get();

        $cropsBySpecies = Crop::select('species_id', DB::raw('COUNT(id) as count'))
            ->where('status', 'Seguimiento')
            ->groupBy('species_id')
            ->with('species')
            ->get();

        $resowingsByStatus = Resowing::select('status', DB::raw('COUNT(id) as count'))
            ->groupBy('status')
            ->get();

        return view('acuaponico::welcome', compact(
            'systems',
            'availableLotsCount',
            'cropsCount',
            'resowingsCount',
            'mortalityData',
            'cropsBySystem',
            'cropsBySpecies',
            'resowingsByStatus'
        ));
    }



    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('acuaponico::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('acuaponico::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('acuaponico::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        return;
    }

    /**
     * Método de prueba para verificar la estructura de la base de datos
     */
    public function testDatabase()
    {
        try {
            // Verificar si la tabla harvestsaquaponics existe
            $tableExists = \Schema::hasTable('harvestsaquaponics');
            
            if ($tableExists) {
                // Obtener las columnas de la tabla
                $columns = \Schema::getColumnListing('harvestsaquaponics');
                
                // Verificar si existe la columna aquaponic_system_id
                $hasSystemId = in_array('aquaponic_system_id', $columns);
                
                // Contar registros
                $totalRecords = HarvestAquaponic::count();
                
                return response()->json([
                    'success' => true,
                    'table_exists' => $tableExists,
                    'columns' => $columns,
                    'has_aquaponic_system_id' => $hasSystemId,
                    'total_records' => $totalRecords,
                    'message' => 'Tabla verificada correctamente'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'La tabla harvestsaquaponics no existe'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'message' => 'Error al verificar la base de datos'
            ]);
        }
    }
}
