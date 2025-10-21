<?php
// 🔹 Iniciar la sesión para acceder a las variables del usuario
session_start();

// Si no existe una sesión de usuario, proteger la página y redirigir al inicio
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php?mensaje=Acceso denegado. Por favor, inicia sesión.&tipo=error");
    exit();
}

// Obtener datos de la sesión para mostrarlos en la página
$rol = $_SESSION['rol'];
$usuario = $_SESSION['usuario'];

// Procesar mensajes de la URL, por ejemplo, al iniciar sesión
$mensaje = !empty($_GET['mensaje']) ? htmlspecialchars($_GET['mensaje']) : '';
$clase_mensaje = !empty($_GET['tipo']) && $_GET['tipo'] === 'success' ? 'success' : '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        /* Contenedor principal del dashboard */
        .dashboard-container {
            width: 100%;
            max-width: 800px;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Encabezado de bienvenida */
        .welcome-header {
            margin-bottom: 30px;
        }

        .welcome-header h1 {
            font-size: 2.5em;
            color: #333;
            font-weight: 700;
        }

        .welcome-header p {
            font-size: 1.1em;
            color: #666;
            text-transform: capitalize; /* Pone en mayúscula la primera letra del rol */
        }

        /* Contenido específico del rol */
        .role-content {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 30px;
        }

        .role-content h2 {
            font-size: 1.8em;
            color: #0056b3;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .role-content p {
            color: #495057;
            font-size: 1em;
            line-height: 1.6;
        }

        /* Estilos para los botones */
        .btn-logout {
            width: 100%;
            background: #dc3545; /* Rojo para cerrar sesión */
            color: white;
            padding: 15px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-logout:hover {
            background: #c82333;
        }

        /* Mensaje de éxito (ej. "Login exitoso") */
        .success {
            color: #28a745;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 1.1em;
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <div class="welcome-header">
        <h1>Bienvenido, <?php echo htmlspecialchars($usuario); ?></h1>
        <p>Rol: <strong><?php echo htmlspecialchars($rol); ?></strong></p>
    </div>

    <?php
    // Muestra el mensaje de éxito si existe (ej. al iniciar sesión)
    if (!empty($mensaje) && !empty($clase_mensaje)) {
        echo "<p class='$clase_mensaje'>" . $mensaje . "</p>";
    }
    ?>
    
    <div class="role-content">
        <?php if ($rol === 'admin'): ?>
            <h2><i class="fas fa-user-shield"></i> Panel de Administrador</h2>
            <p>Tienes acceso total al sistema. Aquí podrás gestionar usuarios, configurar ajustes y supervisar la actividad de la plataforma.</p>
        <?php else: ?>
            <h2><i class="fas fa-user"></i> Panel de Usuario</h2>
            <p>Aquí encontrarás tus herramientas y opciones principales. ¡Explora las funcionalidades disponibles para ti!</p>
        <?php endif; ?>
    </div>

    <form action="logout.php" method="POST">
        <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</button>
    </form>
</div>

</body>
</html>