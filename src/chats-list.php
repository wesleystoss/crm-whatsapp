<?php
function renderChatsList($clientes, $activeChat) {
    echo '<div class="chats-list">';
    echo '<h2>Conversas</h2><ul>';
    foreach ($clientes as $chatId => $cliente) {
        $class = ($chatId === $activeChat) ? 'chat active' : 'chat';
        $url = 'index.php?page=atendimentos&chat=' . urlencode($chatId);
        $whatsapp = isset($cliente['whatsapp']) ? ' <span style="color:#25d366;font-size:0.95em;">(' . htmlspecialchars($cliente['whatsapp']) . ')</span>' : '';
        echo "<li class=\"$class\"><a href=\"$url\">{$cliente['nome']}$whatsapp</a></li>";
    }
    echo '</ul></div>';
} 