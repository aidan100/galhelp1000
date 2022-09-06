FROM golang:1.19-alpine

WORKDIR /src

COPY go.mod ./
COPY go.sum ./
RUN go mod download

COPY *.go ./

RUN go build -o /total 

EXPOSE 91

CMD [ "/total" ]
