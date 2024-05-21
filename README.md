# VippsForLaravel

This package is for Laravel to accept Vipps/Mobilepay payments. Plug and play, you just need to register your business at MobilePay.dk/Vipps.no

# Usage
Put the following variables in your .env

VIPPS_CLIENT_ID=
VIPPS_CLIENT_SECRET=
VIPPS_MERCHANT_SERIAL_NUMBER=
VIPPS_SUBSCRIPTION_KEY=
VIPPS_CURRENCY="DKK"
VIPPS_API_URL=https://apitest.vipps.no #For testing
VIPPS_API_URL=https://api.vipps.no #For production
VIPPS_RETURN_URL=
VIPPS_WEBHOOK_ID=
VIPPS_WEBHOOK_SECRET=

To produce a webhook, just use the command 'php artisan vipps:webhook'
