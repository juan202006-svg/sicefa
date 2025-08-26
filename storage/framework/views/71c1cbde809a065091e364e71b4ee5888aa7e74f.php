

<?php $__env->startPush('breadcrumbs'); ?>
<li class="breadcrumb-item active">Gestión de Resiembras</li>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content7'); ?>
<div class="container-fluid px-4" style="width: 93%; margin-top: 5%; margin-left: 5%;">
    <!-- Header con gradiente y sombra -->
    <div class="container mt-4">
        <div class="card shadow-lg border-0" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
            <div class="card-body py-4">
                <div class="d-flex justify-content-between align-items-center mb-3 animate__animated animate__fadeInDown">
                    <h1 class="h2 mb-0 text-white fw-bold text-center w-100" style="font-size: 2.2rem; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                        <i class="fas fa-seedling me-3"></i>Gestión de Resiembras
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Tarjeta principal con diseño moderno -->
    <div class="card shadow-lg border-0 mt-4 animate__animated animate__fadeInUp" style="border-radius: 15px; overflow: hidden;">
        <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background: linear-gradient(to right, #f8f9fc, #e3e6f0); border-bottom: 1px solid #e3e6f0;">
            <h5 class="mb-0 text-success fw-semibold">
                <i class="fas fa-list me-2"></i>Lista de Resiembras
            </h5>
            <button type="button" class="btn btn-success rounded-pill px-4 py-2 fw-medium shadow-sm" data-toggle="modal" data-target="#agregar"
                style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border: none; transition: all 0.3s ease; margin-left: 60%;">
                <i class="fas fa-plus-circle me-2"></i> Nueva Resiembra
            </button>
        </div>

        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle text-success me-2"></i>
                    <small class="text-muted">Total de resiembras: <?php echo e(count($resiembra)); ?></small>
                </div>
            </div>
            
            <div class="table-responsive rounded-3 shadow-sm">
                <table id="resiembraTable" class="table table-hover align-middle mb-0" style="border: 1px solid #e3e6f0;">
                    <thead class="thead-green" style="background: linear-gradient(to right, #28a745, #20c997); color: white;">
                        <tr>
                            <th class="text-center py-3" style="border-right: 1px solid rgba(255,255,255,0.1);">#</th>
                            <th class="py-3" style="border-right: 1px solid rgba(255,255,255,0.1);">S/Acuapónico</th>
                            <th class="py-3" style="border-right: 1px solid rgba(255,255,255,0.1);">Cultivo</th>
                            <th class="text-center py-3" style="border-right: 1px solid rgba(255,255,255,0.1);">Cantidad</th>
                            <th class="text-center py-3" style="border-right: 1px solid rgba(255,255,255,0.1);">Mortalidad</th>
                            <th class="py-3" style="border-right: 1px solid rgba(255,255,255,0.1);">Lotes</th>
                            <th class="py-3" style="border-right: 1px solid rgba(255,255,255,0.1);">Descripción</th>
                            <th class="text-center py-3" style="border-right: 1px solid rgba(255,255,255,0.1);">Fecha</th>
                            <th class="text-center py-3" style="border-right: 1px solid rgba(255,255,255,0.1);">Estado</th>
                            <th class="text-center py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1; ?>
                        <?php $__currentLoopData = $resiembra; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="animate__animated animate__fadeIn" style="animation-delay: <?php echo e($n * 0.03); ?>s; border-bottom: 1px solid #e3e6f0; transition: all 0.3s ease;">
                            <td class="text-center fw-bold py-3" style="border-right: 1px solid #e3e6f0;"><?php echo e($n++); ?></td>
                            <td class="fw-medium py-3" style="border-right: 1px solid #e3e6f0;"><?php echo e($item->system->name ?? 'Sin sistema'); ?></td>
                            <td class="py-3" style="border-right: 1px solid #e3e6f0;"><?php echo e($item->crops->species->name ?? 'Sin cultivo'); ?></td>
                            <td class="text-center fw-bold py-3" style="border-right: 1px solid #e3e6f0;">
                                <span class="badge bg-info rounded-pill px-3 py-2 shadow-sm"><?php echo e($item->lots->sum('pivot.quantity')); ?></span>
                            </td>
                            <td class="text-center fw-bold py-3" style="border-right: 1px solid #e3e6f0;">
                                <span class="badge bg-warning rounded-pill px-3 py-2 shadow-sm"><?php echo e($item->original_mortality); ?></span>
                            </td>
                            <td class="py-3" style="border-right: 1px solid #e3e6f0;">
                                <?php $__currentLoopData = $item->lots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="badge bg-light text-dark border me-1 mb-1"><?php echo e($lot->name); ?> (<?php echo e($lot->pivot->quantity); ?>)</span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                            <td class="py-3" style="border-right: 1px solid #e3e6f0;">
                                <?php if($item->description): ?>
                                <span class="text-muted" data-toggle="tooltip" title="<?php echo e($item->description); ?>"><?php echo e(Str::limit($item->description, 30)); ?></span>
                                <?php else: ?>
                                <span class="text-muted font-italic">Sin descripción</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center py-3" style="border-right: 1px solid #e3e6f0;">
                                <span class="badge bg-secondary rounded-pill px-3 py-2 shadow-sm"><?php echo e($item->date); ?></span>
                            </td>
                            <td class="text-center py-3" style="border-right: 1px solid #e3e6f0;">
                                <span class="badge bg-success rounded-pill px-3 py-2 shadow-sm pulse-active"><?php echo e($item->status); ?></span>
                            </td>
                            <td class="text-center py-3">
                                <div class="d-flex justify-content-center action-buttons">
                                    <!-- Botón de Editar -->
                                    <button type="button" class="btn btn-action btn-edit editbtn mx-1"
                                        data-id="<?php echo e($item->id); ?>"
                                        data-aquaponic_system_id="<?php echo e($item->aquaponic_system_id); ?>"
                                        data-crop_id="<?php echo e($item->crop_id); ?>"
                                        data-original_mortality="<?php echo e($item->original_mortality); ?>"
                                        data-description="<?php echo e($item->description); ?>"
                                        data-date="<?php echo e($item->date); ?>"
                                        data-status="<?php echo e($item->status); ?>"
                                        <?php $__currentLoopData = $item->lots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        data-lot_<?php echo e($lot->id); ?>="<?php echo e($lot->pivot->quantity); ?>"
                                        data-lot_name_<?php echo e($lot->id); ?>="<?php echo e($lot->name); ?>"
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        data-toggle="modal"
                                        data-target="#editar">
                                        <div class="btn-icon">
                                            <i class="fas fa-pen"></i>
                                        </div>
                                        <span class="btn-tooltip">Editar</span>
                                    </button>
                                    
                                    <!-- Botón de Eliminar -->
                                    <button type="button" class="btn btn-action btn-delete btnEliminar mx-1" data-id="<?php echo e($item->id); ?>">
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
                    Editar Resiembra
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
                                <label for="edit-date" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-calendar me-1"></i>Fecha:
                                </label>
                                <input type="date" class="form-control form-control-sm rounded" id="edit-date" name="date" readonly style="height: 30%;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="edit-aquaponic_system_id" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-water me-1"></i>Sistema Acuapónico:
                                </label>
                                <select name="aquaponic_system_id" id="edit-aquaponic_system_id" class="form-control form-control-sm rounded" required style="height: 30%;">
                                    <option value="" disabled>Seleccione un sistema acuapónico</option>
                                    <?php $__currentLoopData = $acuaponico; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $system): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($system->id); ?>"><?php echo e($system->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="edit-crop_id" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-seedling me-1"></i>Cultivo:
                                </label>
                                <select name="crop_id" id="edit-crop_id" class="form-control form-control-sm rounded" required style="height: 30%;">
                                    <option value="" disabled selected>Seleccione un cultivo</option>
                                </select>
                                <div class="invalid-feedback small" id="edit-crop_id-error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="edit-original_mortality" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-skull me-1"></i>Mortalidad Original:
                                </label>
                                <input type="number" class="form-control form-control-sm rounded" id="edit-original_mortality" name="original_mortality" readonly style="height: 30%;">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label class="form-label small fw-bold text-success mb-1">
                            <i class="fas fa-boxes me-1"></i>Lotes:
                        </label>
                        <div id="edit-lots-container" class="border rounded p-3 bg-light">
                            <!-- Aquí se llenan por JS -->
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="edit-quantity" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-calculator me-1"></i>Cantidad Total:
                                </label>
                                <input type="number" class="form-control form-control-sm rounded" id="edit-quantity" name="quantity" readonly style="height: 30%;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="edit-status" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-power-off me-1"></i>Estado:
                                </label>
                                <select name="status" class="form-control form-control-sm rounded" required style="height: 30%;">
                                    <option value="Registrada">Resiembra</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="edit-description" class="form-label small fw-bold text-success mb-1">
                            <i class="fas fa-align-left me-1"></i>Descripción:
                        </label>
                        <textarea class="form-control form-control-sm rounded" id="edit-description" name="description" rows="3" style="resize: none;"></textarea>
                    </div>
                </div>
                
                <div class="modal-footer bg-light py-3">
                    <button type="button" class="btn btn-sm btn-danger rounded px-3 py-2" data-dismiss="modal">
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
                <p class="mb-0">¿Estás seguro de que deseas eliminar esta resiembra? Esta acción no se puede deshacer.</p>
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
            <div class="modal-header bg-gradient-success text-white py-3">
                <h5 class="modal-title fw-bold mb-0" id="agregarLabel">
                    <i class="fas fa-plus-circle me-2"></i>
                    Nueva Resiembra
                </h5>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            
            <form action="<?php echo e(route('acuaponico.pasante.pasante.storeresowing')); ?>" method="POST" id="formAgregar">
                <?php echo csrf_field(); ?>
                
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="date" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-calendar me-1"></i>Fecha:
                                </label>
                                <input type="date" class="form-control form-control-sm rounded" id="date" name="date" readonly style="height: 30%;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="aquaponic_system_id" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-water me-1"></i>Sistema Acuapónico:
                                </label>
                                <select name="aquaponic_system_id" id="aquaponic_system_id" class="form-control form-control-sm rounded" required style="height: 30%;">
                                    <option value="" disabled selected>Seleccione un sistema acuapónico</option>
                                    <?php $__currentLoopData = $acuaponico; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $system): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($system->id); ?>"><?php echo e($system->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="crop_id" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-seedling me-1"></i>Cultivo de Plantas:
                                </label>
                                <select name="crop_id" id="crop_id" class="form-control form-control-sm rounded" required style="height: 30%;">
                                    <option value="" disabled selected>Seleccione un cultivo de plantas</option>
                                </select>
                                <div class="invalid-feedback small" id="crop_id-error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="mortalidad_total" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-skull me-1"></i>Mortalidad Total:
                                </label>
                                <input type="number" id="mortalidad_total" name="original_mortality" class="form-control form-control-sm rounded" readonly style="height: 30%;">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label class="form-label small fw-bold text-success mb-1">
                            <i class="fas fa-boxes me-1"></i>Lotes:
                        </label>
                        <div id="lots-container" class="border rounded p-3 bg-light">
                            <!-- Aquí se agregan inputs por AJAX -->
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="quantity" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-calculator me-1"></i>Cantidad Total:
                                </label>
                                <input type="number" class="form-control form-control-sm rounded" id="quantity" name="quantity" readonly style="height: 30%;"">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="status" class="form-label small fw-bold text-success mb-1">
                                    <i class="fas fa-power-off me-1"></i>Estado:
                                </label>
                                <select name="status" class="form-control form-control-sm rounded" required style="height: 30%;">
                                    <option value="Registrada">Resiembra</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="description" class="form-label small fw-bold text-success mb-1">
                            <i class="fas fa-align-left me-1"></i>Descripción:
                        </label>
                        <textarea class="form-control form-control-sm rounded" id="description" name="description" rows="3" style="resize: none;"></textarea>
                    </div>
                </div>
                
                <div class="modal-footer bg-light py-3">
                    <button type="button" class="btn btn-sm btn-danger rounded px-3 py-2" data-dismiss="modal">
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

/* ESTILOS ESPECÍFICOS PARA EL THEAD VERDE */
.thead-green {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
    color: white !important;
}

.thead-green th {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
    color: white !important;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
    border-color: rgba(255, 255, 255, 0.1) !important;
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

/* Botón de editar - SOLO ICONO VERDE SIN FONDO */
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

/* Botón de editar hover - SOLO ICONO VERDE */
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

/* Icono de editar - COLOR VERDE */
.btn-edit .btn-icon {
    color: #28a745 !important;
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

/* Efecto de carga para la tabla */
#resiembraTable {
    opacity: 0;
    transition: opacity 0.5s ease;
}

#resiembraTable.loaded {
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
#resiembraTable {
    border-collapse: separate;
    border-spacing: 0;
    width: 100%;
}

#resiembraTable th,
#resiembraTable td {
    border-right: 1px solid #e3e6f0;
    border-bottom: 1px solid #e3e6f0;
}

#resiembraTable th:last-child,
#resiembraTable td:last-child {
    border-right: none;
}

#resiembraTable tr:last-child td {
    border-bottom: none;
}

#resiembraTable thead th {
    background: linear-gradient(135deg, #28a745, #20c997) !important;
    border-top: 1px solid #e3e6f0;
    border-bottom: 2px solid #e3e6f0;
    font-weight: 600;
    color: white !important;
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

/* Estilos adicionales para DataTable con scroll horizontal */

.table-responsive {
    overflow-x: hidden !important;
    -webkit-overflow-scrolling: touch; /* Para mejor scroll en móviles */
}

/* Asegurar que la tabla mantenga su estructura */
#resiembraTable {
    width: 100% !important;
    min-width: 1200px; /* Ancho mínimo para evitar compresión excesiva */
    table-layout: fixed; /* Mantener anchos de columna consistentes */
}

/* Estilos para el scroll horizontal */

.dataTables_scrollBody {
    overflow-x: auto !important;
    overflow-y: auto !important;

}



/* Personalizar la barra de scroll */
.dataTables_scrollBody::-webkit-scrollbar {
    height: 8px;
}

.dataTables_scrollBody::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.dataTables_scrollBody::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #28a745, #20c997);
    border-radius: 10px;
}

.dataTables_scrollBody::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #20c997, #28a745);
}

/* Asegurar que las columnas no se compriman demasiado */
#resiembraTable th,
#resiembraTable td {
    white-space: nowrap; /* Evitar que el texto se divida en múltiples líneas */
    overflow: hidden;
    text-overflow: ellipsis; /* Mostrar "..." si el texto es muy largo */
    padding: 8px 12px !important;
}

/* Excepciones para columnas que pueden necesitar más espacio */
#resiembraTable th:nth-child(6),
#resiembraTable td:nth-child(6),
#resiembraTable th:nth-child(7),
#resiembraTable td:nth-child(7) {
    white-space: normal; /* Permitir salto de línea en Lotes y Descripción */
    max-width: 200px;
    word-wrap: break-word;
}

/* Responsive mejorado para pantallas muy pequeñas */
@media (max-width: 768px) {
    #resiembraTable {
        min-width: 1000px; /* Reducir un poco el ancho mínimo en móviles */
        font-size: 0.85rem; /* Texto ligeramente más pequeño */
    }
    

}
</style>

<?php $__env->startSection('scripts'); ?>
<script>
$(document).ready(function() {
    // DataTable initialization SIN responsive
$('#resiembraTable').DataTable({
    responsive: false,
    autoWidth: false,
    scrollX: true,
    scrollCollapse: true,
    language: {
        url: "<?php echo e(asset('AdminLTE/plugins/datatables/i18n/es-ES.json')); ?>"
    },
    columnDefs: [
        { targets: 0, width: "50px", className: "text-center" }, // #
        { targets: 1, width: "150px" }, // Sistema Acuapónico
        { targets: 2, width: "120px" }, // Cultivo
        { targets: 3, width: "80px", className: "text-center" }, // Cantidad
        { targets: 4, width: "80px", className: "text-center" }, // Mortalidad
        { targets: 5, width: "200px" }, // Lotes
        { targets: 6, width: "200px" }, // Descripción
        { targets: 7, width: "100px", className: "text-center" }, // Fecha
        { targets: 8, width: "80px", className: "text-center" }, // Estado
        { targets: 9, width: "120px", className: "text-center" } // Acciones
    ],
    initComplete: function() {
        $('#resiembraTable tbody tr').addClass('animate__animated animate__fadeInRight');
        $('#resiembraTable').addClass('loaded');
    }
});

    // Hacer visible la tabla inmediatamente si DataTables no está disponible
    $('#resiembraTable').addClass('loaded');

    // Set current date for registration form
    const dateInput = document.getElementById('date');
    if (dateInput) {
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');
        const localDate = `${year}-${month}-${day}`;
        dateInput.value = localDate;
    }

    // FUNCIONALIDAD DE REGISTRO (NUEVA RESIEMBRA)

    // When aquaponic system changes in registration form
    $('#aquaponic_system_id').change(function() {
        let systemId = $(this).val();

        // Reset fields and validation
        $('#crop_id').empty().append('<option value="" disabled selected>Seleccione un cultivo de plantas</option>');
        $('#crop_id').removeClass('is-invalid'); // Resetear color rojo
        $('#crop_id-error').text(''); // Limpiar mensaje de error
        $('#mortalidad_total').val('');
        $('#lots-container').empty();
        $('#quantity').val('');

        if (systemId) {
            console.log('Sistema seleccionado:', systemId);
            $.get(`/crops-by-system/${systemId}`)
                .done(function(data) {
                    console.log('Cultivos recibidos:', data);
                    if (data && data.length > 0) {
                        $('#crop_id').removeClass('is-invalid'); // Asegurar normal
                        $('#crop_id-error').text('');
                        data.forEach(function(crop) {
                            // Mostrar más info para distinguir si hay "duplicados"
                            let optionText = `${crop.species?.name ?? 'Sin especie'} `;
                            $('#crop_id').append(
                                `<option value="${crop.id}">${optionText}</option>`
                            );
                        });
                    } else {
                        $('#crop_id').append('<option value="" disabled>No hay cultivos con mortalidad registrada</option>');
                        $('#crop_id').addClass('is-invalid');
                        $('#crop_id-error').text('No hay cultivos en seguimiento con mortalidad mayor a 0 para este sistema.');

                        // Mostrar alerta
                        Swal.fire({
                            icon: 'warning',
                            title: 'Sin cultivos disponibles',
                            text: 'No hay cultivos en seguimiento con mortalidad mayor a 0 para este sistema acuapónico.',
                            confirmButtonColor: '#3085d6',
                        });
                    }
                })
                .fail(function(xhr, status, error) {
                    console.error('Error al cargar cultivos:', error);
                    $('#crop_id').addClass('is-invalid');
                    $('#crop_id-error').text('Error al cargar cultivos: ' + error);
                });
        }
    });

    // When crop changes in registration form
    $('#crop_id').change(function() {
        let cropId = $(this).val();
        $('#mortalidad_total').val('');
        $('#lots-container').empty();
        $('#quantity').val('');

        if (cropId) {
            console.log('Cultivo seleccionado:', cropId);
            $.get(`/crop-details/${cropId}`)
                .done(function(data) {
                    console.log('Detalles del cultivo:', data);

                    // Show mortality
                    $('#mortalidad_total').val(data.mortality || 0);

                    // Generate lot inputs
                    if (data.lots && data.lots.length > 0) {
                        data.lots.forEach(function(lot) {
                            $('#lots-container').append(`
                                <div class="mb-2">
                                    <label class="small fw-bold text-success mb-1">${lot.name} (Disponible: ${lot.available_capacity})</label>
                                    <input type="number" 
                                           name="lots[${lot.id}]" 
                                           max="${lot.available_capacity}" 
                                           min="0" 
                                           class="form-control form-control-sm rounded lot-input"
                                           data-lot-id="${lot.id}">
                                </div>
                            `);
                        });
                    } else {
                        $('#lots-container').append('<p class="small text-muted">No hay lotes disponibles para este cultivo.</p>');
                    }
                })
                .fail(function(xhr, status, error) {
                    console.error('Error al cargar detalles del cultivo:', error);
                    $('#lots-container').append('<p class="small text-danger">Error al cargar lotes: ' + error + '</p>');
                });
        }
    });

    // Calculate total quantity when lot inputs change in registration form
    $(document).on('input', '.lot-input', function() {
        let total = 0;
        $('.lot-input').each(function() {
            total += parseInt($(this).val()) || 0;
        });
        $('#quantity').val(total);

        // Validar que no exceda la mortalidad
        const mortality = parseInt($('#mortalidad_total').val()) || 0;

        if (total > mortality) {
            $('#quantity').addClass('is-invalid');
            if (!$('#quantity').next('.invalid-feedback').length) {
                $('#quantity').after('<div class="invalid-feedback small">La cantidad total no puede exceder la mortalidad registrada.</div>');
            }
        } else {
            $('#quantity').removeClass('is-invalid');
            $('#quantity').next('.invalid-feedback').remove();
        }
    });

    // Validación del formulario de registro
    $('form[action*="storeresowing"]').on('submit', function(e) {
        const total = parseInt($('#quantity').val()) || 0;
        const mortality = parseInt($('#mortalidad_total').val()) || 0;

        if (total > mortality) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Error de validación',
                text: 'La cantidad total no puede exceder la mortalidad registrada.',
                confirmButtonColor: '#d33',
            });
            return false;
        }
    });

    // FUNCIONALIDAD DE EDICIÓN

    // Edit button events
    $(document).on('click', '.editbtn', function() {
        const id = $(this).data('id');
        $('#formEditar').attr('action', `/pasante/resiembras/update/${id}`);
        $('#edit-id').val(id);

        // Cargar datos de la resiembra
        $.get(`/resowing-edit-data/${id}`)
            .done(function(data) {
                console.log('Datos de edición cargados:', data);

                // Llenar datos básicos
                $('#edit-date').val(data.resowing.date);
                $('#edit-aquaponic_system_id').val(data.resowing.aquaponic_system_id);
                $('#edit-description').val(data.resowing.description);
                $('#edit-original_mortality').val(data.mortality);

                // Llenar cultivos del sistema
                $('#edit-crop_id').empty().append('<option value="" disabled selected>Seleccione un cultivo</option>');
                if (data.cropsInSystem && data.cropsInSystem.length > 0) {
                    data.cropsInSystem.forEach(function(crop) {
                        const selected = crop.id == data.resowing.crop_id ? 'selected' : '';
                        let optionText = `${crop.species?.name ?? 'Sin especie'}`;
                        $('#edit-crop_id').append(
                            `<option value="${crop.id}" ${selected}>${optionText}</option>`
                        );
                    });
                } else {
                    $('#edit-crop_id').append('<option value="" disabled>No hay cultivos con mortalidad registrada</option>');
                    $('#edit-crop_id').addClass('is-invalid');
                    $('#edit-crop_id-error').text('No hay cultivos en seguimiento con mortalidad mayor a 0 para este sistema.');
                }

                // Llenar lotes con cantidades actuales
                $('#edit-lots-container').empty();
                if (data.resowingLots && data.resowingLots.length > 0) {
                    data.resowingLots.forEach(function(lot) {
                        $('#edit-lots-container').append(`
                            <div class="mb-2">
                                <label class="small fw-bold text-success mb-1">${lot.name} (Disponible: ${lot.available_capacity})</label>
                                <input type="number" 
                                       name="lots[${lot.id}]" 
                                       max="${lot.available_capacity}" 
                                       min="0" 
                                       value="${lot.current_quantity}"
                                       class="form-control form-control-sm rounded edit-lot-input"
                                       data-lot-id="${lot.id}">
                            </div>
                        `);
                    });
                } else {
                    $('#edit-lots-container').append('<p class="small text-muted">No hay lotes disponibles para este cultivo.</p>');
                }

                // Calcular cantidad total inicial
                calculateEditTotal();
            })
            .fail(function(xhr, status, error) {
                console.error('Error al cargar datos de edición:', error);
                $('#edit-crop_id').addClass('is-invalid');
                $('#edit-crop_id-error').text('Error al cargar datos de edición: ' + error);
            });
    });

    // Calculate total quantity for edit modal
    function calculateEditTotal() {
        let total = 0;
        $('.edit-lot-input').each(function() {
            total += parseInt($(this).val()) || 0;
        });
        $('#edit-quantity').val(total);

        // Validar que no exceda la mortalidad (usar total existente)
        const mortality = parseInt($('#edit-original_mortality').val()) || 0;

        if (total > mortality) {
            $('#edit-quantity').addClass('is-invalid');
            if (!$('#edit-quantity').next('.invalid-feedback').length) {
                $('#edit-quantity').after('<div class="invalid-feedback small">La cantidad total no puede exceder la mortalidad registrada.</div>');
            }
        } else {
            $('#edit-quantity').removeClass('is-invalid');
            $('#edit-quantity').next('.invalid-feedback').remove();
        }
    }

    // When edit lot inputs change
    $(document).on('input', '.edit-lot-input', function() {
        calculateEditTotal();
    });

    // When edit aquaponic system changes
    $('#edit-aquaponic_system_id').change(function() {
        let systemId = $(this).val();
        let resowingId = $('#edit-id').val(); // Pasamos el ID de la resiembra actual

        // Reset fields (except description and date)
        $('#edit-crop_id').empty().append('<option value="" disabled selected>Seleccione un cultivo</option>');
        $('#edit-crop_id').removeClass('is-invalid');
        $('#edit-crop_id-error').text('');
        $('#edit-original_mortality').val('');
        $('#edit-lots-container').empty();
        $('#edit-quantity').val('');

        if (systemId) {
            console.log('Sistema seleccionado en edición:', systemId);
            let url = `/crops-by-system/${systemId}`;
            if (resowingId) {
                url += `/${resowingId}`; // Agregamos resowingId para modo edición
            }
            $.get(url)
                .done(function(data) {
                    console.log('Cultivos recibidos en edición:', data);
                    if (data && data.length > 0) {
                        $('#edit-crop_id').removeClass('is-invalid');
                        $('#edit-crop_id-error').text('');
                        data.forEach(function(crop) {
                            let optionText = `${crop.species?.name ?? 'Sin especie'}`;
                            $('#edit-crop_id').append(
                                `<option value="${crop.id}">${optionText}</option>`
                            );
                        });
                    } else {
                        $('#edit-crop_id').append('<option value="" disabled>No hay cultivos con mortalidad registrada</option>');
                        $('#edit-crop_id').addClass('is-invalid');
                        $('#edit-crop_id-error').text('No hay cultivos en seguimiento con mortalidad mayor a 0 para este sistema.');

                        Swal.fire({
                            icon: 'warning',
                            title: 'Sin cultivos disponibles',
                            text: 'No hay cultivos en seguimiento con mortalidad mayor a 0 para este sistema acuapónico.',
                            confirmButtonColor: '#3085d6',
                        });
                    }
                })
                .fail(function(xhr, status, error) {
                    console.error('Error al cargar cultivos en edición:', error);
                    $('#edit-crop_id').addClass('is-invalid');
                    $('#edit-crop_id-error').text('Error al cargar cultivos: ' + error);
                });
        }
    });

    // When edit crop changes
    $('#edit-crop_id').change(function() {
        let cropId = $(this).val();
        let resowingId = $('#edit-id').val();
        $('#edit-original_mortality').val('');
        $('#edit-lots-container').empty();
        $('#edit-quantity').val('');

        if (cropId) {
            // Usar el método que filtra por resiembra cuando estamos en modo edición
            let url = `/crop-lots-for-edit/${cropId}/${resowingId}`;

            $.get(url)
                .done(function(data) {
                    // Show mortality
                    $('#edit-original_mortality').val(data.mortality || 0);

                    // Generate lot inputs
                    if (data.lots && data.lots.length > 0) {
                        data.lots.forEach(function(lot) {
                            let currentValue = lot.current_quantity || 0;
                            $('#edit-lots-container').append(`
                                <div class="mb-2">
                                    <label class="small fw-bold text-success mb-1">${lot.name} (Disponible: ${lot.available_capacity})</label>
                                    <input type="number" 
                                           name="lots[${lot.id}]" 
                                           max="${lot.available_capacity}" 
                                           min="0" 
                                           value="${currentValue}"
                                           class="form-control form-control-sm rounded edit-lot-input"
                                           data-lot-id="${lot.id}">
                                </div>
                            `);
                        });
                    } else {
                        $('#edit-lots-container').append('<p class="small text-muted">No hay lotes disponibles para este cultivo.</p>');
                    }

                    // Calcular total inicial
                    calculateEditTotal();
                })
                .fail(function(xhr, status, error) {
                    console.error('Error al cargar detalles del cultivo:', error);
                    $('#edit-lots-container').append('<p class="small text-danger">Error al cargar lotes: ' + error + '</p>');
                });
        }
    });

    // Validación del formulario de edición
    $('#formEditar').on('submit', function(e) {
        const total = parseInt($('#edit-quantity').val()) || 0;
        const mortality = parseInt($('#edit-original_mortality').val()) || 0;

        if (total > mortality) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Error de validación',
                text: 'La cantidad total no puede exceder la mortalidad registrada.',
                confirmButtonColor: '#d33',
            });
            return false;
        }
    });

    // Eliminar los registros de resiembra
    $(document).on('click', '.btnEliminar', function() {
        const id = $(this).data('id');
        
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
            title: '<i class="fas fa-exclamation-triangle me-2"></i>¿Eliminar Resiembra?',
            html: '<div style="text-align:center;">Esta acción <span style="color:#e74a3b; font-weight:bold;">no se puede deshacer</span> y la resiembra será eliminada permanentemente.</div>',
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
                formEliminar.action = `/pasante/resiembras/destroy/${id}`;
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
</script>

<?php if(session('success')): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: '<?php echo e(session("success")); ?>',
            confirmButtonColor: '#28a745',
            showClass: {
                popup: 'animate__animated animate__bounceIn'
            }
        });
    });
</script>
<?php endif; ?>

<?php if(session('error')): ?>
<script>
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
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('acuaponico::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sicefados\Modules/ACUAPONICO\Resources/views/admin/registroresiembras.blade.php ENDPATH**/ ?>