<?php
function renderChatWindow($cliente, $messages) {
    // Gera um número de ticket fixo por cliente para simulação
    $ticketNumbers = [
        'Cliente 1' => '23233',
        'Cliente 2' => '23234',
        'Cliente 3' => '23235',
    ];
    $ticket = $ticketNumbers[$cliente] ?? '00000';
    $canalIcon = '<img src="/assets/whatsapp.svg" alt="WhatsApp" style="width:20px;vertical-align:middle;margin-right:6px;">';
    $canalNome = 'WhatsApp';
    echo '<div class="chat-window">';
    echo '<div class="chat-header">';
    echo $canalIcon . ' Atendimento com <strong>' . htmlspecialchars($cliente) . '</strong> (Ticket #' . $ticket . ') <span style="margin-left:12px;color:#25d366;font-weight:500;">' . $canalNome . '</span>';
    echo '</div>';
    echo '<div class="messages whatsapp-bg">';
    foreach ($messages as $msg) {
        $class = $msg['sent'] ? 'message sent' : 'message received';
        echo '<div class="' . $class . '">' . htmlspecialchars($msg['text']) . '</div>';
    }
    echo '</div>';
    echo '<form class="message-form" method="post" action="?page=atendimentos&chat=' . urlencode($cliente) . '">';
    echo '<input type="text" name="mensagem" placeholder="Digite sua mensagem..." autocomplete="off" required />';
    echo '<button type="submit" name="nova_mensagem">Enviar</button>';
    echo '</form>';
    echo '</div>';
} 