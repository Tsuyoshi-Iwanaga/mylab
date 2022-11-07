# SageMaker Tutorial

## コンテナ起動
```
docker-compose up -d --build
```

## コンテナに入る
```
docker-compose exec python3 bash
```

## コンテナに入らずにpythonコードを実行する
```
docker-compose exec python3 python xxxxx.py
```

## Jupyter Notebookの起動
コンテナを起動した状態で下記のコマンドを実行するとコンテナ内で起動する
127.0.0.1:7777にブラウザでアクセスするとNotebookにアクセスできる
```
jupyter-lab --ip 0.0.0.0 --allow-root -b localhost
```