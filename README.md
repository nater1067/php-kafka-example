docker-compose -v: docker-compose version 1.18.0, build 8dd22a9
docker -v: Docker version 17.12.0-ce, build c97c6d6

Had to use docker-compose run to make this work

docker-compose run -p32181:32181 -d zookeeper

docker ps, get the CONTAINER ID of zookeeper

The Docker Host IP = docker exec -it ZOOKEEPERCONTAINERID /sbin/ip route|awk '/default/ { print $3 }'

Set this host ip to the hostname of the KAFKA_ZOOKEEPER_CONNECT environment variable of the kafka container. Leave the port the same.

docker-compose run -p29092:29092 -d kafka

Run php index.php, keep an eye on the logs

docker exec KAFKACONTAINERID  \
  bash -c "seq 42 | kafka-console-producer --request-required-acks 1 --broker-list localhost:29092 --topic test && echo 'Produced 42 messages.'"
  
You'll notice messages appearing in the index.php stdout