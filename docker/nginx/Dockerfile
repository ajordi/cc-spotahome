FROM nginx:1.15.8

# Install dependency for healthcheck
RUN    apt-get update \
    && apt-get install -y netcat \
    && apt-get clean

# Set working directory
WORKDIR /opt/app/
