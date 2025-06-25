<?php
session_start();
require_once __DIR__ . '/../src/layout.php';
require_once __DIR__ . '/../src/sidebar.php';
require_once __DIR__ . '/../src/header.php';
require_once __DIR__ . '/../src/chats-list.php';
require_once __DIR__ . '/../src/chat-window.php';

$operador = 'João Silva';
$page = $_GET['page'] ?? 'atendimentos';

// Simulação de dados
$chats = ['Cliente 1', 'Cliente 2', 'Cliente 3'];
if (!isset($_SESSION['messages'])) {
    $_SESSION['messages'] = [
        'Cliente 1' => [
            ['text' => 'Olá, preciso de ajuda!', 'sent' => false],
            ['text' => 'Olá! Como posso ajudar?', 'sent' => true],
        ],
        'Cliente 2' => [
            ['text' => 'Bom dia!', 'sent' => false],
            ['text' => 'Bom dia, em que posso ajudar?', 'sent' => true],
        ],
        'Cliente 3' => [
            ['text' => 'Oi, tem promoção?', 'sent' => false],
            ['text' => 'Temos sim! Quer saber mais?', 'sent' => true],
        ],
    ];
}
$activeChat = $_GET['chat'] ?? $chats[0];

// Envio de mensagem
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nova_mensagem']) && isset($_POST['mensagem'])) {
    $msg = trim($_POST['mensagem']);
    if ($msg !== '') {
        $_SESSION['messages'][$activeChat][] = ['text' => $msg, 'sent' => true];
        // Simula resposta automática
        $_SESSION['messages'][$activeChat][] = ['text' => 'Recebido: ' . $msg, 'sent' => false];
    }
    header('Location: index.php?page=atendimentos&chat=' . urlencode($activeChat));
    exit;
}

ob_start();
echo '<div class="container">';
renderSidebar(ucfirst($page));
echo '<main class="main-content">';
renderHeader($operador);
echo '<section class="desk-area">';
if ($page === 'atendimentos') {
    renderChatsList($chats, $activeChat);
    renderChatWindow($activeChat, $_SESSION['messages'][$activeChat]);
} elseif ($page === 'contatos') {
    echo '<div style="padding:32px;"><h2>Contatos</h2><p>Lista de contatos em breve...</p></div>';
} elseif ($page === 'historico') {
    echo '<div style="padding:32px;"><h2>Histórico</h2><p>Histórico de atendimentos em breve...</p></div>';
} elseif ($page === 'configuracoes') {
    echo '<div style="padding:32px;"><h2>Configurações</h2><p>Configurações do sistema em breve...</p></div>';
}
echo '</section>';
echo '</main>';
echo '</div>';
$content = ob_get_clean();

renderLayout('CRM Atendimento WhatsApp', $content);

