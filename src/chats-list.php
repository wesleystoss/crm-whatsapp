<?php
function renderChatsList($clientes, $activeChat) {
    // Garante que cada cliente tenha um id único baseado na chave do array
    foreach ($clientes as $chatId => &$cliente) {
        if (!isset($cliente['id'])) {
            $cliente['id'] = $chatId;
        }
    }
    unset($cliente);
    echo '<div class="chats-list">';
    echo '<h2>Conversas</h2><ul>';
    foreach ($clientes as $chatId => $cliente) {
        $class = ($chatId === $activeChat) ? 'chat active' : 'chat';
        $url = 'index.php?page=atendimentos&chat=' . urlencode($chatId);
        $whatsapp = isset($cliente['whatsapp']) ? $cliente['whatsapp'] : '';
        echo "<li class=\"$class\"><a href=\"$url\"><div style='font-weight:600;'>" . htmlspecialchars($cliente['nome']) . "</div>";
        if ($whatsapp) {
            echo "<div style='font-size:0.97em;'>" . htmlspecialchars($whatsapp) . "</div>";
        }
        echo "</a></li>";
    }
    echo '</ul></div>';
} 