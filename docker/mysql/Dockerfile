# Use official MySQL image
FROM mysql:8.0

# Set timezone
ENV TZ=UTC

# Copy custom configuration
COPY my.cnf /etc/mysql/conf.d/my.cnf

# Set recommended permissions
RUN chmod 0444 /etc/mysql/conf.d/my.cnf

CMD ["mysqld"]