# Gráficas de Análisis de Producción vs Mortalidad de Plantas - Módulo ACUAPONICO

## Descripción General

Este módulo implementa un sistema completo de gráficas para analizar y comparar la producción vs mortalidad de **plantas** en sistemas acuapónicos **durante el año actual**. Las gráficas permiten visualizar qué sistema tuvo mayor producción por menor mortalidad de plantas, facilitando la toma de decisiones para mejorar la gestión.

## Características Implementadas

### 1. Gráfica de Producción vs Mortalidad de Plantas por Sistema
- **Tipo**: Gráfica de líneas múltiples
- **Datos mostrados**: 
  - Cultivos cosechados por mes para cada sistema
  - **Mortalidad de plantas** por mes para cada sistema
- **Período**: **Solo año actual** ({{ date('Y') }})
- **Colores**: Diferentes colores para cada sistema con líneas punteadas para mortalidad de plantas
- **Objetivo**: Identificar qué sistema tuvo mejor rendimiento con menor pérdida de plantas

### 2. Gráfica de Eficiencia por Sistema
- **Tipo**: Gráfica de dona (doughnut)
- **Datos mostrados**: Porcentaje de eficiencia calculado como **producción vs mortalidad de plantas**
- **Fórmula**: `(Cultivos cosechados / (Total cultivos + Mortalidad plantas)) × 100`
- **Colores**: Gradientes de colores según el nivel de eficiencia
- **Ranking**: Sistemas ordenados de mayor a menor eficiencia

### 3. Gráfica de Comparación Mensual
- **Tipo**: Gráfica de líneas con área
- **Datos mostrados**: 
  - Total de cultivos cosechados en todos los sistemas por mes
  - Total de mortalidad de plantas en todos los sistemas por mes
- **Período**: **Solo año actual** ({{ date('Y') }})
- **Características**: Líneas con relleno para mejor visualización mensual

### 4. Tabla de Ranking de Eficiencia
- **Datos mostrados**:
  - Posición en el ranking (1°, 2°, 3° con iconos)
  - Nombre del sistema acuapónico
  - Total de cultivos del año actual
  - Cultivos cosechados
  - Mortalidad de plantas
  - Porcentaje de eficiencia con badges de colores
  - Estado de rendimiento (Excelente, Bueno, Necesita Mejora)

## Enfoque en Plantas (No Peces)

**IMPORTANTE**: Este sistema se enfoca exclusivamente en la **mortalidad de plantas** para:
- Simplificar el análisis
- Enfocarse en el cultivo vegetal
- Facilitar la comparación entre sistemas
- Identificar problemas específicos de gestión de plantas

## Estructura de Datos

### En el Controlador (ACUAPONICOController.php)

```php
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
    ->whereYear('created_at', $currentYear)  // Solo año actual
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
    ->whereYear('trackings.date', $currentYear)  // Solo año actual
    ->groupBy('month')
    ->orderBy('month')
    ->get();

    // Combinar datos por mes
    $monthlyData = [];
    for ($month = 1; $month <= 12; $month++) {
        $monthlyData[] = [
            'month' => $month,
            'month_name' => date('M', mktime(0, 0, 0, $month, 1)),
            'total_crops' => $cropData ? $cropData->total_crops : 0,
            'harvested_crops' => $cropData ? $cropData->harvested_crops : 0,
            'plant_mortality' => $mortalityDataMonth ? $mortalityDataMonth->plant_mortality : 0
        ];
    }
}

// Cálculo de eficiencia enfocado en plantas
$efficiency = ($harvestedCrops / ($totalCrops + $totalPlantMortality)) * 100;

// Ordenar por eficiencia (mejor a peor)
$systemEfficiency = collect($systemEfficiency)->sortByDesc('efficiency_percentage')->values()->all();
```

## Cálculos de Eficiencia

### Nueva Fórmula de Eficiencia
```
Eficiencia (%) = (Cultivos Cosechados / (Total de Cultivos + Mortalidad de Plantas)) × 100
```

**Ventajas de esta fórmula:**
- Considera la mortalidad como pérdida real
- Recompensa sistemas con menor mortalidad
- Refleja mejor la gestión del sistema

### Clasificación de Eficiencia
- **≥ 80%**: Verde (Excelente) - Sistema muy bien gestionado
- **60-79%**: Amarillo (Bueno) - Sistema con buen rendimiento
- **< 60%**: Rojo (Necesita mejora) - Sistema requiere optimización

## Características Técnicas

### Frontend
- **Chart.js**: Biblioteca para gráficas interactivas
- **Responsive**: Adaptable a diferentes tamaños de pantalla
- **Animaciones**: Transiciones suaves y efectos hover
- **Indicadores de carga**: Spinners mientras se cargan los datos
- **Nombres de meses en español**: Ene, Feb, Mar, Abr, May, Jun, Jul, Ago, Sep, Oct, Nov, Dic

### Backend
- **Consultas optimizadas**: Solo datos del año actual
- **Filtros temporales**: `whereYear()` para limitar a año actual
- **Enfoque en plantas**: Solo `trackingplant.mortality`
- **Ordenamiento por eficiencia**: Ranking automático de sistemas

### Estilos
- **Gradientes modernos**: Headers con gradientes de colores
- **Sombras y bordes**: Efectos visuales atractivos
- **Responsive design**: Adaptable a móviles y tablets
- **Animaciones CSS**: Efectos de entrada y hover
- **Iconos de ranking**: Trofeos, medallas y premios

## Uso y Navegación

### Interactividad
- **Hover**: Información detallada al pasar el mouse
- **Zoom**: Las gráficas se adaptan al tamaño de la ventana
- **Leyendas**: Click para mostrar/ocultar series de datos
- **Tooltips**: Información contextual por mes

### Responsive
- **Móviles**: Altura reducida de gráficas
- **Tablets**: Layout adaptativo
- **Desktop**: Vista completa con todas las funcionalidades

## Beneficios del Enfoque en Plantas

1. **Análisis más claro**: Sin confusión entre mortalidad de peces y plantas
2. **Mejor comparación**: Sistemas se comparan en igualdad de condiciones
3. **Identificación de problemas**: Fácil detectar sistemas con alta mortalidad vegetal
4. **Toma de decisiones**: Información clara para optimizar gestión
5. **Ranking objetivo**: Ordenamiento automático por eficiencia real

## Mantenimiento y Extensión

### Agregar Nuevas Métricas
1. Modificar el controlador para obtener nuevos datos
2. Agregar nuevos datasets en las gráficas
3. Actualizar la vista con nuevos elementos

### Personalización de Colores
```javascript
const colors = [
    'rgba(54, 162, 235, 0.8)',  // Azul
    'rgba(255, 99, 132, 0.8)',  // Rojo
    'rgba(75, 192, 192, 0.8)',  // Verde azulado
    'rgba(255, 205, 86, 0.8)',  // Amarillo
    'rgba(153, 102, 255, 0.8)'  // Púrpura
];
```

### Agregar Nuevos Tipos de Gráficas
1. Crear nuevo canvas en la vista
2. Implementar lógica de datos en el controlador
3. Agregar JavaScript para la nueva gráfica

## Dependencias

- **Chart.js**: `https://cdn.jsdelivr.net/npm/chart.js`
- **Font Awesome**: Para iconos
- **Bootstrap**: Para layout y componentes
- **Laravel**: Framework backend

## Consideraciones de Rendimiento

- **Datos limitados**: Solo año actual para mejor rendimiento
- **Consultas optimizadas**: Uso de índices en base de datos
- **Lazy loading**: Las gráficas se cargan solo cuando es necesario
- **Responsive charts**: Las gráficas se redimensionan automáticamente

## Troubleshooting

### Gráficas no se muestran
1. Verificar que Chart.js esté cargado
2. Revisar la consola del navegador para errores JavaScript
3. Confirmar que los datos se están pasando correctamente desde PHP

### Datos no aparecen
1. Verificar que existan registros del año actual
2. Revisar las consultas SQL en el controlador
3. Confirmar las relaciones entre modelos

### Problemas de rendimiento
1. Optimizar consultas con índices de base de datos
2. Los datos ya están limitados al año actual
3. Implementar caché si es necesario para datos estáticos
