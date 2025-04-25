import Layout from '@/pages/layout';

interface Props { 
  appName: string;
}

export default function Wellcome({ appName }: Props) {
  return (
    <Layout>
        <h1>Bienvenido a {appName}</h1>
        <h2>Inertia + React + TypeScript</h2>            
    </Layout>
  )
}