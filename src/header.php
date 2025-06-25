<?php
function renderHeader($operador = 'João Silva') {
    $status = $_SESSION['status'] ?? 'Disponível';
    $statusClass = [
        'Disponível' => 'status-disponivel',
        'Ausente' => 'status-ausente',
        'Ocupado' => 'status-ocupado',
        'Offline' => 'status-offline',
    ][$status] ?? 'status-disponivel';
    $statusOptions = [
        'Disponível' => '🟢 Disponível',
        'Ausente' => '🟡 Ausente',
        'Ocupado' => '🔴 Ocupado',
        'Offline' => '⚫ Offline',
    ];
    echo '<header class="header">';
    echo '<div class="user-info" style="display:flex;align-items:center;gap:18px;">';
    echo '<span>Operador: <strong>' . htmlspecialchars($operador) . '</strong></span>';
    echo '<form method="post" class="status-form" style="margin:0;gap:4px;flex-direction:row;align-items:center;">';
    echo '<label for="status" style="margin:0 6px 0 0;">Status:</label>';
    echo '<select name="status" id="status" class="' . $statusClass . '" onchange="this.form.submit()">';
    foreach ($statusOptions as $opt => $label) {
        $selected = ($status === $opt) ? 'selected' : '';
        echo "<option value=\"$opt\" $selected>$label</option>";
    }
    echo '</select>';
    echo '</form>';
    echo '</div>';
    echo '<div class="actions"><button>Sair</button></div>';
    echo '</header>';
} 