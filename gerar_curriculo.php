<?php

require_once '../vendor/autoload.php';

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['nome'];
    $dataNascimento = $_POST['dataNascimento'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $experiencias = $_POST['experiencia'];
    $referencias = $_POST['referencia'];

    $dataNascimento = new DateTime($dataNascimento);
    $hoje = new DateTime();
    $idade = $hoje->diff($dataNascimento)->y;

    $phpWord = new PhpWord();

    $section = $phpWord->addSection();

    $section->addText('Currículo de ' . $nome);
    $section->addText('Email: ' . $email);
    $section->addText('Idade: ' . $idade . ' anos');
    $section->addText('Telefone: '. $telefone);
    $section->addText('Cidade/UF: '. $endereco);

    $section->addText('Experiências Profissionais:');
    foreach ($experiencias['cargo'] as $key => $cargo) {
        $empresa = isset($experiencias['empresa'][$key]) ? $experiencias['empresa'][$key] : '';
        $periodo = isset($experiencias['periodo'][$key]) ? $experiencias['periodo'][$key] : '';
        $section->addText('Cargo:' . $cargo . ', Empresa:' . $empresa . ', Período:' . $periodo);
    }

    $section->addText('Referências Pessoais:');
    foreach ($referencias['nome'] as $key => $nomeRef) {
        $contatoRef = isset($referencias['contato'][$key]) ? $referencias['contato'][$key] : '';
        $section->addText('- Nome:' . $nomeRef . ' - Contato: ' . $contatoRef);
    }

    $filename = 'curriculo_' . strtolower(str_replace(' ', '_', $nome)) . '.docx';
    $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save($filename);

    header("Content-Description: File Transfer");
    header('Content-Disposition: attachment; filename=' . $filename);
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Length: ' . filesize($filename));
    readfile($filename);

    unlink($filename);
    exit;
}
?>