-- =====================
-- USUARIOS
-- =====================
INSERT INTO users (username, password, name, role, email) VALUES
('admin', :admin_pwd, 'Admin Principal', 'Administrador', 'admin@example.com'),

('tech1', :tech1_pwd, 'Técnico Uno', 'Tecnico', 'tech1@example.com'),
('tech2', :tech2_pwd, 'Técnico Dos', 'Tecnico', 'tech2@example.com'),
('tech3', :tech3_pwd, 'Técnico Tres', 'Tecnico', 'tech3@example.com'),

('client1', :client1_pwd, 'Cliente Uno', 'Cliente', 'cliente1@example.com'),
('client2', :client2_pwd, 'Cliente Dos', 'Cliente', 'cliente2@example.com'),
('client3', :client3_pwd, 'Cliente Tres', 'Cliente', 'cliente3@example.com');


-- =====================
-- TICKETS
-- =====================
INSERT INTO tickets (title, description, priority, requester_id, assigned_to, status, sla_hours)
VALUES
('No enciende impresora', 'La impresora modelo X no responde al imprimir.', 'Alta', 5, 2, 'Abierto', 24),
('Internet intermitente', 'La conexión se cae cada 5 minutos.', 'Critica', 6, 2, 'En Progreso', 12),
('Error al abrir Excel', 'Excel muestra un error inesperado al iniciar la aplicación.', 'Media', 7, NULL, 'Abierto', 24),
('Pantalla azul', 'La PC muestra pantalla azul al arrancar.', 'Alta', 5, 3, 'En Progreso', 48),
('No carga página web', 'Algunos sitios no abren aunque hay conexión.', 'Baja', 6, NULL, 'Abierto', 72),
('Teclado no funciona', 'El teclado presenta teclas sin respuesta.', 'Media', 7, 3, 'Resuelto', 48),
('Actualización de antivirus', 'Solicito actualizar antivirus a última versión.', 'Baja', 5, 4, 'Cerrado', 96),
('Correo no sincroniza', 'Outlook no descarga correos nuevos.', 'Alta', 6, 2, 'Abierto', 24),
('Solicitud acceso a sistema', 'Necesito acceso al sistema administrativo.', 'Media', 7, 4, 'Abierto', 48),
('Laptop muy lenta', 'La laptop tarda demasiado en abrir aplicaciones.', 'Alta', 5, NULL, 'Abierto', 24);


-- ==========================
-- BASE DE CONOCIMIENTO (KB)
-- ==========================
INSERT INTO knowledge_base (title, content, tags, created_by)
VALUES
('Reiniciar impresora', 'Pasos para reiniciar la impresora y limpiar la cola de impresión.', 'impresora,reinicio', 2),
('Solución a internet intermitente', 'Verificar cables, reiniciar router y cambiar DNS si es necesario.', 'internet,router,dns', 3),
('Reparar Excel dañado', 'Use la función de reparación de Office para corregir errores.', 'office,excel,reparacion', 2),
('Cómo resolver pantalla azul', 'Causas: drivers, memoria RAM, SSD defectuoso.', 'bsod,hardware,drivers', 3),
('Optimizar Windows', 'Desactivar aplicaciones de inicio, limpiar disco y actualizar drivers.', 'windows,optimización', 4),
('Configurar Outlook IMAP', 'Instrucciones para sincronizar correo IMAP en Outlook.', 'outlook,correo', 2),
('Actualizar antivirus', 'Guía para actualizar la base de firmas del antivirus.', 'antivirus,seguridad', 4),
('Acceso a sistemas internos', 'Procedimiento para solicitar accesos administrativos.', 'acceso,sistemas', 3);


-- ==========================
-- HISTORIAL DE ESTADOS
-- ==========================
INSERT INTO ticket_status_history (ticket_id, old_status, new_status, notes, changed_by)
VALUES
(1, 'Abierto', 'Abierto', 'Ticket creado por cliente.', 5),
(1, 'Abierto', 'En Progreso', 'Técnico inicia revisión.', 2),
(2, 'Abierto', 'Abierto', 'Cliente reporta intermitencia.', 6),
(2, 'Abierto', 'En Progreso', 'Analizando estabilidad de red.', 2),
(4, 'Abierto', 'Abierto', 'Pantalla azul reportada por cliente.', 5),
(4, 'Abierto', 'En Progreso', 'Diagnosticando drivers.', 3),
(4, 'En Progreso', 'Resuelto', 'Se reemplaza módulo RAM dañado.', 3),
(6, 'Abierto', 'Abierto', 'Cliente reporta fallo del teclado.', 7),
(6, 'Abierto', 'Resuelto', 'Se reemplaza teclado USB.', 3);


-- ==========================
-- HISTORIAL DE ASIGNACIONES
-- ==========================
INSERT INTO ticket_assignments (ticket_id, assigned_to, assigned_by)
VALUES
(1, 2, 1),
(2, 2, 1),
(4, 3, 1),
(6, 3, 1),
(7, 4, 1),
(8, 2, 1);
