<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


function cadastra_objeto_perdido($nome, $descricao, $local, $data, $pdo)
{
    try {
        $stmt = $pdo->prepare("INSERT INTO objetos_perdidos (nome, descricao, local, data) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome, $descricao, $local, $data]);
        return true;
    } catch (PDOException $e) {
        echo "Erro ao cadastrar objeto perdido: " . $e->getMessage();
        return false;
    }
}
function cadastra_objeto_encontrado($nome, $descricao, $local, $data, $categoria, $imagem, $pdo)
{
    try {
        $sql = "INSERT INTO objetos_encontrados (nome, descricao, local, data, categoria) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $descricao, $local, $data, $categoria]);
    } catch (PDOException $e) {
        // Trate os erros de inserção
        error_log("Erro ao cadastrar objeto encontrado: " . $e->getMessage());
        // Você pode lançar uma exceção, retornar um código de erro, ou tomar outra ação apropriada aqui.
    }
}

function pesquisa_objeto_perdido($nome, $pdo)
{
    try {
        $stmt = $pdo->prepare("SELECT * FROM objetos_perdidos WHERE nome LIKE ?");
        $stmt->execute(["%$nome%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erro na pesquisa: " . $e->getMessage();
        return null;
    }
}

function pesquisa_objeto_encontrado($nome, $categoria, $pdo)
{
    $query = "SELECT * FROM objetos_encontrados WHERE nome LIKE :nome";

    if (!empty($categoria)) {
        $query .= " AND categoria = :categoria";
    }

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':nome', '%' . $nome . '%', PDO::PARAM_STR);

    if (!empty($categoria)) {
        $stmt->bindValue(':categoria', $categoria, PDO::PARAM_STR);
    }

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function obter_objetos_encontrados_por_categoria($categoria, $pdo)
{
    $stmt = $pdo->prepare("SELECT * FROM objetos_encontrados WHERE categoria = :categoria");
    $stmt->execute([':categoria' => $categoria]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function obter_categorias($pdo)
{
    try {
        $stmt = $pdo->query("SELECT * FROM categoria");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erro ao obter categorias: " . $e->getMessage();
        return null;
    }
}
function obter_categoria_por_id($categoria_id, $pdo)
{
    try {
        $query = "SELECT * FROM categorias WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $categoria_id, PDO::PARAM_INT);
        $stmt->execute();

        // Retorna a categoria encontrada
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Em caso de erro, você pode tratar ou registrar o erro conforme necessário
        error_log("Erro ao obter categoria por ID: " . $e->getMessage());
        return false;
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

function valida_login($email, $senha, $pdo)
{
    $login = $pdo->prepare('SELECT * from pessoa WHERE email = :email and senha = :senha');
    $login->bindValue(':email', $email);
    $login->bindValue(':senha', $senha);
    $login->execute();

    if ($login->rowCount() === 1) {
        return true;
    } else {
        return false;
    }
}

function cadastra_pessoa($nome, $email, $cpf, $senha, $pdo)
{
    $pesquisaDuplicacaoPessoa = $pdo->prepare('select * from pessoa where cpf = :cpf or email = :email');
    $pesquisaDuplicacaoPessoa->bindValue(':cpf', $cpf);
    $pesquisaDuplicacaoPessoa->bindValue(':email', $email);
    $pesquisaDuplicacaoPessoa->execute();

    if ($pesquisaDuplicacaoPessoa->rowCount() === 0) {
        $password_hash = password_hash($senha, PASSWORD_DEFAULT);

        $cadastra_pessoa = $pdo->prepare('insert into pessoa (nome, cpf, email, senha) values (:nome, :cpf, :email, :senha)');
        $cadastra_pessoa->bindValue(':nome', $nome);
        $cadastra_pessoa->bindValue(':cpf', $cpf);
        $cadastra_pessoa->bindValue(':email', $email);
        $cadastra_pessoa->bindValue(':senha', $password_hash);
        $cadastra_pessoa->execute();

        return true;
    } else {
        return false;
    }
}

function obter_objetos_perdidos($pdo)
{
    try {
        $stmt = $pdo->query('SELECT * FROM objetos_perdidos');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {

        die('Erro ao obter objetos perdidos: ' . $e->getMessage());
    }
}

function obter_objetos_encontrados($pdo)
{
    try {
        $stmt = $pdo->query('SELECT * FROM objetos_encontrados');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {

        die('Erro ao obter objetos encontrados: ' . $e->getMessage());
    }
}

function pesquisa_pessoa($nome, $pdo)
{
    $pessoa = $pdo->prepare('select * from pessoa where nome like :nome"%" and adm = 0 order by nome asc');
    $pessoa->bindValue(':nome', $nome);
    $pessoa->execute();

    if ($pessoa->rowCount() === 0) {
        return false;
    } else {
        return $pessoa->fetchAll();
    }
}

function exclui_usuario($codpessoa, $pdo)
{
    $exclui_usuario = $pdo->prepare('delete from pessoa where codpessoa = :codpessoa');
    $exclui_usuario->bindValue(':codpessoa', $codpessoa);
    $exclui_usuario->execute();

    return true;
}

function seleciona_pessoa($codpessoa, $pdo)
{
    $pessoa = $pdo->prepare('select * from pessoa where codpessoa = :codpessoa');
    $pessoa->bindValue(':codpessoa', $codpessoa);
    $pessoa->execute();

    return $pessoa->fetch();
}

function verifica_administrador($email, $pdo)
{
    $stmt = $pdo->prepare('SELECT * FROM pessoa WHERE email = :email AND adm = 1');
    $stmt->bindValue(':email', $email);
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


function edita_pessoa($codpessoa, $nome, $cpf, $email, $pdo)
{
    $pesquisaDuplicacaoPessoa = $pdo->prepare('select * from pessoa where (cpf = :cpf or email = :email) and codpessoa != :codpessoa');
    $pesquisaDuplicacaoPessoa->bindValue(':cpf', $cpf);
    $pesquisaDuplicacaoPessoa->bindValue(':email', $email);
    $pesquisaDuplicacaoPessoa->bindValue(':codpessoa', $codpessoa);
    $pesquisaDuplicacaoPessoa->execute();

    if ($pesquisaDuplicacaoPessoa->rowCount() === 0) {
        $edita_pessoa = $pdo->prepare('update pessoa set nome = :nome, cpf = :cpf, email = :email where codpessoa = :codpessoa');
        $edita_pessoa->bindValue(':nome', $nome);
        $edita_pessoa->bindValue(':cpf', $cpf);
        $edita_pessoa->bindValue(':email', $email);
        $edita_pessoa->bindValue(':codpessoa', $codpessoa);
        $edita_pessoa->execute();

        return true;
    } else {
        return false;
    }
}
function obter_hash_da_senha($email, $pdo)
{
    $sql = "SELECT senha FROM pessoa WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && isset($result['senha'])) {
        return $result['senha'];
    } else {
        return null;
    }
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
function envia_emailRecuperacaoSenha($email, $token)
{
    require "PHPMailer/src/PHPMailer.php";
    require "PHPMailer/src/SMTP.php";
    require "PHPMailer/src/Exception.php";

    $assunto = "Recuperação de Senha";
    $mensagem = "Clique no link a seguir para redefinir sua senha: $token";

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

    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
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

?>