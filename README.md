# Desenvolvimento de Aplicações Web - Trabalho de Grupo 2: Fase de Implementação

## Configuração

### Base de dados
Nome da base de dados: `dawtg2`

Configurar em `DB_DATABASE` no ficheiro `.env`

### API do Metro de Lisboa
É necessário adicionar um *token* à variável de sistema `METRO_LISBOA_TOKEN`
para que a aplicação *web* funcione corretamente. Antes de executar os *seeders*,
é necessário configurar o *token* primeiro.

### Carregar dependênciais
Executar os seguintes:
- `composer update`
- `npm i`

### Seeders e migrations
Executar os seguintes:
- `php artisan migrate`
- `php artisan db:seed`

O seeder contactará a API do Metro de Lisboa para obter dados das linhas, 
estações e destinos e guardá-los na base de dados.

### Executar o projeto
Executar os seguintes (em terminais à parte):
- `npm run dev`
- `php artisan serve`

A conta admin criada por defeito tem as seguintes credenciais:
- E-mail: `jose20fernandes03@admin.com`
- Password: `admin123`
