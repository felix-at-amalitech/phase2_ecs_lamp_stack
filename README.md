# Ghana Healthy Fruits - Cloud-Native LAMP Stack

A production-ready, containerized LAMP stack application showcasing healthy Ghanaian fruits, deployed on AWS using modern DevOps practices and infrastructure as code.

## 🏗️ Architecture Overview

This project demonstrates a cloud-native implementation of a traditional LAMP stack using:

- **Frontend**: PHP 8.3 with Apache web server
- **Database**: AWS RDS MySQL 8.0 with automated backups
- **Container Orchestration**: AWS ECS Fargate with Application Load Balancer
- **Infrastructure**: AWS Copilot CLI for infrastructure as code
- **Security**: AWS Secrets Manager for credential management
- **Monitoring**: CloudWatch logs and metrics
- **Scaling**: Auto-scaling based on CPU utilization

## 🚀 Live Application

**Production URL**: <http://ghana--publi-hm4pq9k3kx94-1975257123.eu-west-1.elb.amazonaws.com/>

## 📁 Project Structure

```
phase2_ecs_lamp_stack/
├── lamp_app/
│   ├── app/
│   │   ├── index.php          # Main application with fruit catalog
│   │   └── health.php         # Health check endpoint
│   ├── sql/
│   │   └── init.sql          # Database schema and seed data
│   ├── Dockerfile            # Multi-stage container build
│   └── compose.yml           # Local development environment
├── copilot/
│   └── php-apache/
│       └── manifest.yml      # AWS Copilot service configuration
└── README.md
```

## 🛠️ Technology Stack

### Application Layer

- **PHP 8.3**: Latest stable PHP with performance improvements
- **Apache 2.4**: Web server with mod_rewrite enabled
- **PDO MySQL**: Secure database connectivity with prepared statements
- **Bootstrap 5.3**: Responsive UI framework
- **Inter Font**: Modern typography from Google Fonts

### Infrastructure Layer

- **AWS ECS Fargate**: Serverless container orchestration
- **Application Load Balancer**: High availability and SSL termination
- **AWS RDS MySQL**: Managed database with automated backups
- **AWS Secrets Manager**: Secure credential storage
- **CloudWatch**: Centralized logging and monitoring
- **AWS Copilot**: Infrastructure as code and deployment automation

### Development Tools

- **Docker**: Containerization and local development
- **Docker Compose**: Multi-container local environment
- **Git**: Version control and collaboration

## 🏃‍♂️ Quick Start

### Prerequisites

- Docker and Docker Compose
- AWS CLI configured
- AWS Copilot CLI installed
- Git

### Local Development

1. **Clone the repository**

   ```bash
   git clone <repository-url>
   cd phase2_ecs_lamp_stack/lamp_app
   ```

2. **Start local environment**

   ```bash
   docker-compose up --build
   ```

3. **Access application**
   - Application: <http://localhost>
   - Health check: <http://localhost/health.php>

### Production Deployment

1. **Initialize Copilot application**

   ```bash
   copilot app init ghana-healthy-fruits
   ```

2. **Deploy environment**

   ```bash
   copilot env init --name dev
   copilot env deploy --name dev
   ```

3. **Create secrets**

   ```bash
   copilot secret init --name DB_USER
   copilot secret init --name DB_PASS
   ```

4. **Deploy service**

   ```bash
   copilot svc deploy --name php-apache --env dev
   ```

## 🗄️ Database Schema

### Fruits Table

```sql
CREATE TABLE fruits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    season VARCHAR(50) NOT NULL,
    nutritional_info TEXT NOT NULL,
    color VARCHAR(20) NOT NULL
);
```

### Sample Data

The application includes 13 popular Ghanaian fruits with:

- Seasonal availability information
- Nutritional benefits
- Color-coded visual elements

## 🔧 Configuration Management

### Environment Variables

| Variable | Description | Example |
|----------|-------------|---------|
| `DB_HOST` | Database endpoint | `fruits-db.region.rds.amazonaws.com` |
| `DB_NAME` | Database name | `fruits_db` |
| `DB_USER` | Database username | Stored in AWS Secrets Manager |
| `DB_PASS` | Database password | Stored in AWS Secrets Manager |

### AWS Secrets Manager

Sensitive credentials are stored securely:

- `/copilot/ghana-healthy-fruits/dev/secrets/DB_USER`
- `/copilot/ghana-healthy-fruits/dev/secrets/DB_PASS`

## 📊 Monitoring and Observability

### Health Checks

- **Endpoint**: `/health.php`
- **Interval**: 10 seconds
- **Timeout**: 5 seconds
- **Healthy threshold**: 2 consecutive successes
- **Unhealthy threshold**: 3 consecutive failures

### Logging

- **CloudWatch Logs**: Centralized application and access logs
- **Log Group**: `/copilot/ghana-healthy-fruits-dev-php-apache`
- **Retention**: 30 days (configurable)

### Metrics

- **CPU Utilization**: Auto-scaling trigger at 70%
- **Memory Usage**: Monitored for optimization
- **Request Count**: Load balancer metrics
- **Response Time**: Application performance tracking

## 🔄 Auto Scaling Configuration

```yaml
scaling:
  min_replicas: 2      # Minimum instances for high availability
  max_replicas: 4      # Maximum instances for cost control
  target_cpu: 70       # CPU threshold for scaling decisions
```

## 🔒 Security Best Practices

### Application Security

- **Input Sanitization**: All user inputs sanitized with `htmlspecialchars()`
- **Prepared Statements**: SQL injection prevention
- **Error Handling**: Graceful error handling without information disclosure
- **HTTPS Ready**: Load balancer configured for SSL termination

### Infrastructure Security

- **VPC Isolation**: Private subnets for database and application
- **Security Groups**: Least privilege network access
- **IAM Roles**: Fine-grained permissions for ECS tasks
- **Secrets Management**: No hardcoded credentials

## 🚀 Performance Optimizations

### Application Level

- **PHP OPcache**: Bytecode caching enabled
- **Connection Pooling**: Efficient database connections
- **Static Asset Optimization**: CDN-ready static resources
- **Gzip Compression**: Reduced bandwidth usage

### Infrastructure Level

- **Fargate**: Right-sized compute resources (512 CPU, 1024 MB RAM)
- **Application Load Balancer**: Efficient request distribution
- **Multi-AZ Deployment**: High availability across availability zones
- **Auto Scaling**: Dynamic resource allocation

## 🔄 CI/CD Pipeline (Recommended)

```yaml
# Example GitHub Actions workflow
name: Deploy to AWS
on:
  push:
    branches: [main]
jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      - name: Configure AWS credentials
        uses: aws-actions/configure-aws-credentials@v2
      - name: Deploy with Copilot
        run: copilot svc deploy --name php-apache --env dev
```

## 🐛 Troubleshooting

### Common Issues

1. **Container Exit Errors**

   ```bash
   # Check logs
   copilot svc logs --name php-apache --env dev --follow
   
   # Check service status
   copilot svc status --name php-apache --env dev
   ```

2. **Database Connection Issues**
   - Verify RDS endpoint in environment variables
   - Check security group rules
   - Validate secrets in AWS Secrets Manager

3. **Health Check Failures**
   - Ensure `/health.php` returns HTTP 200
   - Check application startup time
   - Verify container port configuration

### Debugging Commands

```bash
# Service logs
copilot svc logs --name php-apache --env dev

# Service status
copilot svc status --name php-apache --env dev

# Environment information
copilot env show --name dev

# Task execution
copilot task run --image <image-uri> --command "php -v"
```

## 📈 Cost Optimization

### Current Configuration Costs (Estimated)

- **ECS Fargate**: ~$25/month (2 tasks, 0.5 vCPU, 1GB RAM)
- **Application Load Balancer**: ~$16/month
- **RDS MySQL**: ~$15/month (db.t3.micro)
- **CloudWatch Logs**: ~$2/month
- **Total**: ~$58/month

### Optimization Strategies

- Use Spot instances for non-production environments
- Implement scheduled scaling for predictable traffic patterns
- Optimize container resource allocation based on metrics
- Use Reserved Instances for predictable workloads

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit changes (`git commit -m 'Add amazing feature'`)
4. Push to branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- AWS Copilot team for excellent documentation
- PHP community for continuous improvements
- Bootstrap team for responsive design framework
- Ghana's rich agricultural heritage for inspiration

---

**Maintained by**: Felix Frimpong
**Last Updated**: July 2025
**Version**: 1.0.0
