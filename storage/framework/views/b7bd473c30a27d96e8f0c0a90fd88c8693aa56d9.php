

<?php $__env->startPush('breadcrumbs'); ?>
<li class="breadcrumb-item active">Seguimientos Plantas</li>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content10'); ?>
<div class="container-fluid px-4" style="width: 93%; margin-top: 5%; margin-left: 5%;">
    <!-- Header con gradiente azul -->
    <div class="container mt-4">
        <div class="card shadow-lg border-0" style="background: linear-gradient(135deg, #71ccef 0%, #71ccef 100%);">
            <div class="card-body py-4">
                <div class="d-flex justify-content-between align-items-center mb-4 animate__animated animate__fadeInDown">
                    <h1 class="h2 mb-0 text-white fw-bold text-center w-100" style="font-size: 2.2rem; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                        <i class="fas fa-seedling me-3"></i>Gestión de Seguimiento de Plantas
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Tarjeta principal -->
    <div class="card shadow-lg border-0 mt-4 animate__animated animate__fadeInUp" style="border-radius: 15px; overflow: hidden;">
        <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background: linear-gradient(to right, #f8f9fc, #e3e6f0); border-bottom: 1px solid #e3e6f0;">
            <h5 class="mb-0 fw-semibold" style="color: #71ccef;">
                <i class="fas fa-list me-2"></i>Lista de Seguimientos de Plantas
            </h5>
            <div class="spinner-border" style="color: #71ccef;" role="status" id="tableSpinner" style="width: 1.5rem; height: 1.5rem;">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle" style="color: #71ccef;"></i>
                    <small class="text-muted">Total de seguimientos: <?php echo e(count($seguimientoPlanta)); ?></small>
                </div>
                <button type="button" class="btn rounded-pill px-4 py-2 fw-medium shadow-sm" data-toggle="modal" data-target="#agregar"
                    style="background: linear-gradient(135deg, #71ccef 0%, #71ccef 100%); border: none; transition: all 0.3s ease;">
                    <i class="fas fa-plus-circle me-2"></i> Nuevo Seguimiento
                </button>
            </div>
            
            <!-- Contenedor de tabla con scroll horizontal -->
            <div class="table-container" style="overflow-x: auto; width: 100%;">
                <table id="seguimientoplantatable" class="table table-hover align-middle mb-0" style="min-width: 1100px; border: 1px solid #e3e6f0;">
                    <thead class="thead-dark" style="background: linear-gradient(to right, #71ccef, #71ccef); color: white;">
                        <tr>
                            <th class="text-center py-3" style="border-right: 1px solid rgba(255,255,255,0.1); width: 50px;">#</th>
                            <th class="py-3" style="border-right: 1px solid rgba(255,255,255,0.1); min-width: 100px;">Fecha</th>
                            <th class="py-3" style="border-right: 1px solid rgba(255,255,255,0.1); min-width: 150px;">Sistema Acuapónico</th>
                            <th class="py-3" style="border-right: 1px solid rgba(255,255,255,0.1); min-width: 120px;">Cultivo</th>
                            <th class="text-center py-3" style="border-right: 1px solid rgba(255,255,255,0.1); min-width: 100px;">N° Plantas</th>
                            <th class="text-center py-3" style="border-right: 1px solid rgba(255,255,255,0.1); min-width: 100px;">Altura (cm)</th>
                            <th class="text-center py-3" style="border-right: 1px solid rgba(255,255,255,0.1); min-width: 100px;">Tonalidad</th>
                            <th class="text-center py-3" style="border-right: 1px solid rgba(255,255,255,0.1); min-width: 110px;">Crecimiento</th>
                            <th class="text-center py-3" style="border-right: 1px solid rgba(255,255,255,0.1); min-width: 110px;">Mortalidad</th>
                            <th class="text-center py-3" style="min-width: 130px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1; ?>
                        <?php $__currentLoopData = $seguimientoPlanta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="animate__animated animate__fadeIn" style="animation-delay: <?php echo e($n * 0.03); ?>s; border-bottom: 1px solid #e3e6f0; transition: all 0.3s ease;">
                            <td class="text-center fw-bold py-3" style="border-right: 1px solid #e3e6f0;"><?php echo e($n++); ?></td>
                            <td class="fw-medium py-3" style="border-right: 1px solid #e3e6f0;"><?php echo e($sp->Tracking->date); ?></td>
                            <td class="py-3" style="border-right: 1px solid #e3e6f0;"><?php echo e($sp->Tracking->aquaponicSystem->name ?? 'Sin sistema'); ?></td>
                            <td class="py-3" style="border-right: 1px solid #e3e6f0;"><?php echo e($sp->Tracking->crops->species->name); ?></td>
                            <td class="text-center fw-bold py-3" style="border-right: 1px solid #e3e6f0;">
                                <span class="badge bg-info rounded-pill px-3 py-2 shadow-sm"><?php echo e($sp->plant_count); ?></span>
                            </td>
                            <td class="text-center fw-bold py-3" style="border-right: 1px solid #e3e6f0;">
                                <span class="badge bg-primary rounded-pill px-3 py-2 shadow-sm"><?php echo e($sp->height_cm); ?> cm</span>
                            </td>
                            <td class="text-center py-3" style="border-right: 1px solid #e3e6f0;">
                                <span class="color-circle-large" style="background-color: <?php echo e($sp->color_tone); ?>;"></span>
                            </td>
                            <td class="text-center fw-bold py-3" style="border-right: 1px solid #e3e6f0;">
                                <span class="badge bg-warning rounded-pill px-3 py-2 shadow-sm"><?php echo e($sp->growth); ?> cm</span>
                            </td>
                            <td class="text-center fw-bold py-3" style="border-right: 1px solid #e3e6f0;">
                                <span class="badge bg-danger rounded-pill px-3 py-2 shadow-sm"><?php echo e($sp->mortality); ?></span>
                            </td>
                            <td class="text-center py-3">
                                <div class="d-flex justify-content-center action-buttons">
                                    <!-- Botón de Editar -->
                                    <button type="button" class="btn btn-action btn-edit editbtn mx-1"
                                        data-id="<?php echo e($sp->id); ?>"
                                        data-aquaponic_system_id="<?php echo e($sp->Tracking->aquaponic_system_id); ?>"
                                        data-tracking_id="<?php echo e($sp->tracking_id); ?>"
                                        data-plant_count="<?php echo e($sp->plant_count); ?>"
                                        data-height_cm="<?php echo e($sp->height_cm); ?>"
                                        data-color_tone="<?php echo e($sp->color_tone); ?>"
                                        data-growth="<?php echo e($sp->growth); ?>"
                                        data-mortality="<?php echo e($sp->mortality); ?>"
                                        data-toggle="modal"
                                        data-target="#editar">
                                        <div class="btn-icon">
                                            <i class="fas fa-pen"></i>
                                        </div>
                                        <span class="btn-tooltip">Editar</span>
                                    </button>
                                    
                                    <!-- Botón de Eliminar -->
                                    <button type="button" class="btn btn-action btn-delete btnEliminar mx-1" data-id="<?php echo e($sp->id); ?>">
                                        <div class="btn-icon">
                                            <i class="fas fa-trash"></i>
                                        </div>
                                        <span class="btn-tooltip">Eliminar</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Indicador de scroll -->
            <div class="text-center mt-3">
                <small class="text-muted">
                    <i class="fas fa-info-circle me-1"></i>Desliza horizontalmente para ver todos los campos
                </small>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar -->
<div class="modal fade" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="overflow: hidden;">
            <div class="modal-header text-white py-3" style="background: linear-gradient(87deg, #71ccef 0%, #71ccef 100%);">
                <h5 class="modal-title fw-bold mb-0" id="editarLabel">
                    <i class="fas fa-edit me-2"></i>
                    Editar Seguimiento de Plantas
                </h5>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="formEditar" action="" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('put'); ?>
                
                <div class="modal-body p-4">
                    <input type="hidden" name="id" id="edit-id">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="edit_aquaponic_system_id" class="form-label small fw-bold mb-1" style="color: #71ccef;">
                                    <i class="fas fa-water me-1"></i>Sistema Acuapónico:
                                </label>
                                <select class="form-control form-control-sm rounded" id="edit_aquaponic_system_id" name="aquaponic_system_id" required style="height: 30%;">
                                    <option value="">Seleccione un sistema</option>
                                    <?php $__currentLoopData = $aquaponicSystems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $system): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($system->id); ?>"><?php echo e($system->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="edit_tracking_id" class="form-label small fw-bold mb-1" style="color: #71ccef;">
                                    <i class="fas fa-seedling me-1"></i>Cultivo en seguimiento:
                                </label>
                                <select class="form-control form-control-sm rounded" id="edit_tracking_id" name="tracking_id" required style="height: 30%;">
                                    <option value="">Seleccione un seguimiento</option>
                                    <!-- Se cargará dinámicamente -->
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="edit-plant_count" class="form-label small fw-bold mb-1" style="color: #71ccef;">
                                    <i class="fas fa-leaf me-1"></i>N° Plantas:
                                </label>
                                <input type="number" class="form-control form-control-sm rounded" id="edit-plant_count" name="plant_count" required>
                                <div class="invalid-feedback" id="error-plantas-edit"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="edit-height_cm" class="form-label small fw-bold mb-1" style="color: #71ccef;">
                                    <i class="fas fa-ruler-vertical me-1"></i>Altura (cm):
                                </label>
                                <input type="number" class="form-control form-control-sm rounded" name="height_cm" id="edit-height_cm" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label class="form-label small fw-bold mb-1 d-block" style="color: #71ccef;">
                            <i class="fas fa-palette me-1"></i>Color de hoja:
                        </label>
                        <div class="d-flex justify-content-between align-items-center">
                            <?php
                            $colores = [
                                '#138713ff' => 'Verde oscuro',
                                '#a6d842ff' => 'Verde amarillento', 
                                '#32dc32ff' => 'Verde claro',
                                '#1ccf00ff' => 'Verde normal'
                            ];
                            ?>
                            <?php $__currentLoopData = $colores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color => $nombre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label class="color-option text-center">
                                <input type="radio" name="color_tone" value="<?php echo e($color); ?>" required>
                                <span class="color-circle-modal" style="background-color: <?php echo e($color); ?>;" data-toggle="tooltip" title="<?php echo e($nombre); ?>"></span>
                            </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="edit-growth" class="form-label small fw-bold mb-1" style="color: #71ccef;">
                                    <i class="fas fa-chart-line me-1"></i>Crecimiento:
                                </label>
                                <input type="number" class="form-control form-control-sm rounded" name="growth" id="edit-growth" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="edit-mortality" class="form-label small fw-bold mb-1" style="color: #71ccef;">
                                    <i class="fas fa-skull me-1"></i>Mortalidad:
                                </label>
                                <input type="number" class="form-control form-control-sm rounded" name="mortality" id="edit-mortality" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer bg-light py-3">
                    <button type="button" class="btn btn-sm btn-danger rounded px-3 py-2" data-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-sm rounded px-3 py-2 shadow" style="background: linear-gradient(135deg, #71ccef, #71ccef); color: white;">
                        <i class="fas fa-save me-1"></i>Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Eliminar -->
<div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="eliminarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white py-3">
                <h5 class="modal-title" id="eliminarLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirmar Eliminación
                </h5>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="mb-0">¿Estás seguro de que deseas eliminar este seguimiento de plantas? Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer bg-light py-3">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-danger" id="confirmarEliminacion">
                    <i class="fas fa-trash me-2"></i>Eliminar
                </button>
            </div>
            <form id="formEliminar" method="POST" action="">
                <?php echo csrf_field(); ?>
                <?php echo method_field('delete'); ?>
            </form>
        </div>
    </div>
</div>

<!-- Modal Agregar -->
<div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="overflow: hidden;">
            <div class="modal-header text-white py-3" style="background: linear-gradient(87deg, #71ccef 0%, #71ccef 100%);">
                <h5 class="modal-title fw-bold mb-0" id="agregarLabel">
                    <i class="fas fa-plus-circle me-2"></i>
                    Nuevo Seguimiento de Plantas
                </h5>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="<?php echo e(route('acuaponico.pasante.pasante.storetrackingplant')); ?>" method="POST" id="formAgregar">
                <?php echo csrf_field(); ?>
                
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="aquaponic_system_id" class="form-label small fw-bold mb-1" style="color: #71ccef;">
                                    <i class="fas fa-water me-1"></i>Sistema Acuapónico:
                                </label>
                                <select name="aquaponic_system_id" id="aquaponic_system_id" class="form-control form-control-sm rounded" required style="height: 30%;">
                                    <option value="">Seleccione un sistema</option>
                                    <?php $__currentLoopData = $aquaponicSystems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $system): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($system->id); ?>"><?php echo e($system->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="tracking_id" class="form-label small fw-bold mb-1" style="color: #71ccef;">
                                    <i class="fas fa-seedling me-1"></i>Cultivo en seguimiento:
                                </label>
                                <select name="tracking_id" id="tracking_id" class="form-control form-control-sm rounded" required style="height: 30%;">
                                    <option value="">Seleccione un seguimiento</option>
                                    <!-- Se cargará dinámicamente -->
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="plant_count" class="form-label small fw-bold mb-1" style="color: #71ccef;">
                                    <i class="fas fa-leaf me-1"></i>N° Plantas:
                                </label>
                                <input type="number" name="plant_count" class="form-control form-control-sm rounded" id="plant_count" required>
                                <div class="invalid-feedback" id="error-plantas"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="height_cm" class="form-label small fw-bold mb-1" style="color: #71ccef;">
                                    <i class="fas fa-ruler-vertical me-1"></i>Altura (cm):
                                </label>
                                <input type="number" name="height_cm" class="form-control form-control-sm rounded" id="height_cm" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label class="form-label small fw-bold mb-1 d-block" style="color: #71ccef;">
                            <i class="fas fa-palette me-1"></i>Color de hoja:
                        </label>
                        <div class="d-flex justify-content-between align-items-center">
                            <?php
                            $colores = [
                                '#138713ff' => 'Verde oscuro',
                                '#a6d842ff' => 'Verde amarillento', 
                                '#32dc32ff' => 'Verde claro',
                                '#1ccf00ff' => 'Verde normal'
                            ];
                            ?>
                            <?php $__currentLoopData = $colores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color => $nombre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label class="color-option text-center">
                                <input type="radio" name="color_tone" value="<?php echo e($color); ?>" required>
                                <span class="color-circle-modal" style="background-color: <?php echo e($color); ?>;" data-toggle="tooltip" title="<?php echo e($nombre); ?>"></span>
                            </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="growth" class="form-label small fw-bold mb-1" style="color: #71ccef;">
                                    <i class="fas fa-chart-line me-1"></i>Crecimiento:
                                </label>
                                <input type="number" name="growth" class="form-control form-control-sm rounded" id="growth" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="mortality" class="form-label small fw-bold mb-1" style="color: #71ccef;">
                                    <i class="fas fa-skull me-1"></i>Mortalidad:
                                </label>
                                <input type="number" name="mortality" class="form-control form-control-sm rounded" id="mortality" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer bg-light py-3">
                    <button type="button" class="btn btn-sm btn-danger rounded px-3 py-2" data-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-sm rounded px-3 py-2 shadow" style="background: linear-gradient(135deg, #71ccef, #71ccef); color: white;">
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
                    &copy; <?php echo e(date('Y')); ?> Sistema Acuapónico. Todos los derechos reservados.
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
    background-color: rgba(113, 204, 239, 0.05);
    transform: translateX(5px);
    transition: all 0.3s ease;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-blue {
    background: linear-gradient(135deg, #71ccef 0%, #71ccef 100%);
    border: none;
}

.btn-blue:hover {
    background: linear-gradient(135deg, #5bbde8, #5bbde8);
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(113, 204, 239, 0.3);
}

.badge {
    font-weight: 500;
}

/* Animaciones personalizadas */
@keyframes  fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes  pulse {
    0% { transform: scale(1); }
     50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

@keyframes  bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
    40% { transform: translateY(-10px); }
    60% { transform: translateY(-5px); }
}

@keyframes  shake {
    0%, 100% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
    20%, 40%, 60%, 80% { transform: translateX(5px); }
}

@keyframes  iconPulse {
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
#seguimientoplantatable {
    opacity: 0;
    transition: opacity 0.5s ease;
}

#seguimientoplantatable.loaded {
    opacity: 1;
}

/* Tooltip personalizado */
.tooltip-inner {
    background-color: #333;
    color: #fff;
    border-radius: 4px;
    padding: 5px 10px;
}

.btooltip-top .arrow::before {
    border-top-color: #333;
}

/* Estilos para tabla con líneas */
#seguimientoplantatable {
    border-collapse: separate;
    border-spacing: 0;
    width: 100%;
}

#seguimientoplantatable th,
#seguimientoplantatable td {
    border-right: 1px solid #e3e6f0;
    border-bottom: 1px solid #e3e6f0;
}

#seguimientoplantatable th:last-child,
#seguimientoplantatable td:last-child {
    border-right: none;
}

#seguimientoplantatable tr:last-child td {
    border-bottom: none;
}

#seguimientoplantatable thead th {
    background: linear-gradient(to right, #71ccef, #71ccef);
    border-top: 1px solid #e3e6f0;
    border-bottom: 2px solid #e3e6f0;
    font-weight: 600;
    color: white;
}

/* ESTILOS ESPECÍFICOS PARA EL MODAL DE EDICIÓN MEJORADO */
.bg-gradient-blue {
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
    box-shadow: 0 6px 15px rgba(113, 204, 239, 0.4) !important;
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

/* Animación para el modal completo */
@keyframes  modalEntry {
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
    box-shadow: 0 0 0 0.2rem rgba(113, 204, 239, 0.25);
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

/* Estilos para los círculos de color */
.color-circle-large {
    display: inline-block;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid #e3e6f0;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
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
    margin-right: 8px;
    transition: transform 0.2s ease, border-color 0.2s ease;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.color-option {
    display: flex;
    flex-direction: column;
    align-items: center;
}

input[type="radio"] {
    display: none;
}

input[type="radio"]:checked + .color-circle-modal {
    border: 3px solid #71ccef;
    transform: scale(1.1);
}

.color-circle-modal:hover {
    transform: scale(1.1);
    border-color: #555;
}

/* Contenedor de tabla con scroll horizontal */
.table-container {
    overflow-x: auto;
    width: 100%;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.table-container::-webkit-scrollbar {
    height: 8px;
}

.table-container::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

.table-container::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 4px;
}

.table-container::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* Responsividad mejorada */
@media (max-width: 768px) {
    .container-fluid {
        width: 100% !important;
        margin-top: 1% !important;
        padding: 0 10px;
    }
    
    .card-header h1 {
        font-size: 1.5rem !important;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 8px;
    }
    
    .table-container {
        font-size: 0.85rem;
    }
    
    .color-option {
        margin-bottom: 10px;
    }
    
    .badge {
        font-size: 0.75rem;
        padding: 0.35em 0.65em;
    }
}
</style>

<!-- Scripts para funcionalidad y animaciones -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ocultar spinner y mostrar tabla con animación
        setTimeout(function() {
            document.getElementById('tableSpinner').style.display = 'none';
            document.getElementById('seguimientoplantatable').classList.add('loaded');
        }, 800);
        
        // Lógica para el modal de agregar
        const aquaponicSystemId = document.getElementById('aquaponic_system_id');
        if (aquaponicSystemId) {
            aquaponicSystemId.addEventListener('change', function() {
                const systemId = this.value;
                const trackingSelect = document.getElementById('tracking_id');
                if (trackingSelect) {
                    trackingSelect.innerHTML = '<option value="">Seleccione un seguimiento</option>';
                    if (systemId) {
                        fetch(`/pasante/seguimientoPlanta/seguimientos/${systemId}`)
                            .then(res => res.json())
                            .then(data => {
                                data.forEach(item => {
                                    const option = document.createElement('option');
                                    option.value = item.id;
                                    option.text = `${item.crops.species.name} - ${item.date}`;
                                    option.setAttribute('data-date', item.date);
                                    trackingSelect.appendChild(option);
                                });
                            })
                            .catch(error => console.error('Error fetching seguimientos:', error));
                    }
                }
            });
        }

        // Lógica para el modal de editar
        let editPlantasPrevias = 0;
        let editAlturaPrevia = 0;

        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const systemId = this.getAttribute('data-aquaponic_system_id');
                const trackingId = this.getAttribute('data-tracking_id');
                const plantCount = this.getAttribute('data-plant_count');
                const heightCm = this.getAttribute('data-height_cm');
                const growth = this.getAttribute('data-growth');
                const mortality = this.getAttribute('data-mortality');
                const colorTone = this.getAttribute('data-color_tone');

                const form = document.getElementById('formEditar');
                if (form) {
                    form.action = `/pasante/seguimientoPlanta/update/${id}`;
                    document.getElementById('edit-id').value = id;
                    document.getElementById('edit_aquaponic_system_id').value = systemId;
                    document.getElementById('edit-plant_count').value = plantCount;
                    document.getElementById('edit-height_cm').value = heightCm;
                    document.getElementById('edit-growth').value = growth;
                    document.getElementById('edit-mortality').value = mortality;

                    // Preseleccionar el color
                    const colorRadios = document.querySelectorAll('input[name="color_tone"]');
                    if (colorRadios) {
                        colorRadios.forEach(radio => {
                            radio.checked = radio.value === colorTone;
                        });
                    }

                    // Cargar seguimientos y preseleccionar
                    const editAquaponicSystem = document.getElementById('edit_aquaponic_system_id');
                    const editTrackingSelect = document.getElementById('edit_tracking_id');
                    if (editAquaponicSystem && editTrackingSelect) {
                        editAquaponicSystem.value = systemId;
                        editTrackingSelect.innerHTML = '<option value="">Cargando...</option>';

                        fetch(`/pasante/seguimientoPlanta/seguimientos/${systemId}`)
                            .then(res => res.json())
                            .then(data => {
                                editTrackingSelect.innerHTML = '<option value="">Seleccione un seguimiento</option>';
                                let trackingFound = false;
                                if (data.length === 0) {
                                    editTrackingSelect.innerHTML = '<option value="">No hay seguimientos para este sistema</option>';
                                } else {
                                    data.forEach(item => {
                                        const option = document.createElement('option');
                                        option.value = item.id;
                                        option.text = `${item.crops.species.name} - ${item.date}`;
                                        if (item.id == trackingId) {
                                            option.selected = true;
                                            trackingFound = true;
                                        }
                                        editTrackingSelect.appendChild(option);
                                    });
                                }
                                if (trackingFound && trackingId) {
                                    fetch(`/pasante/seguimientoPlanta/prevdata/${trackingId}`)
                                        .then(res => res.json())
                                        .then(data => {
                                            editPlantasPrevias = parseInt(data.plantas) || 0;
                                            editAlturaPrevia = parseFloat(data.altura) || 0;
                                            calcularEditar();
                                        })
                                        .catch(error => console.error('Error fetching prev data:', error));
                                }
                            })
                            .catch(error => {
                                console.error('Error fetching seguimientos:', error);
                                editTrackingSelect.innerHTML = '<option value="">Error al cargar seguimientos</option>';
                            });
                    }
                }
            });
        });

        // Listener para actualizar campos al cambiar el seguimiento
        const editTrackingId = document.getElementById('edit_tracking_id');
        if (editTrackingId) {
            editTrackingId.addEventListener('change', function() {
                const trackingId = this.value;
                const editPlantCount = document.getElementById('edit-plant_count');
                const editHeightCm = document.getElementById('edit-height_cm');

                if (trackingId) {
                    fetch(`/pasante/seguimientoPlanta/prevdata/${trackingId}`)
                        .then(res => res.json())
                        .then(data => {
                            editPlantasPrevias = parseInt(data.plantas) || 0;
                            editAlturaPrevia = parseFloat(data.altura) || 0;
                            if (editPlantCount) editPlantCount.value = data.plantas || '';
                            if (editHeightCm) editHeightCm.value = data.altura || '';
                            calcularEditar();
                        })
                        .catch(error => console.error('Error fetching prev data:', error));
                } else {
                    editPlantasPrevias = 0;
                    editAlturaPrevia = 0;
                    if (editPlantCount) editPlantCount.value = '';
                    if (editHeightCm) editHeightCm.value = '';
                    calcularEditar();
                }
            });
        }

        // Escuchar cambios en los campos de entrada para recalcular
        ['edit-plant_count', 'edit-height_cm'].forEach(field => {
            const input = document.getElementById(field);
            if (input) {
                input.addEventListener('input', calcularEditar);
            }
        });

        // Función para calcular campos en edición
        function calcularEditar() {
            const editPlantCount = document.getElementById('edit-plant_count');
            const editHeightCm = document.getElementById('edit-height_cm');
            const editGrowth = document.getElementById('edit-growth');
            const editMortality = document.getElementById('edit-mortality');
            const errorPlantasEdit = document.getElementById('error-plantas-edit');

            if (!editPlantCount || !editHeightCm || !editGrowth || !editMortality || !errorPlantasEdit) {
                console.error('Uno o más elementos del DOM no están disponibles.');
                return false;
            }

            const actuales = parseInt(editPlantCount.value) || 0;
            const alturaActual = parseFloat(editHeightCm.value) || 0;

            const growth = (alturaActual - editAlturaPrevia).toFixed(2);
            editGrowth.value = growth > 0 ? growth : 0;

            const mortality = editPlantasPrevias - actuales > 0 ? editPlantasPrevias - actuales : 0;
            editMortality.value = mortality;

            if (actuales > editPlantasPrevias) {
                editPlantCount.classList.add('is-invalid');
                editPlantCount.classList.remove('is-valid');
                errorPlantasEdit.innerText = `No puede ingresar más plantas (${actuales}) que las registradas anteriormente (${editPlantasPrevias})`;
                return false;
            } else {
                editPlantCount.classList.remove('is-invalid');
                editPlantCount.classList.add('is-valid');
                errorPlantasEdit.innerText = '';
                return true;
            }
        }

        // Validar formulario antes de enviar
        const editForm = document.querySelector('#editar form');
        if (editForm) {
            editForm.addEventListener('submit', function(e) {
                if (!calcularEditar()) {
                    e.preventDefault();
                }
            });
        }

        // Lógica para el modal de eliminar
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
                        
                        /* ESTILOS ESPECÍFICOS PARA EL BOTÓN de CANCELAR */
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
                            color: #71ccef;
                            border-color: #71ccef;
                        }
                        
                        /* Mejorar el contraste del texto en el botón de cancelar */
                        .swal2-popup.custom-delete-style .swal2-cancel:focus {
                            box-shadow: 0 0 0 3px rgba(113, 204, 239, 0.25);
                        }
                        
                        @keyframes  pulse-icon {
                            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(231, 74, 59, 0.4); }
                            70% { transform: scale(1.02); box-shadow: 0 0 0 10px rgba(231, 74, 59, 0); }
                            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(231, 74, 59, 0); }
                        }
                        
                        /* Animación de entrada personalizada */
                        @keyframes  custom-modal-in {
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
                    html: '<div style="text-align:center;">Esta acción <span style="color:#e74a3b; font-weight:bold;">no se puede deshacer</span> y el seguimiento de plantas será eliminado permanentemente.</div>',
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
                        const formEliminar = document.getElementById('formEliminar');
                        formEliminar.action = `/pasante/seguimientoPlanta/destroy/${id}`;
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

        // Lógica para el modal de agregar
        let plantasPrevias = 0;
        let alturaPrevia = 0;

        const trackingIdSelect = document.getElementById('tracking_id');
        if (trackingIdSelect) {
            trackingIdSelect.addEventListener('change', function() {
                const trackingId = this.value;
                if (trackingId) {
                    fetch(`/pasante/seguimientoPlanta/prevdata/${trackingId}`)
                        .then(res => res.json())
                        .then(data => {
                            plantasPrevias = parseInt(data.plantas) || 0;
                            alturaPrevia = parseFloat(data.altura) || 0;
                            calcularAgregar();
                        })
                        .catch(error => console.error('Error fetching prev data:', error));
                }
            });

            document.getElementById('plant_count')?.addEventListener('input', calcularAgregar);
            document.getElementById('height_cm')?.addEventListener('input', calcularAgregar);

            function calcularAgregar() {
                const plantCount = document.getElementById('plant_count');
                const heightCm = document.getElementById('height_cm');
                const growth = document.getElementById('growth');
                const mortality = document.getElementById('mortality');
                const errorPlantas = document.getElementById('error-plantas');

                if (!plantCount || !heightCm || !growth || !mortality || !errorPlantas) {
                    console.error('Uno o más elementos del DOM no están disponibles.');
                    return;
                }

                const actuales = parseInt(plantCount.value) || 0;
                const alturaActual = parseFloat(heightCm.value) || 0;

                growth.value = (alturaActual - alturaPrevia).toFixed(2);
                mortality.value = (plantasPrevias - actuales > 0 ? plantasPrevias - actuales : 0);

                if (actuales > plantasPrevias) {
                    plantCount.classList.add('is-invalid');
                    plantCount.classList.remove('is-valid');
                    errorPlantas.innerText = `No puede ingresar más plantas (${actuales}) que las registradas anteriormente (${plantasPrevias})`;
                } else {
                    plantCount.classList.remove('is-invalid');
                    plantCount.classList.add('is-valid');
                    errorPlantas.innerText = '';
                }
            }
        }
        
        // DataTable initialization - DESACTIVAR RESPONSIVE
        $('#seguimientoplantatable').DataTable({
            responsive: false,
            autoWidth: false,
            language: {
                url: "<?php echo e(asset('AdminLTE/plugins/datatables/i18n/es-ES.json')); ?>"
            },
            initComplete: function() {
                // Añadir animación a las filas de la tabla
                $('#seguimientoplantatable tbody tr').addClass('animate__animated animate__fadeInRight');
            }
        });

        // Tooltip initialization
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover',
            animation: true
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

    // Mostrar notificaciones de éxito o error
    <?php if(session('success')): ?>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: '<?php echo e(session("success")); ?>',
            confirmButtonColor: '#71ccef',
            showClass: {
                popup: 'animate__animated animate__bounceIn'
            }
        });
    });
    <?php endif; ?>

    <?php if(session('error')): ?>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '<?php echo e(session("error")); ?>',
            confirmButtonColor: '#d33',
            showClass: {
                popup: 'animate__animated animate__shakeX'
            }
        });
    });
    <?php endif; ?>
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('acuaponico::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sicefa\Modules/ACUAPONICO\Resources/views/admin/plantaseguimiento.blade.php ENDPATH**/ ?>