LuLu: a skin for PukiWiki
====

シンプルでレスポンシブな[PukiWiki](https://pukiwiki.osdn.jp/)用スキン。

- [デモ](http://fukuchiharuki.me/lulu/)

「lulu」はハワイ語で「静かな」という意味だそうです。やかましくない、シンプルなスキンを目指しました。

特徴
----

* シンプル
  * 1カラムレイアウト
* レスポンシブ
  * [Material Design Lite](https://getmdl.io/)を利用する

v3で[Material Design Lite](https://getmdl.io/)を利用するようにしました。外部のリソースをCDNからリンクするのでスキンのインストールが容易です。

インストール
----

最終的に次のディレクトリ構造になります。

```
/path/to/PukiWiki/
├── default.ini.php
└── skin/
    └── lulu/
        ├── lulu.main.css
        └── assets/
```

1. GitHubからスキンデータ一式をダウンロードする

        $ cd /path/to/PukiWiki/
        $ git clone https://github.com/fukuchiharuki/LuLu-a-skin-for-PukiWiki.git skin/lulu
1. ファイル``/path/to/PukiWiki/default.ini.php``の17行目を変更する

        define(’SKIN_FILE’, DATA_HOME . SKINK_DIR . ‘pukiwiki.skin.php’);
                                                     ↓
        define(’SKIN_FILE’, DATA_HOME . SKINK_DIR . ‘lulu/lulu.skin.php’);
