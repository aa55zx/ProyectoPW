// Gestión de equipos - Crear, listar y gestionar equipos
document.addEventListener('DOMContentLoaded', function() {
    
    // ==========================================
    // MODAL DE REGISTRO DE EQUIPO
    // ==========================================
    
    const modalRegistro = document.getElementById('modal-registrar-equipo');
    const btnAbrirModal = document.getElementById('btn-registrar-equipo');
    const btnCerrarModal = document.getElementById('btn-cerrar-modal');
    const btnCancelar = document.getElementById('btn-cancelar');
    const formRegistro = document.getElementById('form-registrar-equipo');
    
    // Abrir modal
    if (btnAbrirModal) {
        btnAbrirModal.addEventListener('click', function() {
            modalRegistro.classList.remove('hidden');
            modalRegistro.classList.add('flex');
        });
    }
    
    // Cerrar modal
    function cerrarModal() {
        modalRegistro.classList.add('hidden');
        modalRegistro.classList.remove('flex');
        formRegistro.reset();
    }
    
    if (btnCerrarModal) {
        btnCerrarModal.addEventListener('click', cerrarModal);
    }
    
    if (btnCancelar) {
        btnCancelar.addEventListener('click', cerrarModal);
    }
    
    // Cerrar al hacer click fuera del modal
    modalRegistro.addEventListener('click', function(e) {
        if (e.target === modalRegistro) {
            cerrarModal();
        }
    });
    
    // ==========================================
    // ENVIAR FORMULARIO DE REGISTRO
    // ==========================================
    
    if (formRegistro) {
        formRegistro.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(formRegistro);
            const btnSubmit = formRegistro.querySelector('button[type="submit"]');
            const btnText = btnSubmit.innerHTML;
            
            // Deshabilitar botón
            btnSubmit.disabled = true;
            btnSubmit.innerHTML = '<span class="spinner"></span> Creando...';
            
            fetch('/estudiante/registrar-equipo', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    mostrarNotificacion('Equipo registrado exitosamente', 'success');
                    cerrarModal();
                    
                    // Redirigir después de 1 segundo
                    setTimeout(() => {
                        if (data.redirect) {
                            window.location.href = data.redirect;
                        } else {
                            location.reload();
                        }
                    }, 1000);
                } else {
                    mostrarNotificacion(data.message || 'Error al registrar equipo', 'error');
                    btnSubmit.disabled = false;
                    btnSubmit.innerHTML = btnText;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                mostrarNotificacion('Error al registrar equipo', 'error');
                btnSubmit.disabled = false;
                btnSubmit.innerHTML = btnText;
            });
        });
    }
    
    // ==========================================
    // CARGAR EQUIPOS
    // ==========================================
    
    const equiposContainer = document.getElementById('equipos-container');
    const filtroEvento = document.querySelector('select[name="event_filter"]');
    
    if (equiposContainer && filtroEvento) {
        filtroEvento.addEventListener('change', cargarEquipos);
        cargarEquipos();
    }
    
    function cargarEquipos() {
        const eventId = filtroEvento.value;
        const params = new URLSearchParams();
        
        if (eventId && eventId !== 'all') {
            params.append('event_id', eventId);
        }
        
        fetch(`/estudiante/equipos?${params.toString()}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            renderEquipos(data.equipos);
        })
        .catch(error => {
            console.error('Error al cargar equipos:', error);
        });
    }
    
    function renderEquipos(equipos) {
        if (equipos.length === 0) {
            equiposContainer.innerHTML = `
                <div class="col-span-full text-center py-12">
                    <div class="text-gray-400 mb-4">
                        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-500 text-lg">No tienes equipos</p>
                    <p class="text-gray-400 text-sm mt-2">Crea un equipo o acepta una invitación</p>
                </div>
            `;
            return;
        }
        
        equiposContainer.innerHTML = equipos.map(equipo => crearTarjetaEquipo(equipo)).join('');
    }
    
    function crearTarjetaEquipo(equipo) {
        const isLeader = equipo.leader_id === window.currentUserId;
        
        return `
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">${equipo.name}</h3>
                        <p class="text-sm text-gray-600">${equipo.event.title}</p>
                    </div>
                    ${isLeader ? '<span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">Líder</span>' : ''}
                </div>
                
                <p class="text-gray-600 text-sm mb-4">${equipo.description || 'Sin descripción'}</p>
                
                <div class="flex items-center gap-4 text-sm text-gray-600 mb-4">
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span>${equipo.members_count} miembros</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                        <span>Código: ${equipo.invitation_code}</span>
                    </div>
                </div>
                
                <button onclick="window.location.href='/estudiante/equipos/${equipo.id}'" 
                        class="w-full py-2 px-4 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors">
                    Ver detalles
                </button>
            </div>
        `;
    }
    
    // ==========================================
    // FUNCIONES AUXILIARES
    // ==========================================
    
    function mostrarNotificacion(mensaje, tipo = 'success') {
        const notification = document.createElement('div');
        const bgColor = tipo === 'success' ? 'bg-green-500' : 'bg-red-500';
        notification.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 flex items-center gap-2`;
        
        const icon = tipo === 'success' ? '✓' : '✗';
        notification.innerHTML = `<span class="text-xl">${icon}</span><span>${mensaje}</span>`;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100%)';
            notification.style.transition = 'all 0.3s ease';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
});
