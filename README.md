# CRM Atendimento WhatsApp

Sistema de atendimento ao cliente via WhatsApp, inspirado no Blip Desk, com navegação otimizada para operadores e interface personalizada.

## Objetivo
Prover uma experiência completa de atendimento ao cliente via WhatsApp, focando inicialmente no front-end do operador.

## Tecnologias
- PHP 8.1
- Apache (via Docker)
- Composer

## Como rodar localmente
1. Certifique-se de ter o Docker instalado.
2. No terminal, execute:
   ```sh
   docker-compose up --build
   ```
3. Acesse [http://localhost:8080](http://localhost:8080) no navegador.

## Estrutura de Diretórios
- `public/` - Ponto de entrada do sistema (index.php)
- `src/` - Código-fonte principal
- `app/` - Lógica de aplicação
- `config/` - Arquivos de configuração
- `resources/` - Recursos estáticos (imagens, scripts, etc.)
- `views/` - Templates de visualização

## Deploy na Hostinger
1. Faça upload de todos os arquivos para o diretório `public_html` da sua hospedagem.
2. Certifique-se de que o arquivo `.htaccess` está presente na pasta `public` (ou na raiz, conforme estrutura da hospedagem).
3. Aponte o domínio para a pasta `public` ou mova o conteúdo dela para `public_html`.
4. O PHP mínimo recomendado é 8.1.
5. Recomenda-se ativar o mod_rewrite no painel da Hostinger.

---
Projeto em desenvolvimento. Foco inicial: experiência do operador no atendimento. 