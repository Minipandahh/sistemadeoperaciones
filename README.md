# TransferOps — PC Pro (HTML + CSS + JS)

## Abrir
Descomprime y haz doble clic en `index.html`. No necesitas instalar dependencias para las reservas y la mesa de operaciones.

## Mesa de trabajo
- Usa **Hoy**, las flechas anterior/siguiente, **Mañana** y los filtros de prioridad.
- Busca con `/` y crea una reserva con `N`.
- En una fila pulsa **Ver detalles →**: aparecerá un panel lateral con chofer, vehículo, estado, pagos, extras, teléfono y acciones directas.
- Exporta una hoja CSV compatible con Excel desde el botón superior.
- Exporta frecuentemente tu respaldo JSON: los datos solo viven en el navegador y dispositivo actual.

## Vuelos
La pantalla `vuelos.html` necesita PHP para usar `flight-api.php` (incluido). Sin servidor PHP o si el proveedor bloquea consultas, el radar no funcionará. **No se representa ningún resultado simulado como dato en vivo.**

## Limitaciones y producción
Este software es una demo de operación en un solo navegador, sin login real ni base de datos central. No debe usarse para coordinar más de 100 reservas diarias entre empleados sin conectar un backend (PHP + MySQL recomendado), copias de seguridad automáticas y pruebas de concurrencia. Los ejemplos iniciales son ficticios.


## Novedades de esta edición
- La fila completa toma un color según el estado (incluye etiqueta de texto).
- Nombre del chofer en bloque verde o rojo claramente visible.
- Indicador ARROYADO manual, independiente del estado y del atraso horario.
- Contador y filtro exclusivo de ARROYADOS, también accesible desde la tarjeta superior.
- El indicador se guarda localmente, sobrevive a edición y se exporta a CSV.
- En ficha lateral se muestra chofer, vehículo y botón para marcar/desmarcar ARROYADO.
- ARROYADO se refiere a una marca de incidencia/prioridad colocada por el operador, no se deduce de fuentes externas.
