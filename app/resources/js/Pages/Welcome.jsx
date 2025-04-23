import { Head } from '@inertiajs/react'
import Layout from '@/Pages/Layout.jsx'

export default function Welcome({ appName }) {
  return (
    <Layout>
      <Head title="Welcome" />
      <h1>Bienvenido a {appName}</h1>
    </Layout>
  )
}