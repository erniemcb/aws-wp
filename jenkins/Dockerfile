FROM ubuntu
# if we want to install via apt
RUN apt-get update && apt-get install curl wget sudo -y
RUN wget -q -O - https://pkg.jenkins.io/debian/jenkins-ci.org.key | apt-key add -
RUN echo deb http://pkg.jenkins.io/debian-stable binary/ > /etc/apt/sources.list.d/jenkins.list
RUN apt-get update && apt-get install jenkins git jq php7.0-cli pylint -y
EXPOSE 8080
COPY start /usr/local/bin
CMD ["start"]
