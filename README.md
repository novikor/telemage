# Telemage

[![tests](https://github.com/novikor/telemage/actions/workflows/tests.yml/badge.svg)](https://github.com/novikor/telemage/actions/workflows/tests.yml)

Telemage is a multi-tenant integration service connecting Magento 2 stores with Telegram, keeping channel orchestration outside Magento via a [connector module](https://github.com/novikor/telemage-magento).

## Stack

* PHP 8.4 / Laravel 12 & Filament 4
* Nutgram for Telegram Bot API integration
* Redis for integration state and customer tokens
* Magento REST & GraphQL APIs (JWE via `web-token/jwt-framework`)

## Local Development

Requires **Warden** for local containers and **ngrok** to tunnel Telegram webhooks (`APP_URL`).

* `warden env up -d` - Start environment containers
* `warden shell -c "composer setup"` - Install dependencies and initialize app
* `ngrok http https://telemage.test` - Tunnel local domain for Telegram webhooks
* `warden shell -c "composer dev"` - Start server, queue, logs, and Vite
* `warden shell -c "composer test"` - Run automated test suite (Pest)

Quality checks: Pest, Larastan, Pint, Rector, GrumPHP.
