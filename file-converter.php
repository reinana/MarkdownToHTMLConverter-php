<?php

// Composerのオートローダーを読み込む
require 'vendor/autoload.php';

// Parsedownクラスのインスタンスを作成
$parsedown = new Parsedown();

// 引数の数をチェックする
if ($argc !== 4) {
    echo "Usage: php file-converter.php markdown inputfile.md outputfile.html\n";
    exit(1);
}

// 引数から入力ファイル名と出力ファイル名を取得
$command = $argv[1];
$inputFileName = $argv[2];
$outputFileName = $argv[3];

// コマンドがmarkdownであることを確認
if ($command !== "markdown") {
    echo "Unsupported command. Use 'markdown'.\n";
    exit(1);
}

// 入力ファイルを読み込む
$markdownContent = file_get_contents($inputFileName);
if ($markdownContent === false) {
    echo "Failed to open input file: $inputFileName\n";
    exit(1);
}

// マークダウンをHTMLに変換
$htmlContent = $parsedown->text($markdownContent);

// 変換したHTMLを出力ファイルに保存
if (file_put_contents($outputFileName, $htmlContent) === false) {
    echo "Failed to write output file: $outputFileName\n";
    exit(1);
}

echo "Conversion completed successfully. Output file: $outputFileName\n";
