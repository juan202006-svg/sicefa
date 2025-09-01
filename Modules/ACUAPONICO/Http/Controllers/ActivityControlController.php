<?php

namespace Modules\ACUAPONICO\Http\Controllers;

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ACUAPONICO\Entities\ActivityAquaponic;
use Modules\ACUAPONICO\Entities\ActivityControl;
use Illuminate\Support\Facades\Storage;



class ActivityControlController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
  public function index()
{
    // Filtra actividades con estado 'Pendiente' y enviada = true
    $activities = ActivityAquaponic::with('user')
        ->where('activity_status', 'Pendiente')
        ->where('enviada', true)
        ->get();

    $evidencias = ActivityControl::with('activity')->get();

    return view('acuaponico::pasante.controlactividad', compact('activities', 'evidencias'));
}






    public function store(Request $request)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'activity_id' => 'required|exists:activities_aquaponics,id',
            'date' => 'required|date',
            'news' => 'required|string',
            'evidence' => 'nullable|file|mimes:pdf|max:2048', // Máximo 2MB para PDF
        ]);

        $evidencePath = null;

        if ($request->hasFile('evidence')) {
            // Almacenar archivo en el disco 'public' bajo la carpeta 'evidencias'
            $evidencePath = $request->file('evidence')->store('evidencias', 'public');

            // Asignar permisos 0644 al archivo
            $fullPath = storage_path('app/public/' . $evidencePath);
            if (file_exists($fullPath)) {
                chmod($fullPath, 0644);
            }
        }

        // Guardar el registro de la evidencia
        $controlActividad = new ActivityControl();
        $controlActividad->activity_id = $request->activity_id;
        $controlActividad->date = $request->date;
        $controlActividad->news = $request->news;
        $controlActividad->evidence = $evidencePath;
        $controlActividad->save();

        // Actualizar el estado de la actividad a 'Completada'
        $actividad = ActivityAquaponic::findOrFail($request->activity_id);
        $actividad->activity_status = 'Completada';
        $actividad->save();

        return redirect()->back()->with('success', 'Evidencia registrada exitosamente.');
    }




    public function verEvidencia($id)
    {
        $evidencia = ActivityControl::findOrFail($id);

        if ($evidencia->evidence && Storage::disk('public')->exists($evidencia->evidence)) {
            $file = Storage::disk('public')->get($evidencia->evidence);
            return response($file, 200)
                ->header('Content-Type', 'application/pdf');
        } else {
            abort(404, 'Archivo no encontrado');
        }
    }


    public function update(Request $request, $id)
    {
        $evidencia = ActivityControl::findOrFail($id);
        $evidencia->date = $request->date;
        $evidencia->news = $request->news;

        // Si se carga un nuevo archivo, se reemplaza
        if ($request->hasFile('evidence')) {
            // Elimina archivo anterior si existe
            if ($evidencia->evidence && Storage::disk('public')->exists($evidencia->evidence)) {
                Storage::disk('public')->delete($evidencia->evidence);
            }

            // Sube nuevo archivo
            $path = $request->file('evidence')->store('evidencias', 'public');
            $evidencia->evidence = $path;
        }

        $evidencia->save();

        return redirect()->back()->with('success', 'Evidencia actualizada correctamente.');
    }
    public function destroy($id)
    {
        $evidencia = ActivityControl::findOrFail($id);

        // Obtener la actividad relacionada
        $actividad = ActivityAquaponic::find($evidencia->activity_id);

        // Eliminar archivo físico si existe
        if ($evidencia->evidence && Storage::disk('public')->exists($evidencia->evidence)) {
            Storage::disk('public')->delete($evidencia->evidence);
        }

        $evidencia->delete();

        // Cambiar estado a "Pendiente" si existe la actividad
        if ($actividad) {
            $actividad->activity_status = 'Pendiente';
            $actividad->save();
        }

        return redirect()->back()->with('success', 'Evidencia eliminada correctamente.');
    }
    public function enviar($id)
    {
        $activity = ActivityAquaponic::findOrFail($id);
        $activity->update(['enviada' => true]);

        return redirect()->back()->with('success', 'Actividad enviada');
    }
}
