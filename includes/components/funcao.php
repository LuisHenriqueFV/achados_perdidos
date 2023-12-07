<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;



function cadastra_objeto($nome, $descricao, $local, $data, $categoria, $tipo, $imagem, $codpessoa, $pdo)
{
    $sql = "INSERT INTO objeto (nome, descricao, local, data, categoria, tipo, imagem, codpessoa) 
            VALUES (:nome, :descricao, :local, :data, :categoria, :tipo, :imagem, :codpessoa)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':local', $local);
    $stmt->bindParam(':data', $data);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':imagem', $imagem);
    $stmt->bindParam(':codpessoa', $codpessoa);

    $stmt->execute();
}

function pesquisa_objeto($nome, $categoria, $tipo, $pdo)
{
    $sql = "SELECT * FROM objeto WHERE nome LIKE :nome";

    if (!empty($categoria)) {
        $sql .= " AND categoria = :categoria";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nome', '%' . $nome . '%', PDO::PARAM_STR);

    if (!empty($categoria)) {
        $stmt->bindValue(':categoria', $categoria, PDO::PARAM_STR);
    }

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



function obter_categorias($pdo)
{
    try {
        $sql = "SELECT * FROM categoria";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erro ao obter categorias: " . $e->getMessage();
        return null;
    }
}





function cadastra_categoria($nomeCategoria, $pdo)
{
    try {
        $stmt = $pdo->prepare("INSERT INTO categoria (nome) VALUES (?)");
        $stmt->execute([$nomeCategoria]);
        return true;
    } catch (PDOException $e) {
        echo "Erro ao cadastrar categoria: " . $e->getMessage();
        return false;
    }
}



function exclui_categoria($categoria_id, $pdo)
{
    try {
        $stmt = $pdo->prepare("DELETE FROM categorias WHERE id = :categoria_id");
        $stmt->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        error_log("Erro ao excluir categoria no banco de dados: " . $e->getMessage());
        return false;
    }
}



function atualizar_objeto($objetoId, $novoNome, $novaDescricao, $novoLocal, $novaData, $caminhoArquivo, $novaCategoria, $pdo)
{
    try {
        $stmt = $pdo->prepare('UPDATE objeto SET nome = :nome, descricao = :descricao, local = :local, data = :data, imagem = :imagem, categoria = :categoria WHERE id = :id');

        $stmt->bindParam(':nome', $novoNome, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $novaDescricao, PDO::PARAM_STR);
        $stmt->bindParam(':local', $novoLocal, PDO::PARAM_STR);
        $stmt->bindParam(':data', $novaData, PDO::PARAM_STR);
        $stmt->bindParam(':imagem', $caminhoArquivo, PDO::PARAM_STR);
        $stmt->bindParam(':categoria', $novaCategoria, PDO::PARAM_STR);
        $stmt->bindParam(':id', $objetoId, PDO::PARAM_INT);

        $stmt->execute();
    } catch (PDOException $e) {
        die('Erro ao atualizar objeto: ' . $e->getMessage());
    }
}
function obter_objeto_por_id($objetoId, $pdo)
{
    try {
        $stmt = $pdo->prepare('SELECT * FROM objeto WHERE id = :id');
        $stmt->bindParam(':id', $objetoId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die('Erro ao obter objeto por ID: ' . $e->getMessage());
    }
}

function obter_cards_do_banco($pdo)
{
    $stmt = $pdo->prepare("SELECT * FROM objeto");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



function pesquisa_pessoa_por_id($codpessoa, $pdo)
{
    $pessoa = $pdo->prepare('select * from pessoa where codpessoa = :codpessoa');
    $pessoa->bindValue(':codpessoa', $codpessoa);
    $pessoa->execute();

    return $pessoa->fetch();

}




function verifica_administrador($userId, $pdo)
{
    $stmt = $pdo->prepare('SELECT * FROM pessoa WHERE codpessoa = :userId AND adm = 1');
    $stmt->bindValue(':userId', $userId);
    $stmt->execute();

    return $stmt->rowCount() === 1;
}



function verificaCodigo($email, $codigo, $pdo)
{
    $stmt = $pdo->prepare("SELECT * FROM pessoa WHERE email = :email AND codigo_verificacao = :codigo");
    $stmt->execute(['email' => $email, 'codigo' => $codigo]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    return ($usuario !== false);
}



function envia_email($email)
{
    require "PHPMailer/src/PHPMailer.php";
    require "PHPMailer/src/SMTP.php";
    require "PHPMailer/src/Exception.php";

    $assunto = "Acesso realizado!";
    $mensagem = "Você acessou a plataforma de cadastro de pessoa!";

    $mail = new PHPMailer();

    $mail->isSMTP();

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;

    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPOptions = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ]
    ];
    $mail->Username = 'luishenriquefonsecaphp@gmail.com';
    $mail->Password = 'wkgpoufbcedqvwgh';

    $mail->setFrom('luishenriquefonsecaphp@gmail.com', 'Adm Site');

    $mail->addAddress($email);

    $mail->CharSet = "utf-8";

    $mail->Subject = $assunto;

    $mail->Body = $mensagem;

    $mail->isHTML(true);

    $mail->send();
}


function buscaUtilizador($user, $hash, $pdo)
{


    $utilizador = $pdo->prepare('select * from recuperacao where utilizador = :user  and chave  = :hash');

    $utilizador->bindParam(':user', $user, PDO::PARAM_STR);
    $utilizador->bindParam(':hash', $hash, PDO::PARAM_STR);
    $utilizador->execute();

    if ($utilizador->rowCount() == 0) {
        return false;
    } else {
        return $utilizador->fetchAll();
    }

}

function cadastra_historia($relato, $pdo)
{
    try {
        $stmt = $pdo->prepare("INSERT INTO historia (relato) VALUES (?)");
        $stmt->execute([$relato]);
        return true;
    } catch (PDOException $e) {
        error_log("Erro ao cadastrar história no banco de dados: " . $e->getMessage());
        return false;
    }
}



function obter_historias($pdo)
{
    try {
        $stmt = $pdo->prepare("SELECT * FROM historia");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erro ao obter histórias do banco de dados: " . $e->getMessage());
        return false;
    }
}



function exclui_historia($historia_id, $pdo)
{
    try {
        $stmt = $pdo->prepare("DELETE FROM historia WHERE id = :id");

        $stmt->bindParam(':id', $historia_id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        error_log("Erro ao excluir história: " . $e->getMessage());
        return false;
    }
}


function atualiza_historia($relato, $novo_relato, $pdo)
{
    try {
        $stmt = $pdo->prepare("UPDATE historia SET relato = :novo_relato WHERE id = :relato_id");
        $stmt->bindParam(':novo_relato', $novo_relato, PDO::PARAM_STR);
        $stmt->bindParam(':relato_id', $relato, PDO::PARAM_INT);

        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("Erro ao atualizar história no banco de dados: " . $e->getMessage());
        return false;
    }
}

function atualizaInfo($nome, $email, $senhaHash, $cep, $bairro, $logradouro, $cidade, $userId, $pdo)
{
    $atualizaInfo = $pdo->prepare('UPDATE pessoa SET nome = ?, email = ?, senha = ?, cep = ?, bairro = ?, logradouro = ?, cidade = ? WHERE codpessoa = ?');
    $atualizaInfo->execute([$nome, $email, $senhaHash, $cep, $bairro, $logradouro, $cidade, $userId]);

    $consulta = $pdo->prepare('SELECT * FROM pessoa WHERE codpessoa = ?');
    $consulta->execute([$userId]);
    $usuario = $consulta->fetch();

    return $usuario;
}


?>