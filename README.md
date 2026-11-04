# TransferOps — versión HTML / CSS / JavaScript puro

## Inicio

1. Descomprime `transferops-html.zip`.
2. Abre `index.html` con Chrome, Edge o Firefox. No necesitas Node.js ni instalar paquetes.
3. Usa el menú para añadir choferes, vehículos, agencias y hoteles y registrar reservaciones.

## Archivos

- `index.html`: interfaz y formularios.
- `styles.css`: estilos y adaptación a celulares.
- `app.js`: lógica, CRUD de reservas, calendarios, asignaciones y persistencia local.

## Funciones

- Dashboard de operaciones.
- Campos completos del comprobante: pasajero, fecha/hora, origen, destino, PAX, vehículo solicitado, número de reserva externo (Res), vuelo/habitación, estado de pago (PAY) y extras.
- El número de reserva externo se conserva por separado del código interno del sistema. El vehículo solicitado se conserva por separado del vehículo asignado.
- En el PDF proporcionado, PAY figura como “-”, por lo que el software usa «No indicado» y no asume que esté pagado. El precio 270 USD aparece en el nombre del archivo, no en el contenido impreso.
- Los PDF todavía se transcriben manualmente: esta versión no realiza importación automática.
- Reservas directas y de agencias/hoteles; ida y vuelta como trayectos separados.
- Alta, edición, eliminación, filtros y búsquedas de reservaciones.
- Calendario mensual.
- Asignar choferes y vehículos con detección de solapamiento estimado.
- Registro de choferes, vehículos, agencias y hoteles.
- Exportación JSON de una copia de seguridad.

## Limitaciones importantes

**Esta es una versión de demostración local, no un sistema de producción.** Los datos se guardan en `localStorage` del navegador y no se sincronizan entre dispositivos. Si borras los datos del sitio, cambias de navegador, o abres el archivo en otro origen, es posible que no aparezcan. Descarga copias de seguridad regularmente. No tiene inicio de sesión real, roles, backend ni protección para datos sensibles. No ingreses información real de clientes hasta implementar autenticación, base de datos central, copias de seguridad y controles de seguridad.

Las reservas incluidas al inicio son **datos de ejemplo ficticios**. Los horarios se comprueban solo usando duración estimada; no cubren tiempos de desplazamiento entre traslados ni disponibilidad real.

## Para pasar a producción

Conservar el frontend en HTML/CSS/JS si así prefieres, y agregar un backend (por ejemplo PHP + MySQL, o Node.js + PostgreSQL) con API, login, roles, logs y respaldo. El frontend por sí solo no puede garantizar usuarios, permisos o una base compartida.

## Edición para operación de 100+ servicios diarios
- Reservaciones: búsqueda, filtros por fecha y paginación de 30 registros por pantalla.
- Despacho: fecha diaria por defecto, cambio de fecha y paginación de 25 servicios.
- Las reservas de ida y vuelta generan dos servicios, por lo que 100 reservas podrían implicar hasta 200 servicios.

**Advertencia crítica:** esta edición es un prototipo local y guarda todo en `localStorage` del navegador. No se recomienda introducir información real de clientes ni depender de ella para operar 100+ reservas diarias. Para producción se requiere servidor y base de datos central (por ejemplo, PHP + MySQL), autenticación, control de concurrencia, permisos, copias de seguridad automatizadas, registro de auditoría y pruebas de carga. HTML/CSS/JS siguen siendo adecuados para la interfaz.

## Mesa de operaciones (versión para días de mucho movimiento)

La pantalla inicial ahora es **Mesa de operaciones**: filtros por fecha (Hoy/Mañana), búsqueda instantánea, alertas de hora, recuentos de servicios sin asignar, filas compactas con asignación directa de chofer, vehículo y estado, selección múltiple para actualizar estados y paginación de 40 servicios por pantalla.

Atajos: `N` abre nueva reserva, `/` abre Mesa y enfoca la búsqueda, `Escape` cierra el formulario. Los atajos no se aplican cuando estás escribiendo en un campo.

**Precauciones:** Es un prototipo local con `localStorage` del navegador. La información NO se comparte entre equipos, NO tiene cuentas ni registro de auditoría y puede perderse si se borran datos del navegador. Exporta las copias de seguridad con frecuencia. Las alertas toman la hora local del equipo, no información actualizada del aeropuerto. No uses datos reales sensibles ni operación de misión crítica hasta instalar un backend con autenticación, base de datos, copias automáticas y control de acceso.

## Interfaz móvil (actualización)
- Navegación inferior fija: Mesa, Reservas, Agenda, Despacho y Nueva.
- Mesa adaptada a tarjetas para pantallas pequeñas, sin desplazamiento horizontal en el despacho principal.
- Controles por servicio: asignación desplegable de chofer, vehículo y estado; avance rápido del estado y edición.
- Avisos visuales de servicios cercanos, atrasados y sin asignar; los avisos utilizan el reloj local.
- Formularios con campos grandes y botón de guardar accesible en móvil.
- En escritorio se conserva la tabla operativa densa.

**Alcance:** demo local en el navegador, con almacenamiento localStorage. No garantiza sincronización entre teléfonos o computadoras, usuarios simultáneos, control de accesos ni recuperación ante borrado de datos. Para operaciones reales con más de 100 servicios al día se requiere servidor y base de datos compartida.
