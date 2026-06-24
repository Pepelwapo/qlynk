<?php
require_once __DIR__ . '/core/db.php';

// Cargar planes desde DB
$planes = [];
if ($pdo) {
    $stmt = $pdo->prepare("
        SELECT * FROM plans
        WHERE is_active = 1
        ORDER BY sort_order ASC
    ");
    $stmt->execute();
    $planes = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>QLynk — QR Dinámicos para tu negocio</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
<style>
*  { box-sizing:border-box }
.hero { background:linear-gradient(135deg,#1a1a2e 0%,#16213e 60%,#0f3460 100%);min-height:100vh }
.hero h1 { font-size:clamp(2rem,5vw,3.5rem);font-weight:700;line-height:1.15 }
.plan-card { border-radius:16px;transition:.2s;cursor:pointer;border:1px solid #e5e5e5 }
.plan-card:hover { transform:translateY(-4px);box-shadow:0 12px 40px rgba(0,0,0,.12) }
.plan-card.featured { border:2px solid #1a1a2e }
.badge-popular { background:#1a1a2e;color:#fff;font-size:11px;padding:4px 12px;border-radius:20px }
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark px-4 py-3"
     style="background:transparent;position:absolute;width:100%;z-index:10">
    <a class="navbar-brand fw-bold fs-4" href="/">⚡ QLynk</a>
    <div class="d-flex gap-2">
        <a href="https://app.qlynk.mx/login"
           class="btn btn-outline-light btn-sm">Entrar</a>
        <a href="https://app.qlynk.mx/register"
           class="btn btn-light btn-sm text-dark fw-bold">Empezar gratis</a>
    </div>
</nav>

<!-- HERO -->
<section class="hero d-flex align-items-center text-white">
<div class="container py-5 mt-5">
<div class="row align-items-center">
    <div class="col-lg-6">
        <span class="badge bg-primary mb-3">✨ 14 días gratis sin tarjeta</span>
        <h1 class="mb-4">QR Dinámicos<br>para tu negocio</h1>
        <p class="fs-5 text-white-50 mb-4">
            Crea, edita y rastrea tus códigos QR en tiempo real.
            Cambia el destino sin reimprimir. Analiza cada escaneo.
        </p>
        <div class="d-flex gap-3 flex-wrap">
            <a href="https://app.qlynk.mx/register"
               class="btn btn-primary btn-lg px-4">Comenzar gratis</a>
            <a href="#planes"
               class="btn btn-outline-light btn-lg px-4">Ver planes</a>
        </div>
        <div class="mt-4 d-flex gap-4 text-white-50" style="font-size:14px">
            <span>✅ Sin tarjeta de crédito</span>
            <span>✅ Cancela cuando quieras</span>
        </div>
    </div>
    <div class="col-lg-6 text-center mt-5 mt-lg-0">
        <div style="background:#ffffff10;border-radius:24px;padding:40px;display:inline-block">
            <div style="font-size:120px;line-height:1">⚡</div>
            <div class="text-white-50 mt-2">QR · Menús · Catálogos · Forms</div>
        </div>
    </div>
</div>
</div>
</section>

<!-- FEATURES -->
<section class="py-5 bg-white">
<div class="container py-4">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Todo lo que necesita tu negocio</h2>
        <p class="text-muted">Una plataforma, múltiples herramientas</p>
    </div>
    <div class="row g-4">
    <?php
    $features = [
        ['🔗','QR Dinámicos','Edita el destino de tu QR cuando quieras, sin reimprimir.'],
        ['📊','Analíticas','Cuántos escaneos, desde dónde, con qué dispositivo.'],
        ['🍽️','Menús digitales','Menús interactivos para restaurantes y cafeterías.'],
        ['📦','Catálogos','Muestra tus productos con fotos, precios y categorías.'],
        ['📋','Formularios','Captura leads, encuestas y pedidos desde el QR.'],
        ['🔒','Seguro','HTTPS, passwords en QR, fechas de expiración.'],
    ];
    foreach ($features as [$icon,$title,$desc]):
    ?>
    <div class="col-md-4">
        <div class="card border-0 h-100 p-2" style="border-radius:16px;background:#f8f9fa">
            <div class="card-body">
                <div style="font-size:36px"><?php echo $icon; ?></div>
                <h5 class="mt-2 fw-bold"><?php echo $title; ?></h5>
                <p class="text-muted mb-0"><?php echo $desc; ?></p>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    </div>
</div>
</section>

<!-- PLANES -->
<section id="planes" class="py-5" style="background:#f8f9fa">
<div class="container py-4">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Planes simples y transparentes</h2>
        <p class="text-muted">Empieza gratis. Escala cuando lo necesites.</p>
    </div>
    <div class="row g-4 justify-content-center">
    <?php foreach ($planes as $plan):
        $isFeatured = ($plan['id'] == 3);
    ?>
    <div class="col-md-3">
    <div class="card plan-card border-0 shadow-sm h-100 <?php echo $isFeatured ? 'featured' : ''; ?>">
    <div class="card-body p-4">
        <?php if ($isFeatured): ?>
        <div class="text-center mb-2">
            <span class="badge-popular">⭐ Más popular</span>
        </div>
        <?php endif; ?>
        <h5 class="fw-bold"><?php echo htmlspecialchars($plan['name']); ?></h5>
        <div class="my-3">
            <span style="font-size:2rem;font-weight:700">
                $<?php echo number_format($plan['price'],0); ?>
            </span>
            <span class="text-muted"> MXN/mes</span>
        </div>
        <ul class="list-unstyled text-muted" style="font-size:14px">
            <li class="mb-1">✅ <?php echo number_format($plan['qr_dynamic_limit']); ?> QR Dinámicos</li>
            <li class="mb-1">✅ <?php echo number_format($plan['scans_limit']); ?> escaneos/mes</li>
            <li class="mb-1">✅ <?php echo number_format($plan['collections_limit']); ?> catálogos</li>
            <li class="mb-1">✅ <?php echo number_format($plan['forms_limit']); ?> formularios</li>
        </ul>
        <a href="https://app.qlynk.mx/register"
           class="btn w-100 mt-3 <?php echo $isFeatured ? 'btn-dark' : 'btn-outline-dark'; ?>">
            <?php echo $plan['price'] == 0 ? 'Empezar gratis' : 'Elegir plan'; ?>
        </a>
    </div>
    </div>
    </div>
    <?php endforeach; ?>
    </div>
</div>
</section>

<!-- FOOTER -->
<footer class="py-4 text-center" style="background:#1a1a2e">
    <p class="mb-0" style="color:#666">
        © <?php echo date('Y'); ?> QLynk · Todos los derechos reservados
    </p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>