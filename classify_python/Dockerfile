FROM ubuntu:18.04
RUN set -xe \
    && apt-get update -y \
    && apt-get install -y python3-pip 
COPY ./requirements.txt /app/requirements.txt
WORKDIR /app
RUN pip3 install -r requirements.txt --no-cache
COPY ./src /app
EXPOSE 100
ENTRYPOINT ["python3"]
CMD ["index.py"]