@extends('acuaponico::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">Seguimientos Peces</li>
@endpush
@section('content9')

<div class="container-fluid px-4" style="width: 93%; margin-top: 5%; margin-left: 5%;">
    <!-- Header con gradiente y sombra -->
    <div class="container mt-4">
        <div class="card shadow-lg border-0" style="background: linear-gradient(135deg, #71ccef 0%, #71ccef 100%);">
            <div class="card-body py-4">
                <div class="d-flex justify-content-between align-items-center mb-4 animate__animated animate__fadeInDown">
                    <h1 class="h2 mb-0 text-white fw-bold text-center w-100" style="font-size: 2.2rem; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                        <i class="fas fa-fish me-3"></i>Gestión de Seguimiento de Peces
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Tarjeta principal con diseño moderno -->
    <div class="card shadow-lg border-0 mt-4 animate__animated animate__fadeInUp" style="border-radius: 15px; overflow: hidden;">
        <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background: linear-gradient(to right, #f8f9fc, #e3e6f0); border-bottom: 1px solid #e3e6f0;">
            <h5 class="mb-0 text-primary fw-semibold">
                <i class="fas fa-list me-2"></i>Lista de Seguimientos
            </h5>
            <div class="spinner-border text-primary" role="status" id="tableSpinner" style="width: 1.5rem; height: 1.5rem;">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle text-primary me-2"></i>
                    <small class="text-muted">Total de seguimientos: {{ count($seguimientoPez) }}</small>
                </div>
                <button type="button" class="btn btn-primary rounded-pill px-4 py-2 fw-medium shadow-sm" data-toggle="modal" data-target="#agregar"
                    style="background: linear-gradient(135deg, #71ccef 0%, #71ccef 100%); border: none; transition: all 0.3s ease;">
                    <i class="fas fa-plus-circle me-2"></i> Nuevo Seguimiento
                </button>
            </div>
            
            <div class="table-responsive rounded-3 shadow-sm">
                <table id="seguimientopeztable" class="table table-hover align-middle mb-0" style="border: 1px solid #e3e6f0;">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center py-3" style="background-color: #71ccef; color: white; border-right: 1px solid rgba(255,255,255,0.1);">#</th>
                            <th class="py-3" style="background-color: #71ccef; color: white; border-right: 1px solid rgba(255,255,255,0.1);">Fecha</th>
                            <th class="py-3" style="background-color: #71ccef; color: white; border-right: 1px solid rgba(255,255,255,0.1);">Cultivo</th>
                            <th class="text-center py-3" style="background-color: #71ccef; color: white; border-right: 1px solid rgba(255,255,255,0.1);">N° Peces</th>
                            <th class="text-center py-3" style="background-color: #71ccef; color: white; border-right: 1px solid rgba(255,255,255,0.1);">Peso(gr)</th>
                            <th class="text-center py-3" style="background-color: #71ccef; color: white; border-right: 1px solid rgba(255,255,255,0.1);">Biomasa(gr)</th>
                            <th class="text-center py-3" style="background-color: #71ccef; color: white; border-right: 1px solid rgba(255,255,255,0.1);">Ganancia(gr)</th>
                            <th class="text-center py-3" style="background-color: #71ccef; color: white; border-right: 1px solid rgba(255,255,255,0.1);">Mortalidad</th>
                            <th class="text-center py-3" style="background-color: #71ccef; color: white;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $n = 1; @endphp
                        @foreach ($seguimientoPez as $sp)
                        <tr class="animate__animated animate__fadeIn" style="animation-delay: {{ $n * 0.03 }}s; border-bottom: 1px solid #e3e6f0; transition: all 0.3s ease;">
                            <td class="text-center fw-bold py-3" style="border-right: 1px solid #e3e6f0;">{{ $n++ }}</td>
                            <td class="fw-medium py-3" style="border-right: 1px solid #e3e6f0;">{{ $sp->Tracking->date ?? 'Sin fecha' }}</td>
                            <td class="py-3" style="border-right: 1px solid #e3e6f0;">
                                @if ($sp->Tracking->crops->species->name ?? 'sin especie')
                                <span class="text-muted">{{ $sp->Tracking->crops->species->name ?? 'sin especie' }}</span>
                                @else
                                <span class="text-muted font-italic">Sin cultivo</span>
                                @endif
                            </td>
                            <td class="text-center fw-bold py-3" style="border-right: 1px solid #e3e6f0;">
                                <span class="badge bg-info rounded-pill px-3 py-2 shadow-sm">{{ $sp->fish_count }}</span>
                            </td>
                            <td class="text-center fw-bold py-3" style="border-right: 1px solid #e3e6f0;">
                                <span class="badge bg-warning rounded-pill px-3 py-2 shadow-sm">{{ $sp->weight_gr }}gr</span>
                            </td>
                            <td class="text-center fw-bold py-3" style="border-right: 1px solid #e3e6f0;">
                                <span class="badge bg-success rounded-pill px-3 py-2 shadow-sm">{{ $sp->biomass_gr }}gr</span>
                            </td>
                            <td class="text-center fw-bold py-3" style="border-right: 1px solid #e3e6f0;">
                                <span class="badge bg-primary rounded-pill px-3 py-2 shadow-sm">{{ $sp->weight_gain_gr }}gr</span>
                            </td>
                            <td class="text-center py-3" style="border-right: 1px solid #e3e6f0;">
                                @if($sp->mortality > 0)
                                <span class="badge bg-danger rounded-pill px-3 py-2 shadow-sm">{{ $sp->mortality }}</span>
                                @else
                                <span class="badge bg-secondary rounded-pill px-3 py-2 shadow-sm">{{ $sp->mortality }}</span>
                                @endif
                            </td>
                            <td class="text-center py-3">
                                <div class="d-flex justify-content-center action-buttons">
                                    <!-- Botón de Editar -->
                                    <button type="button" class="btn btn-action btn-edit editbtn mx-1"
                                        data-id="{{ $sp->id }}"
                                        data-tracking_id="{{ $sp->tracking_id }}"
                                        data-fish_count="{{ $sp->fish_count }}"
                                        data-weight_gr="{{ $sp->weight_gr }}"
                                        data-biomass_gr="{{ $sp->biomass_gr }}"
                                        data-weight_gain_gr="{{ $sp->weight_gain_gr }}"
                                        data-mortality="{{ $sp->mortality }}"
                                        data-toggle="modal"
                                        data-target="#editar">
                                        <div class="btn-icon">
                                            <i class="fas fa-pen"></i>
                                        </div>
                                        <span class="btn-tooltip">Editar</span>
                                    </button>
                                    
                                    <!-- Botón de Eliminar -->
                                    <button type="button" class="btn btn-action btn-delete btnEliminar mx-1" data-id="{{ $sp->id }}">
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
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="overflow: hidden;">
            <div class="modal-header bg-gradient-primary text-white py-3">
                <h5 class="modal-title fw-bold mb-0" id="editarLabel">
                    <i class="fas fa-edit me-2"></i>
                    Editar Seguimiento
                </h5>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="formEditar" action="{{route('acuaponico.pasante.pasante.updatetrackingfish', 0)}}" method="POST">
                @csrf
                @method('put')
                
                <div class="modal-body p-4">
                    <input type="hidden" name="id" id="edit-id">
                    
                    <div class="form-group mb-3">
                        <label for="edit-tracking_id" class="form-label small fw-bold text-primary mb-1">
                            <i class="fas fa-seedling me-1"></i>Cultivo seguimiento:
                        </label>
                        <select class="form-control form-control-sm rounded" id="edit-tracking_id" name="tracking_id" required style="height: 30%;">
                            <option value="">Seleccione un seguimiento</option>
                            @foreach ($seguimientos as $seguimiento)
                            <option value="{{ $seguimiento->id }}"
                                data-peces="{{ optional($seguimiento->latestFishTracking)->fish_count ?? $seguimiento->crops->quantity }}"
                                data-peso="{{ optional($seguimiento->latestFishTracking)->weight_gr ?? 0 }}">
                                {{ $seguimiento->crops->species->name }} - {{ $seguimiento->date }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="edit-fish_count" class="form-label small fw-bold text-primary mb-1">
                                    <i class="fas fa-fish me-1"></i>N° Peces:
                                </label>
                                <input type="number" class="form-control form-control-sm rounded" name="fish_count" id="edit-fish_count" required>
                                <div class="invalid-feedback small" id="edit-error-peces"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="edit-weight_gr" class="form-label small fw-bold text-primary mb-1">
                                    <i class="fas fa-weight me-1"></i>Peso (gr):
                                </label>
                                <input type="number" class="form-control form-control-sm rounded" name="weight_gr" id="edit-weight_gr" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="edit-biomass_gr" class="form-label small fw-bold text-primary mb-1">
                                    <i class="fas fa-weight-hanging me-1"></i>Biomasa (gr):
                                </label>
                                <input type="number" class="form-control form-control-sm rounded" name="biomass_gr" id="edit-biomass_gr" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="edit-weight_gain_gr" class="form-label small fw-bold text-primary mb-1">
                                    <i class="fas fa-arrow-up me-1"></i>Ganancia (gr):
                                </label>
                                <input type="number" class="form-control form-control-sm rounded" name="weight_gain_gr" id="edit-weight_gain_gr" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="edit-mortality" class="form-label small fw-bold text-primary mb-1">
                            <i class="fas fa-skull me-1"></i>Mortalidad:
                        </label>
                        <input type="number" class="form-control form-control-sm rounded" name="mortality" id="edit-mortality" readonly>
                    </div>
                </div>
                
                <div class="modal-footer bg-light py-3">
                    <button type="button" class="btn btn-sm btn-danger rounded px-3 py-2" data-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-sm btn-primary rounded px-3 py-2 shadow">
                        <i class="fas fa-save me-1"></i>Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Agregar -->
<div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="overflow: hidden;">
            <div class="modal-header bg-gradient-primary text-white py-3">
                <h5 class="modal-title fw-bold mb-0" id="agregarLabel">
                    <i class="fas fa-plus-circle me-2"></i>
                    Nuevo Seguimiento
                </h5>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="{{route ('acuaponico.pasante.pasante.storetrackingfish') }}" method="POST" id="formAgregar">
                @csrf
                
                <div class="modal-body p-4">
                    <div class="form-group mb-3">
                        <label for="tracking_id" class="form-label small fw-bold text-primary mb-1">
                            <i class="fas fa-seedling me-1"></i>Cultivo en seguimiento:
                        </label>
                        <select name="tracking_id" id="tracking_id" class="form-control form-control-sm rounded" required style="height: 30%;">
                            <option value="">Seleccione un seguimiento</option>
                            @foreach ($seguimientos as $seguimiento)
                            <option value="{{ $seguimiento->id }}"
                                data-peces="{{ optional($seguimiento->latestFishTracking)->fish_count ?? $seguimiento->crops->quantity }}"
                                data-peso="{{ optional($seguimiento->latestFishTracking)->weight_gr ?? 0 }}">
                                {{ $seguimiento->crops->species->name }} - {{ $seguimiento->date }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="fish_count" class="form-label small fw-bold text-primary mb-1">
                                    <i class="fas fa-fish me-1"></i>N° Peces:
                                </label>
                                <input type="number" name="fish_count" class="form-control form-control-sm rounded" id="fish_count" required>
                                <div class="invalid-feedback small" id="error-peces"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="weight_gr" class="form-label small fw-bold text-primary mb-1">
                                    <i class="fas fa-weight me-1"></i>Peso Promedio (gr):
                                </label>
                                <input type="number" name="weight_gr" class="form-control form-control-sm rounded" id="weight_gr" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="biomass_gr" class="form-label small fw-bold text-primary mb-1">
                                    <i class="fas fa-weight-hanging me-1"></i>Biomasa (gr):
                                </label>
                                <input type="number" name="biomass_gr" class="form-control form-control-sm rounded" id="biomass_gr" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="weight_gain_gr" class="form-label small fw-bold text-primary mb-1">
                                    <i class="fas fa-arrow-up me-1"></i>Ganancia (gr):
                                </label>
                                <input type="number" name="weight_gain_gr" class="form-control form-control-sm rounded" id="weight_gain_gr" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="mortality" class="form-label small fw-bold text-primary mb-1">
                            <i class="fas fa-skull me-1"></i>Mortalidad:
                        </label>
                        <input type="number" name="mortality" class="form-control form-control-sm rounded" id="mortality" readonly>
                    </div>
                </div>
                
                <div class="modal-footer bg-light py-3">
                    <button type="button" class="btn btn-sm btn-danger rounded px-3 py-2" data-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-sm btn-primary rounded px-3 py-2 shadow">
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
    border-radius: 20px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(221, 221, 221, 0.403) !important;
}

.table th {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

.table-hover tbody tr:hover {
    background-color: rgba(221, 221, 221, 0.05);
    transform: translateX(5px);
    transition: all 0.3s ease;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #71ccef 0%, #71ccef 100%);
    border: none;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #71ccef 0%, #71ccef 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(78, 115, 223, 0.3);
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
    box-shadow: 0 4px 8px rgba(208, 208, 208, 0.1);
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
    box-shadow: 0 6px 15px rgba(255, 255, 255, 0.15);
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

/* ESTILOS ESPECÍFICOS PARA EL MODAL DE EDICIÓN MEJORADO */
.bg-gradient-primary {
    background: linear-gradient(87deg, #71ccef 0, #71ccef 100%) !important;
}

.btn-modal-save {
    background: linear-gradient(135deg, #71ccef, #71ccef);
    border: none;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.btn-modal-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(78, 115, 223, 0.4) !important;
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

.custom-file-label {
    transition: all 0.3s ease;
    border-radius: 6px;
}

.custom-file-input:focus ~ .custom-file-label {
    border-color: #71ccef;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
}

/* Animación para el modal completo */
@keyframes modalEntry {
    0% {
        opacity: 0;
        transform: scale(0.9) translateY(-20px);
    }
    100% {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

.modal.fade .modal-dialog {
    transition: transform 0.3s ease-out, opacity 0.3s ease-out;
    transform: translate(0, -50px);
    opacity: 0;
}

.modal.show .modal-dialog {
    transform: translate(0, 0);
    opacity: 1;
    animation: modalEntry 0.4s ease;
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
    border-color: #71ccef;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
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

/* Responsividad mejorada */
@media (max-width: 768px) {
    .container-fluid {
        width: 95% !important;
        margin-top: 2% !important;
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
}
</style>

<!-- Scripts para funcionalidad y animaciones -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ocultar spinner y mostrar tabla con animación
        setTimeout(function() {
            document.getElementById('tableSpinner').style.display = 'none';
            document.getElementById('seguimientopeztable').classList.add('loaded');
        }, 800);
        
        // Script para el modal de edición
        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('formEditar').action = `/pasante/seguimientoPez/update/${id}`;
                document.getElementById('edit-id').value = id;

                // Cargar valores al formulario
                const trackingId = this.getAttribute('data-tracking_id');
                document.getElementById('edit-tracking_id').value = trackingId;
                document.getElementById('edit-fish_count').value = this.getAttribute('data-fish_count');
                document.getElementById('edit-weight_gr').value = this.getAttribute('data-weight_gr');
                document.getElementById('edit-biomass_gr').value = this.getAttribute('data-biomass_gr');
                document.getElementById('edit-weight_gain_gr').value = this.getAttribute('data-weight_gain_gr');
                document.getElementById('edit-mortality').value = this.getAttribute('data-mortality');

                // Disparar evento change para que cargue los datos previos
                document.getElementById('edit-tracking_id').dispatchEvent(new Event('change'));
            });
        });

        // Reemplazar el código existente del evento click de btnEliminar con este nuevo estilo
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
                            color: #4e73df;
                            border-color: #4e73df;
                        }
                        
                        /* Mejorar el contraste del texto en el botón de cancelar */
                        .swal2-popup.custom-delete-style .swal2-cancel:focus {
                            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.25);
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
                        // Crear formulario para enviar la solicitud DELETE
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = `/pasante/seguimientoPez/destroy/${id}`;
                        
                        // Agregar token CSRF
                        const csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = '{{ csrf_token() }}';
                        
                        // Agregar método DELETE
                        const methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = 'DELETE';
                        
                        form.appendChild(csrfToken);
                        form.appendChild(methodInput);
                        document.body.appendChild(form);
                        
                        // Enviar formulario
                        form.submit();
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
        $('#seguimientopeztable').DataTable({
            responsive: true,
            autoWidth: false,
            language: {
                url: "{{ asset('AdminLTE/plugins/datatables/i18n/es-ES.json') }}"
            },
            columnDefs: [
                { orderable: false, targets: [8] } // Deshabilitar ordenamiento en columna de acciones
            ],
            initComplete: function() {
                // Añadir animación a las filas de la tabla
                $('#seguimientopeztable tbody tr').addClass('animate__animated animate__fadeInRight');
            }
        });
        
        // Efecto de hover en botones de acción
        $('.btn-action').hover(
            function() {
                $(this).css('transform', 'translateY(-3px) scale(1.05)');
            },
            function() {
                $(this).css('transform', 'translateY(0) scale(1)');
            }
        );
    });
</script>

<!-- Script para calcular biomasa, ganancia de peso y mortalidad  a la hora de agregar-->
<script>
    let pecesPrevios = 0;
    let pesoPrevio = 0;

    document.getElementById('tracking_id').addEventListener('change', function() {
        const trackingId = this.value;

        if (trackingId) {
            fetch(`/pasante/seguimientoPez/prevdata/${trackingId}`)
                .then(response => response.json())
                .then(data => {
                    pecesPrevios = parseInt(data.peces) || 0;
                    pesoPrevio = parseFloat(data.peso) || 0;
                    calcularCampos();
                });
        }
    });

    document.getElementById('fish_count').addEventListener('input', calcularCampos);
    document.getElementById('weight_gr').addEventListener('input', calcularCampos);

    function calcularCampos() {
        const pecesActuales = parseInt(document.getElementById('fish_count').value) || 0;
        const pesoActual = parseFloat(document.getElementById('weight_gr').value) || 0;

        const inputPeces = document.getElementById('fish_count');
        const errorMsg = document.getElementById('error-peces');

        if (pecesActuales > pecesPrevios) {
            inputPeces.classList.add('is-invalid');
            errorMsg.innerText = `No puede ingresar más peces (${pecesActuales}) que los registrados anteriormente (${pecesPrevios}).`;
        } else {
            inputPeces.classList.remove('is-invalid');
            errorMsg.innerText = '';
        }

        document.getElementById('biomass_gr').value = (pesoActual * pecesActuales).toFixed(2);
        document.getElementById('weight_gain_gr').value = (pesoActual - pesoPrevio).toFixed(2);
        document.getElementById('mortality').value = (pecesPrevios - pecesActuales > 0 ? pecesPrevios - pecesActuales : 0);
    }
</script>

<!-- Script combinado para modal de editar seguimiento de peces -->
<script>
    let editPecesPrevios = 0;
    let editPesoPrevio = 0;

    document.getElementById('edit-tracking_id').addEventListener('change', function() {
        const trackingId = this.value;

        if (trackingId) {
            fetch(`/pasante/seguimientoPez/prevdata/${trackingId}`)
                .then(response => response.json())
                .then(data => {
                    editPecesPrevios = parseInt(data.peces) || 0;
                    editPesoPrevio = parseFloat(data.peso) || 0;
                    calcularCamposEdit();
                });
        }
    });

    document.getElementById('edit-fish_count').addEventListener('input', calcularCamposEdit);
    document.getElementById('edit-weight_gr').addEventListener('input', calcularCamposEdit);

    function calcularCamposEdit() {
        const pecesActuales = parseInt(document.getElementById('edit-fish_count').value) || 0;
        const pesoActual = parseFloat(document.getElementById('edit-weight_gr').value) || 0;

        const inputPeces = document.getElementById('edit-fish_count');
        const errorMsg = document.getElementById('edit-error-peces');

        if (pecesActuales > editPecesPrevios) {
            inputPeces.classList.add('is-invalid');
            errorMsg.innerText = `No puede ingresar más peces (${pecesActuales}) que los registrados anteriormente (${editPesoPrevio}).`;
        } else {
            inputPeces.classList.remove('is-invalid');
            errorMsg.innerText = '';
        }

        document.getElementById('edit-biomass_gr').value = (pesoActual * pecesActuales).toFixed(2);
        document.getElementById('edit-weight_gain_gr').value = (pesoActual - editPesoPrevio).toFixed(2);
        document.getElementById('edit-mortality').value = (editPecesPrevios - pecesActuales > 0 ? editPecesPrevios - pecesActuales : 0);
    }
</script>

@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: '{{ session("success") }}',
            confirmButtonColor: '#3085d6',
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
            confirmButtonColor: '#d33',
            showClass: {
                popup: 'animate__animated animate__shakeX'
            }
        });
    });
</script>
@endif
@endsection