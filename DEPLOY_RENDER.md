# Deploy no Render (PHP + MySQL)

## 1) Preparar repositorio

Este projeto ja esta preparado com:

- `Dockerfile`
- `render.yaml`
- conexao MySQL por variaveis de ambiente em `config/conexao.php`

## 2) Subir para GitHub

Publique este projeto em um repositorio no GitHub.

## 3) Criar Web Service no Render

1. Acesse o dashboard do Render.
2. Clique em `New` -> `Web Service`.
3. Conecte seu repositorio.
4. Render vai detectar o `render.yaml`.
5. Confirme o deploy.

## 4) Configurar banco MySQL

Voce tem duas opcoes:

- Opcao A: rodar um MySQL no proprio Render (servico privado)
- Opcao B: usar MySQL externo (Railway, PlanetScale, Aiven, etc.)

No Web Service, preencha as variaveis:

- `DB_HOST`
- `DB_PORT` (normalmente `3306`)
- `DB_USER`
- `DB_PASSWORD`
- `DB_NAME`

## 5) Criar tabela no banco

Execute este SQL no seu banco:

```sql
CREATE TABLE IF NOT EXISTS clientes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  telefone VARCHAR(50) NOT NULL
);
```

## 6) Validar deploy

1. Abra a URL `onrender.com` do seu Web Service.
2. Teste cadastro, listagem, edicao e exclusao.
3. Se houver erro de banco, revise as variaveis de ambiente.
