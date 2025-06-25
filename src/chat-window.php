<?php
function renderChatWindow($cliente, $messages) {
    $ticket = $cliente['ticket'] ?? '00000';
    $whatsapp = $cliente['whatsapp'] ?? '';
    $nome = $cliente['nome'] ?? $cliente;
    $canalIcon = '<img src="/assets/whatsapp.svg" alt="WhatsApp" style="width:20px;vertical-align:middle;margin-right:6px;">';
    $canalNome = 'WhatsApp';
    echo '<div class="chat-window">';
    echo '<div class="chat-header">';
    echo $canalIcon . ' Atendimento com <strong>' . htmlspecialchars($nome) . '</strong> (Ticket #' . $ticket . ')';
    if ($whatsapp) {
        echo ' <span style="margin-left:12px;color:#25d366;font-weight:500;">WhatsApp: ' . htmlspecialchars($whatsapp) . '</span>';
    }
    echo '</div>';
    echo '<div class="messages whatsapp-bg">';
    foreach ($messages as $msg) {
        $class = $msg['sent'] ? 'message sent' : 'message received';
        echo '<div class="' . $class . '">' . htmlspecialchars($msg['text']) . '</div>';
    }
    echo '</div>';
    echo '<form class="message-form" method="post" action="?page=atendimentos&chat=' . urlencode($nome) . '">';
    echo '<input type="text" name="mensagem" placeholder="Digite sua mensagem..." autocomplete="off" required />';
    echo '<button type="submit" name="nova_mensagem">Enviar</button>';
    echo '</form>';
    echo '</div>';
} 