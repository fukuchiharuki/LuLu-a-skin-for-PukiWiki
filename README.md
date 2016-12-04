LuLu: a skin for PukiWiki
====

レスポンシブでシンプルなPukiWiki用スキン

デモ
----

[デモページ](http://fukuchiharuki.me/lulu/ "LuLu：レスポンシブでシンプルなPukiWiki用スキン")

![スクリーンショット](http://fukuchiharuki.me/lulu/index.php?plugin=attach&refer=LuLu&openfile=screenshot-v1.0.1.png "スクリーンショット")

特徴
----

* レスポンシブデザイン（Bootstrapを利用する）
* 右側にMenuBarを配置した2カラムレイアウト
* シンプル

使い方
----

最終的に次のディレクトリ構造になります。

```
/path/to/PukiWiki
├── default.ini.php
└── skin
    ├── assets
    │   ├── bootstrap
    │   │   ├── css
    │   │   ├── fonts
    │   │   └── js
    │   └── lulu
    │       ├── css
    │       ├── images
    │       └── js
    └── lulu.skin.php
```

1. lulu-1.*.tar.gz を[リリースページ](https://github.com/fukuchiharuki/LuLu-a-skin-for-PukiWiki/releases "Releases · fukuchiharuki/LuLu-a-skin-for-PukiWiki")からダウンロードする
1. ダウンロードした lulu-1.*.tar.gz を PukiWiki のホームディレクトリに解凍する  

        $ cd /path/to/PukiWiki/ 
        $ tar zxf lulu-1.0.tar.gz
1. Bootstrapの一式を[公式ページ](http://getbootstrap.com/getting-started/ "Getting started · Bootstrap")からダウンロードする
1. ディレクトリ bootstrap-3.* を /path/to/PukiWiki/skin/assets/bootstrap にコピーする
1. ファイル /path/to/PukiWiki/default.ini.php の17行目を変更する

        define(’SKIN_FILE’, DATA_HOME . SKINK_DIR . ‘pukiwiki.skin.php’);
                                                     ↓
        define(’SKIN_FILE’, DATA_HOME . SKINK_DIR . ‘lulu.skin.php’);
