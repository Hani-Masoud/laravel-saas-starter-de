#!/bin/bash

docker-compose down
echo "🚀 Starting containers..."
docker-compose up -d

echo "✅ Build complete."