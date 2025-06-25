<?php
function renderChatWindow($cliente, $messages) {
    // Exemplos de avatares gratuitos
    $avatares = [
        'cliente1' => 'https://randomuser.me/api/portraits/men/32.jpg',
        'cliente2' => 'https://randomuser.me/api/portraits/women/44.jpg',
        'cliente3' => 'https://randomuser.me/api/portraits/men/65.jpg',
        'cliente4' => 'https://randomuser.me/api/portraits/women/68.jpg',
    ];
    $ticket = $cliente['ticket'] ?? '00000';
    $whatsapp = $cliente['whatsapp'] ?? '';
    $nome = $cliente['nome'] ?? $cliente;
    $canalIcon = '<img src="/assets/whatsapp.svg" alt="WhatsApp" style="width:20px;vertical-align:middle;margin-right:6px;">';
    $canalNome = 'WhatsApp';
    echo '<div class="chat-window">';
    echo '<div class="chat-header" style="display:flex;align-items:center;gap:12px;padding:10px 16px;background:#075e54;color:#fff;">';
    // Definir avatar baseado no nome ou id do cliente
    $fotoPerfil = $cliente['foto'] ?? $avatares[$cliente['id'] ?? 'cliente1'] ?? '/assets/user-placeholder.png';
    echo '<img src="' . htmlspecialchars($fotoPerfil) . '" alt="Foto do usuário" style="width:40px;height:40px;border-radius:50%;object-fit:cover;border:2px solid #25d366;">';
    // Nome e número
    echo '<div style="display:flex;flex-direction:column;gap:2px;">';
    echo '<span style="font-weight:600;font-size:1.1em;">' . htmlspecialchars($nome) . '</span>';
    if ($whatsapp) {
        echo '<span style="font-size:0.97em;color:#e0e0e0;">' . htmlspecialchars($whatsapp) . '</span>';
    }
    echo '</div>';
    // Ticket à direita
    echo '<div style="margin-left:auto;font-size:0.93em;color:#b2dfdb;">Ticket #' . $ticket . '</div>';
    echo '</div>';
    echo '<div class="messages whatsapp-bg">';
    foreach ($messages as $msg) {
        $class = $msg['sent'] ? 'message sent' : 'message received';
        if (!empty($msg['sent'])) {
            $operador = $msg['operador'] ?? '';
            if ($operador) {
                echo '<div class="' . $class . '"><div><span style="font-weight:bold;">' . htmlspecialchars($operador) . ':</span></div><div>' . htmlspecialchars($msg['text']) . '</div></div>';
            } else {
                echo '<div class="' . $class . '">' . htmlspecialchars($msg['text']) . '</div>';
            }
        } else {
            echo '<div class="' . $class . '">' . htmlspecialchars($msg['text']) . '</div>';
        }
    }
    echo '</div>';
    echo '<form class="message-form" method="post" action="?page=atendimentos&chat=' . urlencode($nome) . '">';
    echo '<input type="text" name="mensagem" placeholder="Digite sua mensagem..." autocomplete="off" required />';
    echo '<button type="submit" name="nova_mensagem">Enviar</button>';
    echo '</form>';
    echo '</div>';
} 