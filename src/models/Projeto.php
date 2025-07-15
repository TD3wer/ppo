<?php

class Projeto {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT p.*, u.nome AS orientador_nome, c.nome AS coorientador_nome FROM projetos p
            LEFT JOIN usuarios u ON p.orientador_id = u.id
            LEFT JOIN usuarios c ON p.coorientador_id = c.id
            ORDER BY p.id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM projetos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUsuariosPorTipo($tipo) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE tipo = ?");
        $stmt->execute([$tipo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($dados) {
        $nomeImagem = null;

        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            // Caminho absoluto baseado na pasta raiz do projeto
            $pastaUpload = __DIR__ . '/../../public/uploads/';

            // Garantir que a pasta exista
            if (!is_dir($pastaUpload)) {
                die("Pasta uploads não existe: " . $pastaUpload);
            }

            // Garantir permissão de escrita
            if (!is_writable($pastaUpload)) {
                die("Pasta uploads não tem permissão de escrita.");
            }

            // Gerar nome único para a imagem
            $nomeArquivo = basename($_FILES['imagem']['name']);
            $nomeImagem = uniqid('img_') . '_' . $nomeArquivo;

            // Mover o arquivo
            if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $pastaUpload . $nomeImagem)) {
                die("Erro ao mover imagem: " . $_FILES['imagem']['name']);
            }
        }

        $stmt = $this->pdo->prepare("
            INSERT INTO projetos 
            (titulo, subtitulo, descricao, orientador_id, coorientador_id, data_inicio, data_fim, status, imagem) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $dados['titulo'],
            $dados['subtitulo'] ?? '',
            $dados['descricao'] ?? '',
            $dados['orientador'] ?? null,
            $dados['coorientador'] ?? null,
            $dados['data_inicio'],
            $dados['data_fim'],
            $dados['status'],
            $nomeImagem
        ]);
    }

    public function update($id, $dados) {
        $nomeImagem = $dados['imagem_atual'] ?? null;

        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $pastaUpload = __DIR__ . '/../../public/uploads/';

            if (!is_dir($pastaUpload)) {
                die("Pasta uploads não existe: " . $pastaUpload);
            }

            if (!is_writable($pastaUpload)) {
                die("Pasta uploads não tem permissão de escrita.");
            }

            if (!empty($nomeImagem) && file_exists($pastaUpload . $nomeImagem)) {
                unlink($pastaUpload . $nomeImagem);
            }

            $nomeArquivo = basename($_FILES['imagem']['name']);
            $nomeImagem = uniqid('img_') . '_' . $nomeArquivo;

            if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $pastaUpload . $nomeImagem)) {
                die("Erro ao mover imagem: " . $_FILES['imagem']['name']);
            }
        }

        $stmt = $this->pdo->prepare("
            UPDATE projetos SET 
                titulo = ?, 
                subtitulo = ?, 
                descricao = ?, 
                orientador_id = ?, 
                coorientador_id = ?, 
                data_inicio = ?, 
                data_fim = ?, 
                status = ?, 
                imagem = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $dados['titulo'],
            $dados['subtitulo'] ?? '',
            $dados['descricao'] ?? '',
            $dados['orientador'] ?? null,
            $dados['coorientador'] ?? null,
            $dados['data_inicio'],
            $dados['data_fim'],
            $dados['status'],
            $nomeImagem,
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM projetos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}