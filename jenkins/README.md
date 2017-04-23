Jenkins docker image
=========================
I decided to write my own simple Dockerfile to run a prestine Jenkins instance within Docker.
Use this 
```
docker build -t jenkins .
docker run -p 8080:8080 --name my-ci jenkins
```

Login to your instance on port 8080 and use the initial password you can get from the docker container logs.
```
docker logs my-ci
```

If you want Jenkins to create docker containers, you will need to add the jenkins user to the docker group and allow the jenkins user also to ssh to the swarm manager and invoke docker swarm commands. Basically do this
```
sudo adduser jenkins
sudo adduser jenkins docker
sudo su - jenkins
ssh-keygen
cat .ssh/id_rsa.pub > .ssh/authorized_keys
docker cp .ssh my-ci:/var/lib/jenkins/
docker exec -ti my-ci chown jenkins: /var/lib/jenkins/ -R

#try ssh'ing to the swarm manager and do docker stuff
docker exec -ti my-ci ssh ${node} "docker service ls"
```
