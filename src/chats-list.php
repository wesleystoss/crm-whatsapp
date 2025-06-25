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
    echo '<h2>Conversas</h2><ul id="lista-contatos">';
    echo '<div class="chats-list-top" style="display:flex;align-items:center;gap:12px;margin:0 0 16px 0px;">';
    echo '<button id="novo-chat-btn" class="icon-btn" title="Novo Chat" style="display:flex;align-items:center;justify-content:center;width:38px;height:38px;background:var(--color1);border:none;border-radius:50%;color:#fff;font-size:1.5em;cursor:pointer;transition:background 0.2s;"><svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></button>';
    echo '<input type="text" id="filtro-contatos" class="filtro-contatos" placeholder="Filtrar contatos..." autocomplete="off" style="flex:1;max-width:160px;padding:9px 14px;border:1.5px solid var(--color3);border-radius:7px;font-size:1em;outline:none;transition:border 0.2s;" />';
    echo '</div>';
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