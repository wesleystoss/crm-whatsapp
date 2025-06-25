// Script para modal de novo chat
const btnNovoChat = document.getElementById('novo-chat-btn');
const modal = document.getElementById('modal-novo-chat');
const backdrop = document.getElementById('modal-backdrop');
const cancelarBtn = document.getElementById('cancelar-novo-chat');
const formNovoChat = document.getElementById('form-novo-chat');

// Filtro de contatos
const filtroInput = document.getElementById('filtro-contatos');
const listaContatos = document.getElementById('lista-contatos');

function abrirModal() {
    modal.classList.add('active');
    backdrop.classList.add('active');
    modal.style.display = 'flex';
    backdrop.style.display = 'block';
    setTimeout(() => {
        modal.classList.add('active');
        backdrop.classList.add('active');
    }, 10);
}
function fecharModal() {
    modal.classList.remove('active');
    backdrop.classList.remove('active');
    setTimeout(() => {
        modal.style.display = 'none';
        backdrop.style.display = 'none';
    }, 300);
}
if (btnNovoChat && modal && backdrop && cancelarBtn) {
    btnNovoChat.addEventListener('click', abrirModal);
    cancelarBtn.addEventListener('click', fecharModal);
    backdrop.addEventListener('click', fecharModal);
}
if (formNovoChat) {
    formNovoChat.addEventListener('submit', function(e) {
        e.preventDefault();
        const nome = document.getElementById('nome-contato').value.trim();
        const numero = document.getElementById('numero-contato').value.trim();
        if (nome && numero) {
            // Redireciona para a página de chat com o novo contato
            const params = new URLSearchParams({ page: 'atendimentos', chat: nome });
            window.location.href = 'index.php?' + params.toString() + '&novo=1&numero=' + encodeURIComponent(numero);
        }
    });
}
if (filtroInput && listaContatos) {
    filtroInput.addEventListener('input', function() {
        const termo = filtroInput.value.toLowerCase();
        const itens = listaContatos.querySelectorAll('li');
        itens.forEach(li => {
            const texto = li.textContent.toLowerCase();
            li.style.display = texto.includes(termo) ? '' : 'none';
        });
    });
} 