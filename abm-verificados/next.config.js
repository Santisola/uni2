/** @type {import('next').NextConfig} */
const nextConfig = {
  reactStrictMode: true,
  env: {
    API_URL: 'http://localhost/uni2/api/public/api',
    API_IMAGEN: 'http://localhost/uni2/api/',
    NEXT_PUBLIC_API_IMAGEN: 'http://localhost/uni2/api/'
  },
  images: {
    domains: ['localhost'],
    path: 'http://localhost/uni2/api/public/api'
  }
}

module.exports = nextConfig
