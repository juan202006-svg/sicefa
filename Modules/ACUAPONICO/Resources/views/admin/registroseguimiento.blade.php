@extends('acuaponico::layouts.master')

@push('breadcrumbs')
<li class="breadcrumb-item active">Seguimiento Resiembra</li>
@endpush

@section('content5')
<div class="container-fluid px-4" style="width: 93%; margin-top: 5%; margin-left: 5%;">
    <!-- Header con gradiente y sombra -->
    <div class="container mt-4">
        <div class="card shadow-lg border-0" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
            <div class="card-body py-4">
                <div class="d-flex justify-content-between align-items-center mb-3 animate__animated animate__fadeInDown">
                    <h1 class="h2 mb-0 text-white fw-bold text-center w-100" style="font-size: 2.5rem; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                        <i class="fas fa-seedling me-3"></i>Seguimiento de Resiembras
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Tarjeta principal con diseño moderno -->
    <div class="card shadow-lg border-0 mt-4 animate__animated animate__fadeInUp" style="border-radius: 15px; overflow: hidden;">
        <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background: linear-gradient(to right, #f8f9fc, #e3e6f0); border-bottom: 1px solid #e3e6f0;">
            <h5 class="mb-0 text-success fw-semibold">
                <i class="fas fa-list me-2"></i>Lista de Seguimientos de Resiembras
            </h5>
            <div class="spinner-border text-success" role="status" id="tableSpinner" style="width: 1.5rem; height: 1.5rem;">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle text-success me-2"></i>
                    <small class="text-muted">Total de seguimientos: {{ count($seguimiento_resiembra) }}</small>
                </div>
                <button type="button" class="btn btn-success rounded-pill px-4 py-2 fw-medium shadow-sm" data-toggle="modal" data-target="#agregar"
                    style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border: none; transition: all 0.3s ease;">
                    <i class="fas fa-plus-circle me-2"></i> Nuevo Seguimiento
                </button>
            </div>
            
            <div class="table-responsive rounded-3 shadow-sm">
                <table id="seguimientoresiembra" class="table table-hover align-middle mb-0" style="border: 1px solid #e3e6f0;">
                    <thead class="thead-dark" style="background: linear-gradient(to right, #28a745, #20c997); color: white;">
                        <tr>
                            <th class="text-center py-3" style="border-right: 1px solid rgba(255,255,255,0.1);">#</th>
                            <th class="py-3" style="border-right: 1px solid rgba(255,255,255,0.1);">Fecha</th>
                            <th class="py-3" style="border-right: 1px solid rgba(255,255,255,0.1);">S/acuapónico</th>
                            <th class="py-3" style="border-right: 1px solid rgba(255,255,255,0.1);">Resiembra</th>
                            <th class="text-center py-3" style="border-right: 1px solid rgba(255,255,255,0.1);">N° Plantas</th>
                            <th class="text-center py-3" style="border-right: 1px solid rgba(255,255,255,0.1);">Color</th>
                            <th class="text-center py-3" style="border-right: 1px solid rgba(255,255,255,0.1);">Altura(cm)</th>
                            <th class="text-center py-3" style="border-right: 1px solid rgba(255,255,255,0.1);">Tiempo(dias)</th>
                            <th class="text-center py-3" style="border-right: 1px solid rgba(255,255,255,0.1);">Crecimiento</th>
                            <th class="text-center py-3" style="border-right: 1px solid rgba(255,255,255,0.1);">Rendimiento(%)</th>
                            <th class="text-center py-3" style="border-right: 1px solid rgba(255,255,255,0.1);">Mortalidad</th>
                            <th class="py-3" style="border-right: 1px solid rgba(255,255,255,0.1);">Novedades</th>
                            <th class="text-center py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $n = 1; @endphp
                        @foreach ($seguimiento_resiembra as $sr)
                        <tr class="animate__animated animate__fadeIn" style="animation-delay: {{ $n * 0.03 }}s; border-bottom: 1px solid #e3e6f0; transition: all 0.3s ease;">
                            <td class="text-center fw-bold py-3" style="border-right: 1px solid #e3e6f0;">{{ $n++ }}</td>
                            <td class="fw-medium py-3" style="border-right: 1px solid #e3e6f0;">{{ $sr->date ?? 'N/A' }}</td>
                            <td class="py-3" style="border-right: 1px solid #e3e6f0;">{{ $sr->aquaponicSystem->name ?? 'Sin sistema' }}</td>
                            <td class="py-3" style="border-right: 1px solid #e3e6f0;">{{ $sr->resowing->crops->species->name ?? 'Sin cultivo' }}</td>
                            <td class="text-center fw-bold py-3" style="border-right: 1px solid #e3e6f0;">
                                <span class="badge bg-info rounded-pill px-3 py-2 shadow-sm">{{ $sr->plant_count ?? '0' }}</span>
                            </td>
                            <td class="text-center py-3" style="border-right: 1px solid #e3e6f0;">
                                <span class="color-circle-large" style="background-color: {{ $sr->color_tone ?? '#000' }};"></span>
                            </td>
                            <td class="text-center fw-bold py-3" style="border-right: 1px solid #e3e6f0;">{{ $sr->height_cm ? $sr->height_cm . 'cm' : 'N/A' }}</td>
                            <td class="text-center fw-bold py-3" style="border-right: 1px solid #e3e6f0;">{{ $sr->days_elapsed ?? '0' }}</td>
                            <td class="text-center fw-bold py-3" style="border-right: 1px solid #e3e6f0;">{{ $sr->growth ? $sr->growth . 'cm' : '0' }}</td>
                            <td class="text-center fw-bold py-3" style="border-right: 1px solid #e3e6f0;">
                                @php
                                    $percentage = $sr->comparison_percentage ?? 0;
                                    $badgeClass = $percentage >= 80 ? 'bg-success' : ($percentage >= 50 ? 'bg-warning' : 'bg-danger');
                                @endphp
                                <span class="badge {{ $badgeClass }} rounded-pill px-3 py-2 shadow-sm">{{ $percentage }}%</span>
                            </td>
                            <td class="text-center fw-bold py-3" style="border-right: 1px solid #e3e6f0;">
                                <span class="badge bg-danger rounded-pill px-3 py-2 shadow-sm">{{ $sr->mortality ?? '0' }}</span>
                            </td>
                            <td class="py-3" style="border-right: 1px solid #e3e6f0;">
                                @if ($sr->notes)
                                <span class="text-muted" data-toggle="tooltip" title="{{ $sr->notes }}">{{ Str::limit($sr->notes, 30) }}</span>
                                @else
                                <span class="text-muted font-italic">Sin novedades</span>
                                @endif
                            </td>
                            <td class="text-center py-3">
                                <div class="d-flex justify-content-center action-buttons">
                                    <!-- Botón de Editar -->
                                    <button type="button" class="btn btn-action btn-edit editbtn mx-1"
                                        data-id="{{ $sr->id }}"
                                        data-aquaponic_system_id="{{ $sr->aquaponicSystem->id ?? '' }}"
                                        data-resowing_id="{{ $sr->resowing->id ?? '' }}"
                                        data-plant_count="{{ $sr->plant_count ?? '' }}"
                                        data-color_tone="{{ $sr->color_tone ?? '' }}"
                                        data-height_cm="{{ $sr->height_cm ?? '' }}"
                                        data-days_elapsed="{{ $sr->days_elapsed ?? '' }}"
                                        data-growth="{{ $sr->growth ?? '' }}"
                                        data-comparison_percentage="{{ $sr->comparison_percentage ?? '' }}"
                                        data-mortality="{{ $sr->mortality ?? '' }}"
                                        data-notes="{{ $sr->notes ?? '' }}"
                                        data-date="{{ $sr->date ?? '' }}"
                                        data-resowing_date="{{ $sr->resowing->date ?? '' }}"
                                        data-toggle="modal"
                                        data-target="#editar">
                                        <div class="btn-icon">
                                            <i class="fas fa-pen"></i>
                                        </div>
                                        <span class="btn-tooltip">Editar</span>
                                    </button>
                                    
                                    <!-- Botón de Eliminar -->
                                    <button type="button" class="btn btn-action btn-delete btnEliminar mx-1" data-id="{{ $sr->id }}">
                                        <div class="btn-icon">
                                            <i class="fas fa-trash"></i>
                                        </div>
                                        <span class="btn-tooltip">Eliminar</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar -->
<div class="modal fade" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="overflow: hidden;">
            <div class="modal-header bg-gradient-success text-white py-3">
                <h5 class="modal-title fw-bold mb-0" id="editarLabel">
                    <i class="fas fa-edit me-2"></i>
                    Editar Seguimiento Resiembra
                </h5>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="formEditar" action="{{ route('acuaponico.pasante.pasante.updateresowingtracking', 0) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <input type="hidden" name="id" id="edit-id">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="edit-date" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-calendar me-1"></i>Fecha:
                                </label>
                                <input type="date" class="form-control form-control-sm rounded" id="edit-date" name="date" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="edit-aquaponic_system_id" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-water me-1"></i>Sistema acuapónico:
                                </label>
                                <select class="form-control form-control-sm rounded" id="edit-aquaponic_system_id" name="aquaponic_system_id" required>
                                    <option value="">Seleccione el sistema</option>
                                    @foreach ($sistema as $s)
                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="edit-resowing_id" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-seedling me-1"></i>Resiembra:
                                </label>
                                <select class="form-control form-control-sm rounded" id="edit-resowing_id" name="resowing_id" required>
                                    <option value="">Seleccione una resiembra</option>
                                    @foreach ($resiembras as $r)
                                    <option value="{{ $r->id }}"
                                        data-system="{{ $r->aquaponic_system_id }}"
                                        data-date="{{ $r->date }}"
                                        data-total_quantity="{{ $r->total_quantity }}"
                                        data-status="{{ $r->status }}">
                                        {{ $r->crops->species->name ?? 'Sin cultivo' }} - {{ $r->status }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="edit-plant_count" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-leaf me-1"></i>N° Plantas:
                                </label>
                                <input type="number" class="form-control form-control-sm rounded" id="edit-plant_count" name="plant_count" required>
                                <div class="invalid-feedback small" id="error-plantas-edit"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-palette me-1"></i>Color de hoja:
                                </label>
                                <div class="d-flex gap-3 justify-content-between">
                                    @php
                                    $colores = [
                                    '#138713ff', // Verde oscuro
                                    '#a6d842ff', // Verde amarillento
                                    '#32dc32ff', // Verde claro
                                    '#1ccf00ff' // Verde normal
                                    ];
                                    @endphp
                                    @foreach($colores as $color)
                                    <label class="color-option">
                                        <input type="radio" name="color_tone" value="{{ $color }}" required>
                                        <span class="color-circle-modal" style="background-color: {{ $color }};"></span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="edit-height_cm" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-ruler-vertical me-1"></i>Altura (cm):
                                </label>
                                <input type="number" class="form-control form-control-sm rounded" name="height_cm" id="edit-height_cm" step="0.1" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="edit-days_elapsed" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-clock me-1"></i>Tiempo (días):
                                </label>
                                <input type="number" class="form-control form-control-sm rounded" name="days_elapsed" id="edit-days_elapsed" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="edit-growth" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-arrow-up me-1"></i>Crecimiento:
                                </label>
                                <input type="number" class="form-control form-control-sm rounded" name="growth" id="edit-growth" step="0.1" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="edit-comparison_percentage" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-chart-line me-1"></i>Rendimiento (%):
                                </label>
                                <input type="number" class="form-control form-control-sm rounded" name="comparison_percentage" id="edit-comparison_percentage" step="0.01" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="edit-mortality" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-skull me-1"></i>Mortalidad:
                                </label>
                                <input type="number" class="form-control form-control-sm rounded" name="mortality" id="edit-mortality" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="edit-notes" class="form-label small fw-bold text-success mb-1">
                            <i class="fas fa-sticky-note me-1"></i>Novedades:
                        </label>
                        <textarea class="form-control form-control-sm rounded" name="notes" id="edit-notes" rows="2" style="resize: none;"></textarea>
                    </div>
                </div>
                
                <div class="modal-footer bg-light py-3">
                    <button type="button" class="btn btn-sm btn-secondary rounded px-3 py-2" data-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-sm btn-success rounded px-3 py-2 shadow">
                        <i class="fas fa-save me-1"></i>Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Agregar -->
<div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="overflow: hidden;">
            <div class="modal-header bg-gradient-success text-white py-3">
                <h5 class="modal-title fw-bold mb-0" id="agregarLabel">
                    <i class="fas fa-plus-circle me-2"></i>
                    Nuevo Seguimiento Resiembra
                </h5>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="{{ route('acuaponico.pasante.pasante.storeresowingtracking') }}" method="POST" id="formAgregar">
                @csrf
                
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="date" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-calendar me-1"></i>Fecha:
                                </label>
                                <input type="date" name="date" class="form-control form-control-sm rounded" id="date" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="aquaponic_system_id" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-water me-1"></i>Sistema acuapónico:
                                </label>
                                <select name="aquaponic_system_id" id="aquaponic_system_id" class="form-control form-control-sm rounded" required>
                                    <option value="">Seleccione el sistema</option>
                                    @foreach ($sistema as $s)
                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="resowing_id" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-seedling me-1"></i>Resiembra:
                                </label>
                                <select name="resowing_id" id="resowing_id" class="form-control form-control-sm rounded" required>
                                    <option value="">Seleccione una resiembra</option>
                                    @foreach ($resiembras as $r)
                                    <option value="{{ $r->id }}"
                                        data-system="{{ $r->aquaponic_system_id }}"
                                        data-date="{{ $r->date }}"
                                        data-total_quantity="{{ $r->total_quantity }}"
                                        data-status="{{ $r->status }}">
                                        {{ $r->crops->species->name ?? 'Sin cultivo' }} - {{ $r->status }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="plant_count" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-leaf me-1"></i>N° Plantas:
                                </label>
                                <input type="number" name="plant_count" class="form-control form-control-sm rounded" id="plant_count" required>
                                <div class="invalid-feedback small" id="error-plantas"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-palette me-1"></i>Color de hoja:
                                </label>
                                <div class="d-flex gap-3 justify-content-between">
                                    @php
                                    $colores = [
                                    '#138713ff', // Verde oscuro
                                    '#a6d842ff', // Verde amarillento
                                    '#32dc32ff', // Verde claro
                                    '#1ccf00ff' // Verde normal
                                    ];
                                    @endphp
                                    @foreach($colores as $color)
                                    <label class="color-option">
                                        <input type="radio" name="color_tone" value="{{ $color }}" required>
                                        <span class="color-circle-modal" style="background-color: {{ $color }};"></span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="height_cm" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-ruler-vertical me-1"></i>Altura (cm):
                                </label>
                                <input type="number" name="height_cm" class="form-control form-control-sm rounded" id="height_cm" step="0.1" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="days_elapsed" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-clock me-1"></i>Tiempo (días):
                                </label>
                                <input type="number" name="days_elapsed" class="form-control form-control-sm rounded" id="days_elapsed" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="growth" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-arrow-up me-1"></i>Crecimiento:
                                </label>
                                <input type="number" name="growth" class="form-control form-control-sm rounded" id="growth" step="0.1" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="comparison_percentage" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-chart-line me-1"></i>Rendimiento (%):
                                </label>
                                <input type="number" name="comparison_percentage" class="form-control form-control-sm rounded" id="comparison_percentage" step="0.01" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label for="mortality" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-skull me-1"></i>Mortalidad:
                                </label>
                                <input type="number" name="mortality" class="form-control form-control-sm rounded" id="mortality" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="notes" class="form-label small fw-bold text-success mb-1">
                            <i class="fas fa-sticky-note me-1"></i>Novedades:
                        </label>
                        <textarea class="form-control form-control-sm rounded" name="notes" id="notes" rows="2" style="resize: none;"></textarea>
                    </div>
                </div>
                
                <div class="modal-footer bg-light py-3">
                    <button type="button" class="btn btn-sm btn-secondary rounded px-3 py-2" data-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-sm btn-success rounded px-3 py-2 shadow">
                        <i class="fas fa-save me-1"></i>Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Footer Sencillo -->
<footer class="footer mt-5 py-4 bg-light border-top">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <span class="text-muted small">
                    &copy; {{ date('Y') }} Sistema Acuapónico. Todos los derechos reservados.
                </span>
            </div>
        </div>
    </div>
</footer>

<style>
.footer {
    margin-top: auto;
    background-color: #f8f9fa !important;
    border-top: 1px solid #e9ecef !important;
}

/* Estilos mejorados para un aspecto más profesional */
.card {
    border: none;
    border-radius: 12px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}

.table th {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

.table-hover tbody tr:hover {
    background-color: rgba(40, 167, 69, 0.05);
    transform: translateX(5px);
    transition: all 0.3s ease;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    border: none;
}

.btn-success:hover {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(40, 167, 69, 0.3);
}

.badge {
    font-weight: 500;
}

/* Animaciones personalizadas */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
    40% { transform: translateY(-10px); }
    60% { transform: translateY(-5px); }
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
    20%, 40%, 60%, 80% { transform: translateX(5px); }
}

@keyframes iconPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.2); }
    100% { transform: scale(1); }
}

.animate__animated {
    animation-duration: 0.5s;
    animation-fill-mode: both;
}

.animate__fadeInDown {
    animation-name: fadeInDown;
}

.animate__fadeInUp {
    animation-name: fadeInUp;
}

.animate__fadeInRight {
    animation-name: fadeInRight;
}

/* Contenedor de botones de acción */
.action-buttons {
    gap: 12px;
}

/* Botones de acción mejorados */
.btn-action {
    position: relative;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    border: none;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

/* Botón de editar - SOLO ICONO AMARILLO SIN FONDO */
.btn-edit {
    background: transparent !important;
    box-shadow: none !important;
}

.btn-delete {
    background: linear-gradient(135deg, #e74a3b, #be2617);
}

.btn-action:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 6px 15px rgba(0,0,0,0.15);
}

.btn-action:active {
    transform: translateY(0) scale(0.98);
}

/* Botón de editar hover - SOLO ICONO AMARILLO */
.btn-edit:hover {
    background: transparent !important;
}

.btn-delete:hover {
    background: linear-gradient(135deg, #be2617, #e74a3b);
    animation: shake 0.5s ease;
}

/* Iconos dentro de los botones */
.btn-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    transition: all 0.3s ease;
}

/* Icono de editar - COLOR AMARILLO */
.btn-edit .btn-icon {
    color: #ffc107 !important; /* Color amarillo */
}

.btn-delete .btn-icon {
    color: white;
}

.btn-action:hover .btn-icon {
    animation: iconPulse 0.5s ease;
}

/* Tooltips para botones */
.btn-tooltip {
    position: absolute;
    bottom: -30px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #333;
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    white-space: nowrap;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 3px 6px rgba(0,0,0,0.16);
}

.btn-action:hover .btn-tooltip {
    opacity: 1;
    visibility: visible;
    bottom: -35px;
}

/* Efectos de hover */
.btn-hover-scale {
    transition: all 0.3s ease;
}

.btn-hover-scale:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

/* Estado activo con pulso */
.pulse-active {
    animation: pulse 2s infinite;
}

/* Spinner personalizado */
.spinner-grow {
    animation-duration: 0.8s;
}

/* Efecto de carga para la tabla */
#seguimientoresiembra {
    opacity: 0;
    transition: opacity 0.5s ease;
}

#seguimientoresiembra.loaded {
    opacity: 1;
}

/* Tooltip personalizado */
.tooltip-inner {
    background-color: #333;
    color: #fff;
    border-radius: 4px;
    padding: 5px 10px;
}

.bs-tooltip-top .arrow::before {
    border-top-color: #333;
}

/* Estilos para tabla con líneas */
#seguimientoresiembra {
    border-collapse: separate;
    border-spacing: 0;
    width: 100%;
}

#seguimientoresiembra th,
#seguimientoresiembra td {
    border-right: 1px solid #e3e6f0;
    border-bottom: 1px solid #e3e6f0;
}

#seguimientoresiembra th:last-child,
#seguimientoresiembra td:last-child {
    border-right: none;
}

#seguimientoresiembra tr:last-child td {
    border-bottom: none;
}

#seguimientoresiembra thead th {
    background: linear-gradient(to right, #28a745, #20c997);
    border-top: 1px solid #e3e6f0;
    border-bottom: 2px solid #e3e6f0;
    font-weight: 600;
    color: white;
}

/* ESTILOS ESPECÍFICOS PARA LOS MODALES MEJORADOS */
.bg-gradient-success {
    background: linear-gradient(87deg, #28a745 0, #20c997 100%) !important;
}

.btn-modal-save {
    background: linear-gradient(135deg, #28a745, #20c997);
    border: none;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.btn-modal-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(40, 167, 69, 0.4) !important;
}

.btn-modal-save:active {
    transform: translateY(0);
}

.btn-modal-cancel {
    transition: all 0.3s ease;
}

.btn-modal-cancel:hover {
    background-color: #858796;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

/* Estilos para inputs más pequeños */
.form-control-sm {
    padding: 0.5rem 0.75rem;
    font-size: 0.875rem;
    line-height: 1.5;
    border-radius: 6px;
    border: 1px solid #d1d3e2;
}

.form-control-sm:focus {
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}

/* Mejoras visuales para los modales */
.modal-content {
    border-radius: 12px;
    overflow: hidden;
}

.modal-header {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.modal-footer {
    border-top: 1px solid #e3e6f0;
}

/* Estilos para los círculos de color mejorados */
.color-circle-large {
    display: inline-block;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    border: 2px solid #e3e6f0;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.color-circle-large:hover {
    transform: scale(1.2);
}

.color-circle-modal {
    display: inline-block;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    border: 2px solid transparent;
    transition: transform 0.2s ease, border-color 0.2s ease;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.color-option input[type="radio"] {
    display: none;
}

.color-option input[type="radio"]:checked + .color-circle-modal {
    border: 3px solid #333;
    transform: scale(1.1);
}

.color-circle-modal:hover {
    transform: scale(1.1);
    border-color: #555;
}

/* Responsividad mejorada */
@media (max-width: 1200px) {
    .container-fluid {
        width: 95% !important;
    }
    
    .table-responsive {
        overflow-x: auto;
    }
}

@media (max-width: 768px) {
    .container-fluid {
        width: 100% !important;
        margin-top: 2% !important;
        padding: 0 10px;
    }
    
    .card-header h1 {
        font-size: 1.8rem !important;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 8px;
    }
    
    .table-responsive {
        font-size: 0.85rem;
    }
    
    .modal-dialog {
        margin: 10px;
    }
}
</style>

<!-- Scripts para funcionalidad y animaciones -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ocultar spinner y mostrar tabla con animación
        setTimeout(function() {
            document.getElementById('tableSpinner').style.display = 'none';
            document.getElementById('seguimientoresiembra').classList.add('loaded');
        }, 800);
        
        // Establecer la fecha actual para el modal de agregar
        const dateInput = document.getElementById('date');
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');
        dateInput.value = `${year}-${month}-${day}`;

        // Filtrar resiembras por sistema acuapónico
        function setupSystemResowingDependency(systemSelectId, resowingSelectId, daysInputId = null) {
            const systemSelect = document.getElementById(systemSelectId);
            const resowingSelect = document.getElementById(resowingSelectId);
            if (!systemSelect || !resowingSelect) return;

            const allOptions = Array.from(resowingSelect.options).slice(1);

            systemSelect.addEventListener('change', function() {
                const selectedSystemId = this.value;
                resowingSelect.innerHTML = '<option value="">Seleccione una resiembra</option>';

                allOptions.forEach(option => {
                    if (option.getAttribute('data-system') === selectedSystemId) {
                        resowingSelect.appendChild(option.cloneNode(true));
                    }
                });

                if (daysInputId) {
                    const daysInput = document.getElementById(daysInputId);
                    if (daysInput) daysInput.value = '';
                }
            });
        }

        setupSystemResowingDependency('aquaponic_system_id', 'resowing_id', 'days_elapsed');
        setupSystemResowingDependency('edit-aquaponic_system_id', 'edit-resowing_id', 'edit-days_elapsed');

        // Función para calcular días transcurridos
        function calculateDaysElapsed(resowingDate, dateInputId, daysInputId) {
            const dateInput = document.getElementById(dateInputId);
            const daysInput = document.getElementById(daysInputId);
            if (!resowingDate || !dateInput.value) {
                console.warn('Falta fecha de resiembra o fecha de seguimiento:', { resowingDate, dateValue: dateInput.value });
                daysInput.value = '';
                return;
            }
            try {
                const fechaInicio = new Date(resowingDate);
                const fechaSeleccionada = new Date(dateInput.value);
                if (isNaN(fechaInicio) || isNaN(fechaSeleccionada)) {
                    console.error('Fechas inválidas:', { resowingDate, dateValue: dateInput.value });
                    daysInput.value = '';
                    return;
                }
                const diffTiempo = fechaSeleccionada - fechaInicio;
                const diffDias = Math.floor(diffTiempo / (1000 * 60 * 60 * 24));
                daysInput.value = Math.max(0, diffDias);
            } catch (error) {
                console.error('Error en calculateDaysElapsed:', error);
                daysInput.value = '';
            }
        }

        // Scripts para agregar
        document.getElementById('resowing_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const fechaResiembra = selectedOption.getAttribute('data-date');
            const totalQuantity = parseInt(selectedOption.getAttribute('data-total_quantity')) || 0;
            console.log('Fecha de resiembra:', fechaResiembra); // Depuración

            calculateDaysElapsed(fechaResiembra, 'date', 'days_elapsed');

            // Limpiar campos calculados
            document.getElementById('growth').value = '';
            document.getElementById('comparison_percentage').value = '';
            document.getElementById('mortality').value = '';

            window.totalQuantity = totalQuantity;
            window.initialPlantCount = totalQuantity;

            if (this.value) {
                fetch(`{{ url('/pasante/seguimiento_resiembra/previous') }}/${this.value}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    window.previousTracking = data.previousTracking;
                    window.totalQuantity = data.total_quantity;
                    window.initialPlantCount = data.total_quantity;
                    updateCalculatedFields();
                })
                .catch(error => {
                    console.error('Error:', error);
                    window.previousTracking = null;
                    updateCalculatedFields();
                });
            }
        });

        // Actualizar días transcurridos al cambiar la fecha en agregar
        document.getElementById('date').addEventListener('change', function() {
            if (!this.value) {
                console.error('El campo de fecha está vacío');
                this.value = `${year}-${month}-${day}`; // Restaurar fecha actual si está vacío
            }
            const resowingSelect = document.getElementById('resowing_id');
            const selectedOption = resowingSelect.options[resowingSelect.selectedIndex];
            const fechaResiembra = selectedOption ? selectedOption.getAttribute('data-date') : null;
            calculateDaysElapsed(fechaResiembra, 'date', 'days_elapsed');
        });

        // Forzar cálculo al abrir el modal de agregar
        document.querySelector('#agregar').addEventListener('show.bs.modal', function() {
            const resowingSelect = document.getElementById('resowing_id');
            const selectedOption = resowingSelect.options[resowingSelect.selectedIndex];
            const fechaResiembra = selectedOption ? selectedOption.getAttribute('data-date') : null;
            calculateDaysElapsed(fechaResiembra, 'date', 'days_elapsed');
        });

        // Escuchar cambios en plant_count y height_cm para agregar
        ['plant_count', 'height_cm'].forEach(field => {
            document.getElementById(field).addEventListener('input', () => updateCalculatedFields());
        });

        // Validar formulario antes de enviar para agregar
        document.querySelector('#agregar form').addEventListener('submit', function(e) {
            if (!updateCalculatedFields()) {
                e.preventDefault();
            }
        });

        // Scripts para editar
        document.getElementById('edit-resowing_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const fechaResiembra = selectedOption.getAttribute('data-date');
            const totalQuantity = parseInt(selectedOption.getAttribute('data-total_quantity')) || 0;
            const resowingStatus = selectedOption.getAttribute('data-status');
            console.log('Fecha de resiembra (editar):', fechaResiembra, 'Estado:', resowingStatus); // Depuración

            calculateDaysElapsed(fechaResiembra, 'edit-date', 'edit-days_elapsed');

            // Limpiar campos calculados
            document.getElementById('edit-plant_count').value = totalQuantity;
            document.getElementById('edit-height_cm').value = '';
            document.getElementById('edit-growth').value = '';
            document.getElementById('edit-comparison_percentage').value = '';
            document.getElementById('edit-mortality').value = '';

            window.totalQuantity = totalQuantity;
            window.initialPlantCount = totalQuantity;

            if (this.value) {
                fetch(`{{ url('/pasante/seguimiento_resiembra/previous') }}/${this.value}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    window.previousTracking = data.previousTracking;
                    window.totalQuantity = data.total_quantity;
                    window.initialPlantCount = data.total_quantity;
                    console.log('Datos del seguimiento anterior:', data); // Depuración
                    updateCalculatedFields(true);
                })
                .catch(error => {
                    console.error('Error al obtener seguimiento anterior:', error);
                    window.previousTracking = null;
                    window.totalQuantity = totalQuantity;
                    window.initialPlantCount = totalQuantity;
                    updateCalculatedFields(true);
                });
            } else {
                updateCalculatedFields(true);
            }
        });

        // Actualizar días transcurridos al cambiar la fecha en edición
        document.getElementById('edit-date').addEventListener('change', function() {
            if (!this.value) {
                console.error('El campo de fecha está vacío (editar)');
                this.value = `${year}-${month}-${day}`; // Restaurar fecha actual si está vacío
            }
            const resowingSelect = document.getElementById('edit-resowing_id');
            const selectedOption = resowingSelect.options[resowingSelect.selectedIndex];
            const fechaResiembra = selectedOption ? selectedOption.getAttribute('data-date') : null;
            calculateDaysElapsed(fechaResiembra, 'edit-date', 'edit-days_elapsed');
            updateCalculatedFields(true);
        });

        // Escuchar cambios en plant_count y height_cm para editar
        ['plant_count', 'height_cm'].forEach(field => {
            document.getElementById(`edit-${field}`).addEventListener('input', () => updateCalculatedFields(true));
        });

        // Validar formulario antes de enviar para editar
        document.querySelector('#editar form').addEventListener('submit', function(e) {
            if (!updateCalculatedFields(true)) {
                e.preventDefault();
            }
        });

        // Lógica para el modal de edición
        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                console.log('Datos del botón:', {
                    id,
                    date: this.getAttribute('data-date'),
                    aquaponic_system_id: this.getAttribute('data-aquaponic_system_id'),
                    resowing_id: this.getAttribute('data-resowing_id'),
                    plant_count: this.getAttribute('data-plant_count'),
                    height_cm: this.getAttribute('data-height_cm'),
                    days_elapsed: this.getAttribute('data-days_elapsed'),
                    growth: this.getAttribute('data-growth'),
                    comparison_percentage: this.getAttribute('data-comparison_percentage'),
                    mortality: this.getAttribute('data-mortality'),
                    notes: this.getAttribute('data-notes'),
                    resowing_date: this.getAttribute('data-resowing_date')
                }); // Depuración
                document.getElementById('formEditar').action = `/pasante/seguimiento_resiembra/update/${id}`;
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-date').value = this.getAttribute('data-date') || `${year}-${month}-${day}`;
                document.getElementById('edit-aquaponic_system_id').value = this.getAttribute('data-aquaponic_system_id');
                document.getElementById('edit-plant_count').value = this.getAttribute('data-plant_count');
                document.getElementById('edit-height_cm').value = this.getAttribute('data-height_cm');
                document.getElementById('edit-days_elapsed').value = this.getAttribute('data-days_elapsed');
                document.getElementById('edit-growth').value = this.getAttribute('data-growth');
                document.getElementById('edit-comparison_percentage').value = this.getAttribute('data-comparison_percentage');
                document.getElementById('edit-mortality').value = this.getAttribute('data-mortality');
                document.getElementById('edit-notes').value = this.getAttribute('data-notes') || '';

                // Seleccionar el color correspondiente
                const colorTone = this.getAttribute('data-color_tone');
                const colorInputs = document.querySelectorAll('#editar input[name="color_tone"]');
                colorInputs.forEach(input => {
                    input.checked = input.value === colorTone;
                });

                // Calcular días elapsed inicial
                const resowingDate = this.getAttribute('data-resowing_date');
                calculateDaysElapsed(resowingDate, 'edit-date', 'edit-days_elapsed');

                // Filtrar y seleccionar el resowing_id
                const systemSelect = document.getElementById('edit-aquaponic_system_id');
                systemSelect.value = this.getAttribute('data-aquaponic_system_id');
                systemSelect.dispatchEvent(new Event('change'));
                setTimeout(() => {
                    const resowingSelect = document.getElementById('edit-resowing_id');
                    resowingSelect.value = this.getAttribute('data-resowing_id');
                    window.previousTracking = null; // Resetear para evitar valores antiguos
                    if (resowingSelect.value) {
                        const selectedOption = resowingSelect.options[resowingSelect.selectedIndex];
                        const resowingStatus = selectedOption.getAttribute('data-status');
                        window.totalQuantity = parseInt(selectedOption.getAttribute('data-total_quantity')) || 0;
                        window.initialPlantCount = window.totalQuantity;
                        fetch(`{{ url('/pasante/seguimiento_resiembra/previous') }}/${resowingSelect.value}`, {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            window.previousTracking = data.previousTracking;
                            window.totalQuantity = data.total_quantity;
                            window.initialPlantCount = data.total_quantity;
                            console.log('Datos del seguimiento anterior:', data); // Depuración
                            updateCalculatedFields(true); // Recalcular después de cargar datos
                        })
                        .catch(error => {
                            console.error('Error al obtener seguimiento anterior:', error);
                            window.previousTracking = null;
                            updateCalculatedFields(true);
                        });
                    } else {
                        updateCalculatedFields(true); // Si no hay resowing_id, usar valores originales
                    }
                }, 100);
            });
        });

        // Lógica para el modal de eliminación
        document.querySelectorAll('.btnEliminar').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                
                // Crear un estilo dinámico para SweetAlert que coincida con tu tema
                const dynamicStyle = `
                    <style>
                        .swal2-popup.custom-delete-style {
                            background: #fff;
                            border-radius: 12px;
                            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
                            border: 1px solid #e3e6f0;
                            overflow: hidden;
                            padding: 2rem;
                            max-width: 450px;
                        }
                        
                        .swal2-popup.custom-delete-style .swal2-title {
                            color: #e74a3b;
                            font-weight: 600;
                            font-size: 1.5rem;
                            margin-bottom: 15px;
                            padding-bottom: 15px;
                            border-bottom: 1px solid #e3e6f0;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            gap: 10px;
                        }
                        
                        .swal2-popup.custom-delete-style .swal2-html-container {
                            color: #5a5c69;
                            font-size: 1rem;
                            line-height: 1.5;
                            margin: 1.5rem 0;
                            text-align: center;
                        }
                        
                        .swal2-popup.custom-delete-style .swal2-icon {
                            width: 60px;
                            height: 60px;
                            border: 4px solid #f8d7da;
                            color: #e74a3b;
                            margin: 10px auto 5px;
                            position: relative;
                            box-sizing: content-box;
                            border-radius: 50%;
                            animation: pulse-icon 2s infinite;
                        }
                        
                        .swal2-popup.custom-delete-style .swal2-icon .swal2-icon-content {
                            font-size: 2.5rem;
                            font-weight: bold;
                        }
                        
                        .swal2-popup.custom-delete-style .swal2-actions {
                            margin: 1.5rem 0 0.5rem;
                            gap: 15px;
                            width: 100%;
                            display: flex;
                            justify-content: center;
                        }
                        
                        .swal2-popup.custom-delete-style .swal2-confirm {
                            background: linear-gradient(135deg, #e74a3b 0%, #be2617 100%);
                            border: none;
                            border-radius: 50px;
                            padding: 10px 25px;
                            font-weight: 600;
                            box-shadow: 0 4px 15px rgba(231, 74, 59, 0.3);
                            transition: all 0.3s ease;
                            min-width: 120px;
                            color: white;
                        }
                        
                        .swal2-popup.custom-delete-style .swal2-confirm:hover {
                            transform: translateY(-2px);
                            box-shadow: 0 6px 15px rgba(231, 74, 59, 0.4);
                        }
                        
                        /* ESTILOS ESPECÍFICOS PARA EL BOTÓN DE CANCELAR */
                        .swal2-popup.custom-delete-style .swal2-cancel {
                            background: #fff;
                            color: #5a5c69;
                            border: 1px solid #e3e6f0;
                            border-radius: 50px;
                            padding: 10px 25px;
                            font-weight: 600;
                            transition: all 0.3s ease;
                            min-width: 120px;
                        }
                        
                        .swal2-popup.custom-delete-style .swal2-cancel:hover {
                            background: #f8f9fc;
                            transform: translateY(-2px);
                            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                            color: #28a745;
                            border-color: #28a745;
                        }
                        
                        /* Mejorar el contraste del texto en el botón de cancelar */
                        .swal2-popup.custom-delete-style .swal2-cancel:focus {
                            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.25);
                        }
                        
                        @keyframes pulse-icon {
                            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(231, 74, 59, 0.4); }
                            70% { transform: scale(1.02); box-shadow: 0 0 0 10px rgba(231, 74, 59, 0); }
                            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(231, 74, 59, 0); }
                        }
                        
                        /* Animación de entrada personalizada */
                        @keyframes custom-modal-in {
                            0% { 
                                transform: scale(0.96) translateY(10px);
                                opacity: 0;
                            }
                            100% { 
                                transform: scale(1) translateY(0);
                                opacity: 1;
                            }
                        }
                        
                        .swal2-show.custom-delete-style {
                            animation: custom-modal-in 0.3s ease-out;
                        }
                        
                        /* Efecto de brillo en el borde superior */
                        .swal2-popup.custom-delete-style::before {
                            content: '';
                            position: absolute;
                            top: 0;
                            left: 0;
                            right: 0;
                            height: 4px;
                            background: linear-gradient(90deg, #ff9d9d, #e74a3b, #be2617);
                            border-radius: 4px 4px 0 0;
                        }
                    </style>
                `;
                
                // Agregar el estilo dinámico al documento
                document.head.insertAdjacentHTML('beforeend', dynamicStyle);
                
                Swal.fire({
                    title: '<i class="fas fa-exclamation-triangle me-2"></i>¿Eliminar Seguimiento?',
                    html: '<div style="text-align:center;">Esta acción <span style="color:#e74a3b; font-weight:bold;">no se puede deshacer</span> y el seguimiento será eliminado permanentemente.</div>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: 'transparent',
                    cancelButtonColor: 'transparent',
                    confirmButtonText: '<i class="fas fa-trash text-white me-2"></i>Eliminar',
                    cancelButtonText: '<i class="fas fa-times me-2"></i>Cancelar',
                    reverseButtons: true,
                    customClass: {
                        popup: 'custom-delete-style',
                        title: 'custom-title',
                        htmlContainer: 'custom-html',
                        confirmButton: 'custom-confirm',
                        cancelButton: 'custom-cancel',
                        icon: 'custom-icon'
                    },
                    buttonsStyling: false,
                    showClass: {
                        popup: 'swal2-show custom-delete-style'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        const formEliminar = document.createElement('form');
                        formEliminar.method = 'POST';
                        formEliminar.action = `/pasante/seguimiento_resiembra/destroy/${id}`;
                        
                        const csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = '{{ csrf_token() }}';
                        formEliminar.appendChild(csrfToken);
                        
                        const methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = 'DELETE';
                        formEliminar.appendChild(methodInput);
                        
                        document.body.appendChild(formEliminar);
                        formEliminar.submit();
                    }
                    
                    // Eliminar el estilo dinámico después de usar
                    const dynamicStyles = document.querySelectorAll('style');
                    dynamicStyles.forEach(style => {
                        if (style.textContent.includes('custom-delete-style')) {
                            style.remove();
                        }
                    });
                });
            });
        });

        // DataTable initialization
$(document).ready(function() {
    // Destruir DataTable si ya existe
    if ($.fn.DataTable.isDataTable('#seguimientoresiembra')) {
        $('#seguimientoresiembra').DataTable().destroy();
    }
    
    // Inicializar DataTable
    $('#seguimientoresiembra').DataTable({
        responsive: true,
        autoWidth: false,
        language: {
            url: "{{ asset('AdminLTE/plugins/datatables/i18n/es-ES.json') }}"
        },
        columnDefs: [
            { orderable: false, targets: [5, 12] } // Deshabilitar ordenamiento en columnas de color y acciones
        ],
        initComplete: function() {
            // Añadir animación a las filas de la tabla
            $('#seguimientoresiembra tbody tr').addClass('animate__animated animate__fadeInRight');
        }
    });
});

        // Función para actualizar campos calculados
        function updateCalculatedFields(isEditModal = false) {
            const prefix = isEditModal ? 'edit-' : '';
            const plantCountInput = document.getElementById(`${prefix}plant_count`);
            const heightInput = document.getElementById(`${prefix}height_cm`);
            const growthInput = document.getElementById(`${prefix}growth`);
            const comparisonPercentageInput = document.getElementById(`${prefix}comparison_percentage`);
            const mortalityInput = document.getElementById(`${prefix}mortality`);
            const errorDiv = document.getElementById(`error-plantas${isEditModal ? '-edit' : ''}`);
            const resowingSelect = document.getElementById(`${prefix}resowing_id`);
            const selectedOption = resowingSelect ? resowingSelect.options[resowingSelect.selectedIndex] : null;
            const resowingStatus = selectedOption ? selectedOption.getAttribute('data-status') : null;

            const plantCount = parseInt(plantCountInput.value) || 0;
            const heightCm = parseFloat(heightInput.value) || 0;
            const totalQuantity = window.totalQuantity || 0;
            const previousTracking = window.previousTracking;

            // Validar plant_count
            if (plantCount > totalQuantity) {
                plantCountInput.classList.add('is-invalid');
                errorDiv.textContent = `El número de plantas no puede exceder la cantidad resembrada total (${totalQuantity}).`;
                return false;
            } else {
                plantCountInput.classList.remove('is-invalid');
                errorDiv.textContent = '';
            }

            // Calcular crecimiento
            let growth = 0;
            if (resowingStatus === 'Seguimiento' && previousTracking) {
                const previousHeight = parseFloat(previousTracking.height_cm) || 0;
                growth = heightCm - previousHeight;
            } else {
                growth = heightCm; // Para resiembra "Registrada" o sin seguimiento anterior
            }
            growth = Math.max(0, growth);
            growthInput.value = growth.toFixed(2);

            // Calcular rendimiento (%)
            let comparisonPercentage = 0;
            let baseQuantity = totalQuantity;
            if (resowingStatus === 'Seguimiento' && previousTracking) {
                baseQuantity = parseInt(previousTracking.plant_count) || totalQuantity;
            }
            if (baseQuantity > 0) {
                comparisonPercentage = (plantCount / baseQuantity) * 100;
                comparisonPercentage = Math.min(100, Math.max(0, comparisonPercentage));
            }
            comparisonPercentageInput.value = comparisonPercentage.toFixed(2);

            // Calcular mortalidad
            let mortality = 0;
            let previousPlantCount = totalQuantity;
            if (resowingStatus === 'Seguimiento' && previousTracking) {
                previousPlantCount = parseInt(previousTracking.plant_count) || totalQuantity;
            }
            mortality = previousPlantCount - plantCount;
            mortality = Math.max(0, mortality);
            mortalityInput.value = mortality;

            return true;
        }

        // Forzar cálculo al abrir el modal de edición
        document.querySelector('#editar').addEventListener('show.bs.modal', function() {
            const resowingSelect = document.getElementById('edit-resowing_id');
            const selectedOption = resowingSelect.options[resowingSelect.selectedIndex];
            const fechaResiembra = selectedOption ? selectedOption.getAttribute('data-date') : null;
            calculateDaysElapsed(fechaResiembra, 'edit-date', 'edit-days_elapsed');
            updateCalculatedFields(true);
        });
    });
</script>

@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: '{{ session("success") }}',
            confirmButtonColor: '#28a745',
            showClass: {
                popup: 'animate__animated animate__bounceIn'
            }
        });
    });
</script>
@endif

@if (session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session("error") }}',
            confirmButtonColor: '#dc3545',
            showClass: {
                popup: 'animate__animated animate__shakeX'
            }
        });
    });
</script>
@endif

@section('scripts')
<script>
    $(document).ready(function() {
        $('#seguimientoresiembra').DataTable({
            responsive: false,
            autoWidth: false,
            language: {
                url: "{{ asset('AdminLTE/plugins/datatables/i18n/es-ES.json') }}"
            }
        });
    });
</script>
@endsection
@endsection