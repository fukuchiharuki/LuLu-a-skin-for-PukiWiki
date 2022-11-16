# LuLu - a skin for PukiWiki

シンプルでレスポンシブな[PukiWiki](https://pukiwiki.osdn.jp/)用スキンです。

[>> DEMO](https://wiki.fukuchiharuki.me/)

すっきりとしてシンプルなスキンを目指しました。  
「lulu」はハワイ語で「静かな」という意味だそうです。

特徴
----

* シンプル
  * 1カラムレイアウト
* レスポンシブ
  * [Material Design Lite](https://getmdl.io/)ベース

また、CDNの外部のリソースにリンクするのでスキンのインストールが容易です。  

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

        define('SKIN_FILE', DATA_HOME . SKINK_DIR . 'pukiwiki.skin.php');
                                                     ↓
        define('SKIN_FILE', DATA_HOME . SKINK_DIR . 'lulu/lulu.skin.php');

### gitとは何ですか？

スキンデータ一式は[Releaseページ](https://github.com/fukuchiharuki/LuLu-a-skin-for-PukiWiki/releases)からダウンロードすることもできます。zipかtar.gzを解凍して、インストール手順冒頭のディレクトリ構造のように手動で配置してください。
