<?php
function renderChatsList($chats, $activeChat) {
    echo '<div class="chats-list">';
    echo '<h2>Conversas</h2><ul>';
    foreach ($chats as $chat) {
        $class = ($chat === $activeChat) ? 'chat active' : 'chat';
        $url = 'index.php?page=atendimentos&chat=' . urlencode($chat);
        echo "<li class=\"$class\"><a href=\"$url\">$chat</a></li>";
    }
    echo '</ul></div>';
} 