LuLu: a skin for PukiWiki
====

レスポンシブでシンプルなPukiWiki用スキン。

特徴
----

* レスポンシブ
  * [Milligram](http://milligram.io/)を利用する
* シンプル
  * MenuBarを右側に配置した2カラムレイアウト

使い方
----

最終的に次のディレクトリ構造になります。

```
/path/to/PukiWiki/
├── default.ini.php
└── skin/
    └── lulu/
        ├── lulu.main.css
        └── lulu.skin.php
```

1. GitHubからスキンデータ一式をダウンロードする
        $ cd /path/to/PukiWiki/
        $ git clone git@github.com:fukuchiharuki/LuLu-a-skin-for-PukiWiki.git skin/lulu
1. ファイル``/path/to/PukiWiki/default.ini.php``の17行目を変更する

        define(’SKIN_FILE’, DATA_HOME . SKINK_DIR . ‘pukiwiki.skin.php’);
                                                     ↓
        define(’SKIN_FILE’, DATA_HOME . SKINK_DIR . ‘lulu/lulu.skin.php’);
