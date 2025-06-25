<?php
// session_start(); // Removido para evitar erro de headers
if (isset($_POST['status'])) {
    $_SESSION['status'] = $_POST['status'];
}
$status = $_SESSION['status'] ?? 'Disponível';
$statusClass = [
    'Disponível' => 'status-disponivel',
    'Ausente' => 'status-ausente',
    'Ocupado' => 'status-ocupado',
    'Offline' => 'status-offline',
][$status] ?? 'status-disponivel';
function renderSidebar($active = 'Atendimentos') {
    global $status, $statusClass;
    $items = [
        'Atendimentos' => [
            'url' => 'index.php?page=atendimentos',
            'icon' => '<svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>',
        ],
        'Contatos' => [
            'url' => 'index.php?page=contatos',
            'icon' => '<svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>',
        ],
        'Histórico' => [
            'url' => 'index.php?page=historico',
            'icon' => '<svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M3 3v5h5"/><path d="M3.05 13A9 9 0 1 0 6 5.3L3 8"/><path d="M12 7v5l4 2"/></svg>',
        ],
        'Configurações' => [
            'url' => 'index.php?page=configuracoes',
            'icon' => '<svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 7 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 5 15.61V15a1.65 1.65 0 0 0-1-1.51A1.65 1.65 0 0 0 3 12.09V12a2 2 0 0 1 0-4v.09A1.65 1.65 0 0 0 5 8.6c.29-.12.62-.15.93-.06.31.09.59.27.82.5.23.23.41.51.5.82.09.31.06.64-.06.93A1.65 1.65 0 0 0 7 8.6V8a2 2 0 0 1 4 0v.09c.31.09.64.06.93-.06.31-.09.59-.27.82-.5.23-.23.41-.51.5-.82.09-.31.06-.64-.06-.93A1.65 1.65 0 0 0 17 8.6V8a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0-1 1.51v.09c0 .31.06.64.06.93a1.65 1.65 0 0 0 .33 1.82z"/></svg>',
        ],
    ];
    echo '<aside class="sidebar">';
    echo '<div class="logo"><img src="https://img.freepik.com/vetores-gratis/vetor-de-design-de-gradiente-colorido-de-passaro_343694-2506.jpg?semt=ais_hybrid&w=740" alt="Logo"></div>';
    echo '<nav><ul class="sidebar-menu">';
    foreach ($items as $item => $data) {
        $class = ($item === $active) ? 'active' : '';
        echo '<li class="' . $class . '"><a href="' . $data['url'] . '" title="' . $item . '">' . $data['icon'] . '<span class="sidebar-label">' . $item . '</span></a></li>';
    }
    echo '</ul></nav>';
    echo '</aside>';
} 