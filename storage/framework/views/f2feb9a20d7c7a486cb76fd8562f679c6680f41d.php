

<?php $__env->startPush('breadcrumbs'); ?>
<li class="breadcrumb-item active">Dashboard</li>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content2'); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
/* Estilos personalizados para las gráficas */
.chart-container {
    position: relative;
    height: 400px;
    margin: 20px 0;
}

.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 15px;
    overflow: hidden;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}

.card-header {
    border-bottom: none;
    padding: 1.5rem;
}

.card-header h5 {
    font-weight: 600;
    letter-spacing: 0.5px;
}

.card-body {
    padding: 1.5rem;
}

/* Estilos para la tabla */
.table {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.table thead th {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

.table tbody tr {
    transition: all 0.3s ease;
}

.table tbody tr:hover {
    background-color: rgba(102, 126, 234, 0.05);
    transform: scale(1.01);
}

/* Badges personalizados */
.badge {
    padding: 0.5em 1em;
    font-size: 0.85rem;
    font-weight: 600;
    border-radius: 20px;
}

.badge-success {
    background: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%);
    color: white;
}

.badge-warning {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
}

.badge-danger {
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
    color: white;
}

/* Responsive para móviles */
@media (max-width: 768px) {
    .chart-container {
        height: 300px;
    }
    
    .card-body {
        padding: 1rem;
    }
    
    .table-responsive {
        font-size: 0.9rem;
    }
}

/* Animaciones para las gráficas */
@keyframes  fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card {
    animation: fadeInUp 0.6s ease-out;
}

.card:nth-child(2) {
    animation-delay: 0.2s;
}

.card:nth-child(3) {
    animation-delay: 0.4s;
}

/* Gradientes personalizados para los headers */
.bg-gradient-info {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.bg-gradient-success {
    background: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%);
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}
</style>

<div class="container-fluid">
    <!-- Header del Dashboard -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white rounded-lg shadow-lg">
                <div class="card-body text-center py-5">
                    <h2 class="mb-2 display-4 font-weight-bold"><i class="fas fa-water mr-3"></i>Sistema de Gestión Acuapónica</h2>
                    <p class="mb-0 lead text-light">Monitoreo y Control de Sistemas de Producción</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards principales de conteos -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow-lg h-100 py-3 rounded-lg hover-scale">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-primary text-uppercase mb-2">
                                Sistemas Acuapónicos
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo e($systems->count()); ?></div>
                            <div class="text-xs text-muted mt-2">Total registrados</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-water fa-3x text-gray-200"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow-lg h-100 py-3 rounded-lg hover-scale">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-info text-uppercase mb-2">
                                Lotes Disponibles
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo e($availableLotsCount); ?></div>
                            <div class="text-xs text-muted mt-2">Disponibles para uso</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes fa-3x text-gray-200"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow-lg h-100 py-3 rounded-lg hover-scale">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-success text-uppercase mb-2">
                                Cultivos Activos
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo e($cropsCount); ?></div>
                            <div class="text-xs text-muted mt-2">En seguimiento</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-seedling fa-3x text-gray-200"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow-lg h-100 py-3 rounded-lg hover-scale">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-warning text-uppercase mb-2">
                                Resiembras Activas
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo e($resowingsCount); ?></div>
                            <div class="text-xs text-muted mt-2">En proceso</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-recycle fa-3x text-gray-200"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficas de Análisis de Producción vs Mortalidad -->
    <div class="row mb-4">
        <!-- Gráfica de Producción vs Mortalidad de Plantas por Sistema -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient-info text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-line mr-2"></i>
                        Producción vs Mortalidad de Plantas por Sistema (<?php echo e($currentYear); ?>)
                    </h5>
                </div>
                <div class="card-body">
                    <div id="loadingChart1" class="text-center py-4">
                        <div class="spinner-border text-info" role="status">
                            <span class="sr-only">Cargando gráfica...</span>
                        </div>
                        <p class="mt-2 text-muted">Cargando datos de producción y mortalidad de plantas...</p>
                    </div>
                    <canvas id="productionMortalityChart" height="100" style="display: none;"></canvas>
                </div>
            </div>
        </div>

        <!-- Gráfica de Eficiencia por Sistema -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient-success text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-percentage mr-2"></i>
                        Eficiencia de Producción vs Mortalidad (<?php echo e($currentYear); ?>)
                    </h5>
                </div>
                <div class="card-body">
                    <div id="loadingChart2" class="text-center py-4">
                        <div class="spinner-border text-success" role="status">
                            <span class="sr-only">Cargando gráfica...</span>
                        </div>
                        <p class="mt-2 text-muted">Cargando datos de eficiencia...</p>
                    </div>
                    <canvas id="efficiencyChart" height="100" style="display: none;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfica de Comparación Mensual -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient-warning text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        Comparación Mensual de Producción vs Mortalidad de Plantas (<?php echo e($currentYear); ?>)
                    </h5>
                </div>
                <div class="card-body">
                    <div id="loadingChart3" class="text-center py-4">
                        <div class="spinner-border text-warning" role="status">
                            <span class="sr-only">Cargando gráfica...</span>
                        </div>
                        <p class="mt-2 text-muted">Cargando comparación mensual...</p>
                    </div>
                    <canvas id="trendsChart" height="80" style="display: none;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Información adicional -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-info border-0 shadow-sm">
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle fa-2x mr-3 text-info"></i>
                    <div>
                        <h6 class="alert-heading mb-1">Análisis de Eficiencia <?php echo e($currentYear); ?></h6>
                        <p class="mb-0">Las gráficas muestran la comparación entre producción (cultivos cosechados) y mortalidad de plantas para cada sistema acuapónico durante el año <?php echo e($currentYear); ?>. Una mayor eficiencia indica mejor gestión del sistema con menor pérdida de plantas.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts para las gráficas -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Datos para las gráficas desde PHP
    const productionVsMortalityData = <?php echo json_encode($productionVsMortalityData, 15, 512) ?>;
    const systemEfficiency = <?php echo json_encode($systemEfficiency, 15, 512) ?>;
    const currentYear = <?php echo json_encode($currentYear, 15, 512) ?>;

    // Función para ocultar indicadores de carga
    function hideLoading(chartId) {
        const loadingElement = document.getElementById(`loadingChart${chartId}`);
        const canvasElement = document.getElementById(getCanvasId(chartId));
        if (loadingElement) loadingElement.style.display = 'none';
        if (canvasElement) canvasElement.style.display = 'block';
    }

    function getCanvasId(chartId) {
        switch(chartId) {
            case 1: return 'productionMortalityChart';
            case 2: return 'efficiencyChart';
            case 3: return 'trendsChart';
            default: return '';
        }
    }

    // Verificar si hay datos disponibles
    if (!productionVsMortalityData || Object.keys(productionVsMortalityData).length === 0) {
        // Mostrar mensaje si no hay datos
        document.querySelectorAll('[id^="loadingChart"]').forEach(el => {
            el.innerHTML = `
                <div class="text-center py-4">
                    <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                    <h6 class="text-muted">No hay datos disponibles para <?php echo e($currentYear); ?></h6>
                    <p class="text-muted small">Los datos de producción y mortalidad de plantas aparecerán aquí una vez que se registren cultivos y seguimientos en el año <?php echo e($currentYear); ?>.</p>
                </div>
            `;
        });
        return;
    }

    // Nombres de meses en español
    const monthNames = [
        'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
        'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'
    ];

    // Gráfica de Producción vs Mortalidad de Plantas por Sistema
    const productionMortalityCtx = document.getElementById('productionMortalityChart').getContext('2d');
    const productionMortalityChart = new Chart(productionMortalityCtx, {
        type: 'line',
        data: {
            labels: monthNames,
            datasets: Object.entries(productionVsMortalityData).map(([systemId, data], index) => {
                const colors = [
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(255, 205, 86, 0.8)',
                    'rgba(153, 102, 255, 0.8)'
                ];
                
                return [
                    {
                        label: `${data.system_name} - Cultivos Cosechados`,
                        data: data.monthly_data.map(item => item.harvested_crops),
                        borderColor: colors[index % colors.length],
                        backgroundColor: colors[index % colors.length].replace('0.8', '0.1'),
                        borderWidth: 3,
                        fill: false,
                        tension: 0.4
                    },
                    {
                        label: `${data.system_name} - Mortalidad Plantas`,
                        data: data.monthly_data.map(item => item.plant_mortality),
                        borderColor: colors[index % colors.length].replace('0.8', '0.6'),
                        backgroundColor: colors[index % colors.length].replace('0.8', '0.05'),
                        borderWidth: 2,
                        borderDash: [5, 5],
                        fill: false,
                        tension: 0.4
                    }
                ];
            }).flat()
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: `Comparación de Producción vs Mortalidad de Plantas por Sistema - ${currentYear}`
                },
                legend: {
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        padding: 20
                    }
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        title: function(context) {
                            return monthNames[context[0].dataIndex] + ' ' + currentYear;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Cantidad'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Meses del ' + currentYear
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });

    // Ocultar indicador de carga para la primera gráfica
    hideLoading(1);

    // Gráfica de Eficiencia por Sistema
    const efficiencyCtx = document.getElementById('efficiencyChart').getContext('2d');
    const efficiencyChart = new Chart(efficiencyCtx, {
        type: 'doughnut',
        data: {
            labels: systemEfficiency.map(item => item.system_name),
            datasets: [{
                data: systemEfficiency.map(item => item.efficiency_percentage),
                backgroundColor: [
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 205, 86, 0.8)',
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(153, 102, 255, 0.8)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 205, 86, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: `Eficiencia de Producción vs Mortalidad - ${currentYear}`
                },
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 20
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.parsed + '%';
                        }
                    }
                }
            }
        }
    });

    // Ocultar indicador de carga para la segunda gráfica
    hideLoading(2);

    // Gráfica de Comparación Mensual
    const trendsCtx = document.getElementById('trendsChart').getContext('2d');
    const trendsChart = new Chart(trendsCtx, {
        type: 'line',
        data: {
            labels: monthNames,
            datasets: [
                {
                    label: 'Total Cultivos Cosechados (Todos los Sistemas)',
                    data: monthNames.map((month, index) => {
                        return Object.values(productionVsMortalityData).reduce((sum, system) => {
                            return sum + (system.monthly_data[index]?.harvested_crops || 0);
                        }, 0);
                    }),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.1)',
                    borderWidth: 4,
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Total Mortalidad de Plantas (Todos los Sistemas)',
                    data: monthNames.map((month, index) => {
                        return Object.values(productionVsMortalityData).reduce((sum, system) => {
                            return sum + (system.monthly_data[index]?.plant_mortality || 0);
                        }, 0);
                    }),
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.1)',
                    borderWidth: 4,
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: `Comparación Mensual de Producción vs Mortalidad de Plantas - ${currentYear}`
                },
                legend: {
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        padding: 20
                    }
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        title: function(context) {
                            return monthNames[context[0].dataIndex] + ' ' + currentYear;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Cantidad Total'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Meses del ' + currentYear
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });

    // Ocultar indicador de carga para la tercera gráfica
    hideLoading(3);

    // Agregar evento de redimensionamiento para las gráficas
    window.addEventListener('resize', function() {
        productionMortalityChart.resize();
        efficiencyChart.resize();
        trendsChart.resize();
    });
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('acuaponico::layouts.masterpa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sicefa\Modules/ACUAPONICO\Resources/views/welcomepas.blade.php ENDPATH**/ ?>