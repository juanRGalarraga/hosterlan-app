import { Head } from '@inertiajs/react'
import Layout from '@/pages/layout';
import { useState } from 'react'

interface Props { 
  appName: string;
}

export default function Wellcome({ appName }: Props) {

  return (
    <Layout>
      <Head title="Wellcome" />
      <h1>Bienvenido a {appName}</h1>
      <h2>Inertia + React + TypeScript</h2>            
    </Layout>
  )
}