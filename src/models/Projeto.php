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
        // Upload da imagem
        $nomeImagem = null;
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $pastaUpload = '../public/uploads/';
            $nomeImagem = uniqid('img_') . '_' . basename($_FILES['imagem']['name']);
            move_uploaded_file($_FILES['imagem']['tmp_name'], $pastaUpload . $nomeImagem);
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
        // Upload da imagem
        $nomeImagem = $dados['imagem_atual'] ?? null;
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $pastaUpload = '../public/uploads/';

            if (!empty($nomeImagem) && file_exists($pastaUpload . $nomeImagem)) {
                unlink($pastaUpload . $nomeImagem);
            }

            $nomeImagem = uniqid('img_') . '_' . basename($_FILES['imagem']['name']);
            move_uploaded_file($_FILES['imagem']['tmp_name'], $pastaUpload . $nomeImagem);
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