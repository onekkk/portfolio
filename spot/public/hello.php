<?php

// Smartyクラスを読み込む
require_once("../smarty/libs/Smarty.class.php");

// Smartyのインスタンスを生成
$smarty_obj = new Smarty();

// テンプレートディレクトリとコンパイルディレクトリを読み込む
$smarty_obj->setTemplateDir(__DIR__.'/../templates/');
$smarty_obj->setCompileDir(__DIR__.'/../templates_c/');

// assignメソッドを使ってテンプレートに渡す値を設定
$smarty_obj->assign("name", "World");

// テンプレートを表示する
$smarty_obj->display("hello.tpl");
