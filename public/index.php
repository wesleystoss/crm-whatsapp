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
if (!isset($_SESSION['clientes'])) {
    $_SESSION['clientes'] = [
        'Cliente 1' => [
            'id' => 'cliente1',
            'nome' => 'Cliente 1',
            'whatsapp' => '+55 11 91234-5678',
            'ticket' => '23233',
        ],
        'Cliente 2' => [
            'id' => 'cliente2',
            'nome' => 'Cliente 2',
            'whatsapp' => '+55 21 99876-5432',
            'ticket' => '23234',
        ],
        'Cliente 3' => [
            'id' => 'cliente3',
            'nome' => 'Cliente 3',
            'whatsapp' => '+55 31 98765-4321',
            'ticket' => '23235',
        ],
    ];
}
$clientes = $_SESSION['clientes'];
$chats = array_keys($clientes);
if (!isset($_SESSION['messages'])) {
    $_SESSION['messages'] = [
        'Cliente 1' => [
            ['text' => 'Olá, preciso de ajuda!', 'sent' => false, 'hora' => '09:00'],
            ['text' => 'Olá! Como posso ajudar?', 'sent' => true, 'operador' => $operador, 'hora' => '09:01', 'lida' => true],
        ],
        'Cliente 2' => [
            ['text' => 'Bom dia!', 'sent' => false, 'hora' => '10:00'],
            ['text' => 'Bom dia, em que posso ajudar?', 'sent' => true, 'operador' => $operador, 'hora' => '10:01', 'lida' => true],
        ],
        'Cliente 3' => [
            ['text' => 'Oi, tem promoção?', 'sent' => false, 'hora' => '11:00'],
            ['text' => 'Temos sim! Quer saber mais?', 'sent' => true, 'operador' => $operador, 'hora' => '11:01', 'lida' => true],
        ],
    ];
}
$activeChat = $_GET['chat'] ?? $chats[0];

// Criação de novo chat
if (isset($_GET['novo']) && $_GET['novo'] == '1' && !empty($_GET['chat']) && !empty($_GET['numero'])) {
    $novoNome = trim($_GET['chat']);
    $novoNumero = trim($_GET['numero']);
    if (!isset($clientes[$novoNome])) {
        $novoId = 'cliente' . (count($clientes) + 1);
        $clientes[$novoNome] = [
            'id' => $novoId,
            'nome' => $novoNome,
            'whatsapp' => $novoNumero,
            'ticket' => rand(10000, 99999),
        ];
        $_SESSION['clientes'] = $clientes;
        if (!isset($_SESSION['messages'][$novoNome])) {
            $_SESSION['messages'][$novoNome] = [
                ['text' => 'Novo chat criado para ' . $novoNome . '.', 'sent' => false, 'hora' => date('H:i')]
            ];
        }
    }
    $activeChat = $novoNome;
}

// Envio de mensagem
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nova_mensagem']) && isset($_POST['mensagem'])) {
    $msg = trim($_POST['mensagem']);
    if ($msg !== '') {
        $hora = date('H:i');
        // Marca todas as mensagens anteriores como não lidas
        foreach ($_SESSION['messages'][$activeChat] as &$m) {
            if (!empty($m['sent'])) {
                $m['lida'] = false;
            }
        }
        unset($m);
        // Nova mensagem enviada é marcada como lida
        $_SESSION['messages'][$activeChat][] = ['text' => $msg, 'sent' => true, 'operador' => $operador, 'hora' => $hora, 'lida' => true];
        // Simula resposta automática
        $_SESSION['messages'][$activeChat][] = ['text' => 'Recebido: ' . $msg, 'sent' => false, 'hora' => $hora];
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
    echo '<div id="modal-novo-chat" class="modal-novo-chat" style="display:none;">
        <div class="modal-content-novo-chat">
            <h2>Novo Chat</h2>
            <form id="form-novo-chat" method="post" autocomplete="off">
                <label for="nome-contato">Nome do contato:</label>
                <input type="text" id="nome-contato" name="nome-contato" required />
                <label for="numero-contato">Número (WhatsApp):</label>
                <input type="text" id="numero-contato" name="numero-contato" required />
                <div class="modal-actions">
                    <button type="submit">Criar Chat</button>
                    <button type="button" id="cancelar-novo-chat">Cancelar</button>
                </div>
            </form>
        </div>
    </div>';
    renderChatsList($clientes, $activeChat);
    renderChatWindow($clientes[$activeChat], $_SESSION['messages'][$activeChat]);
    echo '<div id="modal-backdrop" class="modal-backdrop" style="display:none;"></div>';
    echo '<script src="/assets/novo-chat.js"></script>';
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

