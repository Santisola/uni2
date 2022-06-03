/** @type {import('next').NextConfig} */
const nextConfig = {
  reactStrictMode: true,
  env: {
    API_URL: 'http://localhost/uni2/api/public/api',
    API_IMAGEN: 'http://localhost/uni2/api/',
    NEXT_PUBLIC_API_IMAGEN: 'http://localhost/uni2/api/',
    API_GOOGLE: 'AIzaSyCRGObGu19f5Z6C7gURKQeP5rF9lNAy3DA'
  },
  images: {
    domains: ['localhost'],
    path: 'http://localhost/uni2/api/public/api'
  }
}

module.exports = nextConfig
