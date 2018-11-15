# https://www.tohuandkonsome.site/entry/2018/09/15/165656#Docker%E3%82%92%E6%BA%96%E5%82%99%E3%81%99%E3%82%8B
FROM node:9.11-alpine

# shadowパッケージをインストールして
# Nuxt.jsを実行するユーザーappを作成
RUN apk --update add shadow &&\
    rm -rf /var/cache/apk/*
# 環境変数HOMEにappユーザーのホームディレクトリを指定し、
ENV HOME=/home

# ホスト環境のpackage.jsonをコンテナ内にコピーする
COPY ./src/package.json $HOME/nuxt/
# ファイルの権限もappユーザーにしておく
# RUN chown -R app:app $HOME/*

# 外部からの通信を受け入れるための設定
ENV HOST 0.0.0.0

# ホームディレクトリ/nuxt下でnpm installして終了
WORKDIR $HOME/nuxt
RUN npm install


# ユーザーをつくる方法だと、エラーを解決できなかったので、諦め
# # https://www.tohuandkonsome.site/entry/2018/09/15/165656#Docker%E3%82%92%E6%BA%96%E5%82%99%E3%81%99%E3%82%8B
# FROM node:9.11-alpine

# # shadowパッケージをインストールして
# # Nuxt.jsを実行するユーザーappを作成
# RUN apk --update add shadow &&\
#     rm -rf /var/cache/apk/* &&\
#     useradd --user-group --create-home app
# # 環境変数HOMEにappユーザーのホームディレクトリを指定し、
# ENV HOME=/home/app

# # ホスト環境のpackage.jsonをコンテナ内にコピーする
# COPY ./src/package.json $HOME/nuxt/
# # ファイルの権限もappユーザーにしておく
# RUN chown -R app:app $HOME/*

# # 外部からの通信を受け入れるための設定
# ENV HOST 0.0.0.0
# USER app

# # ホームディレクトリ/nuxt下でnpm installして終了
# WORKDIR $HOME/nuxt
# RUN npm install