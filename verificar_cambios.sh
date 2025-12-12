#!/bin/bash

echo "╔══════════════════════════════════════════════════════════════════╗"
echo "║  VERIFICACIÓN DE CORRECCIONES - REGISTRO → DASHBOARD            ║"
echo "╚══════════════════════════════════════════════════════════════════╝"
echo ""

# Colores
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

errors=0
warnings=0

# Función para verificar archivo
check_file() {
    if [ -f "$1" ]; then
        echo -e "${GREEN}✓${NC} Archivo existe: $1"
        return 0
    else
        echo -e "${RED}✗${NC} Archivo NO existe: $1"
        ((errors++))
        return 1
    fi
}

# Función para verificar contenido
check_content() {
    if grep -q "$2" "$1" 2>/dev/null; then
        echo -e "${GREEN}✓${NC} Contenido encontrado en $1"
        return 0
    else
        echo -e "${YELLOW}⚠${NC} Contenido NO encontrado en $1"
        ((warnings++))
        return 1
    fi
}

echo "1. Verificando archivos modificados..."
echo "─────────────────────────────────────────────────────────────────"

check_file "app/Http/Controllers/Auth/RegisterController.php"
check_file "app/Http/Middleware/RedirectIfAuthenticated.php"
check_file "routes/web.php"
check_file "bootstrap/app.php"

echo ""
echo "2. Verificando contenido clave..."
echo "─────────────────────────────────────────────────────────────────"

check_content "app/Http/Controllers/Auth/RegisterController.php" "session()->regenerate()"
check_content "app/Http/Controllers/Auth/RegisterController.php" "Auth::login(\$user, true)"
check_content "app/Http/Middleware/RedirectIfAuthenticated.php" "RedirectIfAuthenticated"
check_content "routes/web.php" "middleware('guest')"
check_content "bootstrap/app.php" "'guest'"

echo ""
echo "3. Verificando configuración .env..."
echo "─────────────────────────────────────────────────────────────────"

if [ -f ".env" ]; then
    if grep -q "SESSION_DRIVER=database" ".env"; then
        echo -e "${GREEN}✓${NC} SESSION_DRIVER=database configurado"
    else
        echo -e "${RED}✗${NC} SESSION_DRIVER no está configurado como 'database'"
        ((errors++))
    fi
    
    if grep -q "SESSION_DOMAIN=.railway.app" ".env"; then
        echo -e "${GREEN}✓${NC} SESSION_DOMAIN configurado para Railway"
    else
        echo -e "${YELLOW}⚠${NC} SESSION_DOMAIN podría no estar configurado correctamente"
        ((warnings++))
    fi
else
    echo -e "${RED}✗${NC} Archivo .env no encontrado"
    ((errors++))
fi

echo ""
echo "4. Verificando migraciones de sesiones..."
echo "─────────────────────────────────────────────────────────────────"

migration_exists=$(find database/migrations -name "*create_sessions_table.php" 2>/dev/null | wc -l)

if [ $migration_exists -gt 0 ]; then
    echo -e "${GREEN}✓${NC} Migración de sesiones existe"
else
    echo -e "${YELLOW}⚠${NC} Migración de sesiones NO encontrada"
    echo "   Ejecuta: php artisan session:table"
    ((warnings++))
fi

echo ""
echo "╔══════════════════════════════════════════════════════════════════╗"
echo "║  RESUMEN DE VERIFICACIÓN                                         ║"
echo "╚══════════════════════════════════════════════════════════════════╝"
echo ""

if [ $errors -eq 0 ] && [ $warnings -eq 0 ]; then
    echo -e "${GREEN}✓ Todo está correcto! Puedes hacer commit y push${NC}"
    echo ""
    echo "Siguiente paso:"
    echo "  git add ."
    echo "  git commit -m \"fix: Corregir redirección al dashboard después del registro\""
    echo "  git push origin main"
elif [ $errors -eq 0 ]; then
    echo -e "${YELLOW}⚠ $warnings advertencias encontradas${NC}"
    echo "  Revisa las advertencias antes de continuar"
else
    echo -e "${RED}✗ $errors errores y $warnings advertencias encontradas${NC}"
    echo "  Corrige los errores antes de hacer commit"
fi

echo ""
echo "═══════════════════════════════════════════════════════════════════"
