setup: down up install-deps wait-db db-migrate

# Stop containers
down:
	@echo "🛑 Stopping containers..."
	docker compose down

# Build and Start containers
up:
	@echo "🚀 Building and Starting containers..."
	docker compose up -d --build

# Install Dependencies
install-deps:
	@echo "📦 Installing Backend Dependencies (Composer)..."
	docker exec clarify_php composer install --optimize-autoloader
	@echo "📦 Installing Frontend Dependencies (NPM)..."
	docker exec clarify_node npm install

# Wait for Database
wait-db:
	@echo "⏳ Waiting for Database..."
	@sleep 10

# Database Migration
db-migrate:
	@echo "🗄️ Running Database Migrations..."
	docker exec clarify_php php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration
	docker exec clarify_php php bin/console doctrine:fixtures:load --no-interaction
