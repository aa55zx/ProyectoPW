// Validaciones globales para formularios de estudiante
document.addEventListener('DOMContentLoaded', function() {
    // Agregar validación en tiempo real a todos los formularios
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
        
        inputs.forEach(input => {
            // Validación en tiempo real
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            input.addEventListener('input', function() {
                if (this.classList.contains('is-invalid')) {
                    validateField(this);
                }
            });
        });
        
        // Validación al enviar
        form.addEventListener('submit', function(e) {
            let isValid = true;
            
            inputs.forEach(input => {
                if (!validateField(input)) {
                    isValid = false;
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                mostrarAlertaError('Por favor, completa todos los campos obligatorios correctamente');
            }
        });
    });
});

function validateField(field) {
    const value = field.value.trim();
    const fieldName = field.name;
    let isValid = true;
    let errorMessage = '';
    
    // Limpiar errores previos
    removeError(field);
    
    // Campo requerido
    if (field.hasAttribute('required') && value === '') {
        errorMessage = 'Este campo es obligatorio';
        isValid = false;
    }
    // Email
    else if (field.type === 'email' && value !== '') {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            errorMessage = 'Ingresa un correo electrónico válido';
            isValid = false;
        }
    }
    // Longitud mínima
    else if (field.hasAttribute('minlength')) {
        const minLength = parseInt(field.getAttribute('minlength'));
        if (value.length < minLength) {
            errorMessage = `Debe tener al menos ${minLength} caracteres`;
            isValid = false;
        }
    }
    // Longitud máxima
    else if (field.hasAttribute('maxlength')) {
        const maxLength = parseInt(field.getAttribute('maxlength'));
        if (value.length > maxLength) {
            errorMessage = `No debe exceder ${maxLength} caracteres`;
            isValid = false;
        }
    }
    // Validación de URL
    else if (field.type === 'url' && value !== '') {
        const urlRegex = /^https?:\/\/.+\..+/;
        if (!urlRegex.test(value)) {
            errorMessage = 'Ingresa una URL válida (ejemplo: https://ejemplo.com)';
            isValid = false;
        }
    }
    // Archivos
    else if (field.type === 'file' && field.hasAttribute('required')) {
        if (!field.files || field.files.length === 0) {
            errorMessage = 'Debes seleccionar un archivo';
            isValid = false;
        } else {
            const file = field.files[0];
            const maxSize = 52428800; // 50MB
            
            if (file.size > maxSize) {
                errorMessage = 'El archivo no debe exceder 50MB';
                isValid = false;
            }
            
            const allowedTypes = field.accept ? field.accept.split(',').map(t => t.trim()) : [];
            if (allowedTypes.length > 0) {
                const fileExt = '.' + file.name.split('.').pop().toLowerCase();
                const fileMime = file.type;
                
                const isValidType = allowedTypes.some(type => {
                    if (type.startsWith('.')) {
                        return fileExt === type.toLowerCase();
                    } else {
                        return fileMime.includes(type.replace('*', ''));
                    }
                });
                
                if (!isValidType) {
                    errorMessage = `Tipo de archivo no permitido. Permitidos: ${allowedTypes.join(', ')}`;
                    isValid = false;
                }
            }
        }
    }
    
    if (!isValid) {
        showError(field, errorMessage);
    }
    
    return isValid;
}

function showError(field, message) {
    field.classList.add('is-invalid', 'border-red-500', 'focus:ring-red-500', 'focus:border-red-500');
    field.classList.remove('border-gray-300');
    
    // Crear mensaje de error si no existe
    let errorDiv = field.parentElement.querySelector('.error-message');
    if (!errorDiv) {
        errorDiv = document.createElement('div');
        errorDiv.className = 'error-message text-red-600 text-sm mt-1 flex items-center gap-1';
        field.parentElement.appendChild(errorDiv);
    }
    
    errorDiv.innerHTML = `
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
        </svg>
        ${message}
    `;
}

function removeError(field) {
    field.classList.remove('is-invalid', 'border-red-500', 'focus:ring-red-500', 'focus:border-red-500');
    field.classList.add('border-gray-300');
    
    const errorDiv = field.parentElement.querySelector('.error-message');
    if (errorDiv) {
        errorDiv.remove();
    }
}

function mostrarAlertaError(mensaje) {
    // Crear alerta temporal
    const alert = document.createElement('div');
    alert.className = 'fixed top-4 right-4 bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-lg shadow-lg z-50 max-w-md';
    alert.innerHTML = `
        <div class="flex items-start gap-3">
            <svg class="w-6 h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <div class="flex-1">
                <p class="font-semibold">Error de validación</p>
                <p class="text-sm">${mensaje}</p>
            </div>
        </div>
    `;
    
    document.body.appendChild(alert);
    
    setTimeout(() => {
        alert.remove();
    }, 5000);
}

function mostrarAlertaExito(mensaje) {
    const alert = document.createElement('div');
    alert.className = 'fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg shadow-lg z-50 max-w-md';
    alert.innerHTML = `
        <div class="flex items-start gap-3">
            <svg class="w-6 h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <p>${mensaje}</p>
        </div>
    `;
    
    document.body.appendChild(alert);
    
    setTimeout(() => {
        alert.remove();
    }, 3000);
}

// Validación específica para formularios con AJAX
async function enviarFormularioConValidacion(url, formData, onSuccess) {
    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: formData
        });
        
        const data = await response.json();
        
        if (response.ok && data.success) {
            mostrarAlertaExito(data.message || 'Operación exitosa');
            if (onSuccess) onSuccess(data);
        } else {
            // Mostrar errores de validación del servidor
            if (data.errors) {
                Object.keys(data.errors).forEach(field => {
                    const input = document.querySelector(`[name="${field}"]`);
                    if (input) {
                        showError(input, data.errors[field][0]);
                    }
                });
                mostrarAlertaError('Hay errores en el formulario');
            } else {
                mostrarAlertaError(data.message || 'Ocurrió un error');
            }
        }
    } catch (error) {
        console.error('Error:', error);
        mostrarAlertaError('Error de conexión. Intenta nuevamente');
    }
}
